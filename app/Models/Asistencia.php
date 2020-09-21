<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{

    use HasFactory;
    protected $fillable=['objetos','observaciones','persona_id','destino_1','recinto'];

    public function persona()
    {
        return $this->belongsTo('App\Models\Persona');
    }
    public function destino()
    {
        return $this->belongsTo('App\Models\Destino');
    }
}
