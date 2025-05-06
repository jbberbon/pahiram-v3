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
        Schema::create('item_group_images', function (Blueprint $table) {
            $table->id();
            $table->text('url');
            $table->timestamps();

            // FK
            $table->foreignUuid('item_group_id')
                ->constrained('item_groups')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_group_image');
    }
};
