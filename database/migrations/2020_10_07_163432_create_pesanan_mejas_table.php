<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesananMejasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('T10_D_PESAN_MEJA', function (Blueprint $table) {
					$table->char('FNO_H_PESAN', 9);
					$table->char('FNO_MEJA', 3);
					$table->foreign('FNO_H_PESAN')->references('FNO_H_PESAN')->on('T10_H_PESANAN');
					$table->foreign('FNO_MEJA')->references('FNO_MEJA')->on('T00_M_MEJA');
					$table->softDeletes();
					$table->timestamps();

					$table->primary(['FNO_H_PESAN', 'FNO_MEJA']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('T10_D_PESAN_MEJA');
    }
}
