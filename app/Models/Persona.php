<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $fillable=['nombre','ci','celular'];
//    public function asistencia()
//    {
//        return $this->hasOne('App\Models\Asistencia');
//    }
}
