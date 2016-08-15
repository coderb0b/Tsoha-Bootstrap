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

//reseptin lisääminen tietokantaan
$routes->post('/drink', function() {
    //HelloWorldController::drinks_list();
    recipe_controller::store();
});

//reseptin lisäyslomakkeen näyttäminen
$routes->get('/drink/new', function() {
    //HelloWorldController::drinks_list();
    recipe_controller::create();
});

$routes->get('/drink/:id', function($id) {
    recipe_controller::drinks_show($id);
});
