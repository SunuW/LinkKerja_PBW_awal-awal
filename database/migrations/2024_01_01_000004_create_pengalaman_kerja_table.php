<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengalaman_kerja', function (Blueprint $table) {
            $table->id('id_pengalaman');
            $table->foreignId('id_profil')->constrained('profil_pencari_kerja', 'id_profil')->cascadeOnDelete();
            $table->string('posisi')->nullable();
            $table->string('perusahaan')->nullable();
            $table->year('tahun_mulai')->nullable();
            $table->year('tahun_selesai')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }
 
    public function down(): void
    {
        Schema::dropIfExists('pengalaman_kerja');
    }
};
