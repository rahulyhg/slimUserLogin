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

class ValidationErrorsMiddleware extends Middleware
{
	public function __invoke(Request $request, Response $response, $next)
	{

		if (!empty($_SESSION['validation_errors'])) {
			//var_dump($_SESSION['validation_errors']);
			$request = $request->withAttribute('validation_errors', $_SESSION['validation_errors']);
			unset($_SESSION['validation_errors']);
		}

		return $next($request, $response);
	}
}
