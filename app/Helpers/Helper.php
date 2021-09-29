<?php // Code within app\Helpers\Helper.php



namespace App\Helpers;



use Carbon\Carbon;

use Illuminate\Support\Arr;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;



class Helper

{

    public static function getFileNameSeparator($separator = '_')
    {
        return $separator;
    }

    public static function activeClass($variable, $value, $cls = 'active')
    {
        return isset($variable) && $variable == $value ? $cls : '';
    }

    public static function allowedMimeTypes($types = [])
    {
        return [
            'image/jpeg',
            'image/jpg',
            'image/gif',
            'image/png',
            'image/bmp',
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ];
    }



    public static function allowedMimesTypes()
    {
        return 'jpeg,bmp,png,gif,pdf,jpg,docx';
    }

    public static function allowedFileSize()
    {
        return 2048; // size in Killobytes
    }

    public static function allowedExtensions()
    {
        return  ['jpeg', 'gif', 'png', 'bmp', 'jpg', 'JPG'];
    }

    public static function createFolderName($id, $name)
    {
        return $id . Helper::getFileNameSeparator() . Carbon::now()->timestamp  . Helper::getFileNameSeparator() . Str::snake($name);
    }

    public static function imagesPath($folder_name)
    {
        return 'images' . DIRECTORY_SEPARATOR . 'applications' . DIRECTORY_SEPARATOR . $folder_name;
    }

    /**
     * Return Response in JSON format.
     *
     * @param  Boolean  $success
     * @return Object $data
     */
    public static function jsonResponse($success, $data)
    {
        return response()->json(['success' => $success, 'data' => $data]);;
    }

    public static function showLessMoreText($text, $maxChar = 100)
    {
        $html = '';
        if (strlen($text) <= $maxChar) {
            $html = "<div>{$text}</div>";
        } else {
            $html .= '<span class="short-text">' . substr($text, 0, $maxChar) . '</span>';
            $html .= '<span class="long-text">' . substr($text, $maxChar) . '</span>';
            $html .= '<span class="text-dots">....</span>';
            $html .= '<span class="show-more-button" data-more="0">Read More</span>';
        }
        echo $html;
    }

    public static function parseDate($date, $format = 'Y-m-d')
    {
        return Carbon::parse($date)->format($format);
    }

    public static function uploadImage($request, $filename, $folder_name)
    {
        if ($request->hasFile($filename) && in_array($request->$filename->getClientMimeType(), Helper::allowedMimeTypes())) {
            $current_timestamp = Carbon::now()->timestamp;
            $file_name = $request->$filename->getClientOriginalName();
            // $name = $current_timestamp . '-' . $file_name;
            $name = $current_timestamp . Helper::getFileNameSeparator() . $file_name;
            $request->$filename->storeAs(Helper::imagesPath($folder_name), $name, 'public');
            return $name;
        }
        return null;
    }

    public static function attachImage($request, $folder_name, $resource, $title, $files = 'attachments')
    {
        if ($request->hasFile($files)) {
            $user_id = auth()->user()->id;

            foreach ($request->$files as $file) {
                $filename = $file->getClientOriginalName();
                // $filename = Carbon::now()->timestamp . '-' . $filename;
                $filename = Carbon::now()->timestamp . Helper::getFileNameSeparator() . $filename;
                $file->storeAs(Helper::imagesPath($folder_name), $filename, 'public');
                $resource->images()->create([
                    'file_name' => $filename,
                    'size' => $file->getSize(),
                    'title' => $title,
                    'user_id' => $user_id,
                ]);
            }
        }
    }

    public static function deleteImage($folder_name, $filename)

    {

        Storage::delete(DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'applications' . DIRECTORY_SEPARATOR . $folder_name . DIRECTORY_SEPARATOR . $filename);
    }



    public static function imgStoragePath($folder_name, $filename)

    {

        return asset('storage' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'applications' . DIRECTORY_SEPARATOR . $folder_name  . DIRECTORY_SEPARATOR . $filename);
    }



    public function relationships()

    {

        return ['wife', 'mother', 'father', 'sons', 'daughters', 'brothers', 'sisters'];
    }



    public static function getEnumValues($table, $column)
    {

        $type = DB::select(DB::raw("SHOW COLUMNS FROM $table WHERE Field = '{$column}'"))[0]->Type;

        preg_match('/^enum\((.*)\)$/', $type, $matches);

        $enum = array();

        foreach (explode(',', $matches[1]) as $value) {

            $v = trim($value, "'");

            $enum = Arr::add($enum, $v, Str::ucfirst($v));
        }

        return $enum;
    }



    public static function normalCase($str, $delimiter = '_')
    {

        return ucwords(str_replace($delimiter, " ", $str));
    }

    public static function storeAsPath($folder_name)
    {
        return 'images' . DIRECTORY_SEPARATOR . 'applications' . DIRECTORY_SEPARATOR . $folder_name;
    }
}
