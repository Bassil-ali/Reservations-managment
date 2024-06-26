@extends('admin.index')
@section('content')


<div class="card card-dark">
	<div class="card-header">
		<h3 class="card-title">
		<div class="">
			<span>
			{{ !empty($title)?$title:'' }}
			</span>
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			<span class="caret"></span>
			<span class="sr-only"></span>
			</a>
			<div class="dropdown-menu" role="menu">
				<a href="{{ aurl('bookmachines') }}"  style="color:#343a40"  class="dropdown-item">
				<i class="fas fa-list"></i> {{ trans('admin.show_all') }}</a>
			</div>
		</div>
		</h3>
		<div class="card-tools">
			<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
			<button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
		</div>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
								
{!! Form::open(['url'=>aurl('/bookmachines'),'id'=>'bookmachines','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}
<div class="row">

	<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('Document_number',trans('admin.Document_number'),['class'=>' control-label']) !!}
				{!! Form::text('Document_number',old('Document_number'),['class'=>'form-control','placeholder'=>trans('admin.Document_number')]) !!}
		</div>
	</div>
@if(Session::get('client_id') == null)
<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
	<div class="form-group">
		{!! Form::label('client_id',trans('admin.client_id')) !!}
		{!! Form::select('client_id',App\Models\Client::pluck('first_name','id'),old('client_id'),['class'=>'form-control select2','placeholder'=>trans('admin.choose')]) !!}
	</div>
</div>
@endif
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
	<div class="form-group">
		{!! Form::label('machine_id',trans('admin.machine_id')) !!}
		{!! Form::select('machine_id',App\Models\Machine::pluck('name','id'),old('machine_id'),['class'=>'form-control select2','placeholder'=>trans('admin.choose')]) !!}
	</div>
</div>
<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
    <div class="form-group">
        {!! Form::label('question_1',trans('admin.question_1'),['class'=>' control-label']) !!}
            {!! Form::text('question_1',old('question_1'),['class'=>'form-control','placeholder'=>trans('admin.question_1')]) !!}
    </div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
	<div class="form-group">
		{!! Form::label('answer',trans('admin.answer')) !!}
		{!! Form::select('answer',['Yes'=>trans('admin.Yes'),'No'=>trans('admin.No'),'empty'=>trans('admin.empty'),],old('answer'),['class'=>'form-control select2','placeholder'=>trans('admin.choose')]) !!}
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
            {!! Form::text('date',old('date'),['class'=>'form-control float-right date_time_picker','placeholder'=>trans('admin.created_at'),'readonly'=>'readonly']) !!}
        </div>
        <!-- /.input group -->
    </div>
    <!-- /.form group -->
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
    <div class="form-group">
        {!! Form::label('team_number',trans('admin.team_number'),['class'=>' control-label']) !!}
            {!! Form::text('team_number',old('team_number'),['class'=>'form-control','placeholder'=>trans('admin.team_number')]) !!}
    </div>
</div>

</div>
		<!-- /.row -->
	</div>
	<!-- /.card-body -->
	<div class="card-footer"><button type="submit" name="add" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> {{ trans('admin.add') }}</button>
    <button type="submit" name="add_back" class="btn btn-success btn-flat"><i class="fa fa-plus"></i> {{ trans('admin.next_input') }}</button>
{!! Form::close() !!}	</div>
</div>
@endsection

