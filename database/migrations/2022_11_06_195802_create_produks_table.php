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
        Schema::create('produks', function (Blueprint $table) {
            $table->bigIncrements('id_produk');
            $table->foreignId('id_kategori')->references('id_kategori')->on('kategoris')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('nama_produk', 60);
            $table->integer('stok')->nullable()->default(0);
            $table->integer('berat')->nullable();
            $table->double('harga')->nullable();
            $table->string('gambar', 100);
            $table->text('keterangan');
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
        Schema::dropIfExists('produks');
    }
};
