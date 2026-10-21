<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lowongan', function (Blueprint $table) {
            $table->id('id_lowongan');
            $table->foreignId('id_perusahaan')->constrained('perusahaan', 'id_perusahaan')->cascadeOnDelete();
            $table->string('judul_posisi');
            $table->string('bidang')->nullable();
            $table->string('lokasi')->nullable();
            $table->enum('tipe_kerja', ['full_time', 'part_time', 'magang', 'kontrak']);
            $table->text('deskripsi')->nullable();
            $table->text('kriteria')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }
 
    public function down(): void
    {
        Schema::dropIfExists('lowongan');
    }
};
