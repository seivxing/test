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
        Schema::create('directlybuy', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('productcategory_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->string('model','50');
            $table->decimal('price',10,2);
            $table->decimal('total_amount',12,2);
            $table->string('gpu','70')->nullable();
            $table->string('cpu','70')->nullable();
            $table->string('ram','70')->nullable();
            $table->integer('quantity');
            $table->string('color','70')->nullable();
            $table->string('display','70')->nullable();
            $table->string('weight','70')->nullable();
            $table->string('battery','70')->nullable();
            $table->string('official_warranty','50');
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
        Schema::dropIfExists('directlybuy');
    }
};
