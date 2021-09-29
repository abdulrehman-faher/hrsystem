<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_id')->nullable();
            $table->unsignedBigInteger('interview_id')->nullable();
            $table->unsignedBigInteger('type_of_contract_id')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('club_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('job_type_id')->nullable(); // job_types table foreign key

            $table->string('name');
            $table->string('employee_number')->nullable();
            // $table->string('employee_scale')->nullable();
            $table->string('cnic')->unique();
            $table->timestamp('dob')->nullable();;
            $table->string('dob_in_words')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_profession')->nullable();
            $table->string('email')->nullable();
            $table->string('gender')->nullable();
            $table->string('years_of_experience')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('photograph')->nullable();
            $table->string('grade')->nullable(); // appoitment appt
            $table->string('appointment')->nullable(); // appoitment appt
            $table->date('appointment_date')->nullable(); // appoitment appt
            $table->date('joining_date')->nullable();
            $table->date('contract_end_date')->nullable();
            $table->date('retirement_date')->nullable();
            $table->string('current_salary')->nullable();
            $table->string('previous_salary')->nullable();

            /** armed forces specific fields */
            $table->string('post')->nullable();
            $table->string('rank')->nullable();
            $table->string('arm')->nullable();
            $table->string('last_appointment')->nullable();
            $table->timestamp('enrollment_date')->nullable();
            $table->timestamp('sos_date')->nullable(); // struck of strenth
            $table->timestamp('sod_date')->nullable(); // struck of duty


            $table->string('height')->nullable();
            $table->string('religion')->nullable();
            $table->string('sect')->nullable();
            $table->string('caste')->nullable();
            $table->string('service_period')->nullable();
            $table->string('referee_name')->nullable();
            $table->string('referee_address')->nullable();
            // // $table->timestamp('enrolled_at_club')->nullable();;
            // // $table->timestamp('on_date')->nullable();;

            // Address fields
            $table->string('address01')->nullable();
            $table->string('street_mohallah')->nullable();
            $table->string('city')->nullable();
            $table->string('tehsil')->nullable();
            $table->string('district')->nullable(); // district_policital_agency
            $table->string('post_office')->nullable();
            $table->string('police_station')->nullable();
            $table->string('railway_station')->nullable();
            $table->string('bus_stop')->nullable();
            $table->string('folder_name')->nullable();

            $table->unsignedBigInteger('user_id')->constrained()->onDelete('cascade');
            $table->boolean('active')->default(1);
            $table->timestamps();

            $table->index(['cnic', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
