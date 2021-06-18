<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Realization extends Model
{
    use HasFactory;

	protected $fillable = ['name', 'city', 'street', 'number']

	public function members() {
		return $this->belongsToMany(Employee::class);
	}

	public function assets() {
		return $this->hasMany(RealizationAsset::class);
	}

}
