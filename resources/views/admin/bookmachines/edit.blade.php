@extends('admin.index')
@section('content')


<div class="card card-dark">
	<div class="card-header">
		<h3 class="card-title">
		<div class="">
			{{-- <span>{{!empty($title)?$title:''}}</span> --}}
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			<span class="caret"></span>
			<span class="sr-only"></span>
			</a>
			<div class="dropdown-menu" role="menu">
				<a href="{{aurl('bookmachines')}}" class="dropdown-item" style="color:#343a40">
				<i class="fas fa-list"></i> {{trans('admin.show_all')}} </a>
				<a href="{{aurl('bookmachines/'.$bookmachines->id)}}" class="dropdown-item" style="color:#343a40">
				<i class="fa fa-eye"></i> {{trans('admin.show')}} </a>
				<a class="dropdown-item" style="color:#343a40" href="{{aurl('bookmachines/create')}}">
					<i class="fa fa-plus"></i> {{trans('admin.create')}}
				</a>
				<div class="dropdown-divider"></div>
				<a data-toggle="modal" data-target="#deleteRecord{{$bookmachines->id}}" class="dropdown-item" style="color:#343a40" href="#">
					<i class="fa fa-trash"></i> {{trans('admin.delete')}}
				</a>
			</div>
		</div>
		</h3>
		@push('js')
		<div class="modal fade" id="deleteRecord{{$bookmachines->id}}">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">{{trans('admin.delete')}}</h4>
						<button class="close" data-dismiss="modal">x</button>
					</div>
					<div class="modal-body">
						<i class="fa fa-exclamation-triangle"></i>   {{trans('admin.ask_del')}} {{trans('admin.id')}}  ({{$bookmachines->id}})
					</div>
					<div class="modal-footer">
						{!! Form::open([
						'method' => 'DELETE',
						'route' => ['bookmachines.destroy', $bookmachines->id]
						]) !!}
						{!! Form::submit(trans('admin.approval'), ['class' => 'btn btn-danger btn-flat']) !!}
						<a class="btn btn-default btn-flat" data-dismiss="modal">{{trans('admin.cancel')}}</a>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
		@endpush
		<div class="card-tools">
			<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
			<button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
		</div>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
										
{!! Form::open(['url'=>aurl('/bookmachines/'.$bookmachines->id),'method'=>'put','id'=>'bookmachines','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}
<div class="row">

	<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('Document_number', trans('admin.Document_number'), ['class' => 'control-label']) !!}
			{!! Form::text('Document_number', $bookmachines->Document_number, ['class' => 'form-control', 'placeholder' => trans('admin.Document_number'),  auth()->guard('client')->check() ? 'readonly' : '']) !!}
		</div>
	</div>
	@if(!auth()->guard('client')->check())
	<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
		<div class="form-group">
			{!! Form::label('client_id', trans('admin.client_id'), ['class' => 'control-label']) !!}
			{!! Form::select('client_id', App\Models\Client::pluck('first_name', 'id'), $bookmachines->client_id, ['class' => 'form-control select2', 'placeholder' => trans('admin.client_id'),  auth()->guard('client')->check() ? 'disabled' : '']) !!}
		</div>
	</div>
	@endif
	<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('machine_id', trans('admin.machine_id'), ['class' => 'control-label']) !!}
			{!! Form::select('machine_id', App\Models\Machine::pluck('name', 'id'), $bookmachines->machine_id, ['class' => 'form-control select2', 'placeholder' => trans('admin.machine_id'),  auth()->guard('client')->check() ? 'disabled' : '']) !!}
		</div>
	</div>
	
	
	<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
		<!-- Date range -->
		<div class="form-group">
			{!! Form::label('date',trans('admin.created_at')) !!}
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="far fa-calendar-alt"></i>
					</span>
				</div>
				{!! Form::text('date', $bookmachines->date ,['class'=>'form-control float-right date_time_picker','placeholder'=>trans('admin.created_at'),auth()->guard('client')->check() ? 'readonly' : '']) !!}
			</div>
			<!-- /.input group -->
		</div>
		<!-- /.form group -->
	</div>
	<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('team_number',trans('admin.team_number'),['class'=>'control-label']) !!}
			{!! Form::text('team_number', $bookmachines->team_number ,['class'=>'form-control','placeholder'=>trans('admin.team_number'),auth()->guard('client')->check() ? 'readonly' : '']) !!}
		</div>
	</div>
	@foreach ($questions as $question)
	<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
		<div class="form-group">
			{!! Form::label('question_1', trans('admin.question_1'), ['class' => 'control-label']) !!}
			{!! Form::text('question_1[]', $question->question_1, ['class' => 'form-control', 'placeholder' => trans('admin.question_1'),  auth()->guard('client')->check() ? 'readonly' : '']) !!}
		</div>
	</div>

	<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
			<div class="form-group">
					{!! Form::label('answer[]',trans('admin.answer'),['class'=>'control-label']) !!}
	{!! Form::select('answer[]',['Yes'=>trans('admin.Yes'),'No'=>trans('admin.No'),'Empty'=>trans('admin.empty'),], $question->answer ,['class'=>'form-control select2','placeholder'=>trans('admin.answer_client'),$bookmachines->isAnswer ? 'disabled' : '',]) !!}
			</div>
	</div>
	@endforeach
	


</div>
		<!-- /.row -->
		</div>
	<!-- /.card-body -->
	<div class="card-footer"><button type="submit" name="save" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> {{ trans('admin.save') }}</button>
	{{-- @if(auth()->guard('client')->check())
    <button type="submit" name="save_back" class="btn btn-success btn-flat"><i class="fa fa-save"></i> {{ trans('admin.next_input') }}</bt>
    @endif --}}
{!! Form::close() !!}
</div>
</div>
@endsection


