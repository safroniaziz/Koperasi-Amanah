<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJumlahKeseluruhansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jumlah_keseluruhans', function (Blueprint $table) {
            $table->id();
            $table->string('tahun');
            $table->integer('jumlah_simpanan_seluruh');
            $table->integer('jumlah_jasa_seluruh');
            $table->integer('jumlah_transaksi_seluruh');
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
        Schema::dropIfExists('jumlah_keseluruhans');
    }
}
