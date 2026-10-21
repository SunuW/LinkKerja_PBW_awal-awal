<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dokumen', function (Blueprint $table) {
            $table->id('id_dokumen');
            $table->foreignId('id_profil')->constrained('profil_pencari_kerja', 'id_profil')->cascadeOnDelete();
            $table->enum('jenis', ['cv', 'sertifikat', 'portofolio', 'lainnya'])->default('cv');
            $table->string('nama_file');
            $table->string('path_file');
            $table->timestamps();
        });
    }
 
    public function down(): void
    {
        Schema::dropIfExists('dokumen');
    }
};
