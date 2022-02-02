<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssetObject extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'contract', 'email', 'adress', 'postCode', 'city', 'nip',
    ];

    public function asset(){
        return $this->belongsTo(Asset::Class);
    }

    
}
