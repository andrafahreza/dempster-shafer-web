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
        Schema::create('rule', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('id_penyakit', 50);
            $table->string('id_gejala', 50);
            $table->timestamps();

            $table->foreign("id_penyakit")->references("id")->on("penyakit")->onDelete("cascade");
            $table->foreign("id_gejala")->references("id")->on("gejala")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rule');
    }
};
