<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Ingresoauto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IngresoautoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $request->hasFile('image1')?$path1 = $request->file('image1')->store('images'):$path1='';
        $request->hasFile('image2')?$path2 = $request->file('image2')->store('images'):$path2='';
        $request->hasFile('image3')?$path3 = $request->file('image3')->store('images'):$path3='';
        $request->hasFile('image4')?$path4 = $request->file('image4')->store('images'):$path4='';

        $d=New Ingresoauto();
//        return $request->objetos;
        isset($request->objetos)&&$request->objetos!='undefined'?$d->objetos=strtoupper($request->objetos):$d->objetos='';
        $d->recinto=Auth::user()->tipo;
//            $d->motivo=$request->motivo;
        isset($request->motivo)&&$request->motivo!='undefined'?$d->motivo=strtoupper($request->motivo):$d->motivo='';
//            $d->targeta=$request->targeta;
        isset($request->targeta)&&$request->targeta!='undefined'?$d->targeta=strtoupper($request->targeta):$d->targeta='';
//        $d->objetos=$request->objetos;
//        $d->recinto=Auth::user()->tipo;
//        $d->motivo=$request->motivo;
//        $d->targeta=$request->targeta;
        $d->persona_id=$request->persona_id;
        $d->destino_id=$request->destino_id;
        $d->auto_id=$request->auto_id;
        $d->image1=$path1;
        $d->image2=$path2;
        $d->image3=$path3;
        $d->image4=$path4;
        $d->user_id=Auth::user()->id;
        $d->save();

        $ad=New Asistencia();
//        return $request->objetos;
        isset($request->objetos)&&$request->objetos!='undefined'?$ad->objetos=strtoupper($request->objetos):$ad->objetos='';
        $ad->recinto=Auth::user()->tipo;
//            $ad->motivo=$request->motivo;
        isset($request->motivo)&&$request->motivo!='undefined'?$ad->motivo=strtoupper($request->motivo):$ad->motivo='';
//            $ad->targeta=$request->targeta;
        isset($request->targeta)&&$request->targeta!='undefined'?$ad->targeta=strtoupper($request->targeta):$ad->targeta='';
        $ad->persona_id=$request->persona_id;
        $ad->destino_id=$request->destino_id;
        $ad->image1=$path1;
        $ad->image2=$path2;
        $ad->image3=$path3;
        $ad->image4=$path4;
        $ad->user_id=Auth::user()->id;
        $ad->save();
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
}
