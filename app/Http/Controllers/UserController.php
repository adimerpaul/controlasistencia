<?php

namespace App\Http\Controllers;

use App\Models\Recinto;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::where('id','<>',1)->with('recinto')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $r=Recinto::find($request->recinto_id);
        $u=new User();
        $u->name=$request->name;
        $u->email=$request->email;
        $u->tipo=$r->nombre;
        $u->tipo2=$request->tipo2;
        $u->recinto_id=$request->recinto_id;
        $u->password= Hash::make($request->password);
        $u->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }
    public function usuario(){
        return Auth::user();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $r=Recinto::find($request->recinto_id);
        $u=User::find($id);
        $u->name=$request->name;
        $u->email=$request->email;
        $u->tipo=$r->nombre;
        $u->tipo2=$request->tipo2;
        $u->recinto_id=$request->recinto_id;
        $u->save();
//        return isset($request->password);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $u=User::find($id);
        $u->delete();
    }
    public function pass(Request $request, $id)
    {
        $u=User::find($id);
        $u->password=Hash::make($request->password);
        $u->save();
//        return isset($request->password);
    }
}
