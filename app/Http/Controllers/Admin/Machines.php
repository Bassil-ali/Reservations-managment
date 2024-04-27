<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\MachinesDataTable;
use Carbon\Carbon;
use App\Models\Machine;

use App\Http\Controllers\Validations\MachinesRequest;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class Machines extends Controller
{

	public function __construct() {

		$this->middleware('AdminRole:machines_show', [
			'only' => ['index', 'show'],
		]);
		$this->middleware('AdminRole:machines_add', [
			'only' => ['create', 'store'],
		]);
		$this->middleware('AdminRole:machines_edit', [
			'only' => ['edit', 'update'],
		]);
		$this->middleware('AdminRole:machines_delete', [
			'only' => ['destroy', 'multi_delete'],
		]);
	}

	

            /**
             * Baboon Script By [it v 1.6.40]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(MachinesDataTable $machines)
            {
               return $machines->render('admin.machines.index',['title'=>trans('admin.machines')]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
            	
               return view('admin.machines.create',['title'=>trans('admin.create')]);
            }

            /**
             * Baboon Script By [it v 1.6.40]
             * Store a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response Or Redirect
             */
            public function store(MachinesRequest $request)
            {
                $data = $request->except("_token", "_method");
            	              $data['date'] = date('Y-m-d H:i', strtotime(request('date')));
$data['photo'] = "";
$data['admin_id'] = admin()->id(); 
		  		$machines = Machine::create($data); 
               if(request()->hasFile('photo')){
              $machines->photo = it()->upload('photo','machines/'.$machines->id);
              $machines->save();
              }
                $redirect = isset($request["add_back"])?"/create":"";
                return redirectWithSuccess(aurl('machines'.$redirect), trans('admin.added')); }

            /**
             * Display the specified resource.
             * Baboon Script By [it v 1.6.40]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
        		$machines =  Machine::find($id);
        		return is_null($machines) || empty($machines)?
        		backWithError(trans("admin.undefinedRecord"),aurl("machines")) :
        		view('admin.machines.show',[
				    'title'=>trans('admin.show'),
					'machines'=>$machines
        		]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
        		$machines =  Machine::find($id);
        		return is_null($machines) || empty($machines)?
        		backWithError(trans("admin.undefinedRecord"),aurl("machines")) :
        		view('admin.machines.edit',[
				  'title'=>trans('admin.edit'),
				  'machines'=>$machines
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
				foreach (array_keys((new MachinesRequest)->attributes()) as $fillableUpdate) {
					if (!is_null(request($fillableUpdate))) {
						$fillableCols[$fillableUpdate] = request($fillableUpdate);
					}
				}
				return $fillableCols;
			}

            public function update(MachinesRequest $request,$id)
            {
              // Check Record Exists
              $machines =  Machine::find($id);
              if(is_null($machines) || empty($machines)){
              	return backWithError(trans("admin.undefinedRecord"),aurl("machines"));
              }
              $data = $this->updateFillableColumns(); 
              $data['admin_id'] = admin()->id(); 
              $data['date'] = date('Y-m-d H:i', strtotime(request('date')));
               if(request()->hasFile('photo')){
              it()->delete($machines->photo);
              $data['photo'] = it()->upload('photo','machines');
               } 
              Machine::where('id',$id)->update($data);
              $redirect = isset($request["save_back"])?"/".$id."/edit":"";
              return redirectWithSuccess(aurl('machines'.$redirect), trans('admin.updated'));
            }

            /**
             * Baboon Script By [it v 1.6.40]
             * destroy a newly created resource in storage.
             * @param  $id
             * @return \Illuminate\Http\Response
             */
	public function destroy($id){
		$machines = Machine::find($id);
		if(is_null($machines) || empty($machines)){
			return backWithSuccess(trans('admin.undefinedRecord'),aurl("machines"));
		}
               		if(!empty($machines->photo)){
			it()->delete($machines->photo);		}

		it()->delete('machine',$id);
		$machines->delete();
		return redirectWithSuccess(aurl("machines"),trans('admin.deleted'));
	}


	public function multi_delete(){
		$data = request('selected_data');
		if(is_array($data)){
			foreach($data as $id){
				$machines = Machine::find($id);
				if(is_null($machines) || empty($machines)){
					return backWithError(trans('admin.undefinedRecord'),aurl("machines"));
				}
                    					if(!empty($machines->photo)){
				  it()->delete($machines->photo);
				}
				it()->delete('machine',$id);
				$machines->delete();
			}
			return redirectWithSuccess(aurl("machines"),trans('admin.deleted'));
		}else {
			$machines = Machine::find($data);
			if(is_null($machines) || empty($machines)){
				return backWithError(trans('admin.undefinedRecord'),aurl("machines"));
			}
                    
			if(!empty($machines->photo)){
			 it()->delete($machines->photo);
			}			it()->delete('machine',$data);
			$machines->delete();
			return redirectWithSuccess(aurl("machines"),trans('admin.deleted'));
		}
	}
            

}