<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\GradesDataTable;
use Carbon\Carbon;
use App\Models\Grade;

use App\Http\Controllers\Validations\GradesRequest;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class Grades extends Controller
{

	public function __construct() {

		$this->middleware('AdminRole:grades_show', [
			'only' => ['index', 'show'],
		]);
		$this->middleware('AdminRole:grades_add', [
			'only' => ['create', 'store'],
		]);
		$this->middleware('AdminRole:grades_edit', [
			'only' => ['edit', 'update'],
		]);
		$this->middleware('AdminRole:grades_delete', [
			'only' => ['destroy', 'multi_delete'],
		]);
	}

	

            /**
             * Baboon Script By [it v 1.6.40]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(GradesDataTable $grades)
            {
               return $grades->render('admin.grades.index',['title'=>trans('admin.grades')]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
            	
               return view('admin.grades.create',['title'=>trans('admin.create')]);
            }

            /**
             * Baboon Script By [it v 1.6.40]
             * Store a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response Or Redirect
             */
            public function store(GradesRequest $request)
            {
                $data = $request->except("_token", "_method");
            			  		$grades = Grade::create($data); 
                $redirect = isset($request["add_back"])?"/create":"";
                return redirectWithSuccess(aurl('grades'.$redirect), trans('admin.added')); }

            /**
             * Display the specified resource.
             * Baboon Script By [it v 1.6.40]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
        		$grades =  Grade::find($id);
        		return is_null($grades) || empty($grades)?
        		backWithError(trans("admin.undefinedRecord"),aurl("grades")) :
        		view('admin.grades.show',[
				    'title'=>trans('admin.show'),
					'grades'=>$grades
        		]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
        		$grades =  Grade::find($id);
        		return is_null($grades) || empty($grades)?
        		backWithError(trans("admin.undefinedRecord"),aurl("grades")) :
        		view('admin.grades.edit',[
				  'title'=>trans('admin.edit'),
				  'grades'=>$grades
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
				foreach (array_keys((new GradesRequest)->attributes()) as $fillableUpdate) {
					if (!is_null(request($fillableUpdate))) {
						$fillableCols[$fillableUpdate] = request($fillableUpdate);
					}
				}
				return $fillableCols;
			}

            public function update(GradesRequest $request,$id)
            {
              // Check Record Exists
              $grades =  Grade::find($id);
              if(is_null($grades) || empty($grades)){
              	return backWithError(trans("admin.undefinedRecord"),aurl("grades"));
              }
              $data = $this->updateFillableColumns(); 
              Grade::where('id',$id)->update($data);
              $redirect = isset($request["save_back"])?"/".$id."/edit":"";
              return redirectWithSuccess(aurl('grades'.$redirect), trans('admin.updated'));
            }

            /**
             * Baboon Script By [it v 1.6.40]
             * destroy a newly created resource in storage.
             * @param  $id
             * @return \Illuminate\Http\Response
             */
	public function destroy($id){
		$grades = Grade::find($id);
		if(is_null($grades) || empty($grades)){
			return backWithSuccess(trans('admin.undefinedRecord'),aurl("grades"));
		}
               
		it()->delete('grade',$id);
		$grades->delete();
		return redirectWithSuccess(aurl("grades"),trans('admin.deleted'));
	}


	public function multi_delete(){
		$data = request('selected_data');
		if(is_array($data)){
			foreach($data as $id){
				$grades = Grade::find($id);
				if(is_null($grades) || empty($grades)){
					return backWithError(trans('admin.undefinedRecord'),aurl("grades"));
				}
                    	
				it()->delete('grade',$id);
				$grades->delete();
			}
			return redirectWithSuccess(aurl("grades"),trans('admin.deleted'));
		}else {
			$grades = Grade::find($data);
			if(is_null($grades) || empty($grades)){
				return backWithError(trans('admin.undefinedRecord'),aurl("grades"));
			}
                    
			it()->delete('grade',$data);
			$grades->delete();
			return redirectWithSuccess(aurl("grades"),trans('admin.deleted'));
		}
	}
            

}