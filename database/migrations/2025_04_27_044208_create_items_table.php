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
        Schema::create('items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('apc_item_id')->unique();
            $table->boolean('is_borrowable')->default(false);
            $table->boolean('is_required_supervisor_approval')->default(false);

            // FK
            $table->foreignUuid('department_id')
                ->nullable()
                ->constrained('departments')
                ->onDelete('restrict');
            $table->foreignUuid('possessed_by')
                ->nullable()
                ->constrained('users')
                ->onDelete('restrict');
            $table->foreignUuid('item_group_id')
                ->constrained('item_groups')
                ->onDelete('restrict');
            $table->foreignUuid('item_status_id')
                ->constrained('item_statuses')
                ->onDelete('restrict');

            // TODO: Uncomment when purchase orders are implemented
            // $table->foreignUuid('purchase_order_id')
            //     ->nullable()
            //     ->constrained('purchase_orders')
            //     ->onDelete('restrict');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
