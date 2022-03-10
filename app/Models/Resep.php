<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;


    protected $fillable=['resep_kode','patient','doctor','poli'];
    
    public $timestamps = false;

    public function detailReseps()
    {
        return $this->hasMany(DetailResep::class)->with(['detailRacikans','signa']);
    }
}
