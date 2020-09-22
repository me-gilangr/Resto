<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t00_m_menu', function (Blueprint $table) {
					$table->char('FK_MENU', 5)->primary();
					$table->string('FN_MENU', 40);
					$table->char('FK_KAT');
					$table->foreign('FK_KAT')->references('FK_KAT')->on('t00_m_kat');
					$table->string('FDESKRIPSI', 100);
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
        Schema::dropIfExists('t00_m_menu');
    }
}
