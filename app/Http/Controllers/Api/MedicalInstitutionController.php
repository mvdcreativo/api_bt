<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MedicalInstitution;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class MedicalInstitutionController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = MedicalInstitution::query();

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

        $medical_institutions = $query
        ->filter($filter)
        ->orderBy('id', $sort)
        ->paginate($per_page);

        return $this->successResponse($medical_institutions,'MedicalInstitution list', 200);
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

        $medical_institution = MedicalInstitution::create($input);

        return $this->successResponse($medical_institution,'MedicalInstitution saved', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MedicalInstitution  $medical_institution
     * @return \Illuminate\Http\Response
     */
    public function show(MedicalInstitution $medical_institution)
    {

        $medical_institution_show = MedicalInstitution::find($medical_institution->id);

        if (empty($medical_institution_show)) {
            return $this->errorResponse('State not found',404);
        }
        return $this->successResponse($medical_institution_show,'MedicalInstitution show', 200);
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MedicalInstitution  $medical_institution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MedicalInstitution $medical_institution)
    {
        $medical_institution_update = MedicalInstitution::find($medical_institution->id);

        if (empty($medical_institution_update)) {
            return $this->errorResponse('State not found',404);
        }
        $medical_institution_update->fill($request->all());
        $medical_institution_update->save();

        return $this->successResponse($medical_institution_update,'MedicalInstitution updated', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MedicalInstitution  $medical_institution
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicalInstitution $medical_institution)
    {
        $medical_institution_delete = MedicalInstitution::find($medical_institution->id);
        if (empty($medical_institution_delete)) {
            return $this->errorResponse('State not found',404);
        }  
        $medical_institution_delete->delete();
        return $this->successResponse($medical_institution_delete,'MedicalInstitution deleted', 200);
    }
}
