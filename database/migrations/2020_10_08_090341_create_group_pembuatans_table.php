<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupPembuatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t00_ref_group', function (Blueprint $table) {
					$table->char('FNO_PRODUK', 6);
					$table->char('FTEMPAT', 1);

					$table->foreign('FNO_PRODUK')->references('FNO_PRODUK')->on('t00_m_produk');
					$table->primary(['FNO_PRODUK', 'FTEMPAT']);
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
        Schema::dropIfExists('t00_ref_group');
    }
}
