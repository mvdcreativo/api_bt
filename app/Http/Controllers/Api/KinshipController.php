<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kinship;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class KinshipController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Kinship::query();

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

        $kinships = $query
        ->filter($filter)
        ->orderBy('id', $sort)
        ->paginate($per_page);

        return $this->successResponse($kinships,'Kinship list', 200);
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

        $kinship = Kinship::create($input);

        return $this->successResponse($kinship,'Kinship saved', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kinship  $kinship
     * @return \Illuminate\Http\Response
     */
    public function show(Kinship $kinship)
    {

        $kinship_show = Kinship::find($kinship->id);

        if (empty($kinship_show)) {
            return $this->errorResponse('Kinship not found',404);
        }
        return $this->successResponse($kinship_show,'Kinship show', 200);
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kinship  $kinship
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kinship $kinship)
    {
        $kinship_update = Kinship::find($kinship->id);

        if (empty($kinship_update)) {
            return $this->errorResponse('Kinship not found',404);
        }
        $kinship_update->fill($request->all());
        $kinship_update->save();

        return $this->successResponse($kinship_update,'Kinship updated', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kinship  $kinship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kinship $kinship)
    {
        $kinship_delete = Kinship::find($kinship->id);
        if (empty($kinship_delete)) {
            return $this->errorResponse('Kinship not found',404);
        }  
        $kinship_delete->delete();
        return $this->successResponse($kinship_delete,'Kinship deleted', 200);
    }
}
