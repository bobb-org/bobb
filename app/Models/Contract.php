<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contract extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'post_code', 'city', 'adress', 'general_contractor', 'contractor',
    ];

    public function realization(){
        return $this->hasOne(Realization::Class);
    }

    public function organizationContractor(){
        return $this->belongsTo(Organizations::Class, 'contractor');
    }

    public function organizationGeneralContractor(){
        return $this->belongsTo(Asset::Class, 'general_contractor');
    }
    
}
