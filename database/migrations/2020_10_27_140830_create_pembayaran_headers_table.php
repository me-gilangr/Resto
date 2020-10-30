<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t20_h_bayar', function (Blueprint $table) {
          $table->char('FNO_H_BAYAR', 9)->primary();
          $table->date('FTGL_BAYAR');
          $table->unsignedBigInteger('USER_ID');
          $table->foreign('USER_ID')->references('id')->on('users');
          $table->double('FTOTAL');
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
        Schema::dropIfExists('t20_h_bayar');
    }
}
