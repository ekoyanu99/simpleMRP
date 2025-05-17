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
        Schema::create('odm_mstr', function (Blueprint $table) {
            $table->id('odm_mstr_id');
            $table->bigInteger('odm_mstr_sodid')->nullable();
            $table->string('odm_mstr_nbr')->nullable();
            $table->bigInteger('odm_mstr_fg')->nullable();
            $table->string('odm_mstr_fguom')->nullable();
            $table->string('odm_mstr_qtyorder')->nullable();
            $table->string('odm_mstr_level')->nullable();
            $table->bigInteger('odm_mstr_parent')->nullable();
            $table->string('odm_mstr_parentuom')->nullable();
            $table->bigInteger('odm_mstr_child')->nullable();
            $table->string('odm_mstr_childuom')->nullable();
            $table->string('odm_mstr_rjrate')->nullable();
            $table->string('odm_mstr_req')->nullable();
            $table->string('odm_mstr_status')->nullable();
            $table->bigInteger('odm_mstr_cb')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('odm_mstr');
    }
};
