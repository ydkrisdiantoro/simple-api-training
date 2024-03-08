<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/debug-sentry', function () {

    throw new Exception('My first Sentry error!');

});

Route::get('encrypt', function(){
    $text = 'Welcome';
    $encrypt = Crypt::encrypt($text);
    $decrypt = Crypt::decrypt($encrypt);

    return response()->json([
        'text' => 'Welcome',
        'encrypted' => $encrypt,
        'decryppted' => $decrypt,
    ]);
});

Route::get('about', function(){
    return 'About';
});

Route::get('contact', function(){
    return 'Contact';
});
