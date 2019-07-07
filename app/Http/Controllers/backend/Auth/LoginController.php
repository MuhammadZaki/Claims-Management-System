<?php
/**
 * This LoginController File.
 *
 * PHP version 7.2.11
 *
 * @category PHP
 * @package  PHP
 * @author   Areeb Group <admin@domain.net>
 * @license  https://www.areebgroup.com/ Areeb Licence
 * @link     https://www.areebgroup.com/ Areeb Licence
 */
namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

/**
 * Class LoginController
 *
 * @category Class
 * @package  PHP
 * @author   Areeb Group <admin@domain.net>
 * @license  https://www.areebgroup.com/ Areeb Licence
 * @link     https://www.areebgroup.com
 */
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin-guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('backend.auth.login');
    }

   
    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }

   
}
