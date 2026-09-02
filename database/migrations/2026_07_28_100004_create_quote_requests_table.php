<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quote_requests', function (Blueprint $table) {

            $table->id();

            $table->string('name');

            $table->string('company')->nullable();

            $table->string('phone');

            $table->string('email')->nullable();

            $table->foreignId('product_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->text('message')->nullable();

            $table->string('status')->default('new'); // new, contacted, closed

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quote_requests');
    }
};
