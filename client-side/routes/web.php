<?php

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Test1Controller;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('redirect/test1', [Test1Controller::class, 'signInwithTest1']);
// Route::get('redirect/test1', function (Request $request) {
//     $request->session()->put('state', $state = Str::random(40));
//     $query = http_build_query([
//         'client_id' => config('services.socialite.test1_auth.client_id'),
//         'redirect_uri' => 'http://test2.test/callback/test1',
//         'response_type' => 'code',
//         'scope' => '',
//         'state' => $state,
//     ]);
//     return redirect('http://test1.test/oauth/authorize?'.$query);
// });
Route::get('callback/test1', [Test1Controller::class, 'callbackToTest1']);
// Route::get('callback/test1', function (Request $request) {
//     $state = $request->session()->pull('state');
//     throw_unless(
//         strlen($state) > 0 && $state === $request->state,
//         InvalidArgumentException::class
//     );
//     $response = Http::asForm()->post('http://test1.test/oauth/token', [
//         'grant_type' => 'authorization_code',
//         'client_id' => config('services.socialite.test1_auth.client_id'),
//         'client_secret' => config('services.socialite.test1_auth.client_secret'),
//         'redirect_uri' => 'http://test2.test/callback/test1',
//         'code' => $request->code,
//     ]);
//     session()->put('token', $response->json()['access_token']);

//     return redirect('authUser');
// });

Route::get('authUser', function ()
{

    $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.session()->get('token'),
        ])->get('http://test1.test/api/user');
    return $response->json();
});
