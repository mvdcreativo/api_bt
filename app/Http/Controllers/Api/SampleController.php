<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sample;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class SampleController extends Controller
{

    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Sample::query();

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

        $samples = $query
        ->with('sample_data', 'patient', 'type_sample', 'tumor_lineage', 'topography', 'sample_data_anatomo', 'tnm', 'stages' )
        ->filter($filter)
        ->orderBy('id', $sort)
        ->paginate($per_page);

        return $this->successResponse($samples,'Sample list', 200);
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

        $samples = Sample::create($input);

        return $this->successResponse($samples,'Sample saved', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sample  $samples
     * @return \Illuminate\Http\Response
     */
    public function show(Sample $samples)
    {

        $samples_show = Sample::with('sample_data', 'patient', 'type_sample', 'tumor_lineage', 'topography')->find($samples->id);

        if (empty($samples_show)) {
            return $this->errorResponse('Sample not found',404);
        }

        return $this->successResponse($samples_show,'Sample show', 200);
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sample  $samples
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sample $samples)
    {
        $samples_update = Sample::find($samples->id);

        if (empty($samples_update)) {
            return $this->errorResponse('Sample not found',404);
        }
        $samples_update->fill($request->all());
        $samples_update->save();

        return $this->successResponse($samples_update,'Sample updated', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sample  $samples
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sample $samples)
    {
        $samples_delete = Sample::find($samples->id);
        if (empty($samples_delete)) {
            return $this->errorResponse('Sample not found',404);
        }  
        $samples_delete->delete();
        return $this->successResponse($samples_delete,'Sample deleted', 200);
    }
}
