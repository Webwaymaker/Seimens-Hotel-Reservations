<h2>Siemens - Welcome Administrator</h2>

<p>Hello,</p>

<p>
	You have just been added to the Siemen's Hotel Registration system as a Site
	Administrator.
</p>  

<ul>
	<li>The administrator site can be accessed at https://corpcoach.net/registration/admin</li>
	<li>Your user name is the email address that was used to register: {{ $admin->email }}</li>
	<li>
		To finalize your activation please 
		<a href="https://corpcoach.net/admin/set/{{ $admin->access_token }}/{{ $admin->id }}">
			click here to set your password
		</a>
	</li>
</ul>

<p>
	Thanks you for your participation!
</p>
