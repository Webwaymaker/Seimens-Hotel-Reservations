<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class HttpsProtocol {

//------------------------------------------------------------------------------
// Public Methods
//------------------------------------------------------------------------------

	// Handle -------------------------------------------------------------------
	// Added to force HTTPS in production
	// See https://stackoverflow.com/a/28403907
	public function handle($request, Closure $next) {
		if (!$request->secure() && App::environment() === 'production') {
				return redirect()->secure($request->getRequestUri());
		}

		return $next($request); 
	}


}  //End of class