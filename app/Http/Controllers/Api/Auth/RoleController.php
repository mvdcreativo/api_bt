<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    use ApiResponser;

    public function __construct()
    {
        $this->middleware(['permission:role.index'])->only('index');
        $this->middleware(['permission:role.show'])->only('show');
        $this->middleware(['permission:role.update'])->only('update');
        $this->middleware(['permission:role.delete'])->only('destroy');
        $this->middleware(['permission:role.create'])->only('store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Role::query();

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

        $roles = $query
        ->with('permissions')
        ->where('name', "LIKE", '%'.$filter.'%')
        ->orderBy('id', $sort)
        ->paginate($per_page);

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
        $role->syncPermissions($request->get('permissions'));

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
            'data' => Role::with('permissions')->find($id),
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
    public function update(UpdateRoleRequest $request, $id)
    {
        $role = Role::find($id);
        $role->guard_name = 'api';
        $role->fill($request->validated());
        $role->save();
        $role->syncPermissions($request->get('permissions'));

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

    public function check_role_exist(Request $request)
    {
        if($request->role_exclude){
            $role_exclude = $request->role_exclude;
        }else{
            $role_exclude = null;
        }
        if($request->role) {
            $role = $request->role;
        }else{
            $role = null;
        }

        
        $role_exist = Role::where('name', $role)
        ->where('name','!=', $role_exclude)->first();
        // return $role_exist;
        if(!$role_exist){
            return response()->json(['exist'=>null], 200);
        }
        
        return response()->json(['exist'=>true], 200);
    }
}
