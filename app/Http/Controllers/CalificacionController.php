<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Competencias;
use App\Models\Calificacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CalificacionController extends Controller
{
    /**
     * Muestra el formulario de calificación
     */
    public function create()
    {
        // Obtener todos los empleados para los selectores
        $empleados = Empleado::orderBy('nombres_apellidos', 'asc')->get();
        $competencias = Competencias::all();

        return view('evaluaciones.calificacion', compact('empleados','competencias'));
    }

    public function store(Request $request)
    {
      
    }

    public function index()
    {

        // Obtener todos los empleados para los selectores
        $empleados = Empleado::orderBy('nombres_apellidos', 'asc')->get();
        $competencias = Competencias::all();

        return view('evaluaciones.calificacion', compact('empleados','competencias'));
    }
}
