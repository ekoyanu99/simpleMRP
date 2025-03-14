<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoDet extends Model
{
    use HasFactory;

    protected $table = 'po_det';
    protected $primaryKey = 'po_det_id';
    protected $fillable = [
        'pod_det_mstr',
        'pod_det_item',
        'pod_det_desc',
        'pod_det_qty',
        'pod_det_uom',
        'pod_det_price',
        'pod_det_subtotal',
        'pod_det_status',
        'pod_det_remarks',
        'pod_det_cb'
    ];

    public function po_mstr()
    {
        return $this->belongsTo(PoMstr::class, 'pod_det_mstr', 'po_mstr_id');
    }
}
