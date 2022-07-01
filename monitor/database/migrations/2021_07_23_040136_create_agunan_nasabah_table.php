<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgunanNasabahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agunan_nasabah', function (Blueprint $table) {
            $table->id();
            $table->string('jenisagunan');
            $table->string('jenis_kepemilikan');
            $table->string('no_pemilik');
            $table->string('nama_pemilik');
            $table->string('IMB');
            $table->string('jatuh_tempo_shgb');
            $table->string('lokasi');
            $table->string('nilai_taksasi');
            $table->string('deskripsi');
            $table->string('jenisagunan1');
            $table->string('jenis_kendaraan');
            $table->string('merk');
            $table->string('tahun');
            $table->string('no_mesin');
            $table->string('no_rangka');
            $table->string('no_bpkb');
            $table->string('no_polisi');
            $table->string('nilai_taksasi1');
            $table->string('deskripsi1');
            $table->string('jenisagunan2');
            $table->string('jaminan');
            $table->string('nama_pemilik2');
            $table->string('deskripsi2');
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
        Schema::dropIfExists('agunan_nasabah');
    }
}
