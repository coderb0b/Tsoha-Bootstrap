<?php

class Recipe extends BaseModel {

    public $id, $name, $description, $instructions, $added;

    public function __construct($attributes = null) {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_description');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Recipe');
        $query->execute();
        $rows = $query->fetchAll();
        $recipes = array();

        //Käydään kyselyn tuottamat rivit läpi
        foreach ($rows as $row) {
            $recipes[] = new Recipe(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'description' => $row['description'],
                'instructions' => $row['instructions'],
                'added' => $row['added']
            ));
        }

        return $recipes;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Recipe WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $recipe = new Recipe(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'description' => $row['description'],
                'instructions' => $row['instructions'],
                'added' => $row['added']
            ));
            return $recipe;
        }
        return null;
    }

    //Tallennetaan olio tietokantaan
    public function save() {
        // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon

        $query = DB::connection()->prepare('INSERT INTO Recipe (name, description, instructions, added) VALUES (:name, :description, :instructions, NOW()) RETURNING id');
        $query->execute(array('name' => $this->name, 'description' => $this->description, 'instructions' => $this->instructions));

        //haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
        $row = $query->fetch();
        //asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
        $this->id = $row['id'];
    }

    public function update($id) {
        $query = DB::connection()->prepare('UPDATE Recipe SET name=:name, description=:description, instructions=:instructions WHERE id = :id');
        $query->execute(array('name' => $this->name, 'description' => $this->description, 'instructions' => $this->instructions, 'id' => $id));
    }
    
    public function destroy($id) {
        $query = DB::connection()->prepare('DELETE FROM Recipe WHERE id = :id');
        $query->execute(array('id' => $id));
    }

}
