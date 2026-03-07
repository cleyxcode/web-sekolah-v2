<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('info_pendaftaran_id')->constrained()->cascadeOnDelete();
            $table->string('nama_anak');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('agama');
            $table->integer('anak_ke')->nullable();
            $table->string('asal_sekolah')->nullable();
            $table->string('nik')->nullable();
            $table->string('no_kk')->nullable();
            $table->text('alamat');
            $table->string('nama_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('nama_wali')->nullable();
            $table->string('no_hp');
            $table->string('dokumen')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
