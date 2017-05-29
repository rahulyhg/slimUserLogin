<?php
/**
 * Created by IntelliJ IDEA.
 * User: fredericleveillee
 * Date: 17-05-28
 * Time: 21:26
 */

namespace UserLogin\Controllers;


use Illuminate\Contracts\Validation\Validator as v;
use Slim\Http\Request;
use Slim\Http\Response;
use UserLogin\Models\User;
use UserLogin\Validation\Validator;

class RegistrationController extends Controller
{

	public function getRegistration(Request $request, Response $response)
	{
		// Sample log message
		//$this->logger->info("Register '/register' route");

		return $this->render($response, 'registration.phtml', [
			'router' => $this->container->router,
			'previous_params' => $request->getAttribute('previous_params'),
			'validation_errors' => $request->getAttribute('validation_errors')
		]);
	}

	public function postRegistration(Request $request, Response $response)
	{
		/** @var Validator $validation */
		$validation = $this->container->validator->validate($request, [
			'name' => v::notEmpty()->alpha(),
			'email' => v::notEmpty()->noWhitespace()->email()->emailAvailable(),
			'password' => v::notEmpty()->noWhitespace()
		]);

		if ($validation->failed()) {
			return $response->withRedirect($this->container->router->pathFor('registration'));
		} else {
			User::create([
				'name' => $request->getParam('name'),
				'email' => $request->getParam('email'),
				'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT)
			]);

			$this->container->auth->attempt($request->getParam('email'), $request->getParam('password'));

			return $response->withRedirect($this->container->router->pathFor('home'));
		}

	}


}
