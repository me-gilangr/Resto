<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('T00_D_MENU', function (Blueprint $table) {
					$table->char('FNO_H_MENU', 5);
					$table->foreign('FNO_H_MENU')->references('FNO_H_MENU')->on('T00_H_MENU');
					$table->char('FNO_PRODUK', 6);
					$table->foreign('FNO_PRODUK')->references('FNO_PRODUK')->on('T00_M_PRODUK');
					$table->integer('FJML');
					$table->softDeletes();
					$table->timestamps();

					$table->primary(['FNO_H_MENU', 'FNO_PRODUK']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('T00_D_MENU');
    }
}

