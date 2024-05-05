<?php
namespace App\DataTables;
use App\Models\BookMachine;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Services\DataTable;
// Auto DataTable By Baboon Script
// Baboon Maker has been Created And Developed By [it v 1.6.40]
// Copyright Reserved [it v 1.6.40]
class BookMachinesDataTable extends DataTable
{
    	

     /**
     * dataTable to render Columns.
     * Auto Ajax Method By Baboon Script [it v 1.6.40]
     * @return \Illuminate\Http\JsonResponse
     */
    public function dataTable(DataTables $dataTables, $query)
    {
        return datatables($query)
            ->addColumn('actions', 'admin.bookmachines.buttons.actions')

            ->addColumn('answer', '{{ trans("admin.".$answer) }}')

   		->addColumn('created_at', '{{ date("Y-m-d H:i:s",strtotime($created_at)) }}')   		->addColumn('updated_at', '{{ date("Y-m-d H:i:s",strtotime($updated_at)) }}')            ->addColumn('checkbox', '<div  class="icheck-danger">
                  <input type="checkbox" class="selected_data" name="selected_data[]" id="selectdata{{ $id }}" value="{{ $id }}" >
                  <label for="selectdata{{ $id }}"></label>
                </div>')
            ->rawColumns(['checkbox','actions',]);
    }
  

     /**
     * Get the query object to be processed by dataTables.
     * Auto Ajax Method By Baboon Script [it v 1.6.40]
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
	public function query()
    {
		if(auth()->guard('client')->check()){
        return BookMachine::query()->where('client_id',auth()->guard('client')->user()->id)->with(['client_id','machine_id',])->select("book_machines.*");
		}else{
		return BookMachine::query()->with(['client_id','machine_id',])->select("book_machines.*");
		}
         
    }
    	

    	 /**
	     * Optional method if you want to use html builder.
	     *[it v 1.6.40]
	     * @return \Yajra\Datatables\Html\Builder
	     */
    	public function html()
{
    $buttons = [
        [
            'extend' => 'print',
            'className' => 'btn btn-outline',
            'text' => '<i class="fa fa-print"></i> '.trans('admin.print')
        ],
        [
            'extend' => 'excel',
            'className' => 'btn btn-outline',
            'text' => '<i class="fa fa-file-excel"> </i> '.trans('admin.export_excel')
        ],
        [
            'extend' => 'csv',
            'className' => 'btn btn-outline',
            'text' => '<i class="fa fa-file-excel"> </i> '.trans('admin.export_csv')
        ],
        [
            'extend' => 'pdf',
            'className' => 'btn btn-outline',
            'text' => '<i class="fa fa-file-pdf"> </i> '.trans('admin.export_pdf')
        ]
    ];

    if (!auth()->guard('client')->check()) {
        $buttons[] = [
			[
				'text' => '<i class="fa fa-trash"></i> '.trans('admin.delete'),
				'className'    => 'btn btn-outline deleteBtn',
			],
			[
            'text' => '<i class="fa fa-plus"></i> '.trans('admin.add'),
            'className' => 'btn btn-primary',
            'action' => 'function(){
                window.location.href =  "'.\URL::current().'/create";
            }',]
        ];
    }

    $parameters = [
        'searching' => true,
        'paging' => true,
        'bLengthChange' => true,
        'bInfo' => true,
        'responsive' => true,
        'dom' => 'Blfrtip',
        "lengthMenu" => [[10, 25, 50,100, -1], [10, 25, 50,100, trans('admin.all_records')]],
        'buttons' => $buttons,
        'initComplete' => "function () {
            ". filterElement('1,4,1,6', 'input') . "
            ". filterElement('2', 'select', \App\Models\Client::pluck('first_name','first_name')) . "
            ". filterElement('3', 'select', \App\Models\Machine::pluck('name','name')) . "
            ". filterElement('5', 'select', [
                'Yes' => trans('admin.Yes'),
                'No' => trans('admin.No'),
            ]) . "
        }",
        'order' => [[1, 'desc']],
        'language' => [
            'sProcessing' => trans('admin.sProcessing'),
            'sLengthMenu' => trans('admin.sLengthMenu'),
            'sZeroRecords' => trans('admin.sZeroRecords'),
            'sEmptyTable' => trans('admin.sEmptyTable'),
            'sInfo' => trans('admin.sInfo'),
            'sInfoEmpty' => trans('admin.sInfoEmpty'),
            'sInfoFiltered' => trans('admin.sInfoFiltered'),
            'sInfoPostFix' => trans('admin.sInfoPostFix'),
            'sSearch' => trans('admin.sSearch'),
            'sUrl' => trans('admin.sUrl'),
            'sInfoThousands' => trans('admin.sInfoThousands'),
            'sLoadingRecords' => trans('admin.sLoadingRecords'),
            'oPaginate' => [
                'sFirst' => trans('admin.sFirst'),
                'sLast' => trans('admin.sLast'),
                'sNext' => trans('admin.sNext'),
                'sPrevious' => trans('admin.sPrevious'),
            ],
            'oAria' => [
                'sSortAscending' => trans('admin.sSortAscending'),
                'sSortDescending' => trans('admin.sSortDescending'),
            ],
        ]
    ];

    $html = $this->builder()
        ->columns($this->getColumns())
        ->parameters($parameters);

    return $html;
}


    	

    	/**
	     * Get columns.
	     * Auto getColumns Method By Baboon Script [it v 1.6.40]
	     * @return array
	     */

	    protected function getColumns()
	    {

	       $columns = [

	       	
 [
                'name' => 'checkbox',
                'data' => 'checkbox',
                'title' => '<div  class="icheck-danger">
                  <input type="checkbox" class="select-all" id="select-all"  onclick="select_all()" >
                  <label for="select-all"></label>
                </div>',
                'orderable'      => false,
                'searchable'     => false,
                'exportable'     => false,
                'printable'      => false,
                'width'          => '10px',
                'aaSorting'      => 'none'
            ],
			[
				'name'=>'Document_number',
				'data'=>'Document_number',
				'title'=>trans('admin.Document_number'),
		   ],
			// 	[
                    
            //      'name'=>'client_id.first_name',
            //      'data'=>'client_id.first_name',
            //      'title'=>trans('admin.client_id'),
		    // ],
				[
                 'name'=>'machine_id.name',
                 'data'=>'machine_id.name',
                 'title'=>trans('admin.machine_id'),
		    ],
				[
                 'name'=>'question_1',
                 'data'=>'question_1',
                 'title'=>trans('admin.question_1'),
		    ],
				[
                 'name'=>'book_machines.answer',
                 'data'=>'answer',
                 'title'=>trans('admin.answer'),
		    ],
				
            [
	                'name' => 'actions',
	                'data' => 'actions',
	                'title' => trans('admin.actions'),
	                'exportable' => false,
	                'printable'  => false,
	                'searchable' => false,
	                'orderable'  => false,
					
	            ],
    	 ];
         // Check if the client is authenticated
    if (!auth()->guard('client')->check()) {
        // Include the client name column if the client is not logged in
        $columns[0] = [
            'name'=>'client_id.first_name',
            'data'=>'client_id.first_name',
            'title'=>trans('admin.client_id'),
        ];
    }
    return $columns;
			}

	    /**
	     * Get filename for export.
	     * Auto filename Method By Baboon Script
	     * @return string
	     */
	    protected function filename()
	    {
	        return 'bookmachines_' . time();
	    }
    	
}