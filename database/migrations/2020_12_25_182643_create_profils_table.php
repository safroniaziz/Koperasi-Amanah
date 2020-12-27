<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profils', function (Blueprint $table) {
            $table->id();
            $table->string('alamat_lengkap');
            $table->string('visi');
            $table->string('telephone');
            $table->string('email');
            $table->string('facebook');
            $table->string('instagram');
            $table->string('jumlah_anggota');
            $table->string('jumlah_pengurus');
            $table->string('tahun_berdiri');
            $table->string('kerja_sama');
            $table->string('foto')->nullable();
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
        Schema::dropIfExists('profils');
    }
}
