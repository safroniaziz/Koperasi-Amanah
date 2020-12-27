<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinjamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjamen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anggota_id')->constrained('anggotas');
            $table->unsignedBigInteger('user_id')->constrained('users');
            $table->integer('jumlah_pinjaman');
            $table->enum('bunga',['7','14']);
            $table->string('jumlah_angsuran_pokok');
            $table->string('jumlah_angsuran_bunga');
            $table->string('bulan_mulai_angsuran');
            $table->string('bulan_akhir_angsuran');
            $table->enum('status_pinjaman',['lunas','belum']);
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
        Schema::dropIfExists('pinjamen');
    }
}
