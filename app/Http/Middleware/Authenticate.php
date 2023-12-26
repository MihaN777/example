<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Str;

class Authenticate extends Middleware
{
	/**
	 * Get the path the user should be redirected to when they are not authenticated.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return string|null
	 */
	protected function redirectTo($request)
	{
		if (!$request->expectsJson()) {
			$path = Str::substr(Str::lower($request->path()), 0, 5);

			if ($path == 'admin') {
				abort(404);
			}
		}
	}
}
