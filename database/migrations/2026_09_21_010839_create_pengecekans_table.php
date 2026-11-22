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
        Schema::create('pengecekans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aset_id')->constrained('asets')->cascadeOnDelete();
            
            // Kolom user_id kita buat nullable dulu karena sistem kita belum pakai Login
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete(); 
            
            $table->dateTime('tanggal_cek');
            
            // Ubah enum jadi string supaya bebas diisi 'Normal', 'Warning', dll
            $table->string('status'); 
            
            $table->integer('beban')->nullable(); 
            $table->integer('suhu')->nullable(); 
            $table->string('tegangan')->nullable(); 
            $table->integer('waktu_backup')->nullable(); 
            $table->integer('battery_health')->nullable(); 
            
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengecekans');
    }
};
