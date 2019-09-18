<h2>Siemens - Welcome Administrator</h2>

<p>Hello,</p>

<p>
	You have just been added to the Siemen's Hotel Registration system as a site
	Administrator.
</p>  

<ul>
	<li>The administrator site can be accessed at https://corpcoach.net/registration/admin</li>
	<li>Your user name is the email address that was used to register you: {{ $admin->email }}</li>
	<li>
		To finalize your activation please 
		<a href="http://ccreg.webwaymaker.com/admin/set/{{ strtotime($admin->created_at) }}/{{ $admin->id }}">
			click here to set your password
		</a>
	</li>
</ul>

<p>
	Thanks you for your participation!
</p>
