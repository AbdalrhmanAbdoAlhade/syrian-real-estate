<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('property_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->string('type', 10);
            $table->string('path', 500);
            $table->string('disk', 50)->default('public');
            $table->string('mime_type', 100)->nullable();
            $table->unsignedBigInteger('size')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_cover')->default(false);
            $table->timestamps();

            $table->unique(['property_id', 'path']);
            $table->index(['property_id', 'sort_order']);
            $table->index(['property_id', 'is_cover']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('property_media');
    }
};
