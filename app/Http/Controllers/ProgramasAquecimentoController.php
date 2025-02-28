<?php

namespace App\Http\Controllers;

use App\Models\ProgramasAquecimento;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Mockery\Exception;

class ProgramasAquecimentoController extends Controller
{
    public function getAll()
    {
        $programasAquecimento = ProgramasAquecimento::all();
        return $programasAquecimento;
    }

    public function create(Request  $request)
    {
        try {
            $request->validate([
                'nome' => 'required|string|unique:programas_aquecimentos,nome|max:255',
                'alimento' => 'required|string|max:255',
                'tempo' => 'required|string',
                'potencia' => 'required|integer',
                'instrucoes' => 'nullable|string'
            ]);

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
