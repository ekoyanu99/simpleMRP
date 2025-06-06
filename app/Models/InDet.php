<?php

namespace App\Models;

use Illuminate\Support\Str;
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
        'in_det_cb',
        'in_det_uuid',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->in_det_uuid = Str::uuid();
        });
    }


    public function itemMstr()
    {
        return $this->belongsTo(ItemMstr::class, 'in_det_item', 'item_id');
    }

    public function scopesearchFilter($query, $field, $value, $exactMatch = false)
    {
        if (!empty($value)) {
            if ($exactMatch) {
                return $query->where($field, '=', $value);
            } else {
                return $query->where($field, 'LIKE', '%' . $value . '%');
            }
        }
        return $query;
    }

    public function scopeFilter($query, $request)
    {
        session([
            'InDetList_Filter.f_item_name' => $request->input('f_item_name'),
            'InDetList_Filter.f_item_desc' => $request->input('f_item_desc'),
            'InDetList_Filter.f_in_det_loc' => $request->input('f_in_det_loc'),
            'InDetList_Filter.isExactMatch' => $request->input('isExactMatch'),
        ]);

        if ($request->filled('f_item_name')) {
            $query->whereHas('itemMstr', function ($q) use ($request) {
                $q->searchFilter('item_name', $request->input('f_item_name'), $request->input('isExactMatch'));
            });
        }
        if ($request->filled('f_item_desc')) {
            $query->whereHas('itemMstr', function ($q) use ($request) {
                $q->searchFilter('item_desc', $request->input('f_item_desc'), $request->input('isExactMatch'));
            });
        }
        if ($request->filled('f_in_det_loc')) {
            $query->searchFilter('in_det_loc', $request->input('f_in_det_loc'), $request->input('isExactMatch'));
        }

        return $query;
    }
}
