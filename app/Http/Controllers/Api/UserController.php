<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponser;

    public function index(Request $request)
    {
        $query = User::query();

        if ($request->get('per_page')) {
            $per_page = $request->get('per_page');
        }else{
            $per_page = 20;
        }
        
        if ($request->get('sort')) {
            $sort = $request->get('sort');
        }else{
            $sort = "desc";
        }

        if ($request->get('filter')) {
            $filter = $request->get('filter');
        }else{
            $filter = "";
        }

        $users = $query
        ->filter($filter)
        ->orderBy('id', $sort)
        ->paginate($per_page);

        return $this->successResponse($users,'Users list', 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        if(!isset($input['password'])) $input['password'] = "password";
        

        $user = User::create($input);

        return $this->successResponse($user,'User saved', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        $user_show = User::find($user->id);

        if (empty($user_show)) {
            return $this->errorResponse('State not found',404);
        }
        return $this->successResponse($user_show,'User show', 200);
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user_update = User::find($user->id);

        if (empty($user_update)) {
            return $this->errorResponse('State not found',404);
        }
        $user_update->fill($request->all());
        $user_update->save();

        return $this->successResponse($user_update,'User updated', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user_delete = User::find($user->id);
        if (empty($user_delete)) {
            return $this->errorResponse('State not found',404);
        }  
        $user_delete->delete();
        return $this->successResponse($user_delete,'User deleted', 200);
    }


    public function check_email_exist(Request $request)
    {
        if($request->email_exclude){
            $email_exclude = $request->email_exclude;
        }else{
            $email_exclude = null;
        }
        if($request->email) {
            $email = $request->email;
        }else{
            $email = null;
        }
        

        $user = User::where('email','!=', $email_exclude)
        ->email_exist($email)
        ->first();
        if(empty($user)){
            return response()->json(['exist'=>null], 200);
        }
        
        return response()->json(['exist'=>true], 200);
        
    }
}
