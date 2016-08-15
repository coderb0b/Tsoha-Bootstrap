<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/main', function() {
    HelloWorldController::drinks_main();
});

$routes->get('/login', function() {
    HelloWorldController::login();
});

$routes->get('/drink', function() {
    //HelloWorldController::drinks_list();
    recipe_controller::index();
});

$routes->get('/drink/:id', function($id) {
    recipe_controller::drinks_show($id);
});
