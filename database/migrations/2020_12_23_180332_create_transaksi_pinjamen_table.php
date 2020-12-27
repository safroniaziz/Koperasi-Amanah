<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiPinjamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_pinjamen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaksi_id')->constrained('transaksis');
            $table->unsignedBigInteger('pinjaman_id')->constrained('pinjamen');
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
        Schema::dropIfExists('transaksi_pinjamen');
    }
}
