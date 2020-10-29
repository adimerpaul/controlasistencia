<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Auto;
use App\Models\Ingresoauto;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IngresoautoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function quitar($id)
    {
        $d=Ingresoauto::find($id);
//        $d->objetos=$request->objetos;
//        $d->recinto=Auth::user()->tipo;
        $d->observado="NO";
//        $d->observaciones=$request->observaciones;
        $d->save();
        return  $d;
    }
    public function index()
    {
        return Ingresoauto::with('persona')
            ->with('destino')
            ->with('user')
            ->with('auto')
//            ->whereDate('created_at','>=',$d1)
//            ->whereDate('created_at','<=',$d2)
//                ->where('estado','=','')
            ->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $request->hasFile('image1')?$path1 = $request->file('image1')->store('images'):$path1='';
//        $request->hasFile('image2')?$path2 = $request->file('image2')->store('images'):$path2='';
//        $request->hasFile('image3')?$path3 = $request->file('image3')->store('images'):$path3='';
//        $request->hasFile('image4')?$path4 = $request->file('image4')->store('images'):$path4='';
//
//        $d=New Ingresoauto();
////        return $request->objetos;
//        isset($request->objetos)&&$request->objetos!='undefined'?$d->objetos=strtoupper($request->objetos):$d->objetos='';
//        $d->recinto=Auth::user()->tipo;
////            $d->motivo=$request->motivo;
//        isset($request->motivo)&&$request->motivo!='undefined'?$d->motivo=strtoupper($request->motivo):$d->motivo='';
////            $d->targeta=$request->targeta;
//        isset($request->targeta)&&$request->targeta!='undefined'?$d->targeta=strtoupper($request->targeta):$d->targeta='';
////        $d->objetos=$request->objetos;
////        $d->recinto=Auth::user()->tipo;
////        $d->motivo=$request->motivo;
////        $d->targeta=$request->targeta;
//        $d->persona_id=$request->persona_id;
//        $d->destino_id=$request->destino_id;
//        $d->auto_id=$request->auto_id;
//        $d->image1=$path1;
//        $d->image2=$path2;
//        $d->image3=$path3;
//        $d->image4=$path4;
//        $d->user_id=Auth::user()->id;
//        $d->save();
//
//        $ad=New Asistencia();
////        return $request->objetos;
//        isset($request->objetos)&&$request->objetos!='undefined'?$ad->objetos=strtoupper($request->objetos):$ad->objetos='';
//        $ad->recinto=Auth::user()->tipo;
////            $ad->motivo=$request->motivo;
//        isset($request->motivo)&&$request->motivo!='undefined'?$ad->motivo=strtoupper($request->motivo):$ad->motivo='';
////            $ad->targeta=$request->targeta;
//        isset($request->targeta)&&$request->targeta!='undefined'?$ad->targeta=strtoupper($request->targeta):$ad->targeta='';
//        $ad->persona_id=$request->persona_id;
//        $ad->destino_id=$request->destino_id;
//        $ad->image1=$path1;
//        $ad->image2=$path2;
//        $ad->image3=$path3;
//        $ad->image4=$path4;
//        $ad->user_id=Auth::user()->id;
//        $ad->save();
        $persona=Persona::where('ci','=',$request->ci)->get();
        if ($persona->count()==0){
            $per=new Persona();
            $per->nombres=$request->nombres;
            $per->apellidos=$request->apellidos;
            $per->ci=$request->ci;
            $per->celular=isset($request->celular)&&$request->celular!='undefined'?$request->celular:'';
            $per->expedido=$request->expedido;
            $per->nacionalidad=$request->nacionalidad;
            $per->save();
            $persona_id=$per->id;
        }else{
            $per=Persona::find($persona[0]->id);
            $per->nombres=$request->nombres;
            $per->apellidos=$request->apellidos;
            $per->ci=$request->ci;
            $per->celular=isset($request->celular)&&$request->celular!='undefined'?$request->celular:'';
            $per->expedido=$request->expedido;
            $per->nacionalidad=$request->nacionalidad;
            $per->save();
            $persona_id=$per->id;
        }
        $auto=Auto::where('placa','=',$request->placa)->get();
        if ($auto->count()==0){
            $au=new Auto();
            $au->placa=$request->placa;
            $au->tipo=$request->tipo;
            $au->uso=$request->uso;
            $au->persona_id=$persona_id;
            $au->save();
            $auto_id=$au->id;
        }else{
            $au=Auto::find($auto[0]->id);
            $au->placa=$request->placa;
            $au->tipo=$request->tipo;
            $au->uso=$request->uso;
            $au->persona_id=$persona_id;
            $au->save();
            $auto_id=$au->id;
//            return $auto[0]->id;
        }


        $d=New Ingresoauto();
        isset($request->objetos)&&$request->objetos!='undefined'?$d->objetos=strtoupper($request->objetos):$d->objetos='';
        $d->recinto=Auth::user()->tipo;
        isset($request->motivo)&&$request->motivo!='undefined'?$d->motivo=strtoupper($request->motivo):$d->motivo='';
        isset($request->observaciones)&&$request->observaciones!='undefined'?$d->targeta=strtoupper($request->observaciones):$d->targeta='';
        $d->persona_id=$persona_id;
        $d->destino_id=$request->destino_id;
        $d->auto_id=$auto_id;
        $d->image1='';
        $d->image2='';
        $d->image3='';
        $d->image4='';
        $d->user_id=Auth::user()->id;
        $d->save();
//
//
        $ad=New Asistencia();
//        return $request->objetos;
        isset($request->objetos)&&$request->objetos!='undefined'?$ad->objetos=strtoupper($request->objetos):$ad->objetos='';
        $ad->recinto=Auth::user()->tipo;
//            $ad->motivo=$request->motivo;
        isset($request->motivo)&&$request->motivo!='undefined'?$ad->motivo=strtoupper($request->motivo):$ad->motivo='';
//            $ad->targeta=$request->targeta;
        isset($request->targeta)&&$request->targeta!='undefined'?$ad->targeta=strtoupper($request->targeta):$ad->targeta='';
        $ad->persona_id=$persona_id;
        $ad->destino_id=$request->destino_id;
        $ad->image1='';
        $ad->image2='';
        $ad->image3='';
        $ad->image4='';
        $ad->user_id=Auth::user()->id;
        $ad->save();

//        return $persona->id;
//        return $persona[0];

//        $auto=Auto::where('placa','=',$request->placa)->get();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ingresoauto  $ingresoauto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $d=Ingresoauto::find($id);
        $d->salida=date('Y-m-d H:i:s');
        $d->estado="SALIDO";
        $d->save();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ingresoauto  $ingresoauto
     * @return \Illuminate\Http\Response
     */
    public function edit(Ingresoauto $ingresoauto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ingresoauto  $ingresoauto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $d=Ingresoauto::find($id);
//        $d->objetos=$request->objetos;
//        $d->recinto=Auth::user()->tipo;
        $d->observado="SI";
        $d->observaciones=$request->observaciones;
        $d->save();
        return  $d;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ingresoauto  $ingresoauto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ingresoauto $ingresoauto)
    {
        //
    }
    public function date($d1,$d2)
    {
        if (Auth::user()->tipo=='ADMIN')
            return Ingresoauto::with('persona')
                ->with('destino')
                ->with('user')
                ->with('auto')
                ->whereDate('created_at','>=',$d1)
                ->whereDate('created_at','<=',$d2)
//                ->where('estado','=','')
                ->get();
        else
            return Ingresoauto::with('persona')
                ->with('destino')
                ->with('user')
                ->with('auto')
                ->where('recinto','=',Auth::user()->tipo)
                ->whereDate('created_at','>=',$d1)
                ->whereDate('created_at','<=',$d2)
                ->get();
    }
    public function date2($d1,$d2)
    {
        return Ingresoauto::with('persona')
            ->with('destino')
            ->with('auto')
            ->where('recinto','=',Auth::user()->tipo)
            ->whereNull('salida')
            ->where('user_id','=',Auth::user()->id)
            ->whereDate('created_at','>=',$d1)
            ->whereDate('created_at','<=',$d2)
            ->get();
    }
    public function date3($d1,$d2)
    {
        return Ingresoauto::with('persona')
            ->with('destino')
            ->with('auto')
            ->with('user')
            ->where('recinto','=',Auth::user()->tipo)
            ->whereNull('salida')
//            ->where('user_id','=',Auth::user()->id)
            ->whereDate('created_at','>=',$d1)
            ->whereDate('created_at','<=',$d2)
            ->get();
    }
}
