<?php namespace App\Http\Middleware;

use Closure;
// use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Laravel\Lumen\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		// echo "<pre/>";
		// print_r(get_class_methods($request)); die;
		if($this->excludedRoutes($request))
			return $this->addCookieToResponse($request, $next($request));
		return parent::handle($request, $next);
	}

	protected function excludedRoutes($request)  
	{
		$routes = [
				'auth/login',
				'api/v1/auth/log',
				'api/v1/auth/login',
				'api/v1/auth/logout',
				'api/v1/auth/register',
				'api/v1/auth/profile'
		];
		// echo "<pre/>";
		// print_r(get_class_methods($request)); die;
		foreach($routes as $route)
			if ($request->is($route))
				return true;

			return false;
	}
}
