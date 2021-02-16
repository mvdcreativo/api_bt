<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sample;
use App\Models\SampleData;
use App\Models\SampleDataAnatomo;
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

        if ($request->get('patient_id')) {
            $patient_id = $request->get('patient_id');
        }else{
            $patient_id = "";
        }

        $samples = $query
        ->with('sample_data', 'patient', 'type_sample', 'tumor_lineage', 'topography', 'sample_data_anatomo', 'tnm' )
        ->filter($filter)
        ->patient_id($patient_id)
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
         try {
            $sample = new Sample;
            $sample->fill($request->all());
            $sample->save();

            if($sample && $request->get('sample_data')){
                $sample_data = new SampleData;
                $sample_data->fill($request->get('sample_data'));
                $sample_data->sample()->associate($sample);
                $sample_data->save();
            }
            if($sample && $request->get('sample_data_anatomo')){
                $sample_data_anatomo = new SampleDataAnatomo();
                $sample_data_anatomo->fill($request->get('sample_data_anatomo'));
                $sample_data_anatomo->sample()->associate($sample);
                $sample_data_anatomo->save();
            }
        } catch (\Throwable $th) {
            return $th ;
        }


        
        $sample->sample_data;
        $sample->patient;
        $sample->type_sample;
        $sample->tumor_lineage;
        $sample->topography;
        $sample->sample_data_anatomo;
        $sample->tnm;
        // $sample->stages;

        return $this->successResponse($sample,'Sample saved', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sample  $samples
     * @return \Illuminate\Http\Response
     */
    public function show(Sample $sample)
    {

        $sample_show = Sample::with('sample_data', 'sample_data_anatomo', 'patient', 'type_sample', 'tumor_lineage', 'topography')->find($sample->id);

        if (empty($sample_show)) {
            return $this->errorResponse('Sample not found',404);
        }

        return $this->successResponse($sample_show,'Sample show', 200);
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sample  $samples
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sample $sample)
    {
        // return $request->all();
        try {
            $samples_update = Sample::find($sample->id);
            $samples_update->fill($request->all());
            $samples_update->save();

            $data = $request->sample_data;
            $data_anatomo =   $request->sample_data_anatomo;
            if($samples_update && $request->sample_data){
                if($data['sample_id']){
                    $sample_data= SampleData::where('sample_id', $data['sample_id'])->firstOrFail();
                    $sample_data->fill($request->sample_data);
                }else{
                    $sample_data = new SampleData;
                    $sample_data->fill($request->sample_data);
                    $sample_data->sample()->associate($samples_update);
                }
                $sample_data->save();
            }

            if($samples_update && $request->sample_data_anatomo){
                if($data_anatomo['sample_id']){
                    $sample_data_anatomo= SampleDataAnatomo::where('sample_id', $data_anatomo['sample_id'])->firstOrFail();
                    $sample_data_anatomo->fill($request->sample_data_anatomo);
                }else{
                    $sample_data_anatomo = new SampleDataAnatomo;
                    $sample_data_anatomo->fill($request->sample_data_anatomo);
                    $sample_data_anatomo->sample()->associate($samples_update);
                }
                $sample_data_anatomo->save();
            }
        } catch (\Throwable $th) {
            return $th ;
        }

        $samples_update->samples_data;
        $samples_update->patient;
        $samples_update->type_samples;
        $samples_update->tumor_lineage;
        $samples_update->topography;
        $samples_update->samples_data_anatomo;
        $samples_update->tnm;
        // $samples->stages;

        return $this->successResponse($samples_update,'Sample updated', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sample  $samples
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sample $sample)
    {
        $sample_delete = Sample::find($sample->id);
        if (empty($sample_delete)) {
            return $this->errorResponse('Sample not found',404);
        }  
        $sample_delete->delete();
        return $this->successResponse($sample_delete,'Sample deleted', 200);
    }
}
