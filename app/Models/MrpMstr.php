<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MrpMstr extends Model
{
    use HasFactory;

    protected $table = 'mrp_mstr';
    protected $primaryKey = 'mrp_mstr_id';
    protected $fillable = [
        'mrp_mstr_item',
        'mrp_mstr_qtyreq',
        'mrp_mstr_outstanding',
        'mrp_mstr_saldo',
        'mrp_mstr_summary',
        'mrp_mstr_proceded',
        'mrp_mstr_cb'
    ];
    protected $casts = [
        'mrp_mstr_proceded' => 'boolean'
    ];

    // 
    public function itemMstr()
    {
        return $this->belongsTo(ItemMstr::class, 'mrp_mstr_item', 'item_mstr_id');
    }

    public function mrpDet()
    {
        return $this->hasMany(MrpDet::class, 'mrp_det_mstr', 'mrp_mstr_id');
    }
}
