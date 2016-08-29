@extends('dp::app')

@section ('contentheader_title')
Role &amp; Permission Management
@endsection

@section ('sidebox_permission_group')
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
				<h3 class="box-title">Permission group Management</h3>
			</div>
			<div class="box-body">
				<table class="table table-bordered table-hover table-datatable" style="overflow: auto;">
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
		                		@if (Auth::user()->hasPermission("permission_group.edit"))
		                		<a class="btn btn-sm btn-primary" href="{{ url("/permission/group/$group->id/edit") }}"><i class="fa fa-edit"></i></a>
		                		@endif
		                		@if (Auth::user()->hasPermission("permission_group.delete"))
		                		{!! Form::lbButton("/permission/group/$group->id", "delete", "<i class=\"fa fa-trash\"></i>", array(
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
            @if (Auth::user()->hasPermission("permission_group.add"))
            <div class="box-footer">
            	<a href="{{ url("permission/group/create") }}" class="btn btn-primary">Add new Permission Group</a>
            </div>
            @endif
		</div>
	</div>
	@if (Auth::user()->hasPermission("permission_group.add"))
	<div class="col-md-3">
		<div class="box box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Add New Permission Group</h3>
			</div>
			<div class="box-body">
				{!! Form::lbAlert() !!}
				{!! Form::open(array("url" => "permission/group", "method" => "post")) !!}
				{!! Form::lbText("name", "", "Name", "Group's name", null, config("lbform.CNF_REQUIRE_ANUM")) !!}
				{!! Form::lbText("code", "", "Code", "Group's code", "For developer only", config("lbform.CNF_REQUIRE_ANUM_AND_POINT")) !!}
				{!! Form::lbSubmit() !!}
				{!! Form::close() !!}
            </div>
		</div>
	</div>
	@endif
</div>
@endsection