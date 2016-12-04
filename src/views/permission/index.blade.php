@extends('dp::app')

@section ('contentheader_title')
{{ trans('deeppermission.header.title') }}
@endsection

@section ('sidebox_permission')
active
@endsection

@section ('sidebar_permission')
active
@endsection

@section('main-content')
<div class="row">
	@include("libressltd.deeppermission.sidebox")
	<div class="col-md-6">
		<div class="box box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">{{ trans('deeppermission.permission.title') }}</h3>
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
		                	<th>{{ trans('deeppermission.permission.name') }}</th>
		                	<th>{{ trans('deeppermission.permission.code') }}</th>
		                	<th>{{ trans('deeppermission.permission.group_permission') }}</th>
		                	<th>{{ trans('deeppermission.general.action') }}</th>
		                </tr>
	                </thead>
	                <tbody>
	                <?php
	                	$permissions = App\Models\Permission::paginate(30);
	                ?>
	                	@foreach ($permissions as $permission)
		                <tr>
		                	<td>{{ $permission->id }}.</td>
		                	<td>{{ $permission->name }}</td>
		                	<td>{{ $permission->code }}</td>
		                	<td>{{ @$permission->group->name }}</td>
		                	<td>
		                		@if (Auth::user()->hasPermission("permission.edit"))
		                		<a class="btn btn-sm btn-primary" href="{{ url("/permission/$permission->id/edit") }}"><i class="fa fa-edit"></i></a>
		                		@endif
		                		@if (Auth::user()->hasPermission("permission.delete"))
		                		{!! Form::lbButton("/permission/$permission->id", "delete", "<i class=\"fa fa-trash\"></i>", array(
		                			"class" => "btn btn-sm btn-danger",
		                			"onclick" => "return confirm(\"".trans('deeppermission.general.are_you_sure')."\")"
		                		)) !!}
		                		@endif
		                	</td>
		                </tr>
		                @endforeach
	                </tbody>
                </table>
                {{ $permissions->links() }}
            </div>
            @if (Auth::user()->hasPermission("permission.add"))
            <div class="box-footer">
            	<a href="{{ url("permission/create") }}" class="btn btn-primary">{{ trans('deeppermission.permission.add') }}</a>
            </div>
            @endif
		</div>
	</div>
	@if (Auth::user()->hasPermission("permission.add"))
	<div class="col-md-3">
		<div class="box box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">{{ trans('deeppermission.general.quickadd') }}</h3>
			</div>
			<div class="box-body">
				{!! Form::lbAlert() !!}
				{!! Form::open(array("url" => "permission", "method" => "post")) !!}
				{!! Form::lbText("name", "", trans('deeppermission.permission.name'), trans('deeppermission.permission.name_hint'), null, config("deeppermission.CNF_REQUIRE_ANUM")) !!}
				{!! Form::lbText("code", "", trans('deeppermission.permission.code'), trans('deeppermission.permission.code_hint'), trans('deeppermission.permission.code_note'), config("deeppermission.CNF_REQUIRE_ANUM_AND_POINT")) !!}
				{!! Form::lbSelect2("permission_group_id", "0", App\Models\Permission_group::all_to_option(), trans('deeppermission.permission.group_permission')) !!}
				{!! Form::lbSubmit() !!}
				{!! Form::close() !!}
            </div>
		</div>
	</div>
	@endif
</div>
@endsection