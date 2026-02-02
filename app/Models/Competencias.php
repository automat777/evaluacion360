<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competencias extends Model
{
    // Ajusta 'empleados' al nombre EXACTO que ves en tu base de datos (ej. 'empleado')
    protected $table = 'area_competencia'; 

    protected $fillable = ['nombre_area_competencia'];
}