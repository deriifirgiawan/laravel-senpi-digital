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
        Schema::create('tes', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->unsignedBigInteger('id_personil')->nullable();
            $table->string('hasil_kesehatan');
            $table->string('hasil_psikologi');
            $table->string('hasil_menembak');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('id_personil')->references('id_personil')->on('personil')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tes');
    }
};
