<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarNasabahNotifTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_nasabah_notif', function (Blueprint $table) {
            $table->id();
            $table->string('no_rekening');
            $table->string('no_hp');
            $table->string('no_wa');
            $table->string('keterangan');
            $table->dateTime('tgl_akhir', $precision = 0);
            $table->dateTime('tgl_daftar', $precision = 0);
            $table->string('status');
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
        Schema::dropIfExists('daftar_nasabah_notif');
    }
}
