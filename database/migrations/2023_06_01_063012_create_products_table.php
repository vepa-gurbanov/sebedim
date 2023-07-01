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
            $table->unsignedBigInteger('store_id')->index();
            $table->foreign('store_id')->references('id')->on('stores')->cascadeOnDelete();
            $table->unsignedBigInteger('brand_id')->index();
            $table->foreign('brand_id')->references('id')->on('brands')->cascadeOnDelete();
            $table->unsignedBigInteger('category_id')->index();
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
            $table->string('name');
            $table->string('full_name')->nullable();
            $table->text('description')->nullable();
            $table->string('slug')->unique()->index()->nullable();
            $table->string('image')->nullable();
            $table->string('barcode')->index();
            $table->string('upc_code')->unique()->index()->nullable();
            $table->unsignedInteger('discount_percent')->default(0);
            $table->dateTime('discount_start')->useCurrent();
            $table->dateTime('discount_end')->useCurrent();
            $table->unsignedDouble('price')->default(0);
            $table->unsignedInteger('stock')->default(0);
            $table->unsignedInteger('viewed')->default(0);
            $table->unsignedInteger('sold')->default(0);
            $table->unsignedInteger('favorites')->default(0);
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
