<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Country::query();

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

        $countries = $query
        ->filter($filter)
        ->orderBy('id', $sort)
        ->paginate($per_page);

        return $this->successResponse($countries,'Countries list', 200);
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

        $country = Country::create($input);

        return $this->successResponse($country,'Country saved', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {

        $country_show = Country::find($country->id);

        if (empty($country_show)) {
            return $this->errorResponse('State not found',404);
        }
        return $this->successResponse($country_show,'Country show', 200);
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $country_update = Country::find($country->id);

        if (empty($country_update)) {
            return $this->errorResponse('State not found',404);
        }
        $country_update->fill($request->all());
        $country_update->save();

        return $this->successResponse($country_update,'Country updated', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $country_delete = Country::find($country->id);
        if (empty($country_delete)) {
            return $this->errorResponse('State not found',404);
        }  
        $country_delete->delete();
        return $this->successResponse($country_delete,'Country deleted', 200);
    }
}
