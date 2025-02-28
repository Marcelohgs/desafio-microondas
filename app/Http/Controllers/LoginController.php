<?php

namespace App\Http\Controllers;

use App\Models\ProgramasAquecimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index(){
        return view ('login');
    }

    public function Login()
    {
        $authController = new AuthController();
        $token = $authController->login();
        $statusCode = $token->getStatusCode();
        $token_cookie = json_decode($token->getContent(), true);

        if ($statusCode === 200) {
            session(['access_token' => $token_cookie['access_token']]);

            $programasAquecimento = ProgramasAquecimento::all();

            return redirect()->route('welcome',compact('programasAquecimento'));
        } else {
            return redirect()->back()->with('error', 'Falha ao realizar login. Verifique suas credenciais.');
        }
    }


    public function CreateUser(Request $request){
        try {
            $request->validate([
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string'
            ],[
                'email.unique' => 'E-mail já cadastrado!'
            ]);

            $user = DB::table('users')->insert([
                'name' => $request->email,
                'email' =>$request->email,
                'password' => bcrypt($request->password),
            ]);

            if($user){
                return response()->json(['success' => true, 'data' => 'Cadastro realizado com sucesso'])->setStatusCode(200);
            };
        }catch (\Exception $e){
            return response()->json([
                'success' => false,
                'data' => null !== ($message = $e->getMessage()) ? $message : $e
            ])->setStatusCode(500);
        }

    }

}
