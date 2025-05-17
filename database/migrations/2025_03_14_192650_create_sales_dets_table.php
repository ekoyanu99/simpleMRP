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
        Schema::create('sales_det', function (Blueprint $table) {
            $table->id('sales_det_id');
            $table->unsignedBigInteger('sales_det_mstr');
            $table->date('sales_det_date')->nullable();
            $table->date('sales_det_duedate')->nullable();
            $table->string('sales_det_item');
            $table->string('sales_det_desc')->nullable();
            $table->integer('sales_det_qty')->nullable();
            $table->decimal('sales_det_price', 10, 2)->nullable();
            $table->decimal('sales_det_total', 10, 2)->nullable();
            $table->foreign('sales_det_mstr')->references('sales_mstr_id')->on('sales_mstr')->onDelete('cascade');
            $table->bigInteger('sales_det_cb')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_det');
    }
};
