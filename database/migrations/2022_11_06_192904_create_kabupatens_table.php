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
        Schema::create('kabupatens', function (Blueprint $table) {
            $table->integer('id_kabupaten')->primary();
            $table->integer('id_provinsi');
            $table->string('nama_kabupaten', 50);
        });

        Schema::table('kabupatens', function (Blueprint $table) {
            $table->foreign('id_provinsi')->references('id_provinsi')->on('provinsis')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kabupatens');
    }
};
