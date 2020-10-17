<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemasakanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('T10_D_PEMASAKAN', function (Blueprint $table) {
					$table->char('FNO_D_PEMASAKAN', 12)->primary();
					$table->char('FNO_H_PEMASAKAN', 10);
					$table->foreign('FNO_H_PEMASAKAN')->references('FNO_H_PEMASAKAN')->on('t10_h_pemasakan');
					$table->char('FNO_PRODUK', 6);
					$table->foreign('FNO_PRODUK')->references('FNO_PRODUK')->on('t00_m_produk');
					$table->bigInteger('USER_ID')->nullable()->unsigned();
					$table->foreign('USER_ID')->references('id')->on('users');
					$table->integer('FJML');
					$table->boolean('FSTATUS')->default(0);
					$table->char('FTEMPAT', '1');
					$table->softDeletes();
					$table->timestamps();

					// $table->primary(['FNO_H_PEMASAKAN', 'FNO_PRODUK']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('T10_D_PEMASAKAN');
    }
}
