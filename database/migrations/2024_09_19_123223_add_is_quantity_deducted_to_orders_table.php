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
        Schema::table('orders', function (Blueprint $table) {
            // Adding the is_quantity_deducted column, with a default value of false
            $table->boolean('is_quantity_deducted')->default(false)->after('isDelivered');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Drop the column if the migration is rolled back
            $table->dropColumn('is_quantity_deducted');
        });
    }
};
