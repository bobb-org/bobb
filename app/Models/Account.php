<?php

namespace App\Models;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Account extends Authenticatable //Model
{
    
    use HasApiTokens, HasFactory, Notifiable;//opt
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login', 'password', 'employee_id', 'active', 
    ];

    protected $protected = [
        'password'
    ];

    public function employee(){
        return $this->belongsTo(Employee::Class);
    }
    public function Position(){
        return $this->hasOneThrough(Position::Class, Employee::class, 'position_id', 'employees.id');
    }
}
