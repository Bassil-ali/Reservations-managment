<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\OffsetsDataTable;
use Carbon\Carbon;
use App\Models\Offset;

use App\Http\Controllers\Validations\OffsetsRequest;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class Offsets extends Controller
{

	public function __construct() {

		$this->middleware('AdminRole:offsets_show', [
			'only' => ['index', 'show'],
		]);
		$this->middleware('AdminRole:offsets_add', [
			'only' => ['create', 'store'],
		]);
		$this->middleware('AdminRole:offsets_edit', [
			'only' => ['edit', 'update'],
		]);
		$this->middleware('AdminRole:offsets_delete', [
			'only' => ['destroy', 'multi_delete'],
		]);
	}

	

            /**
             * Baboon Script By [it v 1.6.40]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(OffsetsDataTable $offsets)
            {
               return $offsets->render('admin.offsets.index',['title'=>trans('admin.offsets')]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
            	
               return view('admin.offsets.create',['title'=>trans('admin.create')]);
            }

            /**
             * Baboon Script By [it v 1.6.40]
             * Store a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response Or Redirect
             */
            public function store(OffsetsRequest $request)
            {
                $data = $request->except("_token", "_method");
            	              $data['date'] = date('Y-m-d H:i', strtotime(request('date')));
$data['admin_id'] = admin()->id(); 
		  		$offsets = Offset::create($data); 
                $redirect = isset($request["add_back"])?"/create":"";
                return redirectWithSuccess(aurl('offsets'.$redirect), trans('admin.added')); }

            /**
             * Display the specified resource.
             * Baboon Script By [it v 1.6.40]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
        		$offsets =  Offset::find($id);
        		return is_null($offsets) || empty($offsets)?
        		backWithError(trans("admin.undefinedRecord"),aurl("offsets")) :
        		view('admin.offsets.show',[
				    'title'=>trans('admin.show'),
					'offsets'=>$offsets
        		]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
        		$offsets =  Offset::find($id);
        		return is_null($offsets) || empty($offsets)?
        		backWithError(trans("admin.undefinedRecord"),aurl("offsets")) :
        		view('admin.offsets.edit',[
				  'title'=>trans('admin.edit'),
				  'offsets'=>$offsets
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
				foreach (array_keys((new OffsetsRequest)->attributes()) as $fillableUpdate) {
					if (!is_null(request($fillableUpdate))) {
						$fillableCols[$fillableUpdate] = request($fillableUpdate);
					}
				}
				return $fillableCols;
			}

            public function update(OffsetsRequest $request,$id)
            {
              // Check Record Exists
              $offsets =  Offset::find($id);
              if(is_null($offsets) || empty($offsets)){
              	return backWithError(trans("admin.undefinedRecord"),aurl("offsets"));
              }
              $data = $this->updateFillableColumns(); 
              $data['admin_id'] = admin()->id(); 
              $data['date'] = date('Y-m-d H:i', strtotime(request('date')));
              Offset::where('id',$id)->update($data);
              $redirect = isset($request["save_back"])?"/".$id."/edit":"";
              return redirectWithSuccess(aurl('offsets'.$redirect), trans('admin.updated'));
            }

            /**
             * Baboon Script By [it v 1.6.40]
             * destroy a newly created resource in storage.
             * @param  $id
             * @return \Illuminate\Http\Response
             */
	public function destroy($id){
		$offsets = Offset::find($id);
		if(is_null($offsets) || empty($offsets)){
			return backWithSuccess(trans('admin.undefinedRecord'),aurl("offsets"));
		}
               
		it()->delete('offset',$id);
		$offsets->delete();
		return redirectWithSuccess(aurl("offsets"),trans('admin.deleted'));
	}


	public function multi_delete(){
		$data = request('selected_data');
		if(is_array($data)){
			foreach($data as $id){
				$offsets = Offset::find($id);
				if(is_null($offsets) || empty($offsets)){
					return backWithError(trans('admin.undefinedRecord'),aurl("offsets"));
				}
                    	
				it()->delete('offset',$id);
				$offsets->delete();
			}
			return redirectWithSuccess(aurl("offsets"),trans('admin.deleted'));
		}else {
			$offsets = Offset::find($data);
			if(is_null($offsets) || empty($offsets)){
				return backWithError(trans('admin.undefinedRecord'),aurl("offsets"));
			}
                    
			it()->delete('offset',$data);
			$offsets->delete();
			return redirectWithSuccess(aurl("offsets"),trans('admin.deleted'));
		}
	}
            

}