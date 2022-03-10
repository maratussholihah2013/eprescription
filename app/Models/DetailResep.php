<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailResep extends Model
{
    use HasFactory;
    
    protected $fillable=['resep_id','signa_id','jenis_racikan','nama_racikan'];

    public function signa()
    {
    	return $this->belongsTo(Signa::class);
    }

    public function resep()
    {
    	return $this->belongsTo(Resep::class);
    }

    public function detailRacikans()
    {
        return $this->hasMany(DetailRacikan::class);
    }
}
