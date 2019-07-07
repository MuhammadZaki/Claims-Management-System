<?php
/**
 * This ForgotPasswordController File.
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
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

/**
 * Class ForgotPasswordController
 *
 * @category Class
 * @package  PHP
 * @author   Areeb Group <admin@domain.net>
 * @license  https://www.areebgroup.com/ Areeb Licence
 * @link     https://www.areebgroup.com
 */
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin-guest');
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        return view('backend.auth.passwords.email');
    }
}
