<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanMejasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('T10_D_PESAN_MEJA', function (Blueprint $table) {
					$table->char('FNO_MEJA', 3);
					$table->char('FNO_PESAN', 7);
					$table->softDeletes();
					$table->timestamps();

					$table->primary(['FNO_MEJA', 'FNO_PESAN']);
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
