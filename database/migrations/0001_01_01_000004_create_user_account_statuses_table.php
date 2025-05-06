<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_account_statuses', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // FK
            $table->foreignUuid('user_id')
                ->constrained('users')
                ->onDelete('restrict');
            $table->foreignUuid('account_status_id')
                ->constrained('account_statuses')
                ->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_account_statuses');
    }
};
