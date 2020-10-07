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
        $d=New Ingresoauto();
        $d->objetos=$request->objetos;
        $d->recinto=Auth::user()->tipo;
        $d->motivo=$request->motivo;
        $d->targeta=$request->targeta;
        $d->persona_id=$request->persona_id;
        $d->destino_id=$request->destino_id;
        $d->auto_id=$request->auto_id;
        $d->user_id=Auth::user()->id;
        $d->save();

        $ad=New Asistencia();
        $ad->objetos=$request->objetos;
        $ad->recinto=Auth::user()->tipo;
        $ad->motivo=$request->motivo;
        $ad->targeta=$request->targeta;
        $ad->persona_id=$request->persona_id;
        $ad->destino_id=$request->destino_id;
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
