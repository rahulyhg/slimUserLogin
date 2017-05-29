<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);


use UserLogin\Middleware\DataPersistenceMiddleware;
use UserLogin\Middleware\ValidationErrorsMiddleware;

$app->add(new ValidationErrorsMiddleware($app->getContainer()));

$app->add(new DataPersistenceMiddleware($app->getContainer()));
