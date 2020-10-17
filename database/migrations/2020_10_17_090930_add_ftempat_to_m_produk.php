<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFtempatToMProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t00_m_produk', function (Blueprint $table) {
          $table->char('FTEMPAT', 1)->after('FN_NAMA');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t00_m_produk', function (Blueprint $table) {
          $table->dropColumn('FTEMPAT');
        });
    }
}
