<?php

/**
 * Autori: Jovana Kitanović 17/0603 
 */

namespace App\Controllers;

/**
 * Korisnik - klasa zadužena za prikaz odgovarajuće početne stranice privilegovanpg korisnika i obrade objave novog recepta, 
 * čuvanja recepata, uklanjanja recepata iz sačuvanih, prijave nepoželjnog sadržaja i ocenjivanja recepata
 *
 * @version 1.0
 */

class Korisnik extends BaseController {

    public function login_provera() {

        $_GET['meni']='meni_pocetna';
        $_GET['body']='body';
        
        $this->prikaz_stranice();
    }


    
	/**
	 * Funkcija koja na sklapa sptranicu za korisnika
	 *
	 * @return void
	 *
	 */
	
    public function prikaz_stranice(){
        
        echo view("stranice/headers/header");
        echo view("stranice/meni_stranice/".$_GET['meni']);
        echo view("stranice/".$_GET['body']);       //nisam sigurna kako ovo da napravim.
    }
	
	/**
	 * Funkcija koja otvara formu za logovanje
	 *
	 * @return void
	 *
	 */


    public function logout(){
        echo view("forme/logovanje");
    }
    //--------------------------------------------------------------------
}
