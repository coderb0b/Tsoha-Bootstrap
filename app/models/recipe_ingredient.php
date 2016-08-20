<?php

class Recipe_ingredient {
    
    public $recipeId, $ingredienId;
/*    
    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }
*/    
    public function save($recipeId, $ingredienId) {
        $query = DB::connection()->prepare('INSERT INTO recipe_ingredient VALUES (:recipeId, :ingredientId)');
        $query->execute(array('recipeId' => $recipeId, 'ingredientId' => $ingredienId));
    }
}
