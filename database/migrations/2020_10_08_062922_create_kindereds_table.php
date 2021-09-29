<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKinderedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kindereds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->enum('relationship', ['wife', 'mother', 'father', 'sons', 'daughters', 'brothers', 'sisters']);
            $table->string('name');
            $table->date('dob')->nullable();
            $table->date('marriage_date')->nullable();
            $table->string('next_of_kin')->nullable();
            $table->string('cnic')->nullable();
            $table->date('date_of_entry')->nullable();
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
        Schema::dropIfExists('kindereds');
    }
}
