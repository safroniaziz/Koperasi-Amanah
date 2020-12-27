<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('nm_transaksi');
            $table->enum('jenis_transaksi',['masuk','keluar']);
            $table->enum('status_jenis_transaksi',['1','0'])->default('1');
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
        Schema::dropIfExists('jenis_transaksis');
    }
}
