<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obatalkes extends Model
{
    use HasFactory;
    protected $fillable=['stok'];

 	public $timestamps = false;
 	
    public function detailRacikans()
    {
        return $this->hasMany(DetailRacikan::class);
    }
}
