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
            $table->string('units')->after('quantity')->nullable();
            $table->string('expire_date')->nullable()->after('units');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admin_products', function (Blueprint $table) {
            $table->dropColumn('units');
            $table->dropColumn('expire_date');
        });
    }
};
