<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemMstr extends Model
{
    use HasFactory;

    protected $table = 'item_mstr';

    protected $primaryKey = 'item_id';

    protected $fillable = [
        'item_name',
        'item_desc',
        'item_pmcode',
        'item_prod_line',
        'item_rjrate',
        'item_status',
        'item_cb',
        'item_uom',
        'item_uuid'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'item_spec' => 'array',
        'item_status' => 'boolean',
        'item_cb' => 'integer',
    ];

    protected $attributes = [
        'item_pmcode' => 'P',
        'item_prod_line' => 'SUP',
        'item_rjrate' => '0',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->item_uuid = Str::uuid(); // Auto-generate
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'item_cb', 'id');
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
            'ItemMstrList_Filter.f_item_name' => $request->input('f_item_name'),
            'ItemMstrList_Filter.f_item_desc' => $request->input('f_item_desc'),
            'ItemMstrList_Filter.f_item_pmcode' => $request->input('f_item_pmcode'),
            'ItemMstrList_Filter.f_item_prod_line' => $request->input('f_item_prod_line'),
            'ItemMstrList_Filter.f_item_rjrate' => $request->input('f_item_uom'),
            'ItemMstrList_Filter.isExactMatch' => $request->input('isExactMatch'),
        ]);

        if ($request->filled('f_item_name')) {
            $query->searchFilter('item_name', $request->input('f_item_name'), $request->input('isExactMatch'));
        }
        if ($request->filled('f_item_desc')) {
            $query->searchFilter('item_desc', $request->input('f_item_desc'), $request->input('isExactMatch'));
        }
        if ($request->filled('f_item_pmcode')) {
            $query->searchFilter('item_pmcode', $request->input('f_item_pmcode'), $request->input('isExactMatch'));
        }
        if ($request->filled('f_item_prod_line')) {
            $query->searchFilter('item_prod_line', $request->input('f_item_prod_line'), $request->input('isExactMatch'));
        }
        if ($request->filled('f_item_rjrate')) {
            $query->searchFilter('item_rjrate', $request->input('f_item_rjrate'), $request->input('isExactMatch'));
        }
        if ($request->filled('f_item_uom')) {
            $query->searchFilter('item_uom', $request->input('f_item_uom'), $request->input('isExactMatch'));
        }

        return $query;
    }
}
