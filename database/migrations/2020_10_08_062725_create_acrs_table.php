<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acrs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained();
            $table->date('period_from')->nullable();
            $table->date('period_to')->nullable();
            $table->string('appointment')->nullable();
            $table->date('appointment_date')->nullable();
            $table->string('grade')->nullable();

            $table->date('period_served_io_from')->nullable();
            $table->date('period_served_io_to')->nullable();
            $table->date('period_served_sro_from')->nullable();
            $table->date('period_served_sro_to')->nullable();

            /** Part 3 
             * Reporting Officer's Recommendations
             */

            $table->text('io_remarks_strong_points')->nullable(); // Initiating Officer
            $table->text('io_remarks_weak_area')->nullable();
            $table->text('io_remarks_demo_performance')->nullable();
            $table->text('special_achievements')->nullable();
            $table->unsignedBigInteger('io_performance_appraisal_id')->nullable();
            $table->integer('io_performance_appraisal_score')->nullable();
            $table->unsignedBigInteger('io_employee_id')->nullable();
            $table->string('io_name')->nullable();
            $table->string('io_appointment')->nullable();
            $table->date('io_sign_date')->nullable();
            $table->date('io_emp_sign_date')->nullable();

            $table->string('sro_remarks', '3000')->nullable();
            $table->unsignedBigInteger('sro_performance_appraisal_id')->nullable();
            $table->integer('sro_performance_appraisal_score')->nullable();
            $table->unsignedBigInteger('sro_employee_id')->nullable(); // SRO = Senio Reporting Officer
            $table->string('sro_name')->nullable();
            $table->string('sro_appointment')->nullable();
            $table->date('sro_sign_date')->nullable(); // SRO = Senio Reporting Officer
            $table->date('sro_emp_sign_date')->nullable();

            $table->foreignId('user_id')->constrained();
            $table->unsignedBigInteger('authorized_by')->nullable(); // Authentication (HR)
            $table->date('authorized_by_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acrs');
    }
}
