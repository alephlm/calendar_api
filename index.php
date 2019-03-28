<?php
//Autoload
$loader = require 'vendor/autoload.php';

$app = new \Slim\Slim(array(
    'templates.path' => 'templates'
));

$app->get('/holidaysmonth/',  function() use ($app) {
	$month = $app->request()->get('month');
	$year = $app->request()->get('year');
	(new \controllers\Holiday($app))->listMonth($month, $year);
});

$app->run();
