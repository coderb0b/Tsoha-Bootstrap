<?php

class recipe_controller extends BaseController {
    public static function index() {
        $recipes = Recipe::all();
        View::make('recipe/index.html', array('recipes' => $recipes));
    }
    
    public static function drinks_show($id) {
        $recipe = Recipe::find($id);
        //renderöidään drink_show.html muuttujalla $recipe
        View::make('recipe/drink_show.html', array('recipe' => $recipe));
    }
    
    public static function create() {        
        View::make('recipe/new.html');
    }
    
    public static function store() {
        $params = $_POST; //POST-pyynnön muuttujat
        
        $recipe = new Recipe(array(
           'name'  => $params['name'],
            'description' => $params['description'],            
            'instructions' => $params['instructions']
        ));
        
        $recipe->save();
        
        $ingredient = new Ingredient(array(
           'name'  => $params['name']
        ));
        
        $ingredient->save();
        
        //Tähän tulee $recipe_ingredient tauluun tarvittavat jutut....
        /*
        Kint::dump($recipe->id);
        Kint::dump($ingredient->id);
        */
                
        $recipe_ingredient = new Recipe_ingredient();
        $recipe_ingredient->save($recipe->id, $ingredient->id);
        
        
        
        Redirect::to('/drink/' . $recipe->id, array('message' => 'Lisäys ok :)'));
    }
}
