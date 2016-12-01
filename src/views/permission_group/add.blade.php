@extends('dp::app')

@section ('contentheader_title')
{{ trans('deeppermission.header.title') }}
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
					{{ trans('deeppermission.group.add') }}
					@else
					{{ trans('deeppermission.group.edit') }}: {{ $group->name }}
					@endif
				</h3>
			</div>
			<div class="box-body">
				{!! Form::lbAlert() !!}
				@if (!isset($group))
				{!! Form::open(array("url" => "permission/group", "method" => "post")) !!}
				@else
				{!! Form::open(array("url" => "permission/group/$group->id", "method" => "put")) !!}
				@endif
				
				{!! Form::lbText("name", @$group->name, trans('deeppermission.group.name'), trans('deeppermission.group.name.hint'), null, config("deeppermission.CNF_REQUIRE_ANUM")) !!}
				{!! Form::lbText("code", @$group->code, trans('deeppermission.group.code'), trans('deeppermission.group.code.hint'), trans('deeppermission.group.code.note'), config("deeppermission.CNF_REQUIRE_ANUM_AND_POINT")) !!}
				{!! Form::lbSubmit() !!}
				{!! Form::close() !!}
            </div>
		</div>
	</div>
</div>
@endsection