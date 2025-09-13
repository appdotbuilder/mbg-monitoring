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
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kendaraan');
            $table->string('plat_nomor')->unique();
            $table->string('driver_name');
            $table->string('driver_phone');
            $table->enum('status', ['aktif', 'tidak_aktif'])->default('aktif');
            $table->text('keterangan')->nullable();
            $table->timestamps();
            
            $table->index('status');
            $table->index('plat_nomor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraan');
    }
};