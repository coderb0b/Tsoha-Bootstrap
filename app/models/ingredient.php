<?php

class Ingredient extends BaseModel {

    public $id, $name;

    public function __construct($attributes = null) {
        parent::__construct($attributes);
        $this->validators = array('validate_name');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Ingredient');
        $query->execute();
        $rows = $query->fetchAll();
        $ingredients = array();

        foreach ($rows as $row) {
            $ingredients[] = new Ingredient(array(
                'id' => $row['id'],
                'name' => $row['name']
            ));
        }
        return $ingredients;
    }

    //Haetaan kaikki reseptiin liittyvät ainesosat $id on reseptin id.
    public static function find($id) {
        $query = DB::connection()->prepare('SELECT Recipe.name AS recipe, Ingredient.id AS id, Ingredient.name AS ingredient FROM Recipe, recipe_ingredient, Ingredient WHERE Recipe.id = recipe_ingredient.recipe_id AND recipe_ingredient.ingredient_id = Ingredient.id AND Recipe.id = :id');
        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();
        $ingredients[] = null;

        foreach ($rows as $row) {
            $ingredients[] = new Ingredient(array(
                'id' => $row['id'],
                'name' => $row['ingredient']
            ));
        }

        //Kint::dump($ingredients);
        //die();
        if ($ingredients == null) {
            return null;
        }
        return $ingredients;
    }
    
    //Haetaan kaikki ainesosaan liittyvät reseptit $id on ainesosan id.
    public static function findByIngredient($id) {
        $query = DB::connection()->prepare('SELECT recipe.name AS recipe, recipe.id AS id, ingredient.name AS ingredient FROM recipe, recipe_ingredient, ingredient WHERE recipe.id = recipe_ingredient.recipe_id AND recipe_ingredient.ingredient_id = ingredient.id AND ingredient.id = :id');
        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();

        
        $recipes = array();

        foreach ($rows as $row) {
            $recipes[] = new Recipe(array(
                'id' => $row['id'],
                'name' => $row['recipe']
            ));
        }
        
        return $recipes;
    }

    public function save() {
        // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon

        $query = DB::connection()->prepare('INSERT INTO Ingredient (name) VALUES (:name) RETURNING id');
        $query->execute(array('name' => $this->name));

        //haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
        $row = $query->fetch();
        //asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
        $this->id = $row['id'];
    }

}
