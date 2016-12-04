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
	@include("libressltd.deeppermission.sidebox")
	<div class="col-md-6">
		<div class="box box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">{{ trans('deeppermission.group.title') }}</h3>
			</div>
			<div class="box-body" style="overflow: auto;">
				@if (session('dp_announce'))
				<div class="callout callout-success">
					<p>{{ session('dp_announce') }}</p>
				</div>
				@endif
				<table class="table table-bordered table-hover">
					<thead>
		                <tr>
		                	<th>#</th>
		                	<th>{{ trans('deeppermission.group.name') }}</th>
		                	<th>{{ trans('deeppermission.group.code') }}</th>
		                	<th>{{ trans('deeppermission.group.permission') }}</th>
		                	<th>{{ trans('deeppermission.general.action') }}</th>
		                </tr>
	                </thead>
	                <tbody>
	                <?php
	                	$groups = App\Models\Permission_group::with("permissions")->paginate(30);
	                ?>
	                	@foreach ($groups as $group)
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
		                			"onclick" => "return confirm(\"".trans('deeppermission.general.are_you_sure')."\")"
		                		)) !!}
		                		@endif
		                	</td>
		                </tr>
		                @endforeach
	                </tbody>
	                {{ $groups->links() }}
                </table>
            </div>
            @if (Auth::user()->hasPermission("permission_group.add"))
            <div class="box-footer">
            	<a href="{{ url("permission/group/create") }}" class="btn btn-primary">{{ trans('deeppermission.group.add') }}</a>
            </div>
            @endif
		</div>
	</div>
	@if (Auth::user()->hasPermission("permission_group.add"))
	<div class="col-md-3">
		<div class="box box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">{{ trans('deeppermission.general.quickadd') }}</h3>
			</div>
			<div class="box-body">
				{!! Form::lbAlert() !!}
				{!! Form::open(array("url" => "permission/group", "method" => "post")) !!}
				{!! Form::lbText("name", "", trans('deeppermission.group.name'), trans('deeppermission.group.name_hint'), null, config("lbform.CNF_REQUIRE_ANUM")) !!}
				{!! Form::lbText("code", "", trans('deeppermission.group.code'), trans('deeppermission.group.code_hint'), trans('deeppermission.group.code_note'), config("lbform.CNF_REQUIRE_ANUM_AND_POINT")) !!}
				{!! Form::lbSubmit() !!}
				{!! Form::close() !!}
            </div>
		</div>
	</div>
	@endif
</div>
@endsection