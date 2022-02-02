<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeRealization extends Model
{
    public function employee(){
        return $this->belongsTo(Employee::Class);
    }
    public function realization(){
        return $this->belongsTo(Realization::Class);
    }
    public function contract(){
        return $this->hasManyThrough(Contract::Class, Realization::class, 'contract_id', 'id');
    }
    
}
