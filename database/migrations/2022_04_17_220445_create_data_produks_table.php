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
        Schema::create('data_produks', function (Blueprint $table) {
            $table->increments('No_id');
            $table->binary('gambar');
            $table->string('nama_produk',30);
            $table->string('jumlah_produk',5);
            $table->string('harga_produk',100);
            $table->string('harga_asli',100);
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
        Schema::dropIfExists('data_produks');
    }
};
