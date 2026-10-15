<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    public function up(): void
    {
        // Menyimpan pencarian pengguna; dipakai untuk rekomendasi (KF-04)
        // dan menentukan siapa yang dikirimi email lowongan baru (KF-05)
        Schema::create('riwayat_pencarian', function (Blueprint $table) {
            $table->id('id_riwayat');
            $table->foreignId('id_user')->constrained('users', 'id')->cascadeOnDelete();
            $table->string('kata_kunci')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('bidang')->nullable();
            $table->timestamps();
        });
    }
 
    public function down(): void
    {
        Schema::dropIfExists('riwayat_pencarian');
    }
};
