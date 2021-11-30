<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'id_realization',
    ];

    public function iduser(){

        return $this->belongsTo(User::class,'id');
    }


    public function realization(){

        return $this->belongsTo(Realization::class,'id_realization');
    }
    
}
