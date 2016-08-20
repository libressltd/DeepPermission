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
				<h3 class="box-title">Role Management</h3>
			</div>
			<div class="box-body">
				<table class="table table-bordered table-hover">
	                <tr>
	                	<th>#</th>
	                	<th>Role</th>
	                	<th>Action</th>
	                </tr>
	                <tr>
	                	<td>1.</td>
	                	<td>Administrator</td>
	                	<td><span class="badge bg-red">55%</span></td>
	                </tr>
                </table>
            </div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="box box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Add New Role</h3>
			</div>
			<div class="box-body">
				{!! Form::open(array("test", "post")) !!}
				{!! Form::lbText("name", "", "Name", "Role's name") !!}
				{!! Form::lbText("code", "", "Code", "Role's code", "For developer only") !!}
				{!! Form::lbSubmit() !!}
				{!! Form::close() !!}
            </div>
		</div>
	</div>
</div>
@endsection