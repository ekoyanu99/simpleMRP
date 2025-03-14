<?php

namespace App\Models;

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
        'po_mstr_cb'
    ];

    // public function vendor()
    // {
    //     return $this->belongsTo(VendorMstr::class, 'po_mstr_vendor', 'vd_mstr_id');
    // }


    public function poDet()
    {
        return $this->hasMany(PoDet::class, 'pod_det_mstr', 'po_mstr_id');
    }
}
