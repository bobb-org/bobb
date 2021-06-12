<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function company()
	{
		return $this->belongsTo(Company::class);
	}

	public function position()
	{
		return $this->belongsTo(Position::class);
	}
}
