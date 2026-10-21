<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profil_pencari_kerja', function (Blueprint $table) {
            $table->id('id_profil');
            $table->foreignId('id_user')->constrained('users', 'id')->cascadeOnDelete();
            $table->string('alamat')->nullable();
            $table->string('no_telepon', 20)->nullable();
            $table->text('ringkasan')->nullable();
            $table->string('foto_profil')->nullable();
            $table->timestamps();
        });
    }
 
    public function down(): void
    {
        Schema::dropIfExists('profil_pencari_kerja');
    }
};
