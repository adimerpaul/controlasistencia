<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Destino;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DestinoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Destino::with('recinto')->get();
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
        $d=new Destino();
        $d->nombre=$request->nombre;
        $d->recinto_id=$request->recinto_id;
        $d->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Destino  $destino
     * @return \Illuminate\Http\Response
     */
    public function show(Destino $destino)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Destino  $destino
     * @return \Illuminate\Http\Response
     */
    public function edit(Destino $destino)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Destino  $destino
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $d=Destino::find($id);
        $d->nombre=$request->nombre;
        $d->recinto_id=$request->recinto_id;
        $d->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Destino  $destino
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $d=Destino::find($id);
        $d->delete();
    }

    public function date($d1,$d2)
    {
        if (Auth::user()->tipo=='ADMIN')
            return Destino::with('recinto')
//                ->whereDate('created_at','>=',$d1)
//                ->whereDate('created_at','<=',$d2)
//                ->where('estado','=','')
                ->get();
        else
            return Destino::with('recinto')
                ->where('recinto_id','=',Auth::user()->recinto_id)
//                ->whereDate('created_at','>=',$d1)
//                ->whereDate('created_at','<=',$d2)
                ->get();
    }
}
