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
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('phone')->unique();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->enum('gender', ['M','F'] )->nullable();
            $table->text('location' )->nullable();
            $table->string('promo_code')->unique();
            $table->integer('points')->default(0);
            $table->string('agent_id')->unique();
            $table->string('password');
            $table->enum('status', ['Active','Inactive'] )->default('Active');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};
