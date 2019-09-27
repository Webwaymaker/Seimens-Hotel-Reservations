<div id="model-admin-delete" class="modal" tabindex="-1" role="dialog">
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
					Are you sure you would like to delete 
					<span id="delete-admin-name"></span>'s 
					Administrator Account?
				</p>
				</div>
				<div class="modal-footer">
				<form id="delete-admin-form" method="GET" action="">
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
			$('.delete-link').on("click", function() {
				$('#delete-admin-form').attr('action', this.dataset.route);
				$('#delete-admin-name').text(this.dataset.name)
			});
		});
	</script>