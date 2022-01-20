<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asset extends Model
{

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'realizationId', 'autodeskForgeUrn', 
    ];

    public function assetObject(){
        return $this->hasMany(AssetObject::Class);
    }
    public function realization(){
        return $this->belongsTo(Realization::Class);
    }
}
