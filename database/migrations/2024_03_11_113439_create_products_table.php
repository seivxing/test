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
            $table->unsignedBigInteger('productcategory_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->string('model','50');
            $table->decimal('price',8,2);
            $table->string('gpu','50')->nullable();
            $table->string('cpu','100')->nullable();
            $table->string('ram','50')->nullable();
            $table->integer('quantity');
            $table->string('color','50');
            $table->string('display','100')->nullable();
            $table->string('weight','50')->nullable();
            $table->string('battery','50')->nullable();
            $table->string('official_warranty','50')->nullable();
            $table->string('image');
            $table->string('description','100')->nullable();

            $table->foreign('productcategory_id')->references('id')->on('productcategorys')->onDelete('set null');
            $table->foreign('brand_id')->references('id')->on('productbrands')->onDelete('set null');
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
