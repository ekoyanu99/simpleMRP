<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MrpDet extends Model
{
    use HasFactory;

    protected $table = 'mrp_det';
    protected $primaryKey = 'mrp_det_id';
    protected $fillable = [
        'mrp_det_mstr',
        'mrp_det_item',
        'mrp_det_sales',
        'mrp_det_date',
        'mrp_det_qtyreq',
        'mrp_det_stock',
        'mrp_det_mr'
    ];
}
