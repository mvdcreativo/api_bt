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
    public function index()
    {
        $tumor_lineages = TumorLineage::all();
        return $this->successResponse($tumor_lineages,'Tumor Lineages list', 200);
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
