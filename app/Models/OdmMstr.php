<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OdmMstr extends Model
{
    use HasFactory;

    protected $table = 'odm_mstr';
    protected $primaryKey = 'odm_mstr_id';
    protected $fillable = [
        'odm_mstr_sodid',
        'odm_mstr_nbr',
        'odm_mstr_fg',
        'odm_mstr_fguom',
        'odm_mstr_qtyorder',
        'odm_mstr_level',
        'odm_mstr_parent',
        'odm_mstr_parentuom',
        'odm_mstr_child',
        'odm_mstr_childuom',
        'odm_mstr_rjrate',
        'odm_mstr_req',
        'odm_mstr_cb',
    ];
}
