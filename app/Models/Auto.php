<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auto extends Model
{
    use HasFactory;
    protected $fillable=['placa','tipo','uso','persona_id'];
    public function persona(){
        return $this->belongsTo('App\Models\Persona');
    }
}
