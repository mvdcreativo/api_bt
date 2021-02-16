<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Estadio;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class EstadioController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Estadio::query();

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

        $estadios = $query
        ->filter($filter)
        ->orderBy('id', $sort)
        ->paginate($per_page);

        return $this->successResponse($estadios,'Estadio list', 200);
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

        $estadio = Estadio::create($input);

        return $this->successResponse($estadio,'Estadio saved', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estadio  $estadio
     * @return \Illuminate\Http\Response
     */
    public function show(Estadio $estadio)
    {

        $estadio_show = Estadio::find($estadio->id);

        if (empty($estadio_show)) {
            return $this->errorResponse('Estadio not found',404);
        }
        return $this->successResponse($estadio_show,'Estadio show', 200);
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estadio  $estadio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estadio $estadio)
    {
        $estadio_update = Estadio::find($estadio->id);

        if (empty($estadio_update)) {
            return $this->errorResponse('Estadio not found',404);
        }
        $estadio_update->fill($request->all());
        $estadio_update->save();

        return $this->successResponse($estadio_update,'Estadio updated', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estadio  $estadio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estadio $estadio)
    {
        $estadio_delete = Estadio::find($estadio->id);
        if (empty($estadio_delete)) {
            return $this->errorResponse('Estadio not found',404);
        }  
        $estadio_delete->delete();
        return $this->successResponse($estadio_delete,'Estadio deleted', 200);
    }
}
