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
        Schema::table('admin_products', function (Blueprint $table) {
            // Add the branch_id column
            $table->unsignedBigInteger('branch_id')->after('admin_id')->nullable();

            // Define the foreign key constraint
            $table->foreign('branch_id')
                  ->references('id')
                  ->on('branches')
                  ->onDelete('set null') // or 'cascade' depending on your use case
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admin_products', function (Blueprint $table) {
            // Drop the foreign key and column if rolling back
            $table->dropForeign(['branch_id']);
            $table->dropColumn('branch_id');
        });
    }
};
