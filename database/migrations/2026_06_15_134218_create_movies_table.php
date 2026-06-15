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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('external_id')->unique();
            $table->string('external_source')->default('omdb');
            $table->string('title');
            $table->string('year')->nullable();
            $table->string('poster')->nullable();
            $table->text('plot')->nullable();
            $table->string('genre')->nullable();
            $table->string('director')->nullable();
            $table->string('runtime')->nullable();
            $table->json('raw_payload')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
