<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signa extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function detailReseps()
    {
        return $this->hasMany(DetailResep::class);
    }
}
