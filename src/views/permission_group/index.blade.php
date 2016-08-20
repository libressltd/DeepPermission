@extends('layouts.app')

@section ('contentheader_title')
Role &amp; Permission Management
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
		                	<th>Action</th>
		                </tr>
	                </thead>
	                <tbody>
	                	@foreach (App\Models\Permission_group::all() as $group)
		                <tr>
		                	<td>{{ $group->id }}.</td>
		                	<td>{{ $group->name }}</td>
		                	<td>{{ $group->code }}</td>
		                	<td>
		                		<a class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
		                	</td>
		                </tr>
		                @endforeach
	                </tbody>
                </table>
            </div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="box box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Add New Permission Group</h3>
			</div>
			<div class="box-body">
				{!! Form::open(array("test", "post")) !!}
				{!! Form::lbText("name", "", "Name", "Group's name") !!}
				{!! Form::lbText("code", "", "Code", "Group's code", "For developer only") !!}
				{!! Form::lbSubmit() !!}
				{!! Form::close() !!}
            </div>
		</div>
	</div>
</div>
@endsection