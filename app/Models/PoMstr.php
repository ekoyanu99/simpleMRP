<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoMstr extends Model
{
    use HasFactory;

    protected $table = 'po_mstr';
    protected $primaryKey = 'po_mstr_id';
    protected $fillable = [
        'po_mstr_nbr',
        'po_mstr_date',
        'po_mstr_vendor',
        'po_mstr_delivery_date',
        'po_mstr_arrival_date',
        'po_mstr_status',
        'po_mstr_remarks',
        'po_mstr_cb',
        'po_mstr_uuid',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->po_mstr_uuid = Str::uuid(); // Auto-generate
        });
    }

    // public function vendor()
    // {
    //     return $this->belongsTo(VendorMstr::class, 'po_mstr_vendor', 'vd_mstr_id');
    // }


    public function poDet()
    {
        return $this->hasMany(PoDet::class, 'pod_det_mstr', 'po_mstr_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'po_mstr_cb', 'id');
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
            'PoMstrList_Filter.f_po_mstr_nbr' => $request->input('f_po_mstr_nbr'),
            'PoMstrList_Filter.f_po_mstr_vd' => $request->input('f_po_mstr_vd'),
            'PoMstrList_Filter.isExactMatch' => $request->input('isExactMatch'),
        ]);

        if ($request->filled('f_po_mstr_nbr')) {
            $query->searchFilter('po_mstr_nbr', $request->input('f_po_mstr_nbr'), $request->input('isExactMatch'));
        }
        if ($request->filled('f_po_mstr_vd')) {
            $query->searchFilter('po_mstr_vd', $request->input('f_po_mstr_vd'), $request->input('isExactMatch'));
        }

        return $query;
    }
}
