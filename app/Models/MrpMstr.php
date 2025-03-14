<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MrpMstr extends Model
{
    use HasFactory;

    protected $table = 'mrp_mstr';
    protected $primaryKey = 'mrp_mstr_id';
    protected $fillable = [
        'mrp_mstr_item',
        'mrp_mstr_saldo',
        'mrp_mstr_summary',
        'mrp_mstr_proceded',
        'mrp_mstr_cb'
    ];
    protected $casts = [
        'mrp_mstr_proceded' => 'boolean'
    ];
}
