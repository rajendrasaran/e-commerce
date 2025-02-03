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
            $table->string('name',200);
            $table->tinyInteger('status');
            $table->integer('is_featured');
            $table->string('sku');
            $table->integer('qty');
            $table->tinyInteger('stock_status');
            $table->decimal('weight',10,3);
            $table->decimal('price', 10,3);
            $table->decimal('special_price',10,3);
            $table->date('special_price_form');
            $table->date('special_price_to');
            $table->text('short_description');
            $table->string('category');
            $table->text('description');
            $table->string('url_key',200)->unique();
            $table->string('related_product');
            $table->string('meta_title',200);
            $table->string('meta_keyword',200);
            $table->text('meta_description');
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
