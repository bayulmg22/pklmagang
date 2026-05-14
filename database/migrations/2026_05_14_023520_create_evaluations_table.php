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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('kedisiplinan')->nullable();
            $table->integer('tanggung_jawab')->nullable();
            $table->integer('kerja_sama')->nullable();
            $table->integer('kreativitas')->nullable();
            $table->integer('kemampuan_beradaptasi')->nullable();
            $table->integer('kualitas_hasil_kerja')->nullable();
            $table->integer('penyusunan_laporan')->nullable();
            $table->decimal('average', 5, 2)->nullable();
            $table->string('predicate')->nullable();
            $table->text('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
