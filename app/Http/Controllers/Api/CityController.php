<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class CityController extends Controller
{

    use ApiResponser;
    public function __construct()
    {
        $this->middleware(['permission:ubication.index'])->only('index');
        $this->middleware(['permission:ubication.show'])->only('show');
        $this->middleware(['permission:ubication.update'])->only('update');
        $this->middleware(['permission:ubication.delete'])->only('destroy');
        $this->middleware(['permission:ubication.create'])->only('store');
    }

    public function index(Request $request)
    {
        $query = City::query();

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

        $cities = $query
        ->with('state')
        ->filter($filter)
        ->orderBy('id', $sort)
        ->paginate($per_page);

        return $this->successResponse($cities,'City list', 200);
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

        $city = City::create($input);

        return $this->successResponse($city,'City saved', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {

        $city_show = City::find($city->id);

        if (empty($city_show)) {
            return $this->errorResponse('State not found',404);
        }
        return $this->successResponse($city_show,'City show', 200);
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $city_update = City::find($city->id);

        if (empty($city_update)) {
            return $this->errorResponse('State not found',404);
        }
        $city_update->fill($request->all());
        $city_update->save();

        return $this->successResponse($city_update,'City updated', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city_delete = City::find($city->id);
        if (empty($city_delete)) {
            return $this->errorResponse('State not found',404);
        }  
        $city_delete->delete();
        return $this->successResponse($city_delete,'City deleted', 200);
    }
}
