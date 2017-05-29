<?php
/**
 * Created by IntelliJ IDEA.
 * User: fredericleveillee
 * Date: 17-05-28
 * Time: 21:26
 */

namespace UserLogin\Controllers;


use Respect\Validation\Validator as v;
use Slim\Http\Request;
use Slim\Http\Response;
use UserLogin\Models\User;
use UserLogin\Validation\Validator;

/**
 * Class RegistrationController
 * @package UserLogin\Controllers
 */
class RegistrationController extends Controller
{
	/**
	 * Displays the Registration form
	 * @param Request  $request
	 * @param Response $response
	 * @return Response
	 */
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

	/**
	 * Process the Registration Form received through HTTP POST method
	 * @param Request  $request
	 * @param Response $response
	 * @return Response
	 */
	public function postRegistration(Request $request, Response $response)
	{
		/** @var Validator $validation */
		$validation = $this->container->validator->validate($request, [
			'name' => v::notEmpty()->alpha(),
			'email' => v::notEmpty()->noWhitespace()->email()->emailAvailable(),
			'password' => v::notEmpty()->noWhitespace()
		]);

		if ($validation->failed()) {
			$this->container->flash->addMessage('error',
				'Registration Failed! Please apply corrections as prescribed below.');

			return $response->withRedirect($this->container->router->pathFor('registration'));
		} else {
			User::create([
				'name' => $request->getParam('name'),
				'email' => $request->getParam('email'),
				'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT)
			]);

			$this->container->flash->addMessage('info',
				'Registration Successful! Welcome ' . $request->getParam('name'));
			$this->container->auth->attempt($request->getParam('email'), $request->getParam('password'));

			return $response->withRedirect($this->container->router->pathFor('home'));
		}

	}


}
