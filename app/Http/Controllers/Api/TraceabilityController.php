<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Traceability;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TraceabilityController extends Controller
{

    use ApiResponser;
    public function __construct()
    {
        $this->middleware(['permission:sample.index'])->only('index');
        $this->middleware(['permission:sample.show'])->only('show');
        $this->middleware(['permission:sample.update'])->only('update');
        $this->middleware(['permission:sample.delete'])->only('destroy');
        $this->middleware(['permission:sample.create'])->only('store');
    }

    public function index(Request $request)
    {
        $query = Traceability::query();

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


        $traceabilities = $query
        ->with('sample', 'stage', 'tube')
        ->filter($filter)
        ->orderBy('created_at', $sort)
        ->paginate($per_page);

        return $this->successResponse($traceabilities,'Traceabilities list', 200);
    }




    public function store(Request $request)
    {

        $traceability = Traceability::create([
            'user_name' => Auth::user()->name." ".Auth::user()->last_name,
            'sample_id' => $request->get('sample_id'),
            'stage_id' => $request->get('stage_id'),
            'body' => $request->get('body'),
            'tube_id' => $request->get('tube_id'),
            'obs'  => $request->get('obs'),
        ]);

        return $this->successResponse($traceability,'Traceabilities list', 200);

    }





    public function show(Traceability $traceability)
    {
        //
    }




 
    public function update(Request $request, Traceability $traceability)
    {
        //
    }

 
    


    public function destroy(Traceability $traceability)
    {
        $traceability_delete = Traceability::find($traceability->id);
        if (empty($traceability_delete)) {
            return $this->errorResponse('Traceability not found',404);
        }  
        $traceability_delete->delete();
        return $this->successResponse($traceability_delete,'Traceability deleted', 200);

    }


    public function last_status_sample(Request $request)
    {
        $sample_id = $request->get('sample_id');
        $traceability = Traceability::latest('id')
        ->whereNotNull('stage_id')
        ->where('sample_id', $sample_id)
        ->first();
        $status_sample = $traceability->stage->name;

        return $this->successResponse($status_sample,'Status Sample', 200);
    }
}
