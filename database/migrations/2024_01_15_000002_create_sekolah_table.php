<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sekolah', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sekolah');
            $table->string('alamat');
            $table->string('kepala_sekolah');
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->integer('jumlah_siswa')->default(0);
            $table->timestamps();
            
            $table->index('nama_sekolah');
            $table->index('kepala_sekolah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sekolah');
    }
};