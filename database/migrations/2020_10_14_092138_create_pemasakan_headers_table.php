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
					$table->char('FNO_D_PESAN', 11);
					$table->foreign('FNO_D_PESAN')->references('FNO_D_PESAN')->on('T10_D_PESANAN');
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
