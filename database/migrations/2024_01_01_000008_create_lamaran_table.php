<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lamaran', function (Blueprint $table) {
            $table->id('id_lamaran');
            $table->foreignId('id_lowongan')->constrained('lowongan', 'id_lowongan')->cascadeOnDelete();
            $table->foreignId('id_profil')->constrained('profil_pencari_kerja', 'id_profil')->cascadeOnDelete();
            $table->foreignId('id_dokumen')->nullable()->constrained('dokumen', 'id_dokumen')->nullOnDelete();
            $table->enum('status', ['terkirim', 'ditinjau', 'diterima', 'ditolak'])->default('terkirim');
            $table->timestamps();
 
            // satu pencari kerja hanya bisa melamar 1x per lowongan
            $table->unique(['id_lowongan', 'id_profil'], 'unik_lamaran');
        });
    }
 
    public function down(): void
    {
        Schema::dropIfExists('lamaran');
    }
};

