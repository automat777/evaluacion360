<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
     // Ajusta 'empleados' al nombre EXACTO que ves en tu base de datos (ej. 'empleado')
    protected $table = 'detalle_evaluacion'; 

    protected $fillable = ['calificacion', 'evaluador_id', 'evaluado_id', 'competencia_id'];
}
