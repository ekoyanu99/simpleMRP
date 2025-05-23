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
        Schema::create('bom_mstr', function (Blueprint $table) {
            $table->id('bom_mstr_id');
            $table->uuid('bom_mstr_uuid')->unique()->nullable();;
            $table->integer('bom_mstr_parent');
            $table->integer('bom_mstr_child');
            $table->decimal('bom_mstr_qtyper', 18, 2);
            $table->date('bom_mstr_start');
            $table->date('bom_mstr_expire')->nullable();
            $table->string('bom_mstr_status');
            $table->string('bom_mstr_remark');
            $table->bigInteger('bom_mstr_cb');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bom_mstr');
    }
};
