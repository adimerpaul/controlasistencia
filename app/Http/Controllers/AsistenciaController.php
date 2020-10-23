<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function quitar($id)
    {
        $d=Asistencia::find($id);
//        $d->objetos=$request->objetos;
//        $d->recinto=Auth::user()->tipo;
        $d->observado="NO";
//        $d->observaciones=$request->observaciones;
        $d->save();
        return  $d;
    }
    public function index()
    {
        return Asistencia::with('persona')->with('destino')->with('user')->get();
    }
    public function date($d1,$d2)
    {
        if (Auth::user()->tipo=='ADMIN')
            return Asistencia::with('persona')
                ->with('destino')
                ->with('user')
                ->whereDate('created_at','>=',$d1)
                ->whereDate('created_at','<=',$d2)
//                ->where('estado','=','')
                ->get();
        else
            return Asistencia::with('persona')
                ->with('destino')
                ->with('user')
                ->where('recinto','=',Auth::user()->tipo)
                ->where('user_id','=',Auth::user()->id)
                ->whereDate('created_at','>=',$d1)
                ->whereDate('created_at','<=',$d2)
                ->get();
    }
    public function date2($d1,$d2)
    {
            return Asistencia::with('persona')
                ->with('destino')
                ->with('user')
                ->where('recinto','=',Auth::user()->tipo)
                ->whereNull('salida')
                ->where('user_id','=',Auth::user()->id)
                ->whereDate('created_at','>=',$d1)
                ->whereDate('created_at','<=',$d2)
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

        $folderPath = "images/";
//        return strlen ( $_POST['image1']);
//        return $_POST['image1']=='null';
//        exit;
        if ($_POST['image1']=='' ||$_POST['image1']=='null'){
            $path1="";
        }else{
            $image_parts = explode(";base64,", $_POST['image1']);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . uniqid() . '.'.$image_type;
            file_put_contents($file, $image_base64);
            $path1=$file;
        }



        if ($_POST['image2']=='' ||$_POST['image2']=='null'){
            $path2="";
        }else{

            $image_parts = explode(";base64,", $_POST['image2']);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . uniqid() . '.'.$image_type;
            file_put_contents($file, $image_base64);
            $path2=$file;
        }

        if ($_POST['image3']=='' ||$_POST['image3']=='null'){
            $path3="";
        }else{

            $image_parts = explode(";base64,", $_POST['image3']);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . uniqid() . '.'.$image_type;
            file_put_contents($file, $image_base64);
            $path3=$file;
        }

        if ($_POST['image4']==''||$_POST['image4']=='null'){
            $path4="";
        }else{
            $image_parts = explode(";base64,", $_POST['image4']);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . uniqid() . '.'.$image_type;
            file_put_contents($file, $image_base64);
            $path4=$file;
        }

//        $request->hasFile('image1')?$path1 = $request->file('image1')->store('images'):$path1='';
//        $request->hasFile('image2')?$path2 = $request->file('image2')->store('images'):$path2='';
//        $request->hasFile('image3')?$path3 = $request->file('image3')->store('images'):$path3='';
//        $request->hasFile('image4')?$path4 = $request->file('image4')->store('images'):$path4='';
//        $path = $request->file('image2')->store('images');
//        $path = $request->file('image3')->store('images');
//        $path = $request->file('image4')->store('images');

//        return $path;
//
//        exit;
            $d=New Asistencia();
//            $d->objetos=$request->objetos;
        isset($request->objetos)&&$request->objetos!='undefined'?$d->objetos=strtoupper($request->objetos):$d->objetos='';
            $d->recinto=Auth::user()->tipo;
//            $d->motivo=$request->motivo;
        isset($request->motivo)&&$request->motivo!='undefined'?$d->motivo=strtoupper($request->motivo):$d->motivo='';
//            $d->targeta=$request->targeta;
        isset($request->targeta)&&$request->targeta!='undefined'?$d->targeta=strtoupper($request->targeta):$d->targeta='';
            $d->image1=$path1;
            $d->image2=$path2;
            $d->image3=$path3;
            $d->image4=$path4;
            $d->persona_id=$request->persona_id;
            $d->destino_id=$request->destino_id;
            $d->user_id=Auth::user()->id;
            $d->save();
//            return $d;
        return Asistencia::with('persona')
            ->with('destino')
            ->with('user')
            ->where('recinto','=',Auth::user()->tipo)
            ->where('user_id','=',Auth::user()->id)
            ->where('id','=',$d->id)
            ->get();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $d=Asistencia::find($id);
        $d->salida=date('Y-m-d H:i:s');
        $d->estado="SALIDO";
        $d->save();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function edit(Asistencia $asistencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $d=Asistencia::find($id);
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
     * @param  \App\Models\Asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asistencia $asistencia)
    {
        //
    }
}
