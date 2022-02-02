<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organization extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'contact', 'email', 'adress', 'post_code', 'city', 'nip',
    ];

    public function contractor(){
        return $this->hasMany(Contract::Class, 'contractor');
    }
    
    public function generalContractor(){
        return $this->hasMany(Contract::Class,'general_contractor');
    }

    public function employee(){
        return $this->hasMany(Employee::Class);
    }
}
