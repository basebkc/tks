<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogNotifikasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_notifikasi', function (Blueprint $table) {
            $table->id();
            $table->string('no_rekening');
            $table->string('kode_trans');
            $table->string('jenis_notif');
            $table->string('nominal');
            $table->string('jam_trans');
            $table->string('status_terkirim');
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
        Schema::dropIfExists('log_notifikasi');
    }
}
