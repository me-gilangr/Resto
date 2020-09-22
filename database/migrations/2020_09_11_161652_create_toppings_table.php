<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToppingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t00_m_topping', function (Blueprint $table) {
					$table->char('FK_TOPPING', 2)->primary();
					$table->string('FN_TOPPING', 15);
					$table->char('FK_MENU');
					$table->foreign('FK_MENU')->references('FK_MENU')->on('t00_m_menu');
					$table->double('FHARGA');
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
        Schema::dropIfExists('t00_m_topping');
    }
}
