<?php


class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja.
        //View::make('home.html');
        echo 'Tämä on etusivu!';
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
        //echo 'Hello World!';
        //View::make('helloworld.html');
        $clients = Client::all();
        Kint::dump($clients);
        $recipes = Recipe::all();
        Kint::dump($recipes);
    }

    public static function drinks_main() {
        View::make('suunnitelmat/main.html');
    }
    
    public static function login() {
        View::make('suunnitelmat/login.html');
    }

    public static function drinks_list() {
        View::make('recipe/drink.html');
    }
    
    

}
