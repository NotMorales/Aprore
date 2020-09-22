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
<<<<<<< HEAD
        Schema::connection('mysql')->create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('persona_id');
            $table->unsignedBigInteger('empresa_id');
=======
        Schema::create('users', function (Blueprint $table) {
            $table->id();
>>>>>>> 9ed7d5fc5b4ed4f293600aa9e3fd7803762622ee
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
<<<<<<< HEAD
            $table->text('profile_photo_path')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
=======
            $table->string('current_team_id')->nullable();
            $table->text('profile_photo_path')->nullable();
            $table->timestamps();
>>>>>>> 9ed7d5fc5b4ed4f293600aa9e3fd7803762622ee
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
