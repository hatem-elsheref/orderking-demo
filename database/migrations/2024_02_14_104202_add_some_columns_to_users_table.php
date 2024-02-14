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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->constrained('roles')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('merchant_id')->nullable();
            $table->foreign('merchant_id')->references('id')->on('merchants')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedInteger('type')->comment("(represents user type) => 1 = super admin, 2 = store, 3 = customer")->default(\App\Enums\RoleType::CUSTOMER->value);
            $table->boolean('status')->default(false);
            $table->dropUnique(['email']);
            $table->unique(['email', 'merchant_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['email', 'merchant_id']);
            $table->unique(['email']);
            $table->dropColumn('status');
            $table->dropColumn('type');
            $table->dropForeign(['merchant_id']);
            $table->dropForeign(['role_id']);
            $table->dropColumn('merchant_id');
            $table->dropColumn('role_id');

        });
    }
};
