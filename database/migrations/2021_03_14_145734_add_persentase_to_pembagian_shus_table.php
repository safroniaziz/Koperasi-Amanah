<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPersentaseToPembagianShusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pembagian_shus', function (Blueprint $table) {
            $table->string('persentase_simpanan')->nullable()->after('id');
            $table->string('persentase_jasa')->nullable()->after('persentase_simpanan');
            $table->integer('shu_tahun_berjalan')->nullable()->after('persentase_jasa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pembagian_shus', function (Blueprint $table) {
            //
        });
    }
}
