@extends('layouts.app')

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
				<h3 class="box-title">
					@if (!isset($group))
					Add new Group
					@else
					Edit Group: {{ $group->name }}
					@endif
				</h3>
			</div>
			<div class="box-body">
				@if (!isset($group))
				{!! Form::open(array("url" => "permission/group", "method" => "post")) !!}
				@else
				{!! Form::open(array("url" => "permission/group/$group->id", "method" => "put")) !!}
				@endif
				
				{!! Form::lbText("name", @$group->name, "Name", "Group's name", null, config("deeppermission.CNF_REQUIRE_ANUM")) !!}
				{!! Form::lbText("code", @$group->code, "Code", "Group's code", "For developer only", config("deeppermission.CNF_REQUIRE_ANUM_AND_POINT")) !!}
				{!! Form::lbSubmit() !!}
				{!! Form::close() !!}
            </div>
		</div>
	</div>
</div>
@endsection