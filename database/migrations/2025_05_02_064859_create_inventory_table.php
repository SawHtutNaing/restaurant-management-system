<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['meat', 'fruit', 'vegetable']);
            $table->decimal('stock', 8, 2)->default(0); // Stock in kg
            $table->decimal('price_per_kg', 8, 2); // Price per kg
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('inventory');
    }
};
