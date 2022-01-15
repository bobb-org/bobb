<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetObject extends Model
{
    protected $table='assetobject';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'contract', 'email', 'adress', 'postCode', 'city', 'nip',
    ];

    
}
