<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePermissionRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'data' => Permission::all(),
            'message' => 'Successfully list Permissions!'
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePermissionRequest $request)
    {
        $permission = new Permission;
        $permission->guard_name = 'api';
        $permission->fill($request->validated());
        $permission->save();
        return response()->json([
            'data' => $permission,
            'message' => 'Successfully created Permission!'
        ], 201);
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
            'data' => Permission::find($id),
            'message' => 'Successfully show Permission!'
        ], 200);
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
        $permission = Permission::find($id);
        $permission->fill($request->all());
        return response()->json([
            'data' => $permission,
            'message' => 'Successfully Update Permission!'
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
        $permission = Permission::find($id);
        $permission->delete();
        return response()->json([
            'data' => "success",
            'message' => 'Successfully deleted Permission!'
        ], 200);    
    }
}
