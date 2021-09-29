<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained();
            $table->unsignedBigInteger('club_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->string('title');
            $table->string('hospital_name')->nullable();
            $table->string('appt')->nullable();
            $table->date('admission_date')->nullable();
            $table->date('discharge_date')->nullable();
            $table->string('ion_number')->nullable();
            $table->date('ion_date')->nullable();
            $table->string('attachment')->nullable();
            $table->integer('score')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->unsignedBigInteger('authorized_by')->nullable(); // Authentication (HR)
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
        Schema::dropIfExists('medicals');
    }
}
