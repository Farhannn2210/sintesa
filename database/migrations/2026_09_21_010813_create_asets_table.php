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
    Schema::create('asets', function (Blueprint $table) {
        $table->id();
        $table->string('kode_qr')->unique(); // Barcode hasil scan kamera
        $table->string('nup')->nullable();
        $table->string('nama_perangkat');
        $table->string('kategori');
        $table->foreignId('ruangan_id')->constrained('ruangans')->cascadeOnDelete();
        $table->text('spesifikasi')->nullable();
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asets');
    }
};
