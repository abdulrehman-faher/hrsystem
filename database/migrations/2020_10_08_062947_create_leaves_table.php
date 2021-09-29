<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            /**
             * Types of leave
             * C leave
             * P Leave
             * Incentive Leave
             * Medical Leave
             */
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('type_of_leave_id');
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->integer('total_days')->nullable();
            $table->string('purpose', 5000)->nullable();
            $table->unsignedBigInteger('authorized_by')->nullable();
            $table->string('attachment')->nullable();
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
        Schema::dropIfExists('leaves');
    }
}
