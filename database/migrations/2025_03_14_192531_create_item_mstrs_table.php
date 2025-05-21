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
        Schema::create('item_mstr', function (Blueprint $table) {
            $table->id('item_id');
            $table->uuid('item_uuid')->unique();
            $table->string('item_name', 100);
            $table->string('item_desc', 255);
            $table->string('item_pmcode', 50);
            $table->string('item_prod_line', 50);
            $table->string('item_rjrate', 50);
            $table->boolean('item_status')->default(1);
            $table->string('item_uom', 50);
            $table->json('item_spec')->nullable();
            $table->bigInteger('item_cb');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_mstr');
    }
};
