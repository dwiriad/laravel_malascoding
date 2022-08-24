<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = "anggota";
 
    public function hadiah()
    {
    	return $this->belongsToMany('App\Models\Hadiah');
    }
}
