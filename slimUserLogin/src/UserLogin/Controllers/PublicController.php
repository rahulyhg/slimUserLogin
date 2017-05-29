<?php

namespace UserLogin\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class PublicController
 * @package UserLogin\Controllers
 */
class PublicController extends Controller
{
	/**
	 * Return the public index page
	 * @param Request  $request
	 * @param Response $response
	 * @return Response
	 */
	public function index(Request $request, Response $response)
	{
		// Sample log message
		//$this->logger->info("Homepage '/' route");

		return $this->render($response, 'index.phtml', ["router" => $this->container->router]);
	}


}
