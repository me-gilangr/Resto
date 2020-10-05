<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGroupKodeFieldToTableKategori extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t00_ref_produk', function (Blueprint $table) {
					$table->char('FK_GROUP', 1)->after('FNO_KATEGORI');
					$table->foreign('FK_GROUP')->references('FK_GROUP')->on('t00_ref_kategori');
				});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t00_ref_produk', function (Blueprint $table) {
          $table->dropColumn('FK_GROUP');
        });
    }
}
