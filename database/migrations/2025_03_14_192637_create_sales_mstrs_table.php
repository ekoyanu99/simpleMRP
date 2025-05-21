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
        Schema::create('sales_mstr', function (Blueprint $table) {
            $table->id('sales_mstr_id');
            $table->uuid('sales_mstr_uuid')->unique()->nullable();;
            $table->string('sales_mstr_nbr', 20)->unique();
            $table->string('sales_mstr_bill')->nullable();
            $table->string('sales_mstr_ship')->nullable();
            $table->date('sales_mstr_date')->nullable();
            $table->date('sales_mstr_due_date')->nullable();
            $table->string('sales_mstr_status', 20)->nullable();
            $table->decimal('sales_mstr_total', 20, 2)->nullable();
            $table->bigInteger('sales_mstr_cb')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_mstr');
    }
};
