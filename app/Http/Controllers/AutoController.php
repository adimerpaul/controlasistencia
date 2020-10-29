<?php

namespace App\Http\Controllers;

use App\Models\Auto;
use Illuminate\Http\Request;

class AutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Auto::with('persona')->orderBy('placa')->get();
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
        $d= new Auto();
        $d->placa=$request->placa;
        $d->tipo=$request->tipo;
        $d->uso=$request->uso;
        $d->persona_id=$request->persona_id;
        $d->save();
        return $d;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Auto  $auto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $p=Auto::where('id','=',"$id")->with('persona')->get();
        return $p;
    }
    public function autobuscar($id)
    {
        $p=Auto::where('placa','=',"$id")->with('persona')->get();
        return $p;
    }
    public function buscar($id)
    {
        $p=Auto::where('placa','=',$id)->with('persona')->get();
        return $p;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Auto  $auto
     * @return \Illuminate\Http\Response
     */
    public function edit(Auto $auto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Auto  $auto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $d= Auto::find($id);
        $d->placa=$request->placa;
        $d->tipo=$request->tipo;
        $d->uso=$request->uso;
        $d->persona_id=$request->persona_id;
        $d->save();
        return $d;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Auto  $auto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $d= Auto::find($id);
        $d->delete();
    }
}
