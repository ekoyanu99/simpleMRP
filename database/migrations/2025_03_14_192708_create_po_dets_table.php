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
        Schema::create('po_det', function (Blueprint $table) {
            $table->id('po_det_id');
            $table->unsignedBigInteger('pod_det_mstr');
            $table->string('pod_det_item');
            $table->string('pod_det_desc');
            $table->decimal('pod_det_qty', 10, 2);
            $table->string('pod_det_uom');
            $table->decimal('pod_det_price', 10, 2);
            $table->decimal('pod_det_subtotal', 10, 2);
            $table->string('pod_det_status');
            $table->string('pod_det_remarks')->nullable();
            $table->string('pod_det_cb');
            $table->timestamps();
            $table->foreign('pod_det_mstr')->references('po_mstr_id')->on('po_mstr');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('po_det');
    }
};
