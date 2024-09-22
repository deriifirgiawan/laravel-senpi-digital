<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('personil', function (Blueprint $table) {
            $table->id('id_personil');
            $table->string('nrp')->unique();
            $table->string('nama');
            $table->string('pangkat');
            $table->string('jabatan');
            $table->string('kesatuan');
            $table->string('foto_pribadi')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('personil');
    }
};
