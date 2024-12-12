<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [UserController::class, "login"] );

Route::get('/Profile', function(){
    return "<h1>My name is Charmelle John Cahucom</h1>
    <body>Charmelle John Cahucom</body>";
});

Route::get('/register',[UserController::class, "register"]);

Route::post('/register', [UserController::class, "createUser"]);