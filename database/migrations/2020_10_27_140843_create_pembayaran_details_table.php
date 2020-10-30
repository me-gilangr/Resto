<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t20_d_bayar', function (Blueprint $table) {
          $table->char('FNO_D_BAYAR', 11)->primary();
          $table->char('FNO_H_BAYAR', 9);
          $table->foreign('FNO_H_BAYAR')->references('FNO_H_BAYAR')->on('t20_h_bayar');
          $table->char('FNO_D_PESAN', 11);
          $table->foreign('FNO_D_PESAN')->references('FNO_D_PESAN')->on('t10_d_pesanan');
          $table->integer('FJML');
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
        Schema::dropIfExists('t20_d_bayar');
    }
}
