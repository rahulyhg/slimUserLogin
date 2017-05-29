<?php

namespace UserLogin\Controllers;


use Slim\Container;
use Slim\Http\Response;
use Slim\Views\PhpRenderer;

abstract class Controller
{

	protected $container;
	protected $phpView;

	/**
	 * Controller constructor.
	 * @param $container
	 */
	public function __construct(Container $container)
	{
		$this->container = $container;
		$settings = $this->container->get('settings')['renderer'];
		$this->phpView = new PhpRenderer($settings['template_path']);

	}


	/**
	 * Automated header/footer rendering
	 *
	 * @param Response   $response
	 * @param string     $template
	 * @param array|null $args
	 * @return Response
	 */
	protected function render(Response $response, string $template, $args)
	{
		$args[] = ['auth' => $this->container->auth];

		$this->phpView->render($response, 'includes/header.phtml', [
				'router' => $this->container->router,
				'auth' => $this->container->auth,
			]);
		$this->phpView->render($response, $template, $args);
		$this->phpView->render($response, 'includes/footer.phtml', ['router' => $this->container->router,]);

		return $response;
	}

}
