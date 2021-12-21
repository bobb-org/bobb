<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetObject extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_object', 'id_asset', 'properties', 'name',
    ];
}
