<?php

namespace App\Http\Controllers;

use App\Models\Recinto;
use Illuminate\Http\Request;

class RecintoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Recinto::all();
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
        $r= new Recinto();
        $r->nombre=$request->nombre;
        $r->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recinto  $recinto
     * @return \Illuminate\Http\Response
     */
    public function show(Recinto $recinto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recinto  $recinto
     * @return \Illuminate\Http\Response
     */
    public function edit(Recinto $recinto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recinto  $recinto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $r= Recinto::find($id);
        $r->nombre=$request->nombre;
        $r->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recinto  $recinto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $r= Recinto::find($id);
        $r->delete();
    }
}
