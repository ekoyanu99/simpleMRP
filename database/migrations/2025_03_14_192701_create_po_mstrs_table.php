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
            $table->uuid('po_mstr_uuid')->unique()->nullable();;
            $table->string('po_mstr_nbr', 50);
            $table->date('po_mstr_date')->nullable();
            $table->unsignedBigInteger('po_mstr_vendor')->nullable();
            $table->date('po_mstr_delivery_date')->nullable();
            $table->date('po_mstr_arrival_date')->nullable();
            $table->boolean('po_mstr_status')->default(0);
            $table->string('po_mstr_remarks')->nullable();
            $table->decimal('po_mstr_total', 20, 2)->nullable();
            $table->bigInteger('po_mstr_cb')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
