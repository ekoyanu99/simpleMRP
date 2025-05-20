<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemMstr extends Model
{
    use HasFactory;

    protected $table = 'item_mstr';

    protected $primaryKey = 'item_mstr_id';

    protected $fillable = [
        'item_name',
        'item_desc',
        'item_pmcode',
        'item_prod_line',
        'item_rjrate',
        'item_status',
        'item_mstr_cb',
        'item_uom',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $attributes = [
        'item_pmcode' => 'P',
        'item_prod_line' => 'SUP',
        'item_rjrate' => '0',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'item_mstr_cb', 'id');
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
        ]);

        if ($request->filled('f_item_name')) {
            $query->searchFilter('item_name', $request->input('f_item_name'));
        }
        if ($request->filled('f_item_desc')) {
            $query->searchFilter('item_desc', $request->input('f_item_desc'));
        }
        if ($request->filled('f_item_pmcode')) {
            $query->searchFilter('item_pmcode', $request->input('f_item_pmcode'));
        }
        if ($request->filled('f_item_prod_line')) {
            $query->searchFilter('item_prod_line', $request->input('f_item_prod_line'));
        }
        if ($request->filled('f_item_rjrate')) {
            $query->searchFilter('item_rjrate', $request->input('f_item_rjrate'));
        }
        if ($request->filled('f_item_uom')) {
            $query->searchFilter('item_uom', $request->input('f_item_uom'));
        }

        return $query;
    }
}
