<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesananHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('T10_H_PESANAN', function (Blueprint $table) {
					$table->char('FNO_PESAN', 9)->primary();
					$table->date('TGL_PESAN');
					$table->boolean('FSTATUS_TRANSAKSI');
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
        Schema::dropIfExists('T10_H_PESANAN');
    }
}
