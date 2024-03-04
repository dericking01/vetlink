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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('admin_product_id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('agent_id');
            $table->unsignedBigInteger('productable_id');
            $table->string('productable_type');
            $table->integer('quantity')->default(0);
            $table->decimal('price', 15, 2)->default(0);
            $table->decimal('amount', 15, 2)->default(0);
            $table->decimal('sab_commission', 15, 2)->default(0);
            // $table->decimal('discount', 15, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
            // $table->foreign('admin_product_id')->references('id')->on('admin_products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('agent_id')->references('id')->on('agents')->onDelete('cascade')->onUpdate('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
