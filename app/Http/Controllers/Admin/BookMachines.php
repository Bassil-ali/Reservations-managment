<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\BookMachinesDataTable;
use Carbon\Carbon;
use App\Models\BookMachine;

use App\Http\Controllers\Validations\BookMachinesRequest;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class BookMachines extends Controller
{

	public function __construct() {

		$this->middleware('AdminRole:bookmachines_show', [
			'only' => ['index', 'show'],
		]);
		$this->middleware('AdminRole:bookmachines_add', [
			'only' => ['create', 'store'],
		]);
		$this->middleware('AdminRole:bookmachines_edit', [
			'only' => ['edit', 'update'],
		]);
		$this->middleware('AdminRole:bookmachines_delete', [
			'only' => ['destroy', 'multi_delete'],
		]);
	}

	

            /**
             * Baboon Script By [it v 1.6.40]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(BookMachinesDataTable $bookmachines)
            {
               session()->remove('client_id');
               if(auth()->guard('client')->check()){
                return $bookmachines->render('admin.bookmachines.index',['title'=>trans('admin.client_book')]);
               }else{
               return $bookmachines->render('admin.bookmachines.index',['title'=>trans('admin.bookmachines')]);
               }
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
            	
               return view('admin.bookmachines.create',['title'=>trans('admin.create')]);
            }

            /**
             * Baboon Script By [it v 1.6.40]
             * Store a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response Or Redirect
             */
            public function store(BookMachinesRequest $request)
            {
                $data = $request->except("_token", "_method");
                if(session()->get('client_id') == null){
                  session()->put('client_id',  $data['client_id']);
                  }
                
                
                $client_id = session()->get('client_id');
                
                if($client_id != null){
                  $data['client_id'] = $client_id;
                }
            		$bookmachines = BookMachine::create($data); 
                $redirect = isset($request["add_back"])?"/create":"";
                return redirectWithSuccess(aurl('bookmachines'.$redirect), trans('admin.added')); }

            /**
             * Display the specified resource.
             * Baboon Script By [it v 1.6.40]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {

        		$bookmachines =  BookMachine::find($id);
        		return is_null($bookmachines) || empty($bookmachines)?
        		backWithError(trans("admin.undefinedRecord"),aurl("bookmachines")) :
        		view('admin.bookmachines.show',[
				    'title'=>trans('admin.show'),
					'bookmachines'=>$bookmachines
        		]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
              
        		$bookmachines =  BookMachine::find($id);
            $questions = BookMachine::where('client_id',$bookmachines->client_id)->where('machine_id',$bookmachines->machine_id)->get();
        		return is_null($bookmachines) || empty($bookmachines)?
        		backWithError(trans("admin.undefinedRecord"),aurl("bookmachines")) :
        		view('admin.bookmachines.edit',[
				  'title'=>trans('admin.edit'),
				  'bookmachines'=>$bookmachines,
          'questions' => $questions
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
				foreach (array_keys((new BookMachinesRequest)->attributes()) as $fillableUpdate) {
					if (!is_null(request($fillableUpdate))) {
						$fillableCols[$fillableUpdate] = request($fillableUpdate);
					}
				}
				return $fillableCols;
			}

            public function update(BookMachinesRequest $request,$id)
            {
              //dd($request['question_1'][0]);
              // Check Record Exists
              $bookmachines =  BookMachine::find($id);
              if(is_null($bookmachines) || empty($bookmachines)){
              	return backWithError(trans("admin.undefinedQ"),aurl("bookmachines"));
              }
              $data = $this->updateFillableColumns(); 
             
              //BookMachine::where('id',$id)->update(['isAnswer' => 1]);
              BookMachine::where('id',$id)->update($data);
              $machineAnswers = BookMachine::where('client_id',$bookmachines->client_id)->where('machine_id',$bookmachines->machine_id)->get();
              
              foreach($machineAnswers as $machineAnswer){
                 foreach($request['answer'] as $answer){
                  
                  $machineAnswer->update([
                    'answer' => $answer,
                    'isAnswer' => 1
                  ]);
                 }
              }

              $id = 0;
              if(auth()->guard('client')->check()){
               
               $id =  BookMachine::where('Document_number',$data['Document_number'])->where('isAnswer','')->get();
              }
             // dd($id);
              if($id->isEmpty()){
                //dd('cd');
                return backWithSuccess(trans("admin.undefinedQ"),aurl("bookmachines"));
              }
              
              $redirect = isset($request["save_back"])?"/".($id[0]->id)."/edit":"";
              return redirectWithSuccess(aurl('bookmachines'.$redirect), trans('admin.updated'));
            }

            /**
             * Baboon Script By [it v 1.6.40]
             * destroy a newly created resource in storage.
             * @param  $id
             * @return \Illuminate\Http\Response
             */
	public function destroy($id){
		$bookmachines = BookMachine::find($id);
		if(is_null($bookmachines) || empty($bookmachines)){
			return backWithSuccess(trans('admin.undefinedRecord'),aurl("bookmachines"));
		}
               
		it()->delete('bookmachine',$id);
		$bookmachines->delete();
		return redirectWithSuccess(aurl("bookmachines"),trans('admin.deleted'));
	}


	public function multi_delete(){
		$data = request('selected_data');
		if(is_array($data)){
			foreach($data as $id){
				$bookmachines = BookMachine::find($id);
				if(is_null($bookmachines) || empty($bookmachines)){
					return backWithError(trans('admin.undefinedRecord'),aurl("bookmachines"));
				}
                    	
				it()->delete('bookmachine',$id);
				$bookmachines->delete();
			}
			return redirectWithSuccess(aurl("bookmachines"),trans('admin.deleted'));
		}else {
			$bookmachines = BookMachine::find($data);
			if(is_null($bookmachines) || empty($bookmachines)){
				return backWithError(trans('admin.undefinedRecord'),aurl("bookmachines"));
			}
                    
			it()->delete('bookmachine',$data);
			$bookmachines->delete();
			return redirectWithSuccess(aurl("bookmachines"),trans('admin.deleted'));
		}
	}
            

}