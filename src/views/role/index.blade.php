@extends('dp::app')

@section ('contentheader_title')
{{ trans('deeppermission.header.title') }}
@endsection

@section ('sidebox_role')
active
@endsection

@section ('sidebar_permission')
active
@endsection

@section('main-content')
<div class="row">
	@include("dp::sidebox")
	<div class="col-md-6">
		<div class="box box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">{{ trans('deeppermission.role.title') }}</h3>
			</div>
			<div class="box-body" style="overflow-x: auto;">
				@if (session('dp_announce'))
				<div class="callout callout-success">
					<p>{{ session('dp_announce') }}</p>
				</div>
				@endif
				<table class="table table-bordered table-hover">
					<thead>
		                <tr>
		                	<th>#</th>
		                	<th>{{ trans('deeppermission.role.name') }}</th>
		                	<th>{{ trans('deeppermission.role.code') }}</th>
		                	<th>{{ trans('deeppermission.general.action') }}</th>
		                </tr>
	                </thead>
	                <tbody>
	                <?php
	                	$roles = App\Models\Role::paginate(30);
	                ?>
	                	@foreach ($roles as $role)
		                <tr>
		                	<td>{{ $role->id }}.</td>
		                	<td>{{ $role->name }}</td>
		                	<td>{{ $role->code }}</td>
		                	<td>
		                		@if (Auth::user()->hasPermission("role.edit"))
		                		<a class="btn btn-sm btn-primary" href="{{ url("/role/$role->id/edit") }}"><i class="fa fa-edit"></i></a>
		                		<a class="btn btn-sm btn-warning" href="{{ url("/role/$role->id/permission") }}"><i class="fa fa-key"></i></a>
		                		@endif
		                		
		                		@if (Auth::user()->hasPermission("role.delete"))
		                		{!! Form::lbButton("/role/$role->id", "delete", "<i class=\"fa fa-trash\"></i>", array(
		                			"class" => "btn btn-sm btn-danger",
		                			"onclick" => "return confirm(\"".trans('deeppermission.general.are_you_sure')."\")"
		                		)) !!}
		                		@endif
		                	</td>
		                </tr>
		                @endforeach
					</tbody>
				</table>
				{{ $roles->links() }}
			</div>
			@if (Auth::user()->hasPermission("role.add"))
            <div class="box-footer">
            	<a href="{{ url("role/create") }}" class="btn btn-primary">{{ trans('deeppermission.role.add') }}</a>
            </div>
            @endif
		</div>
	</div>
	@if (Auth::user()->hasPermission("role.add"))
	<div class="col-md-3">
		<div class="box box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">{{ trans('deeppermission.general.quickadd') }}</h3>
			</div>
			<div class="box-body">
				{!! Form::lbAlert() !!}
				{!! Form::open(array("url" => "role", "method" => "post")) !!}
				{!! Form::lbText("name", "", trans('deeppermission.role.name'), trans('deeppermission.role.name_hint'), null, config("deeppermission.CNF_REQUIRE_ANUM")) !!}
				{!! Form::lbText("code", "", trans('deeppermission.role.code'), trans('deeppermission.role.code_hint'), trans('deeppermission.role.code_note'), config("deeppermission.CNF_REQUIRE_ANUM_AND_POINT")) !!}
				{!! Form::lbSubmit() !!}
				{!! Form::close() !!}
            </div>
		</div>
	</div>
	@endif
</div>
@endsection