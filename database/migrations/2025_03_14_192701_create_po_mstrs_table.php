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
        Schema::create('po_mstr', function (Blueprint $table) {
            $table->id('po_mstr_id');
            $table->string('po_mstr_nbr', 50);
            $table->date('po_mstr_date');
            $table->unsignedBigInteger('po_mstr_vendor');
            $table->date('po_mstr_delivery_date');
            $table->date('po_mstr_arrival_date');
            $table->string('po_mstr_status');
            $table->string('po_mstr_remarks');
            $table->unsignedBigInteger('po_mstr_cb');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('po_mstr');
    }
};
