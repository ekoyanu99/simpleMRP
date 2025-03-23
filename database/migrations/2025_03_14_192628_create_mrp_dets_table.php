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
        Schema::create('mrp_det', function (Blueprint $table) {
            $table->id('mrp_det_id');
            $table->unsignedBigInteger('mrp_det_mstr')->nullable(false);
            $table->bigInteger('mrp_det_item');
            $table->string('mrp_det_sales', 100);
            $table->date('mrp_det_date');
            $table->decimal('mrp_det_qtyreq', 10, 2);
            $table->decimal('mrp_det_stock', 10, 2);
            $table->decimal('mrp_det_outstanding', 10, 2);
            $table->decimal('mrp_det_mr', 10, 2);
            $table->foreign('mrp_det_mstr')->references('mrp_mstr_id')->on('mrp_mstr')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mrp_det');
    }
};
