<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class Main extends Controller
{
    public function index(Request $request)
    {
        // 세션에서 로그인 상태를 읽어서 뷰에 로그인 실패 시에만 상태 띄우기
        return view('login',["loginFailed" => $request->session()]);
    }


//로그인
    public function login(Request $request){

        $id = $request->input("inputID", "");
        $password = $request->input("inputPassword", "");

        $result = DB::select('SELECT id, `password` FROM users WHERE id=? AND `password`=?', [$id,$password]);

        if (count($result) == 1) {
            if ($result[0]) {
                $request->session()->put('userID',$result[0]->id);
                // flash('환영합니다')->success();
                return redirect('/');
            }

        }else{
            $request->session()->put('alert-fail');
            // flash('입력하신 정보가 일치하지 않습니다')->success();
             return redirect('/login')->with('alert-fail', '정보를 다시 입력해주세요');
        }


}

    public function logout (Request $request){
        $request->session()->forget('userID');
        return redirect('/login');
    }

    public function join (Request $request) {
        $id = $request->input("inputID", null);
        $name = $request->input("inputName", null);
        $email = $request->input("inputEmail", null);
        $password = $request->input("inputPassword", null);


        try {
            // Validate the value...
            $query = DB::insert('insert into users (id, name, email, password) values (?, ?, ?, ?)', [$id, $name, $email, $password]);
        } catch (\Throwable $e) {
            Log::info(json_encode($e->getCode()));
            if($e->getCode() == "23000"){
                $request->session()->put('Duplicate');
                return redirect()->back()->with('Duplicate', '중복된 아이디입니다.');

            }
                return redirect()->back();

        }


        return view('/login');
    }
}