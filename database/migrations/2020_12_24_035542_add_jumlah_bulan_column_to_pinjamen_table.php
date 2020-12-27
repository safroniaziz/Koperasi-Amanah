<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJumlahBulanColumnToPinjamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pinjamen', function (Blueprint $table) {
            $table->string('jumlah_bulan');
            $table->string('tahun_mulai_angsuran')->nullable();
            $table->string('tahun_akhir_angsuran')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pinjamen', function (Blueprint $table) {
            //
        });
    }
}
