<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

use App\Http\Controllers\UssdController;

Route::post('/ussd', [UssdController::class, 'ussdRequestHandler']);
Route::get('/ussd', [UssdController::class, 'ussdRequestHandler']);


// routes/web.php

use App\Http\Controllers\Admin\HomeController;

Route::get('/admin/home', [HomeController::class, 'index'])->name('admin.home');


