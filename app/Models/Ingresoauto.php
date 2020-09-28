<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingresoauto extends Model
{
    use HasFactory;

    public function persona()
    {
        return $this->belongsTo('App\Models\Persona');
    }
    public function destino()
    {
        return $this->belongsTo('App\Models\Destino');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function auto()
    {
        return $this->belongsTo('App\Models\Auto');
    }
}
