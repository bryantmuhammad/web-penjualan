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
        Schema::create('alamat_pengirimans', function (Blueprint $table) {
            $table->bigIncrements('id_alamat_pengiriman');
            $table->string('id_penjualan', 10);
            $table->integer('id_kabupaten');
            $table->string('kecamatan', 50);
            $table->string('kode_pos', 20);
            $table->text('alamat');
            $table->string('nama_penerima', 40);
            $table->string('no_telepon_penerima', 20);
            $table->timestamps();
        });

        Schema::table('alamat_pengirimans', function (Blueprint $table) {
            $table->foreign('id_penjualan')->references('id_penjualan')->on('penjualans')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alamat_pengiriman');
    }
};
