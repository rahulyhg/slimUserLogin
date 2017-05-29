<?php
/**
 * Created by IntelliJ IDEA.
 * User: fredericleveillee
 * Date: 17-05-28
 * Time: 14:59
 */

namespace UserLogin\Middleware;


use Slim\Container;

abstract class Middleware
{
	protected $container;

	public function __construct(Container $container)
	{
		$this->container = $container;
	}

}
