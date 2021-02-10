<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TypeSurgery;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class TypeSurgeryController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = TypeSurgery::query();

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

        $type_surgeries = $query
        ->filter($filter)
        ->orderBy('id', $sort)
        ->paginate($per_page);

        return $this->successResponse($type_surgeries,'TypeSurgery list', 200);
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

        $type_surgery = TypeSurgery::create($input);

        return $this->successResponse($type_surgery,'TypeSurgery saved', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeSurgery  $type_surgery
     * @return \Illuminate\Http\Response
     */
    public function show(TypeSurgery $type_surgery)
    {

        $type_surgery_show = TypeSurgery::find($type_surgery->id);

        if (empty($type_surgery_show)) {
            return $this->errorResponse('TypeSurgery not found',404);
        }
        return $this->successResponse($type_surgery_show,'TypeSurgery show', 200);
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeSurgery  $type_surgery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeSurgery $type_surgery)
    {
        $type_surgery_update = TypeSurgery::find($type_surgery->id);

        if (empty($type_surgery_update)) {
            return $this->errorResponse('TypeSurgery not found',404);
        }
        $type_surgery_update->fill($request->all());
        $type_surgery_update->save();

        return $this->successResponse($type_surgery_update,'TypeSurgery updated', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeSurgery  $type_surgery
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeSurgery $type_surgery)
    {
        $type_surgery_delete = TypeSurgery::find($type_surgery->id);
        if (empty($type_surgery_delete)) {
            return $this->errorResponse('TypeSurgery not found',404);
        }  
        $type_surgery_delete->delete();
        return $this->successResponse($type_surgery_delete,'TypeSurgery deleted', 200);
    }
}
