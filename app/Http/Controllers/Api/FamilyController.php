<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Family;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    use ApiResponser;

    public function __construct()
    {
        $this->middleware(['permission:patient.index'])->only('index');
        $this->middleware(['permission:patient.show'])->only('show');
        $this->middleware(['permission:patient.update'])->only('update');
        $this->middleware(['permission:patient.delete'])->only('destroy');
        $this->middleware(['permission:patient.create'])->only('store');
    }
    
    public function index(Request $request)
    {
        $query = Family::query();

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

        $families = $query
        // ->with()
        ->filter($filter)
        ->patient_id($patient_id)
        ->orderBy('id', $sort)
        ->paginate($per_page);

        return $this->successResponse($families,'Family list', 200);
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

        $families = Family::create($input);
        $families->patients()->sync($request->patient_id);

        return $this->successResponse($families,'Family saved', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family)
    {
        $family_show = Family::find($family->id);

        if (empty($family_show)) {
            return $this->errorResponse('Family not found',404);
        }

        return $this->successResponse($family_show,'Family show', 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Family $family)
    {
        $family_update = Family::find($family->id);

        if (empty($family_update)) {
            return $this->errorResponse('Family not found',404);
        }
        $family_update->fill($request->all());
        $family_update->save();

        return $this->successResponse($family_update,'Family updated', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function destroy(Family $family)
    {
        //
    }
}
