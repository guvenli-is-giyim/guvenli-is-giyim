<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_variants', function (Blueprint $table) {

            $table->id();

            $table->foreignId('product_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('color_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('size_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('sku')->unique();

            $table->string('barcode')->nullable();

            $table->integer('stock')->default(0);

            $table->decimal('price',10,2)->nullable();

            $table->decimal('sale_price',10,2)->nullable();

            $table->boolean('status')->default(true);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};