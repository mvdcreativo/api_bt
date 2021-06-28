<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Stage;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class StageController extends Controller
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
        $query = Stage::query();

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


        $stages = $query
        
        ->filter($filter)
        ->orderBy('created_at', $sort)
        ->paginate($per_page);

        return $this->successResponse($stages,'Stages list', 200);
    }


    public function store(Request $request)
    {
        $stage = new Stage;
        $stage->fill($request->all());
        $stage->save();

        return $this->successResponse($stage,'Stage saved', 201);
    }


    public function show(Stage $stage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stage $stage)
    {
        $stage_update = Stage::find($stage->id);
        if (empty($stage_update)) {
            return $this->errorResponse('stage not found',404);
        }
        $stage_update->fill($request->all());
        $stage_update->save();

        return $this->successResponse($stage_update,'stage updated', 200);    
    }


    public function destroy(Stage $stage)
    {
        $stage_delete = Stage::find($stage->id);
        if (empty($stage_delete)) {
            return $this->errorResponse('State not found',404);
        }
        $stage_delete->delete();
        return $this->successResponse($stage_delete,'State deleted', 200);
    }
}
