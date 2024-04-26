<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\ResponsesDataTable;
use Carbon\Carbon;
use App\Models\Response;

use App\Http\Controllers\Validations\ResponsesRequest;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class Responses extends Controller
{

	public function __construct() {

		$this->middleware('AdminRole:responses_show', [
			'only' => ['index', 'show'],
		]);
		$this->middleware('AdminRole:responses_add', [
			'only' => ['create', 'store'],
		]);
		$this->middleware('AdminRole:responses_edit', [
			'only' => ['edit', 'update'],
		]);
		$this->middleware('AdminRole:responses_delete', [
			'only' => ['destroy', 'multi_delete'],
		]);
	}

	

            /**
             * Baboon Script By [it v 1.6.40]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(ResponsesDataTable $responses)
            {
               return $responses->render('admin.responses.index',['title'=>trans('admin.responses')]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
            	
               return view('admin.responses.create',['title'=>trans('admin.create')]);
            }

            /**
             * Baboon Script By [it v 1.6.40]
             * Store a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response Or Redirect
             */
            public function store(ResponsesRequest $request)
            {
                $data = $request->except("_token", "_method");
            			  		$responses = Response::create($data); 
                $redirect = isset($request["add_back"])?"/create":"";
                return redirectWithSuccess(aurl('responses'.$redirect), trans('admin.added')); }

            /**
             * Display the specified resource.
             * Baboon Script By [it v 1.6.40]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
        		$responses =  Response::find($id);
        		return is_null($responses) || empty($responses)?
        		backWithError(trans("admin.undefinedRecord"),aurl("responses")) :
        		view('admin.responses.show',[
				    'title'=>trans('admin.show'),
					'responses'=>$responses
        		]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
        		$responses =  Response::find($id);
        		return is_null($responses) || empty($responses)?
        		backWithError(trans("admin.undefinedRecord"),aurl("responses")) :
        		view('admin.responses.edit',[
				  'title'=>trans('admin.edit'),
				  'responses'=>$responses
        		]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * update a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response
             */
            public function updateFillableColumns() {
				$fillableCols = [];
				foreach (array_keys((new ResponsesRequest)->attributes()) as $fillableUpdate) {
					if (!is_null(request($fillableUpdate))) {
						$fillableCols[$fillableUpdate] = request($fillableUpdate);
					}
				}
				return $fillableCols;
			}

            public function update(ResponsesRequest $request,$id)
            {
              // Check Record Exists
              $responses =  Response::find($id);
              if(is_null($responses) || empty($responses)){
              	return backWithError(trans("admin.undefinedRecord"),aurl("responses"));
              }
              $data = $this->updateFillableColumns(); 
              Response::where('id',$id)->update($data);
              $redirect = isset($request["save_back"])?"/".$id."/edit":"";
              return redirectWithSuccess(aurl('responses'.$redirect), trans('admin.updated'));
            }

            /**
             * Baboon Script By [it v 1.6.40]
             * destroy a newly created resource in storage.
             * @param  $id
             * @return \Illuminate\Http\Response
             */
	public function destroy($id){
		$responses = Response::find($id);
		if(is_null($responses) || empty($responses)){
			return backWithSuccess(trans('admin.undefinedRecord'),aurl("responses"));
		}
               
		it()->delete('response',$id);
		$responses->delete();
		return redirectWithSuccess(aurl("responses"),trans('admin.deleted'));
	}


	public function multi_delete(){
		$data = request('selected_data');
		if(is_array($data)){
			foreach($data as $id){
				$responses = Response::find($id);
				if(is_null($responses) || empty($responses)){
					return backWithError(trans('admin.undefinedRecord'),aurl("responses"));
				}
                    	
				it()->delete('response',$id);
				$responses->delete();
			}
			return redirectWithSuccess(aurl("responses"),trans('admin.deleted'));
		}else {
			$responses = Response::find($data);
			if(is_null($responses) || empty($responses)){
				return backWithError(trans('admin.undefinedRecord'),aurl("responses"));
			}
                    
			it()->delete('response',$data);
			$responses->delete();
			return redirectWithSuccess(aurl("responses"),trans('admin.deleted'));
		}
	}
            

}