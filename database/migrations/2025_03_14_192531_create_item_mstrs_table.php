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
            $table->id('item_mstr_id');
            $table->string('item_name', 100);
            $table->string('item_desc', 255);
            $table->string('item_pmcode', 50);
            $table->string('item_prod_line', 50);
            $table->string('item_rjrate', 50);
            $table->string('item_status', 50);
            $table->string('item_uom', 50);
            $table->bigInteger('item_mstr_cb');
            $table->timestamps();
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
