<?php
/**
 * This file is RedirectIfAuthenticated File.
 *
 * PHP version 7.2.11
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @author   Areeb Group <admin@domain.net>
 * @license  https://www.areebgroup.com/ Areeb Licence
 * @link     https://www.areebgroup.com/ Areeb Licence
 */
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * Class Kernel
 *
 * @category Class
 * @package  RedirectIfAuthenticated
 * @author   Areeb Group <admin@domain.net>
 * @license  https://www.areebgroup.com/ Areeb Licence
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */
class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @param  string|null              $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return redirect('/home');
        }

        return $next($request);
    }
}
