<?php

class ingredient_controller extends BaseController {

    public static function index() {
        $ingredients = Ingredient::all();
        View::make('ingredient/index.html', array('ingredients' => $ingredients));
    }

    public static function create() {
        View::make('ingredient/new.html');
    }

    public static function store() {
        $params = $_POST;
        $ingredient_attributes = array(
            'name' => $params['name']
        );

        $ingredient = new Ingredient($ingredient_attributes);

        //Validoidaan käyttäjän syötteet errors metodilla        
        $ingredient_errors = $ingredient->errors();

        if (count($ingredient_errors) == 0) {
            $ingredient->save();

            Redirect::to('/ingredient', array('message' => 'Lisäys ok :)'));
        } else {

            View::make('ingredient/new.html', array('errors' => $ingredient_errors, 'attributes' => $ingredient_attributes));
        }
    }

}
