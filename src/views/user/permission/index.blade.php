@extends('dp::app')

@section ('contentheader_title')
Role &amp; Permission Management
@endsection

@section ('sidebox_user_role')
active
@endsection

@section ('sidebar_permission')
active
@endsection

@section('main-content')
<div class="row">
	@include("dp::sidebox")
	<div class="col-md-9">
		<div class="box box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">{{ $user->name }}'s Permission</h3>
			</div>
			{!! Form::open(array("url" => "/user/$user->id/permission", "method" => "post")) !!}
			<div class="box-body">
				@if (session('dp_announce'))
				<div class="callout callout-success">
					<p>{{ session('dp_announce') }}</p>
				</div>
				@endif
            	@foreach (App\Models\Permission_group::all() as $group)
                	<div class="col-lg-12">
                		<h4>{{ $group->name }}</h4>
                	</div>
                	@foreach ($group->permissions as $permission)
                	<div class="col-lg-4">
                		<input type="checkbox" value="{{ $permission->id }}" name="permission_id[]"
                		<?php
                			$user->loadAllPermissionAndRole();
                			foreach ($user->__localPermissions as $rp)
							{
								if ($permission->id === $rp->id)
								{
									if ($rp->inherited)
									{
										echo "checked disabled ";
									}
									else {
										echo "checked "; break;
									}
								}
							}
                		?>
                		>
                		{{ $permission->name  }} ({{ $permission->code }})
                	</div>
                	@endforeach
                @endforeach
            </div>
            <div class="box-footer">
            	{!! Form::lbSubmit() !!}
            </div>
            {!! Form::close() !!}
		</div>
	</div>
</div>
@endsection