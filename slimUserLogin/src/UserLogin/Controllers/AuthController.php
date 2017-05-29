<?php

namespace UserLogin\Controllers;


use Respect\Validation\Validator as v;
use Slim\Http\Request;
use Slim\Http\Response;
use UserLogin\Validation\Validator;

class AuthController extends Controller
{


	public function getLogin(Request $request, Response $response)
	{
		// Sample log message
		//$this->logger->info("Login '/login' route");

		return $this->render($response, 'login.phtml', [
			'router' => $this->container->router,
			'previous_params' => $request->getAttribute('previous_params'),
			'validation_errors' => $request->getAttribute('validation_errors')
		]);
	}


	public function postLogin(Request $request, Response $response)
	{
		/** @var Validator $validation */
		$validation = $this->container->validator->validate($request, [
			'email' => v::notEmpty()->noWhitespace()->email(),
			'password' => v::notEmpty()->noWhitespace()
		]);

		if ($validation->failed()) {
			$this->container->flash->addMessage('error',
				'Invalid information. Please apply corrections as prescribed below.');

			return $response->withRedirect($this->container->router->pathFor('login'));
		} else {
			$auth = $this->container->auth->attempt($request->getParam('email'), $request->getParam('password'));

			if (!$auth) {
				$this->container->flash->addMessage('error', 'Login Failed! Username or Password incorrect');

				return $response->withRedirect($this->container->router->pathFor('login'));
			} else {
				return $response->withRedirect($this->container->router->pathFor('home'));
			}
		}

	}

	public function getLogout(Request $request, Response $response)
	{
		// Sample log message
		//$this->logger->info("Login '/login' route");

		$this->container->auth->terminate();

		$this->container->flash->addMessage('info', 'You have been logged out.');

		return $response->withRedirect($this->container->router->pathFor('home'));
	}


}
