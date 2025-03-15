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
}
