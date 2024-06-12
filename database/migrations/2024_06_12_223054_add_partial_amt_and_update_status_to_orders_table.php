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
                // Adding the partial_amt column to store partial payment amounts
                $table->decimal('partial_amt', 10, 2)->nullable()->after('total_amount');

                // Adding the 'Partial' status to the status column
                $table->enum('status', ['Pending', 'Completed', 'Cancelled', 'Partial'])
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
              // Dropping the partial_amt column
              $table->dropColumn('partial_amt');

              // Reverting the status column to its original state
              $table->enum('status', ['Pending', 'Completed', 'Cancelled'])
                    ->default('Pending')
                    ->change();
        });
    }
};
