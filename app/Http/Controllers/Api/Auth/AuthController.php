<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    ///REGISTER
    public function register(CreateUserRequest $request)
    {

        $user = User::create([
            'name' => $request['name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password'])
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
            'message' => 'Successfully created user!'
        ];

        return response($response, 201);
    }

    //LOGIN
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 200);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        //elimina todos los tokens para este usuario
        if ($user) {
            $user->tokens()->delete();
            return [
                'message' => 'Logged out'
            ];
        }


    }

    public function currentUser(Request $request){

        $user = $request->user();

        return response($user, 200);

    }
    // public function signup(CreateUserRequest $request)
    // {
    //     // return $request->validated();

    //     $password = bcrypt($request->get('password')) ;

    //     $request['password'] = bcrypt($password);

    //     $user = new User;
    //     $user->fill($request->validated());
    //     $user->save();

    //     // if(isset($user)){

    //     //     $newUser =  $this->login($request);


    //     //     //////////NOtificacion al mail
    //     //     $mail_destino = $user->email;
    //     //     $msg = [
    //     //         'subject' => 'On Capacitaciones - Registro existoso',
    //     //         'title' => 'Gracias por registrarte!!!',
    //     //         'paragraph' => [
    //     //             'Nuestra misión es la educación, cambiar vidas nuestra pasión.',
    //     //             'Te apoyaremos con nuestro staff de educadores y nuestras instalaciones están a tú disposición.',
    //     //             'No dudes en ponerte en contacto con nosotros para informarte.'
    //     //         ],
    //     //         // 'button' => [ 
    //     //         //     'button_name' => 'Crear contraseña',
    //     //         //     'button_link' => url('/api/password/find/'.$passwordReset->token)
    //     //         // ]
    //     //     ];
    //     //     Mail::to($mail_destino)->queue(new Notificaciones($msg));
    //     // };



    //     return response()->json([
    //         'user' => $user,
    //         'message' => 'Successfully created user!'
    //     ], 201);
    // }



}
