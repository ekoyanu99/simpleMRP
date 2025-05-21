<?php

namespace App\Models;

use Illuminate\Support\Str;
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
        'pod_det_cb',
        'pod_det_uuid',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->po_det_uuid = Str::uuid(); // Auto-generate
        });
    }

    public function po_mstr()
    {
        return $this->belongsTo(PoMstr::class, 'pod_det_mstr', 'po_mstr_id');
    }

    public function itemMstr()
    {
        return $this->belongsTo(ItemMstr::class, 'pod_det_item', 'item_id');
    }
}
