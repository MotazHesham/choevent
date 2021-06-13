<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable()->unique();
            $table->datetime('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('remember_token')->nullable();
            $table->string('mobile')->nullable();
            $table->integer('age')->nullable();
            $table->string('nationality')->nullable();
            $table->string('sex')->nullable();
            $table->string('company_register')->nullable();
            $table->string('employee_name')->nullable();
            $table->boolean('active')->default(0);
            $table->string('group')->nullable();
            $table->longText('description')->nullable();
            $table->string('identity_number')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
