<?php

use App\Http\Controllers\Api\PessoaController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::get("/users", [UserController::class, "index"]); // GET - http://127.0.0.1:8000/api/users

Route::get("/pessoas", [PessoaController::class, "index"]); // GET - http://127.0.0.1:8000/api/pessoas
Route::get("/pessoas/{pessoa}", [PessoaController::class, "show"]); // GET - http://127.0.0.1:8000/api/pessoas/id
Route::post("/pessoas", [PessoaController::class, "store"]); // POST - http://127.0.0.1:8000/api/pessoas
Route::put("/pessoas/{pessoa}", [PessoaController::class, "update"]); // POST - http://127.0.0.1:8000/api/pessoas/id
Route::delete("/pessoas/{pessoa}", [PessoaController::class, "destroy"]); // DELETE - http://127.0.0.1:8000/api/pessoas/id




