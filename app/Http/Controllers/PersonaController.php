<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return Persona::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $p=new Persona();
        $p->nombres=$request->nombres;
        $p->apellidos=$request->apellidos;
        $p->celular=$request->celular;
        $p->expedido=$request->expedido;
        $p->nacionalidad=$request->nacionalidad;
        $p->ci=$request->ci;
        $p->save();
        return $p;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $p=Persona::where('ci','=',"$id")->get();
        return $p;
    }
    public function obs($id){
        return Asistencia::where('persona_id','=',$id)->where('observado','=','SI')->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $p=Persona::find($id);
        $p->nombres=$request->nombres;
        $p->apellidos=$request->apellidos;
        $p->celular=$request->celular;
        $p->expedido=$request->expedido;
        $p->nacionalidad=$request->nacionalidad;
        $p->ci=$request->ci;
        $p->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $p=Persona::find($id);
        $p->delete();
    }
}
