<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNasabahKreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nasabah_kredits', function (Blueprint $table) {
            $table->id();
            $table->string('cabang');
            $table->string('permohonan');
            $table->string('nilaidiajukan');
            $table->string('jangkawaktu');
            $table->string('namalengkap');
            $table->string('nik');
            $table->string('email');
            $table->string('telepon');
            $table->string('hp');
            $table->string('alamat');
            $table->string('pekerjaan');
            $table->string('jaminan');
            $table->string('pathktp');
            $table->string('pathkk');
            $table->string('pathsuratjaminan');
            $table->string('pathselfi');
            $table->date('masaberlaku')->nullable();
            $table->string('namaalias');
            $table->string('tempatlahir');
            $table->date('tgllahir')->nullable();
            $table->string('kewarganegaraan');
            $table->string('negara');
            $table->string('jk');
            $table->string('status');
            $table->string('agama');
            $table->string('npwp');
            $table->string('kota');
            $table->string('kodepos');
            $table->string('teleponrumah');
            $table->string('pendidikan');
            $table->string('jmlhtanggungan');
            $table->string('jabatan');
            $table->string('perusahaan');
            $table->string('alamatperusahaan');
            $table->string('kotaperusahaan');
            $table->string('kodeposperusahaan');
            $table->string('namasuamiistri');
            $table->string('namaibukandung');
            $table->string('teleponsaudara');
            $table->string('hpsaudara');
            $table->string('tujuankredit');
            $table->string('kettujuankredit');
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
        Schema::dropIfExists('nasabah_kredits');
    }
}
