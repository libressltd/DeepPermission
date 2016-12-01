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
	@include("dp::sidebox")
	<div class="col-md-6">
		<div class="box box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">
					@if (!isset($permission))
					{{ trans('deeppermission.permission.add') }}
					Add new Permission
					@else
					{{ trans('deeppermission.permission.edit') }}: {{ $permission->name }}
					@endif
				</h3>
			</div>
			<div class="box-body">
				{!! Form::lbAlert() !!}
				@if (!isset($permission))
				{!! Form::open(array("url" => "permission", "method" => "post")) !!}
				@else
				{!! Form::open(array("url" => "permission/$permission->id", "method" => "put")) !!}
				@endif
				
				{!! Form::lbText("name", @$permission->name, trans('deeppermission.permission.name'), trans('deeppermission.permission.name.hint'), null, config("deeppermission.CNF_REQUIRE_ANUM")) !!}
				{!! Form::lbText("code", @$permission->code, trans('deeppermission.permission.code'), trans('deeppermission.permission.code.hint'), trans('deeppermission.permission.code.note'), config("deeppermission.CNF_REQUIRE_ANUM_AND_POINT")) !!}
				{!! Form::lbSelect2("permission_group_id", @$permission->permission_group_id, App\Models\Permission_group::all_to_option(), trans('deeppermission.permission.group_permission')) !!}
				{!! Form::lbSubmit() !!}
				{!! Form::close() !!}
            </div>
		</div>
	</div>
</div>
@endsection