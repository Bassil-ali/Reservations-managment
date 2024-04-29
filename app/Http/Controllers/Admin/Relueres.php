<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\RelueresDataTable;
use Carbon\Carbon;
use App\Models\Reluere;

use App\Http\Controllers\Validations\RelueresRequest;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class Relueres extends Controller
{

	public function __construct() {

		$this->middleware('AdminRole:relueres_show', [
			'only' => ['index', 'show'],
		]);
		$this->middleware('AdminRole:relueres_add', [
			'only' => ['create', 'store'],
		]);
		$this->middleware('AdminRole:relueres_edit', [
			'only' => ['edit', 'update'],
		]);
		$this->middleware('AdminRole:relueres_delete', [
			'only' => ['destroy', 'multi_delete'],
		]);
	}

	

            /**
             * Baboon Script By [it v 1.6.40]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(RelueresDataTable $relueres)
            {
               return $relueres->render('admin.relueres.index',['title'=>trans('admin.relueres')]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
            	
               return view('admin.relueres.create',['title'=>trans('admin.create')]);
            }

            /**
             * Baboon Script By [it v 1.6.40]
             * Store a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response Or Redirect
             */
            public function store(RelueresRequest $request)
            {
                $data = $request->except("_token", "_method");
            	              $data['date'] = date('Y-m-d H:i', strtotime(request('date')));
		  		$relueres = Reluere::create($data); 
                $redirect = isset($request["add_back"])?"/create":"";
                return redirectWithSuccess(aurl('relueres'.$redirect), trans('admin.added')); }

            /**
             * Display the specified resource.
             * Baboon Script By [it v 1.6.40]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
        		$relueres =  Reluere::find($id);
        		return is_null($relueres) || empty($relueres)?
        		backWithError(trans("admin.undefinedRecord"),aurl("relueres")) :
        		view('admin.relueres.show',[
				    'title'=>trans('admin.show'),
					'relueres'=>$relueres
        		]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
        		$relueres =  Reluere::find($id);
        		return is_null($relueres) || empty($relueres)?
        		backWithError(trans("admin.undefinedRecord"),aurl("relueres")) :
        		view('admin.relueres.edit',[
				  'title'=>trans('admin.edit'),
				  'relueres'=>$relueres
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
				foreach (array_keys((new RelueresRequest)->attributes()) as $fillableUpdate) {
					if (!is_null(request($fillableUpdate))) {
						$fillableCols[$fillableUpdate] = request($fillableUpdate);
					}
				}
				return $fillableCols;
			}

            public function update(RelueresRequest $request,$id)
            {
              // Check Record Exists
              $relueres =  Reluere::find($id);
              if(is_null($relueres) || empty($relueres)){
              	return backWithError(trans("admin.undefinedRecord"),aurl("relueres"));
              }
              $data = $this->updateFillableColumns(); 
              $data['date'] = date('Y-m-d H:i', strtotime(request('date')));
              Reluere::where('id',$id)->update($data);
              $redirect = isset($request["save_back"])?"/".$id."/edit":"";
              return redirectWithSuccess(aurl('relueres'.$redirect), trans('admin.updated'));
            }

            /**
             * Baboon Script By [it v 1.6.40]
             * destroy a newly created resource in storage.
             * @param  $id
             * @return \Illuminate\Http\Response
             */
	public function destroy($id){
		$relueres = Reluere::find($id);
		if(is_null($relueres) || empty($relueres)){
			return backWithSuccess(trans('admin.undefinedRecord'),aurl("relueres"));
		}
               
		it()->delete('reluere',$id);
		$relueres->delete();
		return redirectWithSuccess(aurl("relueres"),trans('admin.deleted'));
	}


	public function multi_delete(){
		$data = request('selected_data');
		if(is_array($data)){
			foreach($data as $id){
				$relueres = Reluere::find($id);
				if(is_null($relueres) || empty($relueres)){
					return backWithError(trans('admin.undefinedRecord'),aurl("relueres"));
				}
                    	
				it()->delete('reluere',$id);
				$relueres->delete();
			}
			return redirectWithSuccess(aurl("relueres"),trans('admin.deleted'));
		}else {
			$relueres = Reluere::find($data);
			if(is_null($relueres) || empty($relueres)){
				return backWithError(trans('admin.undefinedRecord'),aurl("relueres"));
			}
                    
			it()->delete('reluere',$data);
			$relueres->delete();
			return redirectWithSuccess(aurl("relueres"),trans('admin.deleted'));
		}
	}
            

}