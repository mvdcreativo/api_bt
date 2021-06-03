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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stage  $stage
     * @return \Illuminate\Http\Response
     */
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stage $stage)
    {
        //
    }
}
