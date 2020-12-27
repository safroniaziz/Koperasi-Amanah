<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jenis_transaksi_id')->constrained('jenis_transaksis');
            $table->unsignedBigInteger('anggota_id')->constrained('anggotas');;
            $table->unsignedBigInteger('user_id')->constrained('users');;
            $table->enum('jenis_transaksi',['masuk','keluar']);
            $table->integer('jumlah_transaksi');
            $table->date('tanggal_transaksi');
            $table->string('bulan_transaksi');
            $table->string('tahun_transaksi');
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
        Schema::dropIfExists('transaksis');
    }
}
