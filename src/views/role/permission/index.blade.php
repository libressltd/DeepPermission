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
	<div class="col-md-9">
		<div class="box box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">{{ $role->name }}'s Permission</h3>
			</div>
			{!! Form::open(array("url" => "/role/$role->id/permission", "method" => "post")) !!}
			<div class="box-body">
            	@foreach (App\Models\Permission_group::all() as $group)
                	<div class="col-lg-12">
                		<h4>{{ $group->name }}</h4>
                	</div>
                	@foreach ($group->permissions as $permission)
                	<div class="col-lg-4">
                		<input name="permission_id[]" type="checkbox" value="{{ $permission->id }}"
                		<?php
                			foreach ($role->permissions as $rp)
							{
								if ($permission->id === $rp->id)
								{
									echo "checked"; break;
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