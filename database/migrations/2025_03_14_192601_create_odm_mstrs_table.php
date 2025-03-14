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
            $table->bigInteger('odm_mstr_sodid');
            $table->string('odm_mstr_nbr');
            $table->bigInteger('odm_mstr_fg');
            $table->string('odm_mstr_fguom');
            $table->string('odm_mstr_qtyorder');
            $table->string('odm_mstr_level');
            $table->bigInteger('odm_mstr_parent');
            $table->string('odm_mstr_parentuom');
            $table->bigInteger('odm_mstr_child');
            $table->string('odm_mstr_childuom');
            $table->string('odm_mstr_rjrate');
            $table->string('odm_mstr_req');
            $table->integer('odm_mstr_cb');
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
