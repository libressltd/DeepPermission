@extends('dp::app')

@section ('contentheader_title')
{{ trans('deeppermission.header.title') }}
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
				<h3 class="box-title">{{ trans('deeppermission.user.role') }}</h3>
			</div>
			<?php
				$roles = App\Models\Role::all();
				$users = App\Models\User::with("roles")->paginate(30);
			?>
			{!! Form::open(array("url" => "user_role", "method" => "post")) !!}
			<div class="box-body" style="overflow-x: auto;">
				@if (session('dp_announce'))
				<div class="callout callout-success">
					<p>{{ session('dp_announce') }}</p>
				</div>
				@endif
				<table class="table table-bordered table-hover">
					<thead>
		                <tr>
		                	<th>#</th>
		                	<th>{{ trans('deeppermission.user.username') }}</th>
		                	<th>{{ trans('deeppermission.user.email') }}</th>
		                	@foreach ($roles as $role)
		                	<th><center>{{ $role->name }}</center></th>
		                	@endforeach
		                	<th>{{ trans('deeppermission.general.action') }}</th>
		                </tr>
	                </thead>
	                <tbody>
	                	@foreach ($users as $user)
		                <tr>
		                	<td>{{ $user->id }}. <input type="hidden" name="user_check_{{ $user->id}}" value="1" /></td>
		                	<td>{{ $user->name }}</td>
		                	<td>{{ $user->email }}</td>
		                	
		                	@foreach ($roles as $role)
		                	<td>
		                		<center>
		                			<input name="user_{{ $user->id }}[]" type="checkbox" value="{{ $role->id }}"
		                			<?php
		                			foreach ($user->roles as $user_role)
		                			{
		                				if ($user_role->id === $role->id)
										{
											echo "checked"; break;
										}
		                			}
		                			?>
		                			>
		                		</center>
		                	</td>
		                	@endforeach
		                	<td>
		                		<a class="btn btn-sm btn-warning" href="{{ url("/user/$user->id/permission") }}"><i class="fa fa-key"></i></a>
		                	</td>
		                </tr>
		                @endforeach
	                </tbody>
                </table>
                {{ $users->links() }}
            </div>
            <div class="box-footer">
            	{!! Form::lbSubmit() !!}
            </div>
            {!! Form::close() !!}
		</div>
	</div>
</div>
@endsection