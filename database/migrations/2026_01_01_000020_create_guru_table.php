<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guru', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nip')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('mata_pelajaran')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('foto')->nullable();
            $table->string('status')->default('aktif');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guru');
    }
};
