<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Topography;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class TopographyController extends Controller
{

    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Topography::query();

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

        $topographies = $query
        ->filter($filter)
        ->orderBy('id', $sort)
        ->paginate($per_page);

        return $this->successResponse($topographies,'Topography list', 200);
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

        $topography = Topography::create($input);

        return $this->successResponse($topography,'Topography saved', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topography  $topography
     * @return \Illuminate\Http\Response
     */
    public function show(Topography $topography)
    {

        $topography_show = Topography::find($topography->id);

        if (empty($topography_show)) {
            return $this->errorResponse('Topography not found',404);
        }
        return $this->successResponse($topography_show,'Topography show', 200);
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Topography  $topography
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topography $topography)
    {
        $topography_update = Topography::find($topography->id);

        if (empty($topography_update)) {
            return $this->errorResponse('Topography not found',404);
        }
        $topography_update->fill($request->all());
        $topography_update->save();

        return $this->successResponse($topography_update,'Topography updated', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Topography  $topography
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topography $topography)
    {
        $topography_delete = Topography::find($topography->id);
        if (empty($topography_delete)) {
            return $this->errorResponse('Topography not found',404);
        }  
        $topography_delete->delete();
        return $this->successResponse($topography_delete,'Topography deleted', 200);
    }
}
