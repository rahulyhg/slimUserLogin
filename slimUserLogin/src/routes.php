<?php
// Routes


$container = $app->getContainer();

$container['PublicController'] =  function($container){
	return new UserLogin\Controllers\PublicController($container);
};

$container['AuthController'] = function ($container) {
	return new UserLogin\Controllers\AuthController($container);
};




$app->get('/', 'PublicController:index');

$app->get('/register', 'PublicController:register')->setName('register');

$app->post('/register', 'AuthController:register');

$app->get('/login', 'PublicController:login')->setName('login');;
$app->post('/login', 'AuthController:login');


$app->get('/home', function ($request, $response, $args) {
	// Sample log message
	$this->logger->info("User Home '/home' route");

	// Render index view
	return $this->renderer->render($response, 'home.phtml', $args);
});

/*
$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
*/
