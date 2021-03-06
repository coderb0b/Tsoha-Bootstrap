<?php

  class BaseController{

    public static function get_user_logged_in(){
      // Toteuta kirjautuneen käyttäjän haku tähän
      
        //Katsotaan onko user-avain sessiossa
        if (isset($_SESSION['user'])) {
            $user_id = $_SESSION['user'];
            //Pyydetään Client-mallilta session mukaista id:tä
            $user = Client::find($user_id);
            return $user;
        }
        //käyttäjä ei ole kirjautunut.
      return null;
    }

    public static function check_logged_in(){
      // Toteuta kirjautumisen tarkistus tähän.
      // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
      if (!isset($_SESSION['user'])) {
          Redirect::to('/login', array('message' => 'Kirjaudu sisään'));
      }
    }

  }
