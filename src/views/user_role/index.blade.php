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
				<h3 class="box-title">User's Role</h3>
			</div>
			<?php
				$roles = App\Models\Role::all();
			?>
			{!! Form::open(array("url" => "user_role", "method" => "post")) !!}
			<div class="box-body">
				<table class="table table-bordered table-hover table-datatable" style="overflow-x: auto;">
					<thead>
		                <tr>
		                	<th>#</th>
		                	<th>User</th>
		                	<th>Email</th>
		                	@foreach ($roles as $role)
		                	<th><center>{{ $role->name }}</center></th>
		                	@endforeach
		                	<th>Action</th>
		                </tr>
	                </thead>
	                <tbody>
	                	@foreach (App\Models\User::with("roles")->get() as $user)
		                <tr>
		                	<td>{{ $user->id }}.</td>
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
            </div>
            <div class="box-footer">
            	{!! Form::lbSubmit() !!}
            </div>
            {!! Form::close() !!}
		</div>
	</div>
</div>
@endsection