<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table='employee';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'contact', 'email', 'PESEL', 'seriesIdCard', 'numberIdCard','validityIdCard', 'dateOfBirth', 'fatherName', 'adress', 'postCode', 'city', 'company', 'position',
    ];

    
}
