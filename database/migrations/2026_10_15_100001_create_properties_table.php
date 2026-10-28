<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('city');
            $table->string('district')->nullable();
            $table->enum('purpose', ['بيع', 'إيجار']);
            $table->decimal('price_usd', 12, 2);
            $table->unsignedInteger('area');
            $table->unsignedTinyInteger('rooms')->default(1);
            $table->unsignedTinyInteger('bathrooms')->default(1);
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('properties');
    }
};
