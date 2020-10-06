<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategorisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('T00_REF_PRODUK', function (Blueprint $table) {
					$table->char('FNO_KATEGORI', 3)->primary();
					$table->char('FK_GROUP', 1);
					$table->foreign('FK_GROUP')->references('FK_GROUP')->on('t00_ref_kategori');
					$table->string('FN_KATEGORI', 20);
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
        Schema::dropIfExists('T00_REF_PRODUK');
    }
}
