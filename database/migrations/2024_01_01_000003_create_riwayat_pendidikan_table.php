<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayat_pendidikan', function (Blueprint $table) {
            $table->id('id_pendidikan');
            $table->foreignId('id_profil')->constrained('profil_pencari_kerja', 'id_profil')->cascadeOnDelete();
            $table->string('jenjang', 50)->nullable();
            $table->string('institusi')->nullable();
            $table->string('jurusan')->nullable();
            $table->year('tahun_mulai')->nullable();
            $table->year('tahun_selesai')->nullable();
            $table->timestamps();
        });
    }
 
    public function down(): void
    {
        Schema::dropIfExists('riwayat_pendidikan');
    }
};
