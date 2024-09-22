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
        Schema::table('kartu_pengajuan', function (Blueprint $table) {
            Schema::table('kartu_pengajuan', function (Blueprint $table) {
                $table->unsignedBigInteger('tes_id')->nullable()->after('update_by');
                $table->foreign('tes_id')->references('id')->on('tes')->onDelete('set null');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kartu_pengajuan', function (Blueprint $table) {
            $table->dropForeign(['tes_id']);
            $table->dropColumn('tes_id');
        });
    }
};
