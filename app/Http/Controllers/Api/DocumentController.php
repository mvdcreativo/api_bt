<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentController extends Controller
{

    use ApiResponser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Document::query();

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

        $documents = $query
        ->filter($filter)
        ->patient_id($patient_id)
        ->orderBy('id', $sort)
        ->paginate($per_page);

        return $this->successResponse($documents,'Document list', 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $patient_id = $request->get('patient_id');
        if($request->hasFile('files')){
            $files_saved = [];
            foreach($request->file('files') as $document)
            {
                $url_dir = 'documents/patients/';
                $name = $document->getClientOriginalName();
                $name_file = $document->getClientOriginalName();
                
                $ext = $document->getClientOriginalExtension();
                $documentNewName = Str::random(5).$patient_id.'-'.time().'.'.$ext;
                $path = 'public/'.$url_dir;
                $url_file = asset('storage/'.$url_dir.$documentNewName);

                $store = Storage::putFileAs($path, $document,$documentNewName);
                // $store = Storage::disk('public')->put( $path, $document);

                if ($store) {
                    $status = ['url_file'=> $url_file ,'upload'=>true, 'saved'=>false ];
                    $doc = new Document();
                    $doc->name = $name;
                    $doc->name_file = $name_file;
                    $doc->url_file = $url_file;
                    $doc->save();
                    $doc->patients()->sync($patient_id);

                    if($doc){ $status = ['url_file'=> $url_file, 'upload'=>true, 'saved'=>true ];}
                }
                $files_saved[]= $status;

            }
            return $this->successResponse($files_saved,'Documents saved', 201);

        }else{
            return $this->successResponse('NO files','Documents not saved', 200);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        $doc = Document::find($document->id);
        $doc->name = $request->get('name');
        $doc->save();
        return $this->successResponse($doc,'Documents not updatd', 200);

    }

    
    public function destroy(Document $document)
    {
        $file = Document::find($document->id);
        $fileName = explode("/", $file->url_file);
        $delete_file = Storage::disk('public')->delete('documents/patients/'.$fileName[6]);
        if($delete_file){
            $file->patients()->detach();
            $file->delete();
        }
        return $this->successResponse('deleted','Documents not updatd', 200);
    }
}
