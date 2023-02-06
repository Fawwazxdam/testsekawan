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
        Schema::create('sewa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_cust');
            $table->string('nohp');
            $table->string('tanggal_sewa');
            $table->string('tanggal_kembali');
            $table->foreignId('kendaraan_id')->constrained('kendaraan');
            $table->foreignId('driver_id')->constrained('driver');
            $table->integer('approval1')->default(0);
            $table->integer('approval2')->default(0);
            $table->string('status')->default('pending');
            $table->string('denda')->nullable();
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
        Schema::dropIfExists('sewa');
    }
};
