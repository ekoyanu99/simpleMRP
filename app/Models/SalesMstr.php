<?php

namespace App\Models;

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
        'sales_mstr_cb'
    ];

    public function salesDet()
    {
        return $this->hasMany(SalesDet::class, 'sales_det_mstr', 'sales_mstr_id');
    }
}
