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
        Schema::create('distribusi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sekolah_id')->constrained('sekolah')->onDelete('cascade');
            $table->foreignId('kendaraan_id')->constrained('kendaraan')->onDelete('cascade');
            $table->date('tanggal_distribusi');
            $table->integer('jumlah_porsi');
            $table->enum('status', ['sudah', 'belum'])->default('belum');
            $table->time('waktu_berangkat')->nullable();
            $table->time('waktu_tiba')->nullable();
            $table->text('catatan')->nullable();
            $table->string('foto_distribusi')->nullable();
            $table->timestamps();
            
            $table->index(['tanggal_distribusi', 'status']);
            $table->index('sekolah_id');
            $table->index('kendaraan_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distribusi');
    }
};