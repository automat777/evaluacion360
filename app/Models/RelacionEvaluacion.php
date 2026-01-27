<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelacionEvaluacion extends Model
{

    // Desactiva el manejo automático de created_at y updated_at
    public $timestamps = false;

    protected $table = 'relacion_evaluacion';

    protected $fillable = [
        'descripcion_relacion_evaluacion',
        'id_evaluado',
        'id_evaluador',
        'fecha',
        'id_tipo',
        'id_periodo'    
];
}
