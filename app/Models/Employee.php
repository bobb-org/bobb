<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'contact', 'email', 'pesel', 'series_id_card', 'number_id_card','validity_id_card', 'date_of_birth', 'father_name', 'adress', 'post_code', 'city', 'organization_id', 'position_id',
    ];

    public function account(){
        return $this->hasOne(Account::Class);
    }

    public function realization(){
        return $this->hasMany(Realization::Class);
    }

    public function employeeRealization(){
        return $this->hasMany(EmployeeRealization::Class);
    }

    public function positions(){
        return $this->belongsTo(Position::Class);
    }

    public function organization(){
        return $this->belongsTo(Organization::Class);
    }

    
}
