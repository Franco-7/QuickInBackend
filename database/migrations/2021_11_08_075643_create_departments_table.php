<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->string('department_id', 5)->primary();
            $table->string('name', 100);
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('departments')->insert(
            array(
                'department_id' => 'IT',
                'name' => 'Tecnologías de la Información'
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
        Schema::dropIfExists('departments');
    }
}
