<?php namespace App\Controllers;

/**
 * Autori: Jovana Kitanović 17/0603 
 */
 
class Gost extends BaseController
{
	public function gost_pristup()
	{
         $_GET['meni']='meni_gost';
         $_GET['body']='body';
         
         $this->prikaz_stranice();
	}
            
	/**
	 * Funkcija koja na sklapa sptranicu za korisnika
	 *
	 * @return void
	 *
	 */
		
        public function prikaz_stranice()
        {
        echo view("stranice/headers/header_gost");
        echo view("stranice/meni_stranice/".$_GET['meni']);
        echo view("stranice/".$_GET['body']);       //nisam sigurna kako ovo da napravim.
        
        }
        
        public function login(){                    // u suštini isto kao i Korisnik/logout samo što je ovako lepše spakovano
             echo view("forme/logovanje");
        }

	//--------------------------------------------------------------------

}
