<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\equipe;
use App\Http\Controllers\piloto;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', function() {return response() ->json(['sucesso'=>true]);});
Route::get('/livros',[equipe::class,'index']);
Route::get('/livros/{id}',[equipe::class,'show']);
Route::post('/livros',[equipe::class,'store']);
Route::put('/livros/{id}',[equipe::class,'update']);
Route::delete('/livros/{id}',[equipe::class,'destroy']);