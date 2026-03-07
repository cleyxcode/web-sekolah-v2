<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nis')->nullable();
            $table->string('kelas')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('tahun_ajaran')->nullable();
            $table->string('foto')->nullable();
            $table->string('status')->default('aktif');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
