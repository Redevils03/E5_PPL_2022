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
        Schema::create('akun_pembelis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email',30);
            $table->string('password');
            $table->binary('foto')->nullable();
            $table->string('nama',30);
            $table->string('nomor_telp',14);
            $table->string('jenis_kelamin',10);
            $table->string('alamat',50);
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
        Schema::dropIfExists('akun_pembelis');
    }
};
