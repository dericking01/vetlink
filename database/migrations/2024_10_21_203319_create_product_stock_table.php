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
        Schema::create('product_stock', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_product_id');
            $table->unsignedBigInteger('branch_id'); // Add branch_id to track stock for each branch
            $table->integer('total_quantity')->default(0); // Total quantity across all branches
            $table->integer('available_quantity')->default(0); // Current available quantity for the branch
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('admin_product_id')->references('id')->on('admin_products')->onDelete('cascade');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_stock');
    }
};
