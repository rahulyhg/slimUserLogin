<?php
/**
 * Created by IntelliJ IDEA.
 * User: fredericleveillee
 * Date: 17-05-28
 * Time: 14:59
 */

namespace UserLogin\Middleware;

use Slim\Container;

/**
 * Class Middleware
 * @package UserLogin\Middleware
 */
abstract class Middleware
{
	protected $container;

	/**
	 * Middleware constructor.
	 * @param Container $container
	 */
	public function __construct(Container $container)
	{
		$this->container = $container;
	}

}
