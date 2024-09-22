<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        // Recupera usuários do banco de dados, ordenados por id, paginados
        $users = User::orderBy("id")->paginate(5);

        // Retorna usuários como resposta JSON
        return response()->json([
            "status" => true,
            "users" => $users,
        ], 200);
    }
}
