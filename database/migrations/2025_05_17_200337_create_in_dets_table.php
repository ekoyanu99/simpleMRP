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
        Schema::create('in_det', function (Blueprint $table) {
            $table->id('in_det_id');
            $table->unsignedBigInteger('in_det_mstr');
            $table->string('in_det_loc');
            $table->string('in_det_item');
            $table->string('in_det_desc')->nullable();
            $table->decimal('in_det_qty', 18, 2)->nullable();
            $table->string('in_det_uom')->nullable();
            $table->decimal('in_det_price', 18, 2)->nullable();
            $table->decimal('in_det_subtotal', 20, 2)->nullable();
            $table->string('in_det_status')->nullable();
            $table->bigInteger('in_det_cb')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('in_det');
    }
};
