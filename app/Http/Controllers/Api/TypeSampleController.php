<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TypeSample;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class TypeSampleController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type_sample = TypeSample::all();
        return $this->successResponse($type_sample,'listado tipos de muestras', 200);
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
     * @param  \App\Models\TypeSample  $typeSample
     * @return \Illuminate\Http\Response
     */
    public function show(TypeSample $typeSample)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeSample  $typeSample
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeSample $typeSample)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeSample  $typeSample
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeSample $typeSample)
    {
        //
    }
}
