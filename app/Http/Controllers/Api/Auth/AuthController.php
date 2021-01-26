<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
        ///REGISTRO
        public function signup(CreateUserRequest $request)
        {
            // return $request->validated();

            $password = bcrypt($request->get('password')) ;
        
            $request['password'] = bcrypt($password);
            
            $user = new User;
            $user->fill($request->validated());
            $user->save();
    
            // if(isset($user)){
                
            //     $newUser =  $this->login($request);
    
    
            //     //////////NOtificacion al mail
            //     $mail_destino = $user->email;
            //     $msg = [
            //         'subject' => 'On Capacitaciones - Registro existoso',
            //         'title' => 'Gracias por registrarte!!!',
            //         'paragraph' => [
            //             'Nuestra misión es la educación, cambiar vidas nuestra pasión.',
            //             'Te apoyaremos con nuestro staff de educadores y nuestras instalaciones están a tú disposición.',
            //             'No dudes en ponerte en contacto con nosotros para informarte.'
            //         ],
            //         // 'button' => [ 
            //         //     'button_name' => 'Crear contraseña',
            //         //     'button_link' => url('/api/password/find/'.$passwordReset->token)
            //         // ]
            //     ];
            //     Mail::to($mail_destino)->queue(new Notificaciones($msg));
            // };
    
    
    
            return response()->json([
                'user' => $user,
                'message' => 'Successfully created user!'
            ], 201);
        }


    //LOGIN
    public function login(Request $request )
    {
        $request->validate([
            'email'       => 'required|string|email',
            'password'    => 'required|string',
            // 'remember_me' => 'boolean',
        ]);
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'], 401);
        }
        $user = $request->user();
        $user->account;
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        //
            $remember_me = true;
        //
        if ($remember_me) {
            $token->expires_at = Carbon::now()->add(1,'minute');
        }
        $token->save();
        // dd($tokenResult);

        return response()->json([
            'token' => $tokenResult->accessToken,
            // 'refresh_token' => $tokenResult->refreshToken,
            'token_type'   => 'Bearer',
            'expires_at'   => Carbon::parse(
                $tokenResult->token->expires_at)
                    ->toDateTimeString(),
            'user' => $user
        ]);
    }
}
