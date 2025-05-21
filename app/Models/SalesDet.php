<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesDet extends Model
{
    use HasFactory;

    protected $table = 'sales_det';
    protected $primaryKey = 'sales_det_id';
    protected $fillable = [
        'sales_det_mstr',
        'sales_det_date',
        'sales_det_duedate',
        'sales_det_item',
        'sales_det_desc',
        'sales_det_qty',
        'sales_det_price',
        'sales_det_total',
        'sales_det_cb',
        'sales_det_uuid',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->sales_det_uuid = Str::uuid(); // Auto-generate
        });
    }

    public function salesMstr()
    {
        return $this->belongsTo(SalesMstr::class, 'sales_det_mstr', 'sales_mstr_id');
    }

    public function itemMstr()
    {
        return $this->belongsTo(ItemMstr::class, 'sales_det_item', 'item_id');
    }
}
