<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodoEvaluacion extends Model
{
    // Si tu tabla en la DB no se llama "periodo_evaluacions", 
    // debes especificar el nombre real de la tabla aquí:
    protected $table = 'periodo_evaluacion'; 

    protected $fillable = ['nombre', 'fecha_inicio', 'fecha_fin'];
}
