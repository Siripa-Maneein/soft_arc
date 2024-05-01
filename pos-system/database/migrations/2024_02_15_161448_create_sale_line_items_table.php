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
        Schema::create('sale_line_items', function (Blueprint $table) {
            if (Schema::hasTable('sale_line_items')) {
                Schema::dropIfExists('sale_line_items');
            }
            $table->increments('id');
            $table->unsignedInteger('sale_id');
            $table->unsignedInteger('quantity');
            $table->string('item_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_line_items');
    }
};
