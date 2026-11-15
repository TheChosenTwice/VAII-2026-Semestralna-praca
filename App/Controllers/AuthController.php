<?php

namespace App\Controllers;

use App\Configuration;
use App\Models\User;
use Exception;
use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;
use Framework\Http\Responses\ViewResponse;

/**
 * Class AuthController
 *
 * This controller handles authentication actions such as login, logout, and redirection to the login page. It manages
 * user sessions and interactions with the authentication system.
 *
 * @package App\Controllers
 */
class AuthController extends BaseController
{
    /**
     * Redirects to the login page.
     *
     * This action serves as the default landing point for the authentication section of the application, directing
     * users to the login URL specified in the configuration.
     *
     * @return Response The response object for the redirection to the login page.
     */
    public function index(Request $request): Response
    {
        return $this->redirect(Configuration::LOGIN_URL);
    }

    /**
     * Authenticates a user and processes the login request.
     *
     * This action handles user login attempts. If the login form is submitted, it attempts to authenticate the user
     * with the provided credentials. Upon successful login, the user is redirected to the home page.
     * If authentication fails, an error message is displayed on the login page.
     *
     * @return Response The response object which can either redirect on success or render the login view with
     *                  an error message on failure.
     * @throws Exception If the parameter for the URL generator is invalid throws an exception.
     */
    public function login(Request $request): Response
    {
        $logged = null;
        if ($request->hasValue('submit')) {
            $logged = $this->app->getAuthenticator()->login($request->value('username'), $request->value('password'));
            if ($logged) {
                return $this->redirect($this->url("home.index"));
            }
        }

        $message = $logged === false ? 'Bad username or password' : null;
        return $this->html(compact("message"));
    }

    /**
     * Logs out the current user.
     *
     * This action terminates the user's session and redirects them to a view. It effectively clears any authentication
     * tokens or session data associated with the user.
     *
     * @return ViewResponse The response object that renders the logout view.
     */
    public function logout(Request $request): Response
    {
        $this->app->getAuthenticator()->logout();
        return $this->html();
    }

    /**
     * Displays the registration page.
     *
     * This action renders the registration view, allowing users to create a new account.
     *
     * @return ViewResponse The response object that renders the registration view.
     */
    public function register(Request $request): Response
    {
        $message = null;
        $username = trim((string)$request->value('username'));

        if ($request->hasValue('submit')) {
            $password = (string)$request->value('password');
            $confirmPassword = (string)$request->value('confirm_password');

            if ($username === '' || strlen($username) > 100) {
                $message = 'Username must be between 1 and 100 characters.';
            } elseif (User::getCount('`login` = ?', [$username]) > 0) {
                $message = 'This username is already taken.';
            } elseif (strlen($password) < 6) {
                $message = 'Password must be at least 6 characters long.';
            } elseif ($password !== $confirmPassword) {
                $message = 'Passwords do not match.';
            } else {
                $user = new User();
                $user->setLogin($username);
                $user->setPassword($password);
                $user->save();

                $this->app->getAuthenticator()->login($request->value('username'), $request->value('password'));
                return $this->redirect($this->url("home.index"));
            }
        }

        return $this->html(compact('message', 'username'));
    }
}
