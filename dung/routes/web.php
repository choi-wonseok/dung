<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Main as inside;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (Request $request) {
    $uid = null;
    if ($request->session()->exists('userID')) {
    $value = $request->session()->get('userID');
    $result = DB::select('SELECT id FROM users WHERE id=? ' , [$value]);
        $uid = $result[0]->id;
    }

    if ($request->input('lat')){
        $lat = $request->input('lat', 37);
        $lng = $request->input('lng', 38);

        $latMin = $lat - 0.018;
        $latMax = $lat + 0.018;
        $lngMin = $lng - 0.022;
        $lngMax = $lng + 0.022;
Log::info($latMin);
        // $rows = DB::select("select * from table_toilet where (lat between $latMin and $latMax) and (lng between $lngMin and $lngMax);", []);
        $rows = DB::SELECT("SELECT toiletNum, toiletName, lat, lng, maker, toiletDetail, ToiletPaper, (6371 * acos (cos ( radians($lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( lat ) ))) AS distance FROM table_toilet where (lat between $latMin and $latMax) and (lng between $lngMin and $lngMax) order by distance;", []);
    } else {
        $rows=[];
    }
    Log::info(json_encode($rows));
    return view('startpage', ["rows" => $rows, "uid" => $uid]);
});

// Route::get('/', function (Request $request) {
//     $latMin = $request->input('latMin', 37);
//     $latMax = $request->input('latMax', 38);
//     $lngMin = $request->input('lngMin', 127);
//     $lngMax = $request->input('lngMax', 128);
//     $rows = DB::select("select * from table_toilet where (lat between $latMin and $latMax) and (lng between $lngMin and $lngMax);", []);
//     Log::info($rows);
//     return view('startpage', ["rows" => $rows]);
// });

Route::get('/login', [inside::class , 'index']);
Route::post('/login', [inside::class , 'login']);
Route::get('/logout', [inside::class , 'logout']);

Route::get('/maker', function () {
    return view('maker');
});
Route::get('/abouts', function () {
    return view('abouts');
});
Route::get('/add', function () {
    return view('add');
});
Route::get('/plustoilet', function (Request $request) {
    $uid = null;
    if ($request->session()->exists('userID')) {
    $value = $request->session()->get('userID');
    $result = DB::select('SELECT id FROM users WHERE id=? ' , [$value]);
        $uid = $result[0]->id;
    }
    return view('plustoilet', ["uid" => $uid]);

})->middleware('auth.dung');
Route::post('/plustoilet', function (Request $request) {

    $toiletName = $request->input("inputtoiletName", "");
    $address1 = $request->input("inputaddress", "");
	$address2 = $request->input("inputaddressDetail","");
    $maker = $request->input("maker","");
    $toiletDetail = $request->input("inputtoiletDetail", "");
    $lat = $request->input("lat","");
	$lng = $request->input("lng","");
    $ToiletPaper = $request->input("ToiletPaper","");

    DB::insert('insert into table_toilet (toiletName, lat, lng, toiletDetail, maker, address1, address2, ToiletPaper ) values (?, ?, ?, ?, ?, ?, ?, ?)', [$toiletName, $lat, $lng, $toiletDetail,$maker, $address1, $address2, $ToiletPaper]);
    return redirect('/');
});

Route::get('/joinmember', function () {
    return view('joinmember');
});

Route::post('/joinmember', function (Request $request) {
    $id = $request->input("inputID", null);
    $name = $request->input("inputName", null);
    $email = $request->input("inputEmail", null);
    $password = $request->input("inputPassword", null);


        DB::insert('insert into users (id, name, email, password) values (?, ?, ?, ?)', [$id, $name, $email, $password]);

    return view('login');
});

// 클라이언트
/** 입력했을 때, 들어가면 안 되는 값
 * 클라에서 막기 <- 회원가입, id는 특수문자 x
 * 클라에서 보내준 다음 서버 응답에 따라
 *  <- 로그인, 비밀번호가 틀림, id 없다
 *  회원가입 이미 존재하는 id
 *
*/
// 서버
/**
 * 서버 input을 DB로 보내면
 * DB 제약조건에 따라 에러메시지
 * 에러 예방: 조건 분기를 이용해서 처리를 할 건가
 * 에러 후처리: DB 에러에 따라서 에러 처리를 할 건가
 */
// DB
/**
 * not null 걸 건가
 * "" UK 걸 건가
 * "" <-> null
 * 서버 SELECT 단일 x, 복수 쿼리 array
 * [[id=>"",pw=>""],[id=>"",pw=>""]] length 2
 * [[id=>"",pw=>""]] length 1
 * [] length 0
 */