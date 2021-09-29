<?php

namespace App\Models;

use App\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Spatie\Activitylog\Traits\LogsActivity;


class Application extends Model
{
    use LogsActivity, HasFactory;
    protected $guarded = [];
    // protected $table = 'applications_test';
    protected static $logName = 'application';
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function qualification()
    {
        return $this->hasMany(EducationDetail::class)->orderBy('id', 'desc');
    }

    public function workHistory()
    {
        return $this->hasMany(WorkHistory::class)->orderBy('id', 'desc');
    }

    public function jobType()
    {
        return $this->belongsTo(JobType::class, 'job_type_id');
    }

    public static function importToDB()
    {
        $path = resource_path('pending_files' . DIRECTORY_SEPARATOR . '*.csv');
        $files = glob($path);

        foreach ($files as $file) {
            dump($file);
        }
    }

    public static function createApplication(array $fields, Request $request)
    {
        $user = auth()->user();
        $fields['created_by'] = $user->id;
        $fields['club_id'] = $user->club_id;

        $cv = null;

        if ($request->hasFile('cv')) {
            $current_timestamp = Carbon::now()->timestamp;
            $cv = $current_timestamp . '-' . $request->cv->getClientOriginalName();
        }

        $fields['cv'] = $cv;

        $application = Self::create($fields);

        $folder_name = Helper::createFolderName($application->id, $application->name);
        $application->folder_name = $folder_name;
        $application->save();

        if ($request->hasFile('cv')) {
            $request->cv->storeAs(Helper::storeAsPath($folder_name), $cv, 'public');
        }

        return $application;
    }

    public function createApplicantJobs(Application $application, Request $request)
    {
        $user_id = auth()->user()->id;
        $folder_name = '';
        foreach ($request->title as $key => $value) {
            if (!trim($value)) {
                continue;
            }

            $data = [
                'application_id' => $application->id,
                'title' => $value,
                'institute_name' => isset($request->institute_name[$key]) ? $request->institute_name[$key] : null,
                'marks_obtained' => isset($request->marks_obtained[$key]) ? $request->marks_obtained[$key] : null,
                'division_grade' => isset($request->division_grade[$key]) ? $request->division_grade[$key] : null,
                'year_completed' => isset($request->year_completed[$key]) ? $request->year_completed[$key] : null,
                'campus_address' => isset($request->campus_address[$key]) ? $request->campus_address[$key] : null,
                'user_id' => $user_id,
            ];

            if (isset($request->file('education_images')[$key])) {
                $file = $request->file('education_images')[$key];
                if (in_array($file->getClientMimeType(), Helper::allowedMimeTypes())) {

                    $current_timestamp = Carbon::now()->timestamp;
                    $name = $current_timestamp . '-' . $file->getClientOriginalName();
                    $file->storeAs('images/applications/' . $folder_name, $name, 'public');
                    $data['attachment'] = $name;
                    $data['file_ext'] = $file->getClientOriginalExtension();
                }
            }

            EducationDetail::create($data);
        }
    }

    public function createApplicantWorkHistory(Application $application, Request $request)
    {
        $user_id = auth()->user()->id;
        $folder_name = '';
        foreach ($request->job_title as $key => $value) {
            if (!trim($value)) {
                continue;
            }

            $data = [
                'application_id' => $application->id,
                'job_title' => $value,
                'company_name' => isset($request->company_name[$key]) ? $request->company_name[$key] : null,
                'company_address' => isset($request->company_address[$key]) ? $request->company_address[$key] : null,
                'start_date' => isset($request->start_date[$key]) ? $request->start_date[$key] : null,
                'end_date' => isset($request->end_date[$key]) ? $request->end_date[$key] : null,
                'user_id' => $user_id,
            ];

            if (isset($request->file('workhistory_images')[$key])) {
                $file = $request->file('workhistory_images')[$key];
                if (in_array($file->getClientMimeType(), Helper::allowedMimeTypes())) {

                    $current_timestamp = Carbon::now()->timestamp;
                    $name = $current_timestamp . '-' . $file->getClientOriginalName();
                    $file->storeAs('images/applications/' . $folder_name, $name, 'public');
                    $data['attachment'] = $name;
                    $data['file_ext'] = $file->getClientOriginalExtension();
                }
            }

            WorkHistory::create($data);
        }
    }

    public static function writeChunksInFile($filePath, $chunk_size = 50, $destination_path = null)
    {
        // dont delete those lines
        // $path = resource_path('pending_files' . DIRECTORY_SEPARATOR . '*.csv');
        // $files = glob($path);
        $file = file($filePath);
        // $headers = $file[0];
        $data = array_slice($file, 1);
        $chunks = array_chunk($data, $chunk_size);
        $path = $destination_path ? $destination_path : resource_path('pending_files');

        if (!File::exists($path)) {
            File::makeDirectory($path);
        }

        foreach ($chunks as $key => $part) {
            $fileName = $path . DIRECTORY_SEPARATOR . date('y-m-d-H-m-s') . $key . '.csv';
            file_put_contents($fileName, $part);
        }
    }
}
