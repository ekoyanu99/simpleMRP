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
            $table->id('pod_det_id');
            $table->uuid('pod_det_uuid')->unique()->nullable();;
            $table->unsignedBigInteger('pod_det_mstr');
            $table->string('pod_det_item');
            $table->string('pod_det_desc')->nullable();
            $table->decimal('pod_det_qty', 18, 2)->nullable();
            $table->string('pod_det_uom')->nullable();
            $table->decimal('pod_det_price', 18, 2)->nullable();
            $table->decimal('pod_det_subtotal', 20, 2)->nullable();
            $table->boolean('pod_det_status')->default(0);
            $table->string('pod_det_remarks')->nullable();
            $table->bigInteger('pod_det_cb')->nullable();
            $table->timestamps();
            $table->foreign('pod_det_mstr')->references('po_mstr_id')->on('po_mstr');
            $table->softDeletes();
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
