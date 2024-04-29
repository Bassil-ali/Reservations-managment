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
				<a href="{{ aurl('offsets') }}"  style="color:#343a40"  class="dropdown-item">
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
								
{!! Form::open(['url'=>aurl('/offsets'),'id'=>'offsets','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}
<div class="row">

<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
	<div class="form-group">
		{!! Form::label('client_id',trans('admin.client_id')) !!}
		{!! Form::select('client_id',App\Models\Client::pluck('first_name','id'),old('client_id'),['class'=>'form-control select2','placeholder'=>trans('admin.choose')]) !!}
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
        {!! Form::label('cahier_number',trans('admin.cahier_number'),['class'=>' control-label']) !!}
            {!! Form::text('cahier_number',old('cahier_number'),['class'=>'form-control','placeholder'=>trans('admin.cahier_number')]) !!}
    </div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
    <div class="form-group">
        {!! Form::label('grammage',trans('admin.grammage'),['class'=>' control-label']) !!}
            {!! Form::text('grammage',old('grammage'),['class'=>'form-control','placeholder'=>trans('admin.grammage')]) !!}
    </div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
    <div class="form-group">
        {!! Form::label('format',trans('admin.format'),['class'=>' control-label']) !!}
            {!! Form::text('format',old('format'),['class'=>'form-control','placeholder'=>trans('admin.format')]) !!}
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
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
    <div class="form-group">
        {!! Form::label('visa',trans('admin.visa'),['class'=>' control-label']) !!}
            {!! Form::text('visa',old('visa'),['class'=>'form-control','placeholder'=>trans('admin.visa')]) !!}
    </div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
	<div class="form-group">
		{!! Form::label('machine_id',trans('admin.machine_id')) !!}
		{!! Form::select('machine_id',App\Models\Machine::pluck('name','id'),old('machine_id'),['class'=>'form-control select2','placeholder'=>trans('admin.choose')]) !!}
	</div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
	<div class="form-group">
		{!! Form::label('decision_id',trans('admin.decision_id')) !!}
		{!! Form::select('decision_id',App\Models\Decesion::pluck('name','id'),old('decision_id'),['class'=>'form-control select2','placeholder'=>trans('admin.choose')]) !!}
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