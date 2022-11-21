<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alamats', function (Blueprint $table) {
            $table->bigIncrements('id_alamat');
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('id_kabupaten');
            $table->string('kecamatan', 50);
            $table->string('kode_pos', 20);
            $table->text('alamat');
            $table->string('nama_penerima', 40);
            $table->string('no_telepon_penerima', 20);
            $table->smallInteger('aktif');
            $table->timestamps();
        });

        Schema::table('alamats', function (Blueprint $table) {
            $table->foreign('id_kabupaten')->references('id_kabupaten')->on('kabupatens')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alamats');
    }
};
