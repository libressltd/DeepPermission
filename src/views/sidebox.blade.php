<div class="col-md-3">
	<div class="box box-solid">
		<div class="box-header with-border">
			<h3 class="box-title">Role &amp; Permission</h3>
		</div>
		<div class="box-body">
			<ul class="nav nav-pills nav-stacked">
				@if (Auth::user()->hasPermission("user_role.view"))
				<li class="@yield('sidebox_user_role')">
					<a href="{{ url("user_role") }}">
						{{ trans('deeppermission.sidebox.user_role') }}
					</a>
				</li>
				@endif
				@if (Auth::user()->hasPermission("role.view"))
				<li class="@yield('sidebox_role')">
					<a href="{{ url("role") }}">
						{{ trans('deeppermission.sidebox.role') }}
					</a>
				</li>
				@endif
				@if (Auth::user()->hasPermission("permission_group.view"))
				<li class="@yield('sidebox_permission_group')">
					<a href="{{ url("permission/group") }}">
						{{ trans('deeppermission.sidebox.group') }}
					</a>
				</li>
				@endif
				@if (Auth::user()->hasPermission("permission.view"))
				<li class="@yield('sidebox_permission')">
					<a href="{{ url("permission") }}">
						{{ trans('deeppermission.sidebox.permission') }}
					</a>
				</li>
				@endif
				@if (Auth::user()->hasPermission("permission.setting"))
				<li class="@yield('sidebox_setting')">
					<a href="{{ url("permission/setting") }}">
						{{ trans('deeppermission.sidebox.setting') }}
					</a>
				</li>
				@endif
			</ul>
		</div>
	</div>
</div>