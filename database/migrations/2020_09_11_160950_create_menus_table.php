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
        Schema::create('T00_M_MENU', function (Blueprint $table) {
					$table->char('FNO_MENU', 5)->primary();
					$table->char('FNO_KATEGORI', 2);
					$table->foreign('FNO_KATEGORI')->references('FNO_KATEGORI')->on('T00_REF_MENU');
					$table->string('FN_NAMA', 50);
					$table->double('FHARGA');
					$table->double('DISC');
					$table->string('FGAMBAR');
					$table->integer('STATUS_MENU');
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
        Schema::dropIfExists('T00_M_MENU');
    }
}
