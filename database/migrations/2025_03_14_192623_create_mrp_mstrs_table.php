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
        Schema::create('mrp_mstr', function (Blueprint $table) {
            $table->id('mrp_mstr_id');
            $table->string('mrp_mstr_item');
            $table->decimal('mrp_mstr_qtyreq', 18, 2)->nullable();
            $table->decimal('mrp_mstr_saldo', 18, 2)->nullable();
            $table->decimal('mrp_mstr_outstanding', 18, 2)->nullable();
            $table->decimal('mrp_mstr_summary', 18, 2)->nullable();
            $table->boolean('mrp_mstr_proceded')->default(false);
            $table->bigInteger('mrp_mstr_cb')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mrp_mstr');
    }
};
