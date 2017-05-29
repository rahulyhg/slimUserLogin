<?php
/**
 * Created by IntelliJ IDEA.
 * User: fredericleveillee
 * Date: 17-05-28
 * Time: 17:04
 */

namespace UserLogin\Middleware;


use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class DataPersistenceMiddleware
 * @package UserLogin\Middleware
 */
class DataPersistenceMiddleware extends Middleware
{
	/**
	 * Data Persistence MiddleWare Invoker
	 * @param Request  $request
	 * @param Response $response
	 * @param          $next
	 * @return mixed
	 */
	public function __invoke(Request $request, Response $response, $next)
	{
		if (!empty($_SESSION['previous_params'])) {
			//var_dump($_SESSION['validation_errors']);
			$request = $request->withAttribute('previous_params', $_SESSION['previous_params']);
		}

		// Update Previous Params with Current Params for the next round
		$_SESSION['previous_params'] = $request->getParams();

		return $next($request, $response);
	}
}
