<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMejasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('T00_M_MEJA', function (Blueprint $table) {
					$table->char('FNO_MEJA', 3)->primary();
					$table->string('FJENIS', 20);
					$table->integer('STATUS');
					$table->softDeletes();
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
        Schema::dropIfExists('T00_M_MEJA');
    }
}
