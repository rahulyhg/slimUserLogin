<?php

namespace UserLogin\Controllers;


use Slim\Container;
use Slim\Views\PhpRenderer;

abstract  class Controller{

	protected $container;
	protected $phpView;

	/**
	 * Controller constructor.
	 * @param $container
	 */
	public function __construct(Container $container){
		$this->container = $container;
		$settings = $this->container->get('settings')['renderer'];
		$this->phpView = new PhpRenderer($settings['template_path']);

	}

}
