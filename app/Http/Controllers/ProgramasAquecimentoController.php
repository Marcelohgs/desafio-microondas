<?php

namespace App\Http\Controllers;

use App\Models\ProgramasAquecimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\ValidationException;
use Mockery\Exception;
use Tymon\JWTAuth\Facades\JWTAuth;


class ProgramasAquecimentoController extends Controller
{
    public function authenticateToken()
    {
        try {
            $access_token = session('access_token');
            JWTAuth::setToken($access_token)->authenticate();
            return back()->with('success', 'Usuário autenticado com sucesso!');

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return redirect()->route('login')->with('error', 'Token inválido');
        }

    }

    public function getAll()
    {
        $this->authenticateToken();

        try {
            $access_token = session('access_token');
            $user = JWTAuth::setToken($access_token)->authenticate();

            if($user){
                $programasAquecimento = ProgramasAquecimento::all();
                return view('welcome', compact('programasAquecimento'));
            }
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return redirect()->route('login')->with('error', 'Token inválido');
        }

    }

    public function create(Request  $request)
    {
        $this->authenticateToken();

        try {
            $request->validate([
                'nome' => 'required|string|unique:programas_aquecimentos,nome|max:255',
                'alimento' => 'required|string|max:255',
                'tempo' => 'required|string',
                'potencia' => 'required|integer',
                'instrucoes' => 'nullable|string'
            ],[
                'nome.required' => 'Campo nome é obrigatório',
                'alimento.required' => 'Campo alimento é obrigatório',
                'tempo.required' => 'Campo tempo é obrigatório',
                'potencia.required' => 'Campo potencia é obrigatório',
            ]
        );

            $programaAquecimento = ProgramasAquecimento::create($request->all());

            if ($programaAquecimento){
                return response()->json(['success' => true, 'data' => $programaAquecimento])->setStatusCode(200);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null !== ($message = $e->getMessage()) ? $message : $e
            ])->setStatusCode(500);
        }
    }

    public function delete($id)
    {
       $this->authenticateToken();

       try{
           $programasAquecimento = ProgramasAquecimento::find($id);

           if ($programasAquecimento){
               $programasAquecimento->delete();
               return response()->json(['success' => true, 'data' => 'deletado com sucesso'])->setStatusCode(200);
           }
           else
           {
               throw new Exception('Não encontrado nenhum registro com o ID informado!');
           }

           return $programasAquecimento;
       } catch (\Exception $e){
           return response()->json([
               'success' => false,
               'data' => null !== ($message = $e->getMessage()) ? $message : $e
           ])->setStatusCode(500);
       }
    }

}
