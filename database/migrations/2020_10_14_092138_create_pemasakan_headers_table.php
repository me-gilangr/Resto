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
					// $table->char('FNO_H_PEMASAKAN', 12)->primary();
					$table->char('FNO_H_PEMASAKAN',10);
					$table->char('FNO_D_PESAN', 11);
					$table->foreign('FNO_D_PESAN')->references('FNO_D_PESAN')->on('T10_D_PESANAN');
					$table->softDeletes();
					$table->timestamps();
					
					$table->primary(['FNO_H_PEMASAKAN', 'FNO_D_PESAN']);
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
