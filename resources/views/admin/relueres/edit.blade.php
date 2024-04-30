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
				<a href="{{aurl('relueres')}}" class="dropdown-item" style="color:#343a40">
				<i class="fas fa-list"></i> {{trans('admin.show_all')}} </a>
				<a href="{{aurl('relueres/'.$relueres->id)}}" class="dropdown-item" style="color:#343a40">
				<i class="fa fa-eye"></i> {{trans('admin.show')}} </a>
				<a class="dropdown-item" style="color:#343a40" href="{{aurl('relueres/create')}}">
					<i class="fa fa-plus"></i> {{trans('admin.create')}}
				</a>
				<div class="dropdown-divider"></div>
				<a data-toggle="modal" data-target="#deleteRecord{{$relueres->id}}" class="dropdown-item" style="color:#343a40" href="#">
					<i class="fa fa-trash"></i> {{trans('admin.delete')}}
				</a>
			</div>
		</div>
		</h3>
		@push('js')
		<div class="modal fade" id="deleteRecord{{$relueres->id}}">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">{{trans('admin.delete')}}</h4>
						<button class="close" data-dismiss="modal">x</button>
					</div>
					<div class="modal-body">
						<i class="fa fa-exclamation-triangle"></i>   {{trans('admin.ask_del')}} {{trans('admin.id')}}  ({{$relueres->id}})
					</div>
					<div class="modal-footer">
						{!! Form::open([
						'method' => 'DELETE',
						'route' => ['relueres.destroy', $relueres->id]
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
										
{!! Form::open(['url'=>aurl('/relueres/'.$relueres->id),'method'=>'put','id'=>'relueres','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}
<div class="row">

	@if(auth()->guard('client')->check())
	<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 hidden">
			<div class="form-group">
					{!! Form::label('client_id',trans('admin.client_id'),['class'=>'control-label']) !!}
	{!! Form::select('client_id',App\Models\Client::pluck('first_name','second_name','id'), $relueres->client_id ,['class'=>'form-control select2','placeholder'=>trans('admin.client_id')]) !!}
			</div>
	</div>
	@else
	<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 ">
		<div class="form-group">
				{!! Form::label('client_id',trans('admin.client_id'),['class'=>'control-label']) !!}
	{!! Form::select('client_id',App\Models\Client::pluck('first_name','second_name','id'), $relueres->client_id ,['class'=>'form-control select2','placeholder'=>trans('admin.client_id')]) !!}
		</div>
	</div>
	@endif
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
	<div class="form-group">
			{!! Form::label('machine_id',trans('admin.machine_id'),['class'=>'control-label']) !!}
{!! Form::select('machine_id',App\Models\Machine::pluck('name','id'), $relueres->machine_id ,['class'=>'form-control select2','placeholder'=>trans('admin.machine_id')]) !!}
	</div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
    <div class="form-group">
        {!! Form::label('code',trans('admin.code'),['class'=>'control-label']) !!}
        {!! Form::text('code', $relueres->code ,['class'=>'form-control','placeholder'=>trans('admin.code')]) !!}
    </div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
		<div class="form-group">
				{!! Form::label('format',trans('admin.format'),['class'=>'control-label']) !!}
{!! Form::select('format',['1'=>trans('admin.1'),'0'=>trans('admin.0'),], $relueres->format ,['class'=>'form-control select2','placeholder'=>trans('admin.format')]) !!}
		</div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
    <div class="form-group">
        {!! Form::label('poids',trans('admin.poids'),['class'=>'control-label']) !!}
        {!! Form::text('poids', $relueres->poids ,['class'=>'form-control','placeholder'=>trans('admin.poids')]) !!}
    </div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
		<div class="form-group">
				{!! Form::label('category_id',trans('admin.category_id'),['class'=>'control-label']) !!}
{!! Form::select('category_id',App\Models\Category::pluck('name','id'), $relueres->category_id ,['class'=>'form-control select2','placeholder'=>trans('admin.category_id')]) !!}
		</div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
		<div class="form-group">
				{!! Form::label('decesion_id',trans('admin.decesion_id'),['class'=>'control-label']) !!}
{!! Form::select('decesion_id',App\Models\Decesion::pluck('name','id'), $relueres->decesion_id ,['class'=>'form-control select2','placeholder'=>trans('admin.decesion_id')]) !!}
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
            {!! Form::text('date', $relueres->date ,['class'=>'form-control float-right date_time_picker','placeholder'=>trans('admin.date'),'readonly'=>'readonly']) !!}
        </div>
        <!-- /.input group -->
    </div>
    <!-- /.form group -->
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
    <div class="form-group">
        {!! Form::label('equipe',trans('admin.equipe'),['class'=>'control-label']) !!}
        {!! Form::text('equipe', $relueres->equipe ,['class'=>'form-control','placeholder'=>trans('admin.equipe')]) !!}
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