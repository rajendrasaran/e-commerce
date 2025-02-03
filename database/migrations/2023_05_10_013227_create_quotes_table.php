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
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->string('cart_id',255);
            $table->integer('user_id');
            $table->string('name',400);
            $table->string('email',200);
            $table->string('phone',200);
            $table->text('address');
            $table->string('city',250);
            $table->string('state',250);
            $table->string('pincode',250);
            $table->decimal('subtotal',8,2);
            $table->string('coupon',250);
            $table->decimal('coupon_discount',8,2);
            $table->decimal('total',8,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
