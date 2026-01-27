<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\PeriodoEvaluacion;
use App\Models\TipoRelacion;
use App\Models\RelacionEvaluacion;
use Illuminate\Http\Request;

class EvaluacionController extends Controller
{
    public function create()
    {
        // Obtenemos los datos para llenar los selects del formulario
        $periodos = PeriodoEvaluacion::all();
        $empleados = Empleado::all();
        //dd($empleados);
        $tipos = TipoRelacion::all();

        return view('evaluaciones.create', compact('periodos', 'empleados', 'tipos'));
    }

    public function store(Request $request)
    {
       // Validamos usando los nombres que vienen del HTML ('name' del select)
        $request->validate([
            'periodo_id'   => 'required',
            'evaluador_id' => 'required',
            'evaluado_id'  => 'required',
            'tipo_id'      => 'required',
        ]);

       
        $descripcion = TipoRelacion::where('id', $request->tipo_id)->value('descripcion');

        // Preparamos el array final mapeando los nombres del HTML a los nombres de la DB
        $data = [
             'id_periodo'   => $request->periodo_id,
             'id_evaluador' => $request->evaluador_id,
             'id_evaluado'  => $request->evaluado_id,
             'id_tipo'      => $request->tipo_id,
             'fecha'        => now()->format('Y-m-d'),
             'descripcion_relacion_evaluacion' => $descripcion
        ];

        //dd($data);
        
        RelacionEvaluacion::create($data);

        return redirect()->back()->with('success', 'Relación creada con éxito.');
    }
}