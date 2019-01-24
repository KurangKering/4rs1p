<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRiwayatPembacaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_pembaca', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_pembaca');
            // $table->unsignedInteger('berkas_perkara_id');
            $table->string('no_perkara');
            $table->string('nama_berkas');
            // $table->unsignedInteger('berkas_perkara_id');
            // $table->unsignedInteger('user_id');
            $table->dateTime('tanggal');
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
        Schema::dropIfExists('riwayat_pembaca');
    }
}
