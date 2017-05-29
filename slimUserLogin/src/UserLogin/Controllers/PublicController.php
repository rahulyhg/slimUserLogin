<?php

namespace UserLogin\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class PublicController extends Controller
{
	/**
	 * @param $request
	 * @param $response
	 */
	public function index(Request $request, Response $response)
	{
		// Sample log message
		//$this->logger->info("Homepage '/' route");


		$this->phpView->render($response, 'includes/header.phtml');
		$this->phpView->render($response, 'index.phtml', ["router" => $this->container->router]);
		$this->phpView->render($response, 'includes/footer.phtml');
	}


	public function register(Request $request, Response $response)
	{
		// Sample log message
		//$this->logger->info("Register '/register' route");
		$this->phpView->render($response, 'includes/header.phtml');
		$this->phpView->render($response, 'register.phtml', [
			'router' => $this->container->router,
			'previous_params' => $request->getAttribute('previous_params'),
			'validation_errors' => $request->getAttribute('validation_errors')]);

		$this->phpView->render($response, 'includes/footer.phtml');
	}

	public function login(Request $request, Response $response)
	{
		// Sample log message
		//$this->logger->info("Login '/login' route");

		$this->phpView->render($response, 'includes/header.phtml');
		$this->phpView->render($response, 'login.phtml', ["router" => $this->container->router]);
		$this->phpView->render($response, 'includes/footer.phtml');
	}


}
