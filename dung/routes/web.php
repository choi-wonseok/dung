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
        $rows = DB::SELECT("SELECT toiletNum, toiletName, lat, lng, maker, toiletDetail,(6371 * acos (cos ( radians($lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( lat ) ))) AS distance FROM table_toilet where (lat between $latMin and $latMax) and (lng between $lngMin and $lngMax) order by distance;", []);
    } else {
        $rows=[];
    }

    return view('startpage', ["rows" => $rows, "uid" => $uid]);
})->middleware('forcessl');

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


Route::get('/about', function () {
    return view('about');
});
Route::get('/add', function () {
    return view('add');
});
Route::get('/plustoilet', function () {
    return view('plustoilet');
})->middleware('auth.dung');
Route::post('/plustoilet', function (Request $request) {
    $toiletName = $request->input("inputtoiletName", "");
    $address1 = $request->input("inputaddress", "");
	$address2 = $request->input("inputaddressDetail","");
    $toiletDetail = $request->input("inputtoiletDetail", "");
    $lat = $request->input("lat","");
	$lng = $request->input("lng","");

    DB::insert('insert into table_toilet (toiletName, lat, lng, toiletDetail, address1, address2 ) values (?, ?, ?, ?, ?, ?)', [$toiletName, $lat, $lng, $toiletDetail, $address1, $address2]);
    return redirect('/');
});

Route::get('/joinmember', function () {
    return view('joinmember');
});
Route::post('/joinmember', function (Request $request) {
    $id = $request->input("inputID", "");
    $name = $request->input("inputName", "");
    $email = $request->input("inputEmail", "");
    $password = $request->input("inputPassword", "");


    DB::insert('insert into users (id, name, email, password) values (?, ?, ?, ?)', [$id, $name, $email, $password]);
    return view('login');
});