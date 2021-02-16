<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TumorLineage;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class TumorLineageController extends Controller
{

    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = TumorLineage::query();

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

        $tumor_lineges = $query
        ->filter($filter)
        ->orderBy('id', $sort)
        ->paginate($per_page);

        return $this->successResponse($tumor_lineges,'Tumor Lineages list', 200);
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
     * @param  \App\Models\TumorLineage  $tumorLineage
     * @return \Illuminate\Http\Response
     */
    public function show(TumorLineage $tumorLineage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TumorLineage  $tumorLineage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TumorLineage $tumorLineage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TumorLineage  $tumorLineage
     * @return \Illuminate\Http\Response
     */
    public function destroy(TumorLineage $tumorLineage)
    {
        //
    }
}
