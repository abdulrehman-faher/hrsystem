<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeConductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_conducts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained();
            $table->string('title');
            $table->integer('score')->nullable();
            $table->string('place_of_offence');
            $table->dateTime('date_of_offence');
            $table->text('offence_details')->nullable(); // Particulars of Offence
            $table->string('punishment')->nullable(); // Punishment / Award with Date of Award
            $table->date('punishment_date')->nullable(); // Punishment / Award with Date of Award
            $table->date('authority_letter_date')->nullable(); // Authority Ltr & Date
            $table->string('authority_letter_image')->nullable();
            $table->unsignedBigInteger('authorized_by')->nullable();
            $table->foreignId('user_id')->constrained();
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
        Schema::dropIfExists('employee_conducts');
    }
}
