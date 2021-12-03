<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->bigIncrements('vehicle_id');
            $table->string('type', 50); // hatchback, bus...
            $table->string('make', 50);
            $table->string('model', 50);
            $table->integer('year');
            $table->string('license_plate', 10);
            $table->timestamps();
        });

        DB::table('vehicles')->insert(array(
            [
                'vehicle_id' => 1,
                'type' => 'hatchback',
                'make' => 'KIA',
                'model' => 'Forte',
                'year' => 2006,
                'license_plate' => 'BGP-73-72'
            ],
            [
                'vehicle_id' => 2,
                'type' => 'bus',
                'make' => 'Mercedes-Benz',
                'model' => 'Citaro',
                'year' => 2012,
                'license_plate' => 'AM-56-970'
            ]
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
