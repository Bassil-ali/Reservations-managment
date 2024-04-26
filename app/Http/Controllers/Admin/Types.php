<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\TypesDataTable;
use Carbon\Carbon;
use App\Models\Type;

use App\Http\Controllers\Validations\TypesRequest;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class Types extends Controller
{

	public function __construct() {

		$this->middleware('AdminRole:types_show', [
			'only' => ['index', 'show'],
		]);
		$this->middleware('AdminRole:types_add', [
			'only' => ['create', 'store'],
		]);
		$this->middleware('AdminRole:types_edit', [
			'only' => ['edit', 'update'],
		]);
		$this->middleware('AdminRole:types_delete', [
			'only' => ['destroy', 'multi_delete'],
		]);
	}

	

            /**
             * Baboon Script By [it v 1.6.40]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(TypesDataTable $types)
            {
               return $types->render('admin.types.index',['title'=>trans('admin.types')]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
            	
               return view('admin.types.create',['title'=>trans('admin.create')]);
            }

            /**
             * Baboon Script By [it v 1.6.40]
             * Store a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response Or Redirect
             */
            public function store(TypesRequest $request)
            {
                $data = $request->except("_token", "_method");
            			  		$types = Type::create($data); 
                $redirect = isset($request["add_back"])?"/create":"";
                return redirectWithSuccess(aurl('types'.$redirect), trans('admin.added')); }

            /**
             * Display the specified resource.
             * Baboon Script By [it v 1.6.40]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
        		$types =  Type::find($id);
        		return is_null($types) || empty($types)?
        		backWithError(trans("admin.undefinedRecord"),aurl("types")) :
        		view('admin.types.show',[
				    'title'=>trans('admin.show'),
					'types'=>$types
        		]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
        		$types =  Type::find($id);
        		return is_null($types) || empty($types)?
        		backWithError(trans("admin.undefinedRecord"),aurl("types")) :
        		view('admin.types.edit',[
				  'title'=>trans('admin.edit'),
				  'types'=>$types
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
				foreach (array_keys((new TypesRequest)->attributes()) as $fillableUpdate) {
					if (!is_null(request($fillableUpdate))) {
						$fillableCols[$fillableUpdate] = request($fillableUpdate);
					}
				}
				return $fillableCols;
			}

            public function update(TypesRequest $request,$id)
            {
              // Check Record Exists
              $types =  Type::find($id);
              if(is_null($types) || empty($types)){
              	return backWithError(trans("admin.undefinedRecord"),aurl("types"));
              }
              $data = $this->updateFillableColumns(); 
              Type::where('id',$id)->update($data);
              $redirect = isset($request["save_back"])?"/".$id."/edit":"";
              return redirectWithSuccess(aurl('types'.$redirect), trans('admin.updated'));
            }

            /**
             * Baboon Script By [it v 1.6.40]
             * destroy a newly created resource in storage.
             * @param  $id
             * @return \Illuminate\Http\Response
             */
	public function destroy($id){
		$types = Type::find($id);
		if(is_null($types) || empty($types)){
			return backWithSuccess(trans('admin.undefinedRecord'),aurl("types"));
		}
               
		it()->delete('type',$id);
		$types->delete();
		return redirectWithSuccess(aurl("types"),trans('admin.deleted'));
	}


	public function multi_delete(){
		$data = request('selected_data');
		if(is_array($data)){
			foreach($data as $id){
				$types = Type::find($id);
				if(is_null($types) || empty($types)){
					return backWithError(trans('admin.undefinedRecord'),aurl("types"));
				}
                    	
				it()->delete('type',$id);
				$types->delete();
			}
			return redirectWithSuccess(aurl("types"),trans('admin.deleted'));
		}else {
			$types = Type::find($data);
			if(is_null($types) || empty($types)){
				return backWithError(trans('admin.undefinedRecord'),aurl("types"));
			}
                    
			it()->delete('type',$data);
			$types->delete();
			return redirectWithSuccess(aurl("types"),trans('admin.deleted'));
		}
	}
            

}