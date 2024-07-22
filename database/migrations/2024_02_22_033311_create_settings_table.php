<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('title_name')->nullable()->default('BTB-PC');
            $table->string('app_name')->nullable()->default('BTB-PC');
            $table->string('image')->nullable()->default('icon');
            $table->timestamps();
        });

        // Insert a default record
        DB::table('settings')->insert([
            'title_name' => 'BTB-PC',
            'app_name' => 'BTB-PC',
            'image' => 'icon',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};