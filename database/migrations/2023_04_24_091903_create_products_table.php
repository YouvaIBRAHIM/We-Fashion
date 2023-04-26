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
            $table->string('name', 100)->nullable(false);
            $table->text('description');
            $table->decimal('price', 8, 2, true)->nullable(false);
            $table->string('image')->nullable(true);
            $table->boolean('is_visible')->default(true)->nullable(false);
            $table->enum('state', ['en solde', 'standard'])->default('standard')->nullable(false);
            $table->string('product_ref', 16)->nullable(true);
            $table->timestamps();
            $table->softDeletes();
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
