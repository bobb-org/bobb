<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealizationAsset extends Model
{
	use HasFactory;
	public function realization()
	{
		return $this->belongsTo(Realization::class);
	}
}
