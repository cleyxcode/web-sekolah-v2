<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('info_pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('tahun_ajaran');
            $table->date('tanggal_buka');
            $table->date('tanggal_tutup');
            $table->integer('kuota');
            $table->text('syarat')->nullable();
            $table->string('status')->default('nonaktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('info_pendaftaran');
    }
};
