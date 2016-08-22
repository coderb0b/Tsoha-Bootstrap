<?php

class Client extends BaseModel {

    public $id, $name, $password, $admin;
    

    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }

    public static function authenticate($username, $password) {
        $query = DB::connection()->prepare('SELECT * FROM Client WHERE Name = :username AND password = :password LIMIT 1');
        $query->execute(array('username' => $username, 'password' => $password));
        $row = $query->fetch();

        if ($row) {
            $client = new Client(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password'],
                'admin' => $row['admin']
            ));
            return $client;
        }
        return null;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Client WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $client = new Client(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password'],
                'admin' => $row['admin']
            ));
            return $client;
        }
        return null;
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
