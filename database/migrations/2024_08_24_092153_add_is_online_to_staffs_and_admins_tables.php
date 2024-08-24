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
        Schema::table('staffs', function (Blueprint $table) {
            $table->boolean('is_online')->default(false)->after('last_login_at');
        });

        Schema::table('admins', function (Blueprint $table) {
            $table->boolean('is_online')->default(false)->after('last_login_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('staffs', function (Blueprint $table) {
            $table->dropColumn('is_online');
        });

        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn('is_online');
        });
    }
};
