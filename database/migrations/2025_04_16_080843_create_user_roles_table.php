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
        Schema::create('user_roles', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // FK
            $table->foreignUuid('user_id')
                ->constrained('users')
                ->onDelete('restrict');
            $table->foreignUuid('role_id')
                ->constrained('roles')
                ->onDelete('restrict');
            $table->foreignUuid('department_id')
                ->constrained('departments')
                ->onDelete('restrict');
                
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_roles');
    }
};
