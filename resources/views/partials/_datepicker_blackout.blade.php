@section('styles')
	<link href="{{ asset('css/jquery_datetimepicker_2.5.20_min.css') }}" rel="stylesheet">
@endsection

@section('bottom_scripts')
	<script src="{{ asset('js/moment_2.24.0_with_locales.min.js') }}"></script>
	<script src="{{ asset('js/jquery_datetimepicker_2.5.20_full.min.js') }}"></script>
	<script>
			jQuery.datetimepicker.setDateFormatter('moment')
			$('#picker1').datetimepicker({
				timepicker: false,
				datepicker: true,
				format: 'MM/DD/YYYY',
			})
			$('#toggle1').on('click', function() {
				$('#picker1').datetimepicker('toggle')
			})

			$('#picker2').datetimepicker({
				timepicker: false,
				datepicker: true,
				format: 'MM/DD/YYYY',
			})
			$('#toggle2').on('click', function() {
				$('#picker2').datetimepicker('toggle')
			})

			$('#picker3').datetimepicker({
				timepicker: false,
				datepicker: true,
				format: 'MM/DD/YYYY',
			})
			$('#toggle3').on('click', function() {
				$('#picker3').datetimepicker('toggle')
			})
	</script>
@endsection
