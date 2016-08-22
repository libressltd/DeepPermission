@extends('layouts.app')

@section ('contentheader_title')
Role &amp; Permission Management
@endsection

@section ('sidebox_permission')
active
@endsection

@section('main-content')
<div class="row">
	@include("dp::sidebox")
	<div class="col-md-6">
		<div class="box box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Permission group Management</h3>
			</div>
			<div class="box-body">
				<table class="table table-bordered table-hover">
					<thead>
		                <tr>
		                	<th>#</th>
		                	<th>Permission</th>
		                	<th>Code</th>
		                	<th>Group</th>
		                	<th>Action</th>
		                </tr>
	                </thead>
	                <tbody>
	                	@foreach (App\Models\Permission::all() as $permission)
		                <tr>
		                	<td>{{ $permission->id }}.</td>
		                	<td>{{ $permission->name }}</td>
		                	<td>{{ $permission->code }}</td>
		                	<td>{{ $permission->group->name }}</td>
		                	<td>
		                		<a class="btn btn-sm btn-primary" href="{{ url("/permission/$permission->id/edit") }}"><i class="fa fa-edit"></i></a>
		                		{!! Form::lbButton("/permission/$permission->id", "delete", "<i class=\"fa fa-trash\"></i>", array("class" => "btn btn-sm btn-danger")) !!}
		                	</td>
		                </tr>
		                @endforeach
	                </tbody>
                </table>
            </div>
            <div class="box-footer">
            	<a href="{{ url("permission/create") }}" class="btn btn-primary">Add new Permission</a>
            </div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="box box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Quick add</h3>
			</div>
			<div class="box-body">
				{!! Form::open(array("url" => "permission", "method" => "post")) !!}
				{!! Form::lbText("name", "", "Name", "Permission's name") !!}
				{!! Form::lbText("code", "", "Code", "Permission's code", "For developer only") !!}
				{!! Form::lbSelect2("permission_group_id", "0", App\Models\Permission_group::all_to_option(), "Group permission") !!}
				{!! Form::lbSubmit() !!}
				{!! Form::close() !!}
            </div>
		</div>
	</div>
</div>
@endsection