<?php

class recipe_controller extends BaseController {

    public static function index() {
        $recipes = Recipe::all();
        View::make('recipe/index.html', array('recipes' => $recipes));
    }

    public static function drinks_show($id) {
        $recipe = Recipe::find($id);
        $ingredients = Ingredient::find($id);
        //renderöidään drink_show.html muuttujalla $recipe
        View::make('recipe/drink_show.html', array('recipe' => $recipe, 'ingredients' => $ingredients));
    }

    public static function create() {
        View::make('recipe/new.html');
    }

    //Haku pääsivulta
    public static function search() {
        $params = $_POST; //POST-pyynön muuttujat
        /*     $search_attributes = array(
          'name' => $params['name']
          );
         */

        $search_value = $params['name'];

        $recipes = Recipe::search($search_value);
        View::make('recipe/index.html', array('recipes' => $recipes));
    }

    public static function store() {
        $params = $_POST; //POST-pyynnön muuttujat
        $recipe_attributes = array(
            'name' => $params['name'],
            'description' => $params['description'],
            'instructions' => $params['instructions'],
            'ingredient' => $params['ingredient']
        );
        $ingredient_attributes = array(
            'name' => $params['ingredient']
        );

        $recipe = new Recipe($recipe_attributes);
        $ingredient = new Ingredient($ingredient_attributes);

        //Validoidaan käyttäjän syötteet errors metodilla
        $recipe_errors = $recipe->errors();
        $ingredient_errors = $ingredient->errors();

        if (count($recipe_errors) == 0 && count($ingredient_errors) == 0) {
            $recipe->save();
            $ingredient->save();
            /*
              $ingredient = new Ingredient(array(
              'name' => $params['ingredient']
              ));
             */


            //Tähän tulee $recipe_ingredient tauluun tarvittavat jutut....
            /*
              Kint::dump($recipe->id);
              Kint::dump($ingredient->id);
             */

            $recipe_ingredient = new Recipe_ingredient();
            $recipe_ingredient->save($recipe->id, $ingredient->id);


            Redirect::to('/drink/' . $recipe->id, array('message' => 'Lisäys ok :)'));
        } else {
            //Tähän pitää lisätä $ingredient_errors mukaan..
            View::make('recipe/new.html', array('errors' => $recipe_errors, 'attributes' => $recipe_attributes));
        }
    }

    //Muokkauslomakkeen esittäminen
    public static function edit($id) {
        $recipe = Recipe::find($id);
        View::make('recipe/edit.html', array('attributes' => $recipe));
    }

    //Varsinainen muokkaus (lomakkeen käsittely)
    public static function update($id) {
        $params = $_POST;

        $recipe_attributes = array(
            'id' => $id,
            'name' => $params['name'],
            'description' => $params['description'],
            'instructions' => $params['instructions'],
        );

        //Alustetaan Recipe-olio uusilla tiedoilla
        $recipe = new Recipe($recipe_attributes);
        //Kint::dump($recipe);
        //die();
        $recipe_errors = $recipe->errors();

        if (count($recipe_errors) > 0) {
            View::make('recipe/edit.html', array('errors' => $recipe_errors, 'attributes' => $recipe_attributes));
        } else {
            //Kutsutaan alustetun olion update-metodia, joka päivittää tiedot kantaan.
            $recipe->update($id);
            Redirect::to('/drink/' . $recipe->id, array('message' => 'Muokkaus ok.'));
        }
    }

    //Poisto
    public static function destroy($id) {
        //Alustetaan Recipe-olio annetulla id:llä
        $recipe = new Recipe(array('id' => $id));
        //Kutsutaan Recipe-luokan metodia destroy, joka poistaa id:n mukaisen recipen
        $recipe->destroy($id);

        Redirect::to('/drink', array('message' => 'Poisto ok.'));
    }

}
