<?php
// Routes


$container = $app->getContainer();


$container['PublicController'] = function ($container) {
	return new UserLogin\Controllers\PublicController($container);
};

$container['RegistrationController'] =  function($container){
	return new UserLogin\Controllers\RegistrationController($container);
};

$container['AuthController'] = function ($container) {
	return new UserLogin\Controllers\AuthController($container);
};




$app->get('/', 'PublicController:index')->setName('home');

$app->get('/registration', 'RegistrationController:getRegistration')->setName('registration');

$app->post('/registration', 'RegistrationController:postRegistration');

$app->get('/login', 'AuthController:getLogin')->setName('login');;
$app->post('/login', 'AuthController:postLogin');

$app->get('/logout', 'AuthController:getLogout')->setName('logout');;

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
