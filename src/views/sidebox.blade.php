<div class="col-md-3">
	<div class="box box-solid">
		<div class="box-header with-border">
			<h3 class="box-title">Role &amp; Permission</h3>
		</div>
		<div class-"box-body">
			<ul class="nav nav-pills nav-stacked">
				<li class="@yield('sidebox_user_role')">
					<a href="{{ url("user_role") }}">
						User's Role
					</a>
				</li>
				<li class="@yield('sidebox_role')">
					<a href="{{ url("role") }}">
						Role
					</a>
				</li>
				<li class="@yield('sidebox_permission_group')">
					<a href="{{ url("permission_group") }}">
						Group Permission
					</a>
				</li>
				<li class="@yield('sidebox_permission')">
					<a href="{{ url("permission") }}">
						Permission
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>