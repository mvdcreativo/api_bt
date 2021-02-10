<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRoleRequest;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return $this->successResponse($roles,'Roles list', 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRoleRequest $request)
    {
        

        $role = new Role;
        $role->guard_name = 'api';
        $role->fill($request->validated());
        $role->save();

        return $this->successResponse($role,'Successfully created Role!', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'data' => Role::find($id),
            'message' => 'Successfully show Role!'
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $role->fill($request->all());
        return response()->json([
            'data' => $role,
            'message' => 'Successfully Update Role!'
        ], 200);    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        return response()->json([
            'data' => "success",
            'message' => 'Successfully deleted Role!'
        ], 200);    
    }



    public function assign_permission($id, Request $request)
    {

        // return $request->all();
        $role = Role::find($id);
        $role->syncPermissions($request->get('permissions'));
        return response()->json([
            'data' => $role,
            'message' => 'Successfully deleted Role!'
        ], 200);  
    }
}
