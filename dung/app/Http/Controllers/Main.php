<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Main extends Controller
{
    public function index()
    {
        return view('login');
    }


//로그인
    public function login(Request $request){

        $id = $request->input("inputID", "");
        $password = $request->input("inputPassword", "");

        $result = DB::select('SELECT id, `password` FROM users WHERE id=? AND `password`=?', [$id,$password]);
        if($result[0]){
            $request->session()->put('userID',$result[0]->id);
            return redirect('/');
        }
        return redirect('/login');
    }

    public function logout (Request $request){
        $request->session()->forget('userID');
        return redirect('/login');
    }
}
