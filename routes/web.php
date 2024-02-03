<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\LoginController;
use App\Http\Requests\LoginRequest;
use App\Models\Contact;
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

Route::middleware("logged.user")->group(function () {
    Route::get('/', fn () => (new ContactController)->index())->name("contacts");
});

Route::get("/login", fn () => (new LoginController)->index())->name("login");
Route::post("/login", fn (LoginRequest $request) => (new LoginController)->auth($request));
