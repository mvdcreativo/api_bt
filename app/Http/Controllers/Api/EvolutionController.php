<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Evolution;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class EvolutionController extends Controller
{

    use ApiResponser;
    public function __construct()
    {
        $this->middleware(['permission:sample.index'])->only('index');
        $this->middleware(['permission:sample.show'])->only('show');
        $this->middleware(['permission:sample.update'])->only('update');
        $this->middleware(['permission:sample.delete'])->only('destroy');
        $this->middleware(['permission:sample.create'])->only('store');
    }

    public function index(Request $request)
    {
        $query = Evolution::query();

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


        $evolutions = $query
        
        ->filter($filter)
        ->orderBy('created_at', $sort)
        ->paginate($per_page);

        return $this->successResponse($evolutions,'Evolutions list', 200);
    }


    public function store(Request $request)
    {
        $evolution = new Evolution;
        $evolution->fill($request->all());
        $evolution->save();

        return $this->successResponse($evolution,'Evolution saved', 201);
    }


    public function show(Evolution $evolution)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Evolution  $evolution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evolution $evolution)
    {
        $evolution_update = Evolution::find($evolution->id);
        if (empty($evolution_update)) {
            return $this->errorResponse('evolution not found',404);
        }
        $evolution_update->fill($request->all());
        $evolution_update->save();

        return $this->successResponse($evolution_update,'evolution updated', 200);    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evolution  $evolution
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evolution $evolution)
    {
        $evolution_delete = Evolution::find($evolution->id);
        if (empty($evolution_delete)) {
            return $this->errorResponse('State not found',404);
        }
        $evolution_delete->delete();
        return $this->successResponse($evolution_delete,'State deleted', 200);
    }
}
