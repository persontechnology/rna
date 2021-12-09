<?php

namespace App\Http\Controllers;

use App\Models\Historial;
use App\Models\Paciente;
use App\Models\Pulso;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function index(Request $request,$cedula=null)
    {
        if($request->cedula){
            $pacientes=Paciente::where('cedula', "like", "%" . $request->cedula . "%")->take(5)->get();
            return response()->json($pacientes);
        }else{
           $pacientes=Paciente::take(5)->get();
           return response()->json($pacientes);
        }

        
        
    }

    public function eliminar(Request $request)
    {
        $p=Paciente::find($request->id);
        try {
            $p->delete();
            return response()->json(['msg'=>'ok']);
        } catch (\Throwable $th) {
            return response()->json(['msg'=>'no']);
        }
    }
    public function guardar(Request $request)
    {
        $id=$request->id;
        $msg='crear';
        if($id!=''){
            $validated = $request->validate([
                'apellidos' => 'required|max:100',
                'nombres'   => 'required|max:100',
                'cedula'    => 'required|unique:pacientes,cedula,'.$id,
            ]);
            $p=Paciente::find($id);
            $msg='editar';
        }else{
            
            $validated = $request->validate([
                'apellidos' => 'required|max:100',
                'nombres'   => 'required|max:100',
                'cedula'    => 'required|unique:pacientes|max:10',
            ]);
            $p=new Paciente();
        }

        try {
           
           
            
            $p->apellidos=$request->apellidos;
            $p->nombres=$request->nombres;
            $p->cedula=$request->cedula;
            $p->save();
            return response()->json(['msg'=>$msg]);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    public function pulsos()
    {
        $pulso=Pulso::first();
        $pulsos = array();
        foreach ($pulso->data as $key => $value) {
            array_push($pulsos,''.$key+1);
        }
        return response()->json([
            'labels'=>$pulsos,
            'datasets'=>[
                [
                    'data'=>$pulso->data
                ]
            ],
            'valor'=>$pulso->valor
        ]);
    }

    public function guaradarHistorial(Request $request)
    {
        try {
            Historial::create([
                'pulso_cardiaco'=>$request->pulso,
                'paciente_id'=>$request->id,
                'estado'=>'A'
            ]);
            return response()->json('ok');
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    public function listadoHistorial(Request $request)
    {
        $pac=Paciente::find($request->paciente);
        return response()->json($pac->historiales);
        
    }
}
