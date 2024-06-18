<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mahasiswa')->nullable();
            $table->string('nim_mahasiswa')->nullable();
            $table->integer('umur_mahasiswa')->nullable();
            $table->unsignedBigInteger('fakultas_id')->nullable();
            $table->unsignedBigInteger('jurusan_id')->nullable();
            $table->string('status_perkuliahan')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('fakultas_id')->references('id')->on('fakultas')->onDelete('cascade');
            $table->foreign('jurusan_id')->references('id')->on('jurusans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
