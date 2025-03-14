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
            $table->date('sales_det_date');
            $table->date('sales_det_duedate');
            $table->string('sales_det_item');
            $table->string('sales_det_desc');
            $table->integer('sales_det_qty');
            $table->decimal('sales_det_price', 10, 2);
            $table->decimal('sales_det_total', 10, 2);
            $table->foreign('sales_det_mstr')->references('sales_mstr_id')->on('sales_mstr')->onDelete('cascade');
            $table->string('sales_det_cb');
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
