@extends('layouts.app')

@section ('contentheader_title')
Role &amp; Permission Management
@endsection

@section ('sidebox_permission_group')
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
		                	<th>Group</th>
		                	<th>Code</th>
		                	<th>Permission</th>
		                	<th>Action</th>
		                </tr>
	                </thead>
	                <tbody>
	                	@foreach (App\Models\Permission_group::with("permissions")->get() as $group)
		                <tr>
		                	<td>{{ $group->id }}.</td>
		                	<td>{{ $group->name }}</td>
		                	<td>{{ $group->code }}</td>
		                	<td>
		                		<?php
		                		$permission_array = array();
		                		foreach ($group->permissions as $permission)
								{
									$permission_array[] = $permission->code;
								}
								echo implode(", ", $permission_array);
		                		?>
		                	</td>
		                	<td>
		                		<a class="btn btn-sm btn-primary" href="{{ url("/permission_group/$group->id/edit") }}"><i class="fa fa-edit"></i></a>
		                		{!! Form::lbButton("/permission_group/$group->id", "delete", "<i class=\"fa fa-trash\"></i>", array(
		                			"class" => "btn btn-sm btn-danger",
		                			"onclick" => "return confirm(\"Are you sure?\")"
		                		)) !!}
		                	</td>
		                </tr>
		                @endforeach
	                </tbody>
                </table>
            </div>
            <div class="box-footer">
            	<a href="{{ url("permission_group/create") }}" class="btn btn-primary">Add new Permission Group</a>
            </div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="box box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Add New Permission Group</h3>
			</div>
			<div class="box-body">
				{!! Form::open(array("url" => "permission_group", "method" => "post")) !!}
				{!! Form::lbText("name", "", "Name", "Group's name") !!}
				{!! Form::lbText("code", "", "Code", "Group's code", "For developer only") !!}
				{!! Form::lbSubmit() !!}
				{!! Form::close() !!}
            </div>
		</div>
	</div>
</div>
@endsection