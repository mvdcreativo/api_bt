<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tube;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class TubeController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Tube::query();

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

        
        if ($request->get('sample_id')) {
            $sample_id = $request->get('sample_id');
        }else{
            $sample_id = "";
        }

        $tubes = $query
        ->filter($filter)
        ->sample_id($sample_id)
        ->orderBy('id', $sort)
        ->paginate($per_page);

        return $this->successResponse($tubes,'Tube list', 200);
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

        $samples = Tube::create($input);

        return $this->successResponse($samples,'Tube saved', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tube  $tube
     * @return \Illuminate\Http\Response
     */
    public function show(Tube $tube)
    {
        $tube_show = Tube::find($tube->id);

        if (empty($tube_show)) {
            return $this->errorResponse('Tube not found',404);
        }

        return $this->successResponse($tube_show,'Tube show', 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tube  $tube
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tube $tube)
    {
        $tuube_update = Tube::find($tube->id);

        if (empty($tuube_update)) {
            return $this->errorResponse('Tube not found',404);
        }
        $tuube_update->fill($request->all());
        $tuube_update->save();

        return $this->successResponse($tuube_update,'Tube updated', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tube  $tube
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tube $tube)
    {
        $tube_delete = Tube::find($tube->id);
        if (empty($tube_delete)) {
            return $this->errorResponse('Tube not found',404);
        }  
        $tube_delete->delete();
        return $this->successResponse($tube_delete,'Tube deleted', 200);
    }

    public function last_id_tube()
    {
        $id = Tube::latest('id')->first();

        return $this->successResponse($id,'Tube last id', 200);
    }

    public function check_tube_exist(Request $request)
    {
        if($request->tube_exclude){
            $tube_exclude = $request->tube_exclude;
        }else{
            $tube_exclude = null;
        }
        if($request->tube) {
            $tube = $request->tube;
        }else{
            $tube = null;
        }

        
        $tube_exist = Tube::where('code', $tube)
        ->where('code','!=', $tube_exclude)->first();
        // return $tube_exist;
        if(!$tube_exist){
            return response()->json(['exist'=>null], 200);
        }
        
        return response()->json(['exist'=>true], 200);
    }
}
