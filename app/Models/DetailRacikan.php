<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailRacikan extends Model
{
    use HasFactory;
    
    protected $fillable=['obatalkes_id','kuantitas','detail_resep_id'];


    public function detailResep()
    {
    	return $this->belongsTo(DetailResep::class);
    }

    public function obatalkes()
    {
    	return $this->belongsTo(Obatalkes::class);
    }
}
