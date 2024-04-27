<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\DecesionsDataTable;
use Carbon\Carbon;
use App\Models\Decesion;

use App\Http\Controllers\Validations\DecesionsRequest;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class Decesions extends Controller
{

	public function __construct() {

		$this->middleware('AdminRole:decesions_show', [
			'only' => ['index', 'show'],
		]);
		$this->middleware('AdminRole:decesions_add', [
			'only' => ['create', 'store'],
		]);
		$this->middleware('AdminRole:decesions_edit', [
			'only' => ['edit', 'update'],
		]);
		$this->middleware('AdminRole:decesions_delete', [
			'only' => ['destroy', 'multi_delete'],
		]);
	}

	

            /**
             * Baboon Script By [it v 1.6.40]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(DecesionsDataTable $decesions)
            {
               return $decesions->render('admin.decesions.index',['title'=>trans('admin.decesions')]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
            	
               return view('admin.decesions.create',['title'=>trans('admin.create')]);
            }

            /**
             * Baboon Script By [it v 1.6.40]
             * Store a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response Or Redirect
             */
            public function store(DecesionsRequest $request)
            {
                $data = $request->except("_token", "_method");
            			  		$decesions = Decesion::create($data); 
                $redirect = isset($request["add_back"])?"/create":"";
                return redirectWithSuccess(aurl('decesions'.$redirect), trans('admin.added')); }

            /**
             * Display the specified resource.
             * Baboon Script By [it v 1.6.40]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
        		$decesions =  Decesion::find($id);
        		return is_null($decesions) || empty($decesions)?
        		backWithError(trans("admin.undefinedRecord"),aurl("decesions")) :
        		view('admin.decesions.show',[
				    'title'=>trans('admin.show'),
					'decesions'=>$decesions
        		]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
        		$decesions =  Decesion::find($id);
        		return is_null($decesions) || empty($decesions)?
        		backWithError(trans("admin.undefinedRecord"),aurl("decesions")) :
        		view('admin.decesions.edit',[
				  'title'=>trans('admin.edit'),
				  'decesions'=>$decesions
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
				foreach (array_keys((new DecesionsRequest)->attributes()) as $fillableUpdate) {
					if (!is_null(request($fillableUpdate))) {
						$fillableCols[$fillableUpdate] = request($fillableUpdate);
					}
				}
				return $fillableCols;
			}

            public function update(DecesionsRequest $request,$id)
            {
              // Check Record Exists
              $decesions =  Decesion::find($id);
              if(is_null($decesions) || empty($decesions)){
              	return backWithError(trans("admin.undefinedRecord"),aurl("decesions"));
              }
              $data = $this->updateFillableColumns(); 
              Decesion::where('id',$id)->update($data);
              $redirect = isset($request["save_back"])?"/".$id."/edit":"";
              return redirectWithSuccess(aurl('decesions'.$redirect), trans('admin.updated'));
            }

            /**
             * Baboon Script By [it v 1.6.40]
             * destroy a newly created resource in storage.
             * @param  $id
             * @return \Illuminate\Http\Response
             */
	public function destroy($id){
		$decesions = Decesion::find($id);
		if(is_null($decesions) || empty($decesions)){
			return backWithSuccess(trans('admin.undefinedRecord'),aurl("decesions"));
		}
               
		it()->delete('decesion',$id);
		$decesions->delete();
		return redirectWithSuccess(aurl("decesions"),trans('admin.deleted'));
	}


	public function multi_delete(){
		$data = request('selected_data');
		if(is_array($data)){
			foreach($data as $id){
				$decesions = Decesion::find($id);
				if(is_null($decesions) || empty($decesions)){
					return backWithError(trans('admin.undefinedRecord'),aurl("decesions"));
				}
                    	
				it()->delete('decesion',$id);
				$decesions->delete();
			}
			return redirectWithSuccess(aurl("decesions"),trans('admin.deleted'));
		}else {
			$decesions = Decesion::find($data);
			if(is_null($decesions) || empty($decesions)){
				return backWithError(trans('admin.undefinedRecord'),aurl("decesions"));
			}
                    
			it()->delete('decesion',$data);
			$decesions->delete();
			return redirectWithSuccess(aurl("decesions"),trans('admin.deleted'));
		}
	}
            

}