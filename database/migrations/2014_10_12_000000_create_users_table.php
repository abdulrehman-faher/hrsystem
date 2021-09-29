<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('active')->default(1);
            /**
             * director (reports) = 1
             * super admin (overall access) = 2 
             * admin (overall access) = 3
             * normal (clube access) = 4
             */
            // only super admin can add user 
            $table->tinyInteger('type');
            $table->unsignedBigInteger('club_id')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->timestamp('last_login_at')->nullable();

            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
