@extends('dp::app')

@section ('contentheader_title')
Role &amp; Permission Management
@endsection

@section ('sidebox_setting')
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
				<h3 class="box-title">Setting</h3>
			</div>
			<div class="box-body">
				<p>Initital setup: Add all the Group &amp; Permission</p>
				<a class="btn btn-primary" href="{{ url("permission/setting/initial") }}">Initital</a>
			</div>
		</div>
	</div>
</div>
@endsection