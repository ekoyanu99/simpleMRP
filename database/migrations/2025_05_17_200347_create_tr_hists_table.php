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
        Schema::create('tr_hist', function (Blueprint $table) {
            $table->id('tr_id');
            $table->string('tr_item');
            $table->date('tr_effdate');
            $table->string('tr_type');
            $table->decimal('tr_qty', 18, 2)->nullable();
            $table->string('tr_loc')->nullable();
            $table->string('tr_locto')->nullable();
            $table->string('tr_receiver')->nullable();
            $table->string('tr_ref')->nullable();
            $table->string('tr_rmks')->nullable();
            $table->date('tr_shipdate')->nullable();
            $table->bigInteger('tr_cb')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tr_hist');
    }
};
