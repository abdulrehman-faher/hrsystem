<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_id')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->string('title');
            $table->string('institute_name')->nullable();
            $table->string('marks_obtained')->nullable();
            $table->string('division_grade')->nullable();
            $table->string('year_completed')->nullable();
            $table->string('campus_address')->nullable();
            $table->string('attachment')->nullable();
            $table->string('file_ext')->nullable();

            $table->string('user_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('education_details');
    }
}
