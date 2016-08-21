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
//reseptin listaus
$routes->get('/drink/:id', function($id) {
    recipe_controller::drinks_show($id);
});

//Reseptin muokkauslomakkeen esittäminen
$routes->get('/drink/:id/edit', function($id) {
    recipe_controller::edit($id);
});

//Reseptin muokkaaminen
$routes->post('/drink/:id/edit', function($id) {
    recipe_controller::update($id);
});

//Reseptin poisto
$routes->post('/drink/:id/destroy', function($id) {
    recipe_controller::destroy($id);
});

