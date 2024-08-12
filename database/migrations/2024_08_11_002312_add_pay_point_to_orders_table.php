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
            Schema::table('orders', function (Blueprint $table) {
                // Adding the 'PayPoint' column to store points payment amounts
                $table->decimal('PayPoint', 10, 2)->nullable()->after('total_amount');

                // Adding the ''PayPoint'' status to the status column
                $table->enum('status', ['Pending', 'Completed', 'Cancelled', 'Partial', 'PayPoint'])
                      ->default('Pending')
                      ->change();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
             // Dropping the PayPoint column
             $table->dropColumn('PayPoint');

             // Reverting the 'PayPoint' column to its original state
             $table->enum('status', ['Pending', 'Completed', 'Cancelled', 'PayPoint'])
                   ->default('Pending')
                   ->change();
        });
    }
};
