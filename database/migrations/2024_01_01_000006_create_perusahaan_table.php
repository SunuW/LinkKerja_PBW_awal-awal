<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perusahaan', function (Blueprint $table) {
            $table->id('id_perusahaan');
            $table->foreignId('id_user')->constrained('users', 'id')->cascadeOnDelete();
            $table->string('nama_perusahaan');
            $table->string('bidang')->nullable();
            $table->string('lokasi')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('logo')->nullable();
            $table->timestamps();
        });
    }
 
    public function down(): void
    {
        Schema::dropIfExists('perusahaan');
    }
};
