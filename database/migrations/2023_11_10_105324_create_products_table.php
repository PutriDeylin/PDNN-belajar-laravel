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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->foreignId('category_id')->constrained('product_categories');
            $table->string('product_code')->unique()->nullable();
            $table->enum('is_active', ['1', '0'])->default(1);
            $table->text('description')->nullable();
            $table->decimal('price', 15, 2);
            $table->string('unit')->default('PCS');
            $table->decimal('discount_amount', 15, 2);
            $table->integer('stock');
            $table->text('image')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
