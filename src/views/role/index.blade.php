@extends('layouts.app')

@section ('contentheader_title')
Role &amp; Permission Management
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
				<h3 class="box-title">Role Management</h3>
			</div>
			<div class="box-body">
				<table class="table table-bordered table-hover table-datatable" style="overflow-x: auto;">
					<thead>
		                <tr>
		                	<th>#</th>
		                	<th>Role</th>
		                	<th>Code</th>
		                	<th>Action</th>
		                </tr>
	                </thead>
	                <tbody>
	                	@foreach (App\Models\Role::all() as $role)
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
		                			"onclick" => "return confirm(\"Are you sure?\")"
		                		)) !!}
		                		@endif
		                	</td>
		                </tr>
		                @endforeach
					</tbody>
				</table>
			</div>
			@if (Auth::user()->hasPermission("role.add"))
            <div class="box-footer">
            	<a href="{{ url("role/create") }}" class="btn btn-primary">Add new Role</a>
            </div>
            @endif
		</div>
	</div>
	@if (Auth::user()->hasPermission("role.add"))
	<div class="col-md-3">
		<div class="box box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Add New Role</h3>
			</div>
			<div class="box-body">
				{!! Form::open(array("url" => "role", "method" => "post")) !!}
				{!! Form::lbText("name", "", "Name", "Role's name", null, config("lbform.CNF_REQUIRE_ANUM")) !!}
				{!! Form::lbText("code", "", "Code", "Role's code", "For developer only", config("lbform.CNF_REQUIRE_ANUM")) !!}
				{!! Form::lbSubmit() !!}
				{!! Form::close() !!}
            </div>
		</div>
	</div>
	@endif
</div>
@endsection