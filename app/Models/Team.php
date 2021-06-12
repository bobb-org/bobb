<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

	public function owner()
	{
		$this.belongsTo(User::class, 'owner_id');
	}

	public function realizations()
	{
		$this.hasMany(Realization::class);
	}
}
