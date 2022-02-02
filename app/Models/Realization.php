<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Realization extends Model
{
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'realization_id', 'start_date', 'planned_end_date', 'supervisor', 
    ];

    public function asset(){
        return $this->hasMany(Asset::Class);
    }
    public function employeeRealization(){
        return $this->belongsTo(EmployeeRealization::Class);
    }
    public function contract(){
        return $this->belongsTo(Contract::Class);
    }
    public function employee(){
        return $this->belongsTo(Contract::Class);
    }
}
