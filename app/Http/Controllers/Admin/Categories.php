<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\CategoriesDataTable;
use Carbon\Carbon;
use App\Models\Category;

use App\Http\Controllers\Validations\CategoriesRequest;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class Categories extends Controller
{

	public function __construct() {

		$this->middleware('AdminRole:categories_show', [
			'only' => ['index', 'show'],
		]);
		$this->middleware('AdminRole:categories_add', [
			'only' => ['create', 'store'],
		]);
		$this->middleware('AdminRole:categories_edit', [
			'only' => ['edit', 'update'],
		]);
		$this->middleware('AdminRole:categories_delete', [
			'only' => ['destroy', 'multi_delete'],
		]);
	}

	

            /**
             * Baboon Script By [it v 1.6.40]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(CategoriesDataTable $categories)
            {
               return $categories->render('admin.categories.index',['title'=>trans('admin.categories')]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
            	
               return view('admin.categories.create',['title'=>trans('admin.create')]);
            }

            /**
             * Baboon Script By [it v 1.6.40]
             * Store a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response Or Redirect
             */
            public function store(CategoriesRequest $request)
            {
                $data = $request->except("_token", "_method");
            			  		$categories = Category::create($data); 
                $redirect = isset($request["add_back"])?"/create":"";
                return redirectWithSuccess(aurl('categories'.$redirect), trans('admin.added')); }

            /**
             * Display the specified resource.
             * Baboon Script By [it v 1.6.40]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
        		$categories =  Category::find($id);
        		return is_null($categories) || empty($categories)?
        		backWithError(trans("admin.undefinedRecord"),aurl("categories")) :
        		view('admin.categories.show',[
				    'title'=>trans('admin.show'),
					'categories'=>$categories
        		]);
            }


            /**
             * Baboon Script By [it v 1.6.40]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
        		$categories =  Category::find($id);
        		return is_null($categories) || empty($categories)?
        		backWithError(trans("admin.undefinedRecord"),aurl("categories")) :
        		view('admin.categories.edit',[
				  'title'=>trans('admin.edit'),
				  'categories'=>$categories
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
				foreach (array_keys((new CategoriesRequest)->attributes()) as $fillableUpdate) {
					if (!is_null(request($fillableUpdate))) {
						$fillableCols[$fillableUpdate] = request($fillableUpdate);
					}
				}
				return $fillableCols;
			}

            public function update(CategoriesRequest $request,$id)
            {
              // Check Record Exists
              $categories =  Category::find($id);
              if(is_null($categories) || empty($categories)){
              	return backWithError(trans("admin.undefinedRecord"),aurl("categories"));
              }
              $data = $this->updateFillableColumns(); 
              Category::where('id',$id)->update($data);
              $redirect = isset($request["save_back"])?"/".$id."/edit":"";
              return redirectWithSuccess(aurl('categories'.$redirect), trans('admin.updated'));
            }

            /**
             * Baboon Script By [it v 1.6.40]
             * destroy a newly created resource in storage.
             * @param  $id
             * @return \Illuminate\Http\Response
             */
	public function destroy($id){
		$categories = Category::find($id);
		if(is_null($categories) || empty($categories)){
			return backWithSuccess(trans('admin.undefinedRecord'),aurl("categories"));
		}
               
		it()->delete('category',$id);
		$categories->delete();
		return redirectWithSuccess(aurl("categories"),trans('admin.deleted'));
	}


	public function multi_delete(){
		$data = request('selected_data');
		if(is_array($data)){
			foreach($data as $id){
				$categories = Category::find($id);
				if(is_null($categories) || empty($categories)){
					return backWithError(trans('admin.undefinedRecord'),aurl("categories"));
				}
                    	
				it()->delete('category',$id);
				$categories->delete();
			}
			return redirectWithSuccess(aurl("categories"),trans('admin.deleted'));
		}else {
			$categories = Category::find($data);
			if(is_null($categories) || empty($categories)){
				return backWithError(trans('admin.undefinedRecord'),aurl("categories"));
			}
                    
			it()->delete('category',$data);
			$categories->delete();
			return redirectWithSuccess(aurl("categories"),trans('admin.deleted'));
		}
	}
            

}