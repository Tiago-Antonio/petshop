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
            $table->string('name', 30); 
            $table->string('description', 100); 
            $table->string('photo_path')->nullable();  
            $table->decimal('purchase_price', 10, 2)->nullable(); 
            $table->decimal('sale_price', 10, 2)->nullable();     
            $table->unsignedInteger('current_stock')->nullable();         
            $table->unsignedInteger('min_stock')->nullable();             
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
