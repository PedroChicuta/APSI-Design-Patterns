<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('category_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: 'category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->enum('type', ['text', 'number', 'decimal', 'date', 'boolean'])->default('text');
            $table->string('unit')->nullable();
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->text('description')->nullable();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('product_attribute_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_attribute_id')->constrained()->onDelete('cascade');

            $table->text('value_text')->nullable();
            $table->integer('value_number')->nullable();
            $table->decimal('value_decimal', 10, 2)->nullable();
            $table->date('value_date')->nullable();
            $table->boolean('value_boolean')->nullable();

            $table->unique(['product_id', 'category_attribute_id']);

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_attribute_values');
        Schema::dropIfExists('products');
        Schema::dropIfExists('category_attributes');
        Schema::dropIfExists('categories');
    }
};
