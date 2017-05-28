<?php

namespace UserLogin\Controllers;


use Respect\Validation\Validator as v;
use Slim\Http\Request;
use Slim\Http\Response;
use UserLogin\Models\User;
use UserLogin\Validation\Validator;

class AuthController extends Controller
{


	public function register(Request $request, Response $response)
	{
		var_dump($request->getParams());

		/** @var Validator $validation */
		$validation = $this->container->validator->validate($request, [
			'name' => v::notEmpty()->alpha(),
			'email' => v::notEmpty()->noWhitespace()->email(),
			'password' => v::notEmpty()
		]);

		if($validation->failed()){
			return $response->withRedirect($this->container->router->pathFor('register'));
		}
		else{
			User::create([
				'name' => $request->getParam('name'),
				'email' => $request->getParam('email'),
				'password' => password_hash($request->getParam('password'),PASSWORD_DEFAULT)
			]);
		}


		$this->phpView->render($response, 'includes/header.phtml');
		$this->phpView->render($response, 'register.phtml', ["router" => $this->container->router]);
		$this->phpView->render($response, 'includes/footer.phtml');
	}


	public function login(Request $request, Response $response)
	{
		$this->phpView->render($response, 'includes/header.phtml');
		$this->phpView->render($response, 'login.phtml', ["router" => $this->container->router]);
		$this->phpView->render($response, 'includes/footer.phtml');
	}


}
