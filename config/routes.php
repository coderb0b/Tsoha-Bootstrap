<?php

function check_logged_in() {
    BaseController::check_logged_in();
}

$routes->get('/', 'check_logged_in', function() {    
    HelloWorldController::drinks_main();
});

//Haku pääsivulta
$routes->post('/main', 'check_logged_in', function() {
    recipe_controller::search();
});

$routes->get('/hiekkalaatikko', 'check_logged_in', function() {
    HelloWorldController::sandbox();
});

$routes->get('/main', 'check_logged_in', function() {
    HelloWorldController::drinks_main();
});
// Kirjautuminen
// Kirjautumislomakkeen esittäminen
$routes->get('/login', function() {
    UserController::login();
});

//Kirjautumisen käsittely
$routes->post('/login', function() {
    UserController::handle_login();
});

// Uloskirjautuminen
$routes->post('/logout', function() {
    UserController::logout();
});

//reseptien listaus
$routes->get('/drink', 'check_logged_in', function() {
    //HelloWorldController::drinks_list();
    recipe_controller::index();
});

//ainesosien listaus
$routes->get('/ingredient', 'check_logged_in', function() {
    ingredient_controller::index();
});

//ainesosan lisäyslomakkeen näyttäminen
$routes->get('/ingredient/new', 'check_logged_in', function() {
    ingredient_controller::create();
});

//ainesosan lisääminen tietokantaan
$routes->post('/ingredient', 'check_logged_in', function() {
    ingredient_controller::store();
});

//reseptin lisääminen tietokantaan
$routes->post('/drink', 'check_logged_in', function() {
    recipe_controller::store();
});

//reseptin lisäyslomakkeen näyttäminen
$routes->get('/drink/new', 'check_logged_in', function() {
    //HelloWorldController::drinks_list();
    recipe_controller::create();
});
//reseptin listaus
$routes->get('/drink/:id', 'check_logged_in', function($id) {
    recipe_controller::drinks_show($id);
});

//Reseptin muokkauslomakkeen esittäminen
$routes->get('/drink/:id/edit', 'check_logged_in', function($id) {
    recipe_controller::edit($id);
});

//Reseptin muokkaaminen
$routes->post('/drink/:id/edit', 'check_logged_in', function($id) {
    recipe_controller::update($id);
});

//Reseptin poisto
$routes->post('/drink/:id/destroy', 'check_logged_in', function($id) {
    recipe_controller::destroy($id);
});


