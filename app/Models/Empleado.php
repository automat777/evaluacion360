<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    // Ajusta 'empleados' al nombre EXACTO que ves en tu base de datos (ej. 'empleado')
    protected $table = 'empleado'; 

    protected $fillable = ['nombre', 'cargo', 'email'];
}