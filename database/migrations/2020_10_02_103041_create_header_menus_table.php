<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeaderMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('T00_H_MENU', function (Blueprint $table) {
					$table->char('FNO_H_MENU', 7)->primary();
					$table->string('FN_MENU', 50);
					$table->double('FHARGAPOKOK');
					$table->decimal('FMARGIN');
					$table->decimal('FPAJAK');
					$table->double('FHARGAJUAL');
					$table->boolean('FSTATUS');
					$table->string('FGAMBAR', 50);
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
        Schema::dropIfExists('T00_H_MENU');
    }
}
