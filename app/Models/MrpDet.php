<?php

namespace App\Models;

use Illuminate\Support\Str;
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
        'mrp_det_outstanding',
        'mrp_det_mr',
        'mrp_det_status',
        'mrp_det_remarks',
        'mrp_det_cb',
        'mrp_det_uuid',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->mrp_det_uuid = Str::uuid(); // Auto-generate
        });
    }
}
