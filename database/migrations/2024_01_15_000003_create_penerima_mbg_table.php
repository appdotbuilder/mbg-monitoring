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
        Schema::create('penerima_mbg', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sekolah_id')->constrained('sekolah')->onDelete('cascade');
            $table->string('nama_siswa');
            $table->string('nis')->unique();
            $table->string('kelas');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('alamat');
            $table->string('nama_orang_tua');
            $table->timestamps();
            
            $table->index(['sekolah_id', 'kelas']);
            $table->index('nis');
            $table->index('nama_siswa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerima_mbg');
    }
};