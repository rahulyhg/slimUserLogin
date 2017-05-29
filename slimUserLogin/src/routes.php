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

