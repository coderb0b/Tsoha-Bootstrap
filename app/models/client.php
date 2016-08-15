<?php

class Client extends BaseModel {

    public $id, $name, $password, $admin;

    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Client');
        $query->execute();
        $rows = $query->fetchAll();
        $clients = array();

        //Käydään kyselyn tuottamat rivit läpi
        foreach ($rows as $row) {
            $clients[] = new Client(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password'],
                'admin' => $row['admin']
            ));
        }

        return $clients;
    }

}
