<div id="model-password-reset" class="modal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
			<h5 class="modal-title">Confirmation</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			</div>
			<div class="modal-body text-center">
			<p>
				Are you sure you would like to send a password reset email to
				<span id="reset-email-address"></span>?
			</p>
			</div>
			<div class="modal-footer">
			<form id="reset-confirm-form" action="/managment/run_report" method="GET">
				@csrf
				<button class="btn btn-danger" type="submit">Yes</button>
			</form>
			<button class="btn btn-primary" data-dismiss="modal" type="button">No</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		$('.reset-link').on("click", function() {
			$('#reset-confirm-form').attr('action', this.dataset.route);
			$('#reset-email-address').text(this.dataset.email)
		});
	});
</script>
