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
				<a href="{{ aurl('relueres') }}"  style="color:#343a40"  class="dropdown-item">
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
								
{!! Form::open(['url'=>aurl('/relueres'),'id'=>'relueres','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}
<div class="row">

	@if (auth()->guard('client')->check())
	<<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 hidden">
		<div class="form-group">
			{!! Form::label('client_id',trans('admin.client_id')) !!}
			{!! Form::text('client_id',auth()->guard('client')->user()->id,old('client_id'),['class'=>'form-controlt','placeholder'=>trans('admin.choose')]) !!}
		</div>
	</div>
	@else
	<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::label('client_id',trans('admin.client_id')) !!}
			{!! Form::select('client_id',App\Models\Client::pluck('first_name','second_name','id'),old('client_id'),['class'=>'form-control select2','placeholder'=>trans('admin.choose')]) !!}
		</div>
	</div>
	@endif
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
	<div class="form-group">
		{!! Form::label('machine_id',trans('admin.machine_id')) !!}
		{!! Form::select('machine_id',App\Models\Machine::pluck('name','id'),old('machine_id'),['class'=>'form-control select2','placeholder'=>trans('admin.choose')]) !!}
	</div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
    <div class="form-group">
        {!! Form::label('code',trans('admin.code'),['class'=>' control-label']) !!}
            {!! Form::text('code',old('code'),['class'=>'form-control','placeholder'=>trans('admin.code')]) !!}
    </div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
	<div class="form-group">
		{!! Form::label('format',trans('admin.format')) !!}
		{!! Form::select('format',['1'=>trans('admin.1'),'0'=>trans('admin.0'),],old('format'),['class'=>'form-control select2','placeholder'=>trans('admin.choose')]) !!}
	</div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
    <div class="form-group">
        {!! Form::label('poids',trans('admin.poids'),['class'=>' control-label']) !!}
            {!! Form::text('poids',old('poids'),['class'=>'form-control','placeholder'=>trans('admin.poids')]) !!}
    </div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
	<div class="form-group">
		{!! Form::label('category_id',trans('admin.category_id')) !!}
		{!! Form::select('category_id',App\Models\Category::pluck('name','id'),old('category_id'),['class'=>'form-control select2','placeholder'=>trans('admin.choose')]) !!}
	</div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
	<div class="form-group">
		{!! Form::label('decesion_id',trans('admin.decesion_id')) !!}
		{!! Form::select('decesion_id',App\Models\Decesion::pluck('name','id'),old('decesion_id'),['class'=>'form-control select2','placeholder'=>trans('admin.choose')]) !!}
	</div>
</div>

<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
    <!-- Date range -->
    <div class="form-group">
        {!! Form::label('date',trans('admin.date')) !!}
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="far fa-calendar-alt"></i>
                </span>
            </div>
            {!! Form::text('date',old('date'),['class'=>'form-control float-right date_time_picker','placeholder'=>trans('admin.date'),'readonly'=>'readonly']) !!}
        </div>
        <!-- /.input group -->
    </div>
    <!-- /.form group -->
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
    <div class="form-group">
        {!! Form::label('equipe',trans('admin.equipe'),['class'=>' control-label']) !!}
            {!! Form::text('equipe',old('equipe'),['class'=>'form-control','placeholder'=>trans('admin.equipe')]) !!}
    </div>
</div>

</div>
		<!-- /.row -->
	</div>
	<!-- /.card-body -->
	<div class="card-footer"><button type="submit" name="add" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> {{ trans('admin.add') }}</button>
<button type="submit" name="add_back" class="btn btn-success btn-flat"><i class="fa fa-plus"></i> {{ trans('admin.add_back') }}</button>
{!! Form::close() !!}	</div>
</div>
@endsection