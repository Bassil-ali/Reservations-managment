@extends('admin.index')
@section('content')


<div class="card card-dark">
	<div class="card-header">
		<h3 class="card-title">
		<div class="">
			<span>{{!empty($title)?$title:''}}</span>
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			<span class="caret"></span>
			<span class="sr-only"></span>
			</a>
			<div class="dropdown-menu" role="menu">
				<a href="{{aurl('clients')}}" class="dropdown-item" style="color:#343a40">
				<i class="fas fa-list"></i> {{trans('admin.show_all')}} </a>
				<a href="{{aurl('clients/'.$clients->id)}}" class="dropdown-item" style="color:#343a40">
				<i class="fa fa-eye"></i> {{trans('admin.show')}} </a>
				<a class="dropdown-item" style="color:#343a40" href="{{aurl('clients/create')}}">
					<i class="fa fa-plus"></i> {{trans('admin.create')}}
				</a>
				<div class="dropdown-divider"></div>
				<a data-toggle="modal" data-target="#deleteRecord{{$clients->id}}" class="dropdown-item" style="color:#343a40" href="#">
					<i class="fa fa-trash"></i> {{trans('admin.delete')}}
				</a>
			</div>
		</div>
		</h3>
		@push('js')
		<div class="modal fade" id="deleteRecord{{$clients->id}}">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">{{trans('admin.delete')}}</h4>
						<button class="close" data-dismiss="modal">x</button>
					</div>
					<div class="modal-body">
						<i class="fa fa-exclamation-triangle"></i>   {{trans('admin.ask_del')}} {{trans('admin.id')}}  ({{$clients->id}})
					</div>
					<div class="modal-footer">
						{!! Form::open([
						'method' => 'DELETE',
						'route' => ['clients.destroy', $clients->id]
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
										
{!! Form::open(['url'=>aurl('/clients/'.$clients->id),'method'=>'put','id'=>'clients','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}
<div class="row">

<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
    <div class="form-group">
        {!! Form::label('first_name',trans('admin.first_name'),['class'=>'control-label']) !!}
        {!! Form::text('first_name', $clients->first_name ,['class'=>'form-control','placeholder'=>trans('admin.first_name')]) !!}
    </div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
    <div class="form-group">
        {!! Form::label('second_name',trans('admin.second_name'),['class'=>'control-label']) !!}
        {!! Form::text('second_name', $clients->second_name ,['class'=>'form-control','placeholder'=>trans('admin.second_name')]) !!}
    </div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
		<div class="form-group">
				{!! Form::label('grade_id',trans('admin.grade_id'),['class'=>'control-label']) !!}
{!! Form::select('grade_id',App\Models\Grade::pluck('grade_name','id'), $clients->grade_id ,['class'=>'form-control select2','placeholder'=>trans('admin.grade_id')]) !!}
		</div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
		<div class="form-group">
				{!! Form::label('type_id',trans('admin.type_id'),['class'=>'control-label']) !!}
{!! Form::select('type_id',App\Models\Type::pluck('name','id'), $clients->type_id ,['class'=>'form-control select2','placeholder'=>trans('admin.type_id')]) !!}
		</div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
    <div class="form-group">
        {!! Form::label('Passowrd',trans('admin.Passowrd'),['class'=>'control-label']) !!}
            {!! Form::password('Passowrd',['class'=>'form-control','placeholder'=>trans('admin.Passowrd')]) !!}
    </div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
    <div class="form-group">
        {!! Form::label('username',trans('admin.username'),['class'=>'control-label']) !!}
        {!! Form::text('username', $clients->username ,['class'=>'form-control','placeholder'=>trans('admin.username')]) !!}
    </div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
		<div class="form-group">
				{!! Form::label('direction_id',trans('admin.direction_id'),['class'=>'control-label']) !!}
{!! Form::select('direction_id',App\Models\Direction::pluck('name','id'), $clients->direction_id ,['class'=>'form-control select2','placeholder'=>trans('admin.direction_id')]) !!}
		</div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
		<div class="form-group">
				{!! Form::label('active',trans('admin.active'),['class'=>'control-label']) !!}
{!! Form::select('active',['stoped'=>trans('admin.stoped'),'activate'=>trans('admin.activate'),'hanging'=>trans('admin.hanging'),], $clients->active ,['class'=>'form-control select2','placeholder'=>trans('admin.active')]) !!}
		</div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 photo">
    <div class="row">
        <div class="col-md-9">
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
        <div class="col-md-2" style="padding-top: 30px;">
            @include("admin.show_image",["image"=>$clients->photo])
        </div>
    </div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
    <div class="form-group">
        {!! Form::label('email',trans('admin.email'),['class'=>'control-label']) !!}
            {!! Form::email('email', $clients->email ,['class'=>'form-control','placeholder'=>trans('admin.email')]) !!}
    </div>
</div>

</div>
		<!-- /.row -->
		</div>
	<!-- /.card-body -->
	<div class="card-footer"><button type="submit" name="save" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> {{ trans('admin.save') }}</button>
<button type="submit" name="save_back" class="btn btn-success btn-flat"><i class="fa fa-save"></i> {{ trans('admin.save_back') }}</button>
{!! Form::close() !!}
</div>
</div>
@endsection