<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{

    use HasFactory;
    protected $fillable=['objetos','observaciones','persona_id'];

    public function persona()
    {
        return $this->belongsTo('App\Models\persona');
    }
}
