<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('category_id')->nullable();

            $table->unsignedBigInteger('brand_id')->nullable();

            $table->string('name');

            $table->string('slug')->unique();

            $table->string('sku')->unique();

            $table->string('barcode')->nullable();

            $table->text('short_description')->nullable();

            $table->longText('description')->nullable();

            $table->decimal('price',10,2)->default(0);

$table->string('image')->nullable();

$table->integer('stock')->default(0);

$table->boolean('featured')->default(false);

$table->boolean('status')->default(true);

$table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};