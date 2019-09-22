<form method="POST" action="/registration/{{ $conf_num }}/{{ $id }}/delete">
	@csrf
	@method("delete")
	<button class="btn btn-danger mt-2" type="submit" name="btn_cancel">Cancel Registration</button> 
</form>
