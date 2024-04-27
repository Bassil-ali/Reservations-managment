<?php
namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Machine;
use Validator;
use App\Http\Controllers\ValidationsApi\V1\MachinesRequest;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class MachinesApi extends Controller{
	protected $selectColumns = [
		"id",
		"code",
		"date",
		"capacite production",
		"fiche",
		"date finproduction",
		"photo",
	];

            /**
             * Display the specified releationshop.
             * Baboon Api Script By [it v 1.6.40]
             * @return array to assign with index & show methods
             */
            public function arrWith(){
               return [];
            }


            /**
             * Baboon Api Script By [it v 1.6.40]
             * Display a listing of the resource. Api
             * @return \Illuminate\Http\Response
             */
            public function index()
            {
            	$Machine = Machine::select($this->selectColumns)->with($this->arrWith())->orderBy("id","desc")->paginate(15);
               return successResponseJson(["data"=>$Machine]);
            }


            /**
             * Baboon Api Script By [it v 1.6.40]
             * Store a newly created resource in storage. Api
             * @return \Illuminate\Http\Response
             */
    public function store(MachinesRequest $request)
    {
    	$data = $request->except("_token");
    	
              $data["user_id"] = auth()->id(); 
                $data["photo"] = "";
        $Machine = Machine::create($data); 
               if(request()->hasFile("photo")){
              $Machine->photo = it()->upload("photo","machines/".$Machine->id);
              $Machine->save();
              }

		  $Machine = Machine::with($this->arrWith())->find($Machine->id,$this->selectColumns);
        return successResponseJson([
            "message"=>trans("admin.added"),
            "data"=>$Machine
        ]);
    }


            /**
             * Display the specified resource.
             * Baboon Api Script By [it v 1.6.40]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
                $Machine = Machine::with($this->arrWith())->find($id,$this->selectColumns);
            	if(is_null($Machine) || empty($Machine)){
            	 return errorResponseJson([
            	  "message"=>trans("admin.undefinedRecord")
            	 ]);
            	}

                 return successResponseJson([
              "data"=> $Machine
              ]);  ;
            }


            /**
             * Baboon Api Script By [it v 1.6.40]
             * update a newly created resource in storage.
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
            	$Machine = Machine::find($id);
            	if(is_null($Machine) || empty($Machine)){
            	 return errorResponseJson([
            	  "message"=>trans("admin.undefinedRecord")
            	 ]);
  			       }

            	$data = $this->updateFillableColumns();
                 
              $data["user_id"] = auth()->id(); 
               if(request()->hasFile("photo")){
              it()->delete($Machine->photo);
              $data["photo"] = it()->upload("photo","machines/".$Machine->id);
               }
              Machine::where("id",$id)->update($data);

              $Machine = Machine::with($this->arrWith())->find($id,$this->selectColumns);
              return successResponseJson([
               "message"=>trans("admin.updated"),
               "data"=> $Machine
               ]);
            }

            /**
             * Baboon Api Script By [it v 1.6.40]
             * destroy a newly created resource in storage.
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {
               $machines = Machine::find($id);
            	if(is_null($machines) || empty($machines)){
            	 return errorResponseJson([
            	  "message"=>trans("admin.undefinedRecord")
            	 ]);
            	}


              if(!empty($machines->photo)){
               it()->delete($machines->photo);
              }
               it()->delete("machine",$id);

               $machines->delete();
               return successResponseJson([
                "message"=>trans("admin.deleted")
               ]);
            }



 			public function multi_delete()
            {
                $data = request("selected_data");
                if(is_array($data)){
                    foreach($data as $id){
                    $machines = Machine::find($id);
	            	if(is_null($machines) || empty($machines)){
	            	 return errorResponseJson([
	            	  "message"=>trans("admin.undefinedRecord")
	            	 ]);
	            	}

                    	if(!empty($machines->photo)){
                    	it()->delete($machines->photo);
                    	}
                    	it()->delete("machine",$id);
                    	$machines->delete();
                    }
                    return successResponseJson([
                     "message"=>trans("admin.deleted")
                    ]);
                }else {
                    $machines = Machine::find($data);
	            	if(is_null($machines) || empty($machines)){
	            	 return errorResponseJson([
	            	  "message"=>trans("admin.undefinedRecord")
	            	 ]);
	            	}
 
                    	if(!empty($machines->photo)){
                    	it()->delete($machines->photo);
                    	}
                    	it()->delete("machine",$data);

                    $machines->delete();
                    return successResponseJson([
                     "message"=>trans("admin.deleted")
                    ]);
                }
            }

            
}