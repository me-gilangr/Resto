<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesananDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('T10_D_PESANAN', function (Blueprint $table) {
					$table->char('FNO_D_PESAN', 11)->primary();
					$table->char('FNO_H_PESAN', 9);
					$table->foreign('FNO_H_PESAN')->references('FNO_H_PESAN')->on('T10_H_PESANAN');
					$table->char('FNO_H_MENU', 5);
					$table->foreign('FNO_H_MENU')->references('FNO_H_MENU')->on('T00_H_MENU');
					$table->integer('FJML');
					$table->double('FHARGA');
					$table->double('FDISC');
					$table->text('FKET')->nullable();
					$table->char('FSTATUS_PESAN', 1);
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
        Schema::dropIfExists('T10_D_PESANAN');
    }
}
