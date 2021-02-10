<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\State;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class StateController extends Controller
{

    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $query = State::query();

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

        $states = $query
        ->with('country')
        ->filter($filter)
        ->orderBy('id', $sort)
        ->paginate($per_page);

        return $this->successResponse($states,'State list', 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $state = new State;
        $state->fill($request->all());
        $state->save();

        return $this->successResponse($state,'Stete saved', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        
        $state_show = State::find($state->id);
        if (empty($state_show)) {
            return $this->errorResponse('State not found',404);
        }
        return $this->successResponse($state_show,'State show', 200); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, State $state)
    {
        $state_update = State::find($state->id);
        if (empty($state_update)) {
            return $this->errorResponse('State not found',404);
        }
        $state_update->fill($request->all());
        $state_update->save();

        return $this->successResponse($state_update,'State updated', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        $state_delete = State::find($state->id);
        if (empty($state_delete)) {
            return $this->errorResponse('State not found',404);
        }
        $state_delete->delete();
        return $this->successResponse($state_delete,'State deleted', 200);
    }
}
