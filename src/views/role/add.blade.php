@extends('layouts.app')

@section ('contentheader_title')
Role &amp; Permission Management
@endsection

@section ('sidebox_role')
active
@endsection

@section('main-content')
<div class="row">
	@include("dp::sidebox")
	<div class="col-md-6">
		<div class="box box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">
					@if (!isset($role))
					Add new Role
					@else
					Edit Role: {{ $role->name }}
					@endif
				</h3>
			</div>
			<div class="box-body">
				@if (!isset($role))
				{!! Form::open(array("url" => "role", "method" => "post")) !!}
				@else
				{!! Form::open(array("url" => "role/$role->id", "method" => "put")) !!}
				@endif
				
				{!! Form::lbText("name", @$role->name, "Name", "Role's name") !!}
				{!! Form::lbText("code", @$role->code, "Code", "Role's code", "For developer only") !!}
				{!! Form::lbSubmit() !!}
				{!! Form::close() !!}
            </div>
		</div>
	</div>
</div>
@endsection