<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Doctor::query();

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

        $doctors = $query
        ->filter($filter)
        ->orderBy('id', $sort)
        ->paginate($per_page);

        return $this->successResponse($doctors,'Doctor list', 200);
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

        $doctor = Doctor::create($input);

        return $this->successResponse($doctor,'Doctor saved', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {

        $doctor_show = Doctor::find($doctor->id);

        if (empty($doctor_show)) {
            return $this->errorResponse('Doctor not found',404);
        }
        return $this->successResponse($doctor_show,'Doctor show', 200);
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        $doctor_update = Doctor::find($doctor->id);

        if (empty($doctor_update)) {
            return $this->errorResponse('Doctor not found',404);
        }
        $doctor_update->fill($request->all());
        $doctor_update->save();

        return $this->successResponse($doctor_update,'Doctor updated', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        $doctor_delete = Doctor::find($doctor->id);
        if (empty($doctor_delete)) {
            return $this->errorResponse('Doctor not found',404);
        }  
        $doctor_delete->delete();
        return $this->successResponse($doctor_delete,'Doctor deleted', 200);
    }
}
