<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();

            // User details
            $table->string('name');
            $table->string('cnic')->unique();
            $table->string('place_of_birth')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_profession')->nullable();
            $table->string('email')->nullable();
            $table->string('gender')->nullable();
            $table->timestamp('dob')->nullable()->default(null);;
            $table->string('dob_in_words')->nullable();
            $table->string('years_of_experience')->nullable();
            $table->string('phone_number')->nullable();
            /** start new fields */
            $table->string('mobile_number')->nullable();
            $table->string('cv')->nullable();
            $table->string('refered_by_name')->nullable();
            $table->string('refered_by_id')->nullable();
            /** end new fields */
            $table->unsignedBigInteger('job_type_id')->nullable(); // job_types table foreign key
            $table->unsignedBigInteger('type_of_contract_id')->nullable(); // type of job he held in the army

            /** armed forces specific fields */
            $table->string('post')->nullable();
            $table->string('rank')->nullable();
            $table->string('arm')->nullable();
            $table->string('last_appointment')->nullable();
            $table->timestamp('enrollment_date')->nullable()->default(null);
            $table->timestamp('sos_date')->nullable()->default(null); // struck of strenth
            $table->timestamp('sod_date')->nullable()->default(null); // struck of duty

            // Misc information
            $table->string('height')->nullable();
            $table->string('religion')->nullable();
            $table->string('sect')->nullable();
            $table->string('caste')->nullable();
            $table->string('service_period')->nullable();
            $table->string('referee_name')->nullable();
            $table->string('referee_address')->nullable();

            // Address fields
            $table->string('address01')->nullable();
            $table->string('street_mohallah')->nullable();
            $table->string('city')->nullable();
            $table->string('tehsil')->nullable();
            $table->string('district')->nullable();
            $table->string('post_office')->nullable();
            $table->string('police_station')->nullable();
            $table->string('railway_station')->nullable();
            $table->string('bus_stop')->nullable();

            $table->boolean('short_listed')->default(0);
            $table->boolean('is_employeed')->default(0);
            $table->string('folder_name')->nullable();
            $table->foreignId('club_id')->constrained()->nullable();
            $table->unsignedBigInteger('created_by');
            $table->timestamps();

            $table->index(['cnic', 'name', 'job_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
