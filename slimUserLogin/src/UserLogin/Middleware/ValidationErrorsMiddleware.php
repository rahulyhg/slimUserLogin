<?php
/**
 * Created by IntelliJ IDEA.
 * User: fredericleveillee
 * Date: 17-05-28
 * Time: 15:01
 */

namespace UserLogin\Middleware;


use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class ValidationErrorsMiddleware
 * @package UserLogin\Middleware
 */
class ValidationErrorsMiddleware extends Middleware
{
	/**
	 * Validation Errors Middelware Invoker
	 * @param Request  $request
	 * @param Response $response
	 * @param          $next
	 * @return mixed
	 */
	public function __invoke(Request $request, Response $response, $next)
	{

		if (!empty($_SESSION['validation_errors'])) {
			$request = $request->withAttribute('validation_errors', $_SESSION['validation_errors']);
			unset($_SESSION['validation_errors']);
		}

		return $next($request, $response);
	}
}
