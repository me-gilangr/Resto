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
					$table->char('FNO_H_PEMASAKAN', 10);
					$table->char('FNO_PRODUK', 6);
					$table->foreign('FNO_PRODUK')->references('FNO_PRODUK')->on('t00_m_produk');
					$table->integer('FJML');
					$table->boolean('FSTATUS');
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
        Schema::dropIfExists('T10_D_PEMASAKAN');
    }
}
