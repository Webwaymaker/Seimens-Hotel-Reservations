<div id="model-run-report" class="modal" tabindex="-1" role="dialog">
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
				Are you sure you want to run the Nightly Registration 
				Report before it's normal scheduled time?
			</p>
			</div>
			<div class="modal-footer">
			<form action="/managment/run_report" method="GET" />
				@csrf
				<button type="submit" class="btn btn-danger">Yes</button>
			</form>
			<button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
			</div>
		</div>
	</div>
</div>
