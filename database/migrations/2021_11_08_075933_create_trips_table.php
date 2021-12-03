<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->bigIncrements('trip_id');
            $table->integer('status')->default(1);
            $table->string('destination', 100);
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->time('real_start_time')->nullable();
            $table->time('real_end_time')->nullable();
            $table->string('reason', 250);
            $table->string('vehicle_id', 50)->nullable()->default(1);
            $table->string('employee_number', 10);
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
        Schema::dropIfExists('trips');
    }
}
