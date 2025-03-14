<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BomMstr extends Model
{
    use HasFactory;

    protected $table = 'bom_mstr';
    protected $primaryKey = 'bom_mstr_id';
    protected $fillable = [
        'bom_mstr_parent',
        'bom_mstr_child',
        'bom_mstr_qtyper',
        'bom_mstr_start',
        'bom_mstr_expire',
        'bom_mstr_status',
        'bom_mstr_remark',
        'bom_mstr_cb'
    ];
}
