<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InDet extends Model
{
    /** @use HasFactory<\Database\Factories\InDetFactory> */
    use HasFactory;

    protected $table = 'in_det';
    protected $primaryKey = 'in_det_id';

    protected $fillable = [
        'in_det_mstr',
        'in_det_loc',
        'in_det_item',
        'in_det_desc',
        'in_det_qty',
        'in_det_uom',
        'in_det_price',
        'in_det_subtotal',
        'in_det_status',
        'in_det_cb'
    ];

    public function itemMstr()
    {
        return $this->belongsTo(ItemMstr::class, 'in_det_item', 'item_mstr_id');
    }
}
