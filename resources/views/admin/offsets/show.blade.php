@extends('admin.index')
@section('content')
<div class="card card-dark">
	<div class="card-header">
		<h3 class="card-title">
		<div class="">
			<a>{{!empty($title)?$title:''}}</a>
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<span class="caret"></span>
				<span class="sr-only"></span>
			</a>
			<div class="dropdown-menu" role="menu">
				<a href="{{aurl('offsets')}}" class="dropdown-item"  style="color:#343a40">
				<i class="fas fa-list"></i> {{trans('admin.show_all')}}</a>
				<a class="dropdown-item"  style="color:#343a40" href="{{aurl('offsets/'.$offsets->id.'/edit')}}">
					<i class="fas fa-edit"></i> {{trans('admin.edit')}}
				</a>
				<a class="dropdown-item"  style="color:#343a40" href="{{aurl('offsets/create')}}">
					<i class="fas fa-plus"></i> {{trans('admin.create')}}
				</a>
				<div class="dropdown-divider"></div>
				<a data-toggle="modal" data-target="#deleteRecord{{$offsets->id}}" class="dropdown-item"  style="color:#343a40" href="#">
					<i class="fas fa-trash"></i> {{trans('admin.delete')}}
				</a>
			</div>
		</div>
		</h3>
		@push('js')
		<div class="modal fade" id="deleteRecord{{$offsets->id}}">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">{{trans('admin.delete')}}</h4>
						<button class="close" data-dismiss="modal">x</button>
					</div>
					<div class="modal-body">
						<i class="fa fa-exclamation-triangle"></i>  {{trans('admin.ask_del')}} {{trans('admin.id')}} ({{$offsets->id}})
					</div>
					<div class="modal-footer">
						{!! Form::open([
               'method' => 'DELETE',
               'route' => ['offsets.destroy', $offsets->id]
               ]) !!}
                {!! Form::submit(trans('admin.approval'), ['class' => 'btn btn-danger btn-flat']) !!}
						 <a class="btn btn-default" data-dismiss="modal">{{trans('admin.cancel')}}</a>
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
		<div class="row">
			<div class="col-md-12 col-lg-12 col-xs-12">
				<b>{{trans('admin.id')}} :</b> {{$offsets->id}}
			</div>
			<div class="clearfix"></div>
			<hr />
			@if(!empty($offsets->admin_id()->first()))
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
				<b>{{trans('admin.admin_id')}} :</b>
				{{ $offsets->admin_id()->first()->name }}
			</div>
			@endif
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<b>{{trans('admin.code')}} :</b>
				{!! $offsets->code !!}
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<b>{{trans('admin.cahier number')}} :</b>
				{!! $offsets->cahier number !!}
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<b>{{trans('admin.grammage')}} :</b>
				{!! $offsets->grammage !!}
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<b>{{trans('admin.format')}} :</b>
				{!! $offsets->format !!}
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<b>{{trans('admin.poids')}} :</b>
				{!! $offsets->poids !!}
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<b>{{trans('admin.date')}} :</b>
				{!! $offsets->date !!}
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<b>{{trans('admin.equipe')}} :</b>
				{!! $offsets->equipe !!}
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<b>{{trans('admin.visa')}} :</b>
				{!! $offsets->visa !!}
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<b>{{trans('admin.client_id')}} :</b>
				@if(!empty($offsets->client_id()->first()))
			{{ $offsets->client_id()->first()->first_name }}
			@endif
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<b>{{trans('admin.category_id')}} :</b>
				@if(!empty($offsets->category_id()->first()))
			{{ $offsets->category_id()->first()->name }}
			@endif
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<b>{{trans('admin.machine_id')}} :</b>
				@if(!empty($offsets->machine_id()->first()))
			{{ $offsets->machine_id()->first()->name }}
			@endif
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<b>{{trans('admin.decision_id')}} :</b>
				@if(!empty($offsets->decision_id()->first()))
			{{ $offsets->decision_id()->first()->name }}
			@endif
			</div>
			<!-- /.row -->
		</div>
	</div>
	<!-- /.card-body -->
	<div class="card-footer">
	</div>
</div>
@endsection