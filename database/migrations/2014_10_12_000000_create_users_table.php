<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            $table->string('employee_number', 10)->primary();
            $table->integer('type')->default(1);
            $table->string('fname', 50);
            $table->string('lname', 50);
            $table->string('email', 100);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 100);
            $table->string('phone_number', 10);
            $table->string('license', 50);
            $table->string('department_id', 5);
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
            array(
                'employee_number' => '1234567890',
                'type' => 0,
                'fname' => 'Admin',
                'lname' => 'QuickIn',
                'email' => 'fernandofc2000@gmail.com',
                'password' => Hash::make('123'),
                'phone_number' => '6645527887',
                'license' => 'license123',
                'department_id' => 'IT',
            )
        );
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
