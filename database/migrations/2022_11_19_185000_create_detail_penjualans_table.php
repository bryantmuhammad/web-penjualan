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
        Schema::create('detail_penjualans', function (Blueprint $table) {
            $table->bigIncrements('id_detail_penjualan');
            $table->string('id_penjualan', 10);
            $table->foreignId('id_produk')->references('id_produk')->on('produks')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('jumlah');
            $table->double('sub_total');
            $table->timestamps();
        });

        Schema::table('detail_penjualans', function (Blueprint $table) {
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
        Schema::dropIfExists('detail_penjualans');
    }
};
