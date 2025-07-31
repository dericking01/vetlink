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

        Schema::create('short_stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_product_id');
            $table->unsignedBigInteger('branch_id')->nullable(); 
            $table->integer('quantity')->default(0); 
            $table->integer('description')->default(0); 
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('admin_product_id')->references('id')->on('admin_products')->onDelete('cascade');
            // $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('short_stocks');
    }
};
