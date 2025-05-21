<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesMstr extends Model
{
    use HasFactory;

    protected $table = 'sales_mstr';
    protected $primaryKey = 'sales_mstr_id';
    protected $fillable = [
        'sales_mstr_nbr',
        'sales_mstr_bill',
        'sales_mstr_ship',
        'sales_mstr_date',
        'sales_mstr_due_date',
        'sales_mstr_status',
        'sales_mstr_total',
        'sales_mstr_cb',
        'sales_mstr_uuid',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->sales_mstr_uuid = Str::uuid(); // Auto-generate
        });
    }

    public function salesDet()
    {
        return $this->hasMany(SalesDet::class, 'sales_det_mstr', 'sales_mstr_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'sales_mstr_cb', 'id');
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
            'SalesMstrList_Filter.f_sales_mstr_nbr' => $request->input('f_sales_mstr_nbr'),
            'SalesMstrList_Filter.f_sales_mstr_bill' => $request->input('f_sales_mstr_bill'),
            'SalesMstrList_Filter.f_sales_mstr_ship' => $request->input('f_sales_mstr_ship'),
            'SalesMstrList_Filter.isExactMatch' => $request->input('isExactMatch'),
        ]);

        if ($request->filled('f_sales_mstr_nbr')) {
            $query->searchFilter('sales_mstr_nbr', $request->input('f_sales_mstr_nbr'), $request->input('isExactMatch'));
        }
        if ($request->filled('f_sales_mstr_bill')) {
            $query->searchFilter('sales_mstr_bill', $request->input('f_sales_mstr_bill'), $request->input('isExactMatch'));
        }
        if ($request->filled('f_sales_mstr_ship')) {
            $query->searchFilter('sales_mstr_ship', $request->input('f_sales_mstr_ship'), $request->input('isExactMatch'));
        }

        return $query;
    }
}
