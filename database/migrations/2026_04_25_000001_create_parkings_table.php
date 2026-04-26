<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parkings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('city_slug');
            $table->string('image')->nullable();
            $table->integer('capacity')->default(0);
            $table->enum('type', ['surface', 'sous-sol', 'autre'])->default('surface');
            $table->string('levels')->nullable();
            $table->string('location')->nullable();
            $table->string('short_location')->nullable();
            $table->string('address')->nullable();
            $table->text('description')->nullable();
            $table->string('schedule')->nullable();
            $table->string('rates')->nullable();
            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('lng', 10, 7)->nullable();
            $table->string('maps_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parkings');
    }
};
