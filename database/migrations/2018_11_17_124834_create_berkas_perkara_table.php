<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBerkasPerkaraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berkas_perkara', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('perkara_id');
            $table->string('nama');
            $table->text('file');
            $table->timestamps();



            $table->foreign('perkara_id')
            ->references('id')
            ->on('perkara')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('berkas_perkara');
    }
}
