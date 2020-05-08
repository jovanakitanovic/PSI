<?php namespace App\Controllers;
/**
 *	Autor: Jovana Kitanovic 0603/17
 *
 */

use App\Models\ReceptiModel;
use App\Models\KorisnikModel;
use App\Models\KorisnikOcenaModel;
use App\Models\SacuvanoModel;
use App\Models\PrijavaModel;

/**
 * Gost - klasa zadužena za prikaz odgovarajuće početne stranice neprivilegovanog korisnika i obavljanja logovanja i registracije novog korisnika
 *
 * @version 1.2
 */

class Gost extends BaseController
{
	public function gost_pristup()
	{
         $_GET['meni']='meni_gost';
         $_GET['body']='body';
         $_GET['izbor']='main';
         
         $this->prikaz_stranice();
	}
     
/**
 * Funkcija koja na osnovu izbora kategorije filtriranja prikuplja podatke i otvara odgovaarajucu stranicu
 *
 * varijanta Gost
 *
 * @version 1.1
 */
 
    public function prikaz_stranice()
        {
         
        
       // $image = \Config\Services::image() ->withFile('/image/patka.jpg');
       $izbor=$_GET['izbor'];
        $recepti=array();
        
        $receptiModel=new ReceptiModel();
        $svi_recepti=$receptiModel->findAll();
        
        switch ($izbor){
            
            case 'slatko_cose':
                $i=0;
            foreach($svi_recepti as $recept)
            {
                if($recept->k2){
                $recepti[$i]=$recept;
                $i++;
                }
            }
            $body='body_B';
            break;
            
            case 'za_mesojede':
                $i=0;
            foreach($svi_recepti as $recept)
            {
                if($recept->k1){
                $recepti[$i]=$recept;
                $i++;
                }
            }
             $body='body_B';
            break;    
          
            case 'svakojaka_testa':
                $i=0;
            foreach($svi_recepti as $recept)
            {
                if($recept->k3){
                $recepti[$i]=$recept;
                $i++;
                }
            }
             $body='body_B';
            break;    
            
            case 'izvrsni_kuvar':
                $i=0;
            foreach($svi_recepti as $recept)
            {
                if($recept->ocena/$recept->brocena>4){
                $recepti[$i]=$recept;
                $i++;
                }
            }
             $body='body_B';
            break;    

            case 'odlicni_kuvar':
                $i=0;
            foreach($svi_recepti as $recept)
            {
                if($recept->ocena/$recept->brocena>2 && $recept->ocena/$recept->brocena<=4 ){
                $recepti[$i]=$recept;
                $i++;
                }
            }
             $body='body_B';
            break;  
            
            case 'solidni_kuvar':
                $i=0;
            foreach($svi_recepti as $recept)
            {
                if($recept->ocena/$recept->brocena<=2 ){
                $recepti[$i]=$recept;
                $i++;
                }
            }
             $body='body_B';     //treba da se doda ona linija sa ocenom
            break;  
            
            case 'moja_jela':
                $i=0;
            foreach($svi_recepti as $recept)
            {
                if($recept->autor==$this->id ){
                $recepti[$i]=$recept;
                $i++;
                }
            }
             $body='body_B';  //
            break; 

            
        default :
            $body='body_B';
            $recepti=$svi_recepti;
            break;
        }

        $data=['recepti'=>$recepti];
     //   $data=['image'=>$image];
        echo view("stranice/headers/header");
        echo view("stranice/meni_stranice/".$_GET['meni']);
        echo view("stranice/body/".$body,$data);       //nisam sigurna kako ovo da napravim.
        }

/**
 * Funkcija koja otvara stranicu za logovanje
 *
 * @version 1.0
 */
 
        public function login(){                    // u suštini isto kao i Korisnik/logout samo što je ovako lepše spakovano
             echo view("forme/logovanje");
        }

	//--------------------------------------------------------------------

}
