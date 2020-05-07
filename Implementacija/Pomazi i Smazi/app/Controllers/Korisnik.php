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
 * Korisnik - klasa zadužena za prikaz odgovarajuće početne stranice privilegovanpg korisnika i obrade objave novog recepta, 
 * čuvanja recepata, uklanjanja recepata iz sačuvanih, prijave nepoželjnog sadržaja i ocenjivanja recepata
 *
 * @version 1.1
 */

class Korisnik extends BaseController {

    private $id=19;
    
    public function login_provera() {

        $_GET['meni']='meni_pocetna';
        $_GET['body']='body';
        $_GET['izbor']='main';
        
        $this->prikaz_stranice();
    }
	
/**
 * Funkcija koja otvara formu za pravljenje novog naloga
 *
 */

    public function napravi_nalog() {

        echo view("forme/novi_korisnik");
    }
    
/**
 * Funkcija koja na osnovu izbora kategorije filtriranja prikuplja podatke i otvara odgovaarajucu stranicu
 *
 * varijanta ULOGOVANI KORISNIK
 *
 * @version 1.0
 */	
	
    public function prikaz_stranice(){
        
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
            $body='body';
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
             $body='body';
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
             $body='body';
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
             $body='body';
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
             $body='body';
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
             $body='body';
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
             $body='body';  //
            break; 
            
/*            case 'sacuvana_jela':                     //za ovo treba da popunim tabelu sa receptima koje cuvam da bih mogla da uzmem recepte
                $i=0;
            foreach($svi_recepti as $recept)
            {
                if($recept->autor==$this->id ){
                $recepti[$i]=$recept;
                $i++;
                }
            }
             $body='body';  //
            break; 
            
            case 'moj_nalog':           //treba mi tabela recepara koje cuvam jer se tu listaju svi recepti i moji i sacuvani
                $i=0;
            foreach($svi_recepti as $recept)
            {
                if($recept->autor==$this->id ){
                $recepti[$i]=$recept;
                $i++;
                }
            }
             $body='body';  //
            break; */
            
            
        default :
            $body='body';
            $recepti=$svi_recepti;
            break;
        }
        
        
       /* if($_GET['izbor']=='slatko_cose'){
            $i=0;
            foreach($svi_recepti as $recept)
            {
                if($recept->k2){
                $recepti[$i]=$recept;
                $i++;
                }
            }
        }
        else
            $recepti=$svi_recepti;
        */
        
        $data=['recepti'=>$recepti];
     //   $data=['image'=>$image];
        echo view("stranice/headers/header");
        echo view("stranice/meni_stranice/".$_GET['meni']);
        echo view("stranice/body/".$body,$data);       //nisam sigurna kako ovo da napravim.
    }
	
/**
 * Funkcija koja otvara formu za unos novog recepta
 *
 *
 * @version 1.0
 */	
    
    public function novi_recept(){
        echo view("forme/novi_recept");
    }

/**
 * Funkcija koja otvara index stranicu
 *
 *
 * @version 1.0
 */	


    public function index_stranica(){
         echo view("forme/logovanje");
    }
    
/**
 * Funkcija koja je zadužena za napustanje naloga ulogovanog korisnika
 *
 *
 * @version 1.0
 */		
	
    public function logout(){
        echo view("forme/logovanje");
    }
	
/**
 * Funkcija koja pamti prijavu recepta od strane korisnika u bazi
 * Funkcija se poziva sa bilo koje stranice gde korisnik ima opciju "prijavi"
 * Na Administratorskoj stranici se prijavljeni recepti prikazuju
 *
 * @version 1.0
 */		
    
    public function prijava(){
       echo view("forme/logovanje");
    }
	
/**
 * Funkcija koja pamti u bazi koji korisnik je sacuvao koji recept. 
 * Funkcija se poziva sa bilo koje stranice gde korisnik ima opciju "sacuvaj" 
 * Upamceni recepti ce biti prikazani na stranici "sacuvano"
 *
 *
 * @version 1.0
 */		
    
    public function sacuvaj() {
        echo "sacuvaj";
    }
    
    public function nazad($meni,$body){
                
        $receptiModel=new ReceptiModel();
        $recepti=$receptiModel->findAll();
        
        $data=['recepti'=>$recepti];
        echo view("stranice/headers/header");
        echo view("stranice/meni_stranice/".$meni);
        echo view("stranice/".$body,$data);
    }
	
 /**
 * Funkcija zaduzena za pamćenje ocene recepta
 * Poziva se nakon sto korisnik za odabrani recept odabere ocenu.
 * Ujedno se "abdejtuju" ocene za recept i ocene za korisnika
 *
 * @version 1.0
 */   
    
    public function ocenjivanje($id,$o) {
       $receptModel=new ReceptiModel();
        $recepti=$receptModel->findAll();
        
        //$object=$receptModel->find($_GET['id']);
         $object=$receptModel->find($id);       
        $br=$object->brocena+1;
       //$oc=$object->ocena+$_GET['ocena'];
        $oc=$object->ocena+$o;
        
        $data=['ocena'=>$oc,'brocena'=>$br];
       // $receptModel->update($_GET['id'], $data);
       $receptModel->update($id, $data);
    
      //  redirect()->to("http://localhost:8080/index.php/Korisnik/login_provera");
    }
    
    //--------------------------------------------------------------------
}
