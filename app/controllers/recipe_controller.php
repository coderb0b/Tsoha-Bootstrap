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
}
