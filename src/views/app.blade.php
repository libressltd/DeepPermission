@extends('layouts.app')

@section ('dp_script')

<script>
	$(function() {
		$('input[type="checkbox"], input[type="radio"]').iCheck({
			checkboxClass: 'icheckbox_minimal-blue',
			radioClass: 'iradio_minimal-blue'
		});
		$('.data-table').on('draw.dt', function () {
		    $('input[type="checkbox"], input[type="radio"]').iCheck({
				checkboxClass: 'icheckbox_minimal-blue',
				radioClass: 'iradio_minimal-blue'
			});
		});
	});
</script>

@endsection