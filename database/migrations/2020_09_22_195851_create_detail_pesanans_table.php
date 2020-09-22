<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('T10_D_PESANAN', function (Blueprint $table) {
					$table->char('FNO_PESAN', 7);
					$table->char('FNO_MENU', 5);
					$table->integer('FJML');
					$table->double('FHARGA');
					$table->double('DISC');
					$table->softDeletes();
					$table->timestamps();

					$table->primary(['FNO_PESAN', 'FNO_MENU']);
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
