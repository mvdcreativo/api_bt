<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PatientData;
use Illuminate\Http\Request;

class PatientDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\PatientData  $patientData
     * @return \Illuminate\Http\Response
     */
    public function show(PatientData $patientData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PatientData  $patientData
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PatientData $patientData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PatientData  $patientData
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientData $patientData)
    {
        //
    }
}
