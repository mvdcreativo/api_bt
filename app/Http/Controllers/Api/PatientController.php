<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\PatientData;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class PatientController extends Controller
{

    use ApiResponser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Patient::query();

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

        $patients = $query
        ->with('patient_data')
        ->filter($filter)
        ->orderBy('id', $sort)
        ->paginate($per_page);
        return $this->successResponse($patients,'Patients list', 200);
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
            $patient = new Patient;
            $patient->fill($request->all());
            $patient->save();

            if($patient && $request->get('patient_data')){
                $patient_data = new PatientData;
                $patient_data->fill($request->get('patient_data'));
                $patient_data->patient()->associate($patient);
                $patient_data->save();

            }
        } catch (\Throwable $th) {
            return $th ;
        }
        
        
        $patient->patient_data;
        return $this->successResponse($patient,'Patient saved', 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {

        $patient = Patient::with('patient_data', 'city')->find($patient->id);
        return $this->successResponse($patient,'Patient show', 200);
        
    }


        /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function check_patient_exist(Request $request)
    {
        if($request->not_include_patient_id){
            $patient_exclude_id = $request->not_include_patient_id;
        }else{
            $patient_exclude_id = null;
        }

        $patient = Patient::where('id','!=', $patient_exclude_id)->where("n_doc",$request->n_doc)->first();

        if(empty($patient)){
            return response()->json(['exist'=>null], 200);
        }
        
        return response()->json(['exist'=>true], 200);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {

        try {
            $patient = Patient::find($patient->id);
            $patient->fill($request->all());
            $patient->save();
            if($patient && $request->get('patient_data')){
                $data = $request->patient_data;
                // return $data;
                if($data['patient_id']){
                    $patient_data= PatientData::where('patient_id', $data['patient_id'])->firstOrFail();
                    $patient_data->fill($request->patient_data);
                }else{
                    $patient_data = new PatientData;
                    $patient_data->fill($request->patient_data);
                    $patient_data->patient()->associate($patient);
                }
                $patient_data->save();
                // return $patient_data;
            }
        } catch (\Throwable $th) {
            return $th ;
        }
        
        
        $patient->patient_data;
        $patient->city;
        return $this->successResponse($patient,'Patient updated', 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $patient = Patient::find($patient->id);
        $patient->delete();
        return $this->successResponse($patient,'Patient deleted', 200);
    }


    public function search()
    {
        $patient = Patient::all();
        return $this->successResponse($patient,'Patient list', 200);
    }
}
