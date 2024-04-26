<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\DirectionsDataTable;
use Carbon\Carbon;
use App\Models\Direction;

use App\Http\Controllers\Validations\DirectionsRequest;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class Directions extends Controller
{

	public function __construct() {

		$this->middleware('AdminRole:directions_show', [
			'only' => ['index', 'show'],
		]);
		$this->middleware('AdminRole:directions_add', [
			'only' => ['create', 'store'],
		]);
		$this->middleware('AdminRole:directions_edit', [
			'only' => ['edit', 'update'],
		]);
		$this->middleware('AdminRole:directions_delete', [
			'only' => ['destroy', 'multi_delete'],
		]);
	}

	

            /**
             * Baboon Script By [it v 1.6.40]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(DirectionsDataTable $directions)
            {
               return $directions->render('admin.directions.index',['title'=>trans('admin.directions')]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
            	
               return view('admin.directions.create',['title'=>trans('admin.create')]);
            }

            /**
             * Baboon Script By [it v 1.6.40]
             * Store a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response Or Redirect
             */
            public function store(DirectionsRequest $request)
            {
                $data = $request->except("_token", "_method");
            			  		$directions = Direction::create($data); 
                $redirect = isset($request["add_back"])?"/create":"";
                return redirectWithSuccess(aurl('directions'.$redirect), trans('admin.added')); }

            /**
             * Display the specified resource.
             * Baboon Script By [it v 1.6.40]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
        		$directions =  Direction::find($id);
        		return is_null($directions) || empty($directions)?
        		backWithError(trans("admin.undefinedRecord"),aurl("directions")) :
        		view('admin.directions.show',[
				    'title'=>trans('admin.show'),
					'directions'=>$directions
        		]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
        		$directions =  Direction::find($id);
        		return is_null($directions) || empty($directions)?
        		backWithError(trans("admin.undefinedRecord"),aurl("directions")) :
        		view('admin.directions.edit',[
				  'title'=>trans('admin.edit'),
				  'directions'=>$directions
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
				foreach (array_keys((new DirectionsRequest)->attributes()) as $fillableUpdate) {
					if (!is_null(request($fillableUpdate))) {
						$fillableCols[$fillableUpdate] = request($fillableUpdate);
					}
				}
				return $fillableCols;
			}

            public function update(DirectionsRequest $request,$id)
            {
              // Check Record Exists
              $directions =  Direction::find($id);
              if(is_null($directions) || empty($directions)){
              	return backWithError(trans("admin.undefinedRecord"),aurl("directions"));
              }
              $data = $this->updateFillableColumns(); 
              Direction::where('id',$id)->update($data);
              $redirect = isset($request["save_back"])?"/".$id."/edit":"";
              return redirectWithSuccess(aurl('directions'.$redirect), trans('admin.updated'));
            }

            /**
             * Baboon Script By [it v 1.6.40]
             * destroy a newly created resource in storage.
             * @param  $id
             * @return \Illuminate\Http\Response
             */
	public function destroy($id){
		$directions = Direction::find($id);
		if(is_null($directions) || empty($directions)){
			return backWithSuccess(trans('admin.undefinedRecord'),aurl("directions"));
		}
               
		it()->delete('direction',$id);
		$directions->delete();
		return redirectWithSuccess(aurl("directions"),trans('admin.deleted'));
	}


	public function multi_delete(){
		$data = request('selected_data');
		if(is_array($data)){
			foreach($data as $id){
				$directions = Direction::find($id);
				if(is_null($directions) || empty($directions)){
					return backWithError(trans('admin.undefinedRecord'),aurl("directions"));
				}
                    	
				it()->delete('direction',$id);
				$directions->delete();
			}
			return redirectWithSuccess(aurl("directions"),trans('admin.deleted'));
		}else {
			$directions = Direction::find($data);
			if(is_null($directions) || empty($directions)){
				return backWithError(trans('admin.undefinedRecord'),aurl("directions"));
			}
                    
			it()->delete('direction',$data);
			$directions->delete();
			return redirectWithSuccess(aurl("directions"),trans('admin.deleted'));
		}
	}
            

}