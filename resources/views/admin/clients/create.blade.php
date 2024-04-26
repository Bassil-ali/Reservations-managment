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
				<a href="{{ aurl('clients') }}"  style="color:#343a40"  class="dropdown-item">
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
								
{!! Form::open(['url'=>aurl('/clients'),'id'=>'clients','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}
<div class="row">

<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
    <div class="form-group">
        {!! Form::label('first_name',trans('admin.first_name'),['class'=>' control-label']) !!}
            {!! Form::text('first_name',old('first_name'),['class'=>'form-control','placeholder'=>trans('admin.first_name')]) !!}
    </div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
    <div class="form-group">
        {!! Form::label('second_name',trans('admin.second_name'),['class'=>' control-label']) !!}
            {!! Form::text('second_name',old('second_name'),['class'=>'form-control','placeholder'=>trans('admin.second_name')]) !!}
    </div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
    <div class="form-group">
        {!! Form::label('grade',trans('admin.grade'),['class'=>' control-label']) !!}
            {!! Form::text('grade',old('grade'),['class'=>'form-control','placeholder'=>trans('admin.grade')]) !!}
    </div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
    <div class="form-group">
        {!! Form::label('type',trans('admin.type'),['class'=>' control-label']) !!}
            {!! Form::text('type',old('type'),['class'=>'form-control','placeholder'=>trans('admin.type')]) !!}
    </div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
    <div class="form-group">
        {!! Form::label('Passowrd',trans('admin.Passowrd')) !!}
            {!! Form::password('Passowrd',['class'=>'form-control','placeholder'=>trans('admin.Passowrd')]) !!}
    </div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
    <div class="form-group">
        {!! Form::label('username',trans('admin.username'),['class'=>' control-label']) !!}
            {!! Form::text('username',old('username'),['class'=>'form-control','placeholder'=>trans('admin.username')]) !!}
    </div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
    <div class="form-group">
        {!! Form::label('direction',trans('admin.direction'),['class'=>' control-label']) !!}
            {!! Form::text('direction',old('direction'),['class'=>'form-control','placeholder'=>trans('admin.direction')]) !!}
    </div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <div class="custom-control custom-switch">
            {!! Form::checkbox("active","1",old("active"),["class"=>"custom-control-input","placeholder"=>trans("admin.1"),"id"=>"active"]) !!}
            {!! Form::label("active",trans("admin.1"),["class"=>"custom-control-label"]) !!}
        </div>
    </div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 photo">
    <div class="form-group">
        <label for="'photo'">{{ trans('admin.photo') }}</label>
        <div class="input-group">
            <div class="custom-file">
                {!! Form::file('photo',['class'=>'custom-file-input','placeholder'=>trans('admin.photo'),"accept"=>it()->acceptedMimeTypes("image"),"id"=>"photo"]) !!}
                {!! Form::label('photo',trans('admin.photo'),['class'=>'custom-file-label']) !!}
            </div>
            <div class="input-group-append">
                <span class="input-group-text" id="">{{ trans('admin.upload') }}</span>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
    <div class="form-group">
        {!! Form::label('email',trans('admin.email'),['class'=>'control-label']) !!}
            {!! Form::email('email',old('email'),['class'=>'form-control','placeholder'=>trans('admin.email')]) !!}
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