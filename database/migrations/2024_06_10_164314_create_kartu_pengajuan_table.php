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
        Schema::create('kartu_pengajuan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kartu')->nullable();
            $table->date('tanggal_pengajuan');
            $table->unsignedBigInteger('id_personil');
            $table->unsignedBigInteger('id_senjata');
            $table->string('status');
            $table->string('status_description')->nullable();
            $table->date('berlaku_sampai_dengan')->nullable();
            $table->date('tanggal_update')->nullable();
            $table->string('update_by')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_personil')->references('id_personil')->on('personil')->onDelete('cascade');
            $table->foreign('id_senjata')->references('id')->on('weapon')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kartu_pengajuan');
    }
};
