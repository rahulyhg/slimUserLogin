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

		return $this->render($response, 'index.phtml', ["router" => $this->container->router]);
	}


}
