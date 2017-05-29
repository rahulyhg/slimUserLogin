<?php

// DIC configuration
use Slim\Container;
use Respect\Validation\Validator as v;

$container = $app->getContainer();

// view renderer
$container['renderer'] = function (Container $container) {
    $settings = $container->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function (Container $container) {
    $settings = $container->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// Eloquent ORM
$capsule = new Illuminate\Database\Capsule\Manager();
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function(Container $container) use ($capsule){
	return $capsule;
};

//Validator
$container['validator'] = function (Container $container) {
	return new UserLogin\Validation\Validator();
};

// Custom Validation Rules
v::with('UserLogin\\Validation\\Rules\\');

//Authentication
$container['auth'] = function (Container $container) {
	return new UserLogin\Auth\Auth();
};
