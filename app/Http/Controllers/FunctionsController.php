<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FunctionsController extends Controller
{
    public function teste(Request $request)
    {
        try {
            $user = auth()->user();  // Tenta obter o usuário autenticado

            // Se o usuário for autenticado
            if ($user) {
                return response()->json([
                    'message' => 'Usuário autenticado com sucesso!',
                    'user' => $user
                ]);
            }

            // Se o usuário não for autenticado
            return response()->json([
                'message' => 'Usuário não autenticado.'
            ], 401);

        } catch (JWTException $e) {
            // Captura falhas de autenticação ou erro de token e retorna 401
            return response()->json([
                'message' => 'Token inválido ou expirado.'
            ], 401);
        }
    }
}