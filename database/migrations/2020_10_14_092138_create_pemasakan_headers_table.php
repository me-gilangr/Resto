<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemasakanHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('T10_H_PEMASAKAN', function (Blueprint $table) {
					$table->char('FNO_H_PEMASAKAN', 10)->primary();
					$table->char('FNO_PESAN', 9);
					$table->foreign('FNO_PESAN')->references('FNO_PESAN')->on('T10_H_PESANAN');
					$table->char('FNO_H_MENU', 5);
					$table->foreign('FNO_H_MENU')->references('FNO_H_MENU')->on('T00_H_MENU');
					$table->bigInteger('USER_ID')->unsigned();
					$table->foreign('USER_ID')->references('id')->on('users');
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
        Schema::dropIfExists('T10_H_PEMASAKAN');
    }
}
