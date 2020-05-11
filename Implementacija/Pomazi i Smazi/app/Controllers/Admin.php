<?php namespace App\Controllers;

/**
 * Autor: Maja Licina 0506/17
 *
 * @version 1.1
 */

use App\Models\ReceptiModel;
use App\Models\KorisnikModel;
use App\Models\KorisnikModelOperacije;
use App\Models\KorisnikOcenaModel;
use App\Models\SacuvanoModel;
use App\Models\PrijavaModel;

/**
 * Admin - klasa zadužena za obradu funkcionalnosti vezanih za ulogu administratora, kao i za prikaz odgovarajuće početne stranice
 *
 * @version 1.1
 */

class Admin extends BaseController {

    /**
	 * Funkcija koja obezbeđuje prikaz početne stranice - postavlja odgovarajući header i meni i pronalazi sadržaj koji će biti prikazan
	 *
	 * @return void
	 *
	 * @version 1.1
	 */
    public function prikaz_stranice(){
        
        $recepti=array();
        
        $prijavaModel = new PrijavaModel();
        $prijavljeni_recepti = $prijavaModel->findAll();
        $receptiModel = new ReceptiModel();
        
        foreach($prijavljeni_recepti as $pr) {
            if(!isset($recepti[$pr->idR])) {
                $recepti[$pr->idR]=array();
                $recepti[$pr->idR]['recept'] = $receptiModel->find($pr->idR);
                $recepti[$pr->idR]['broj'] = 1;
            } else {
                $recepti[$pr->idR]['broj']++;
            }
        }
        
        
        $data=['recepti'=>$recepti];
        echo view("stranice/headers/header_admin");
        echo view("stranice/meni_stranice/meni_admin");
        echo view("stranice/body/body_admin",$data);       //nisam sigurna kako ovo da napravim.
        
     
    }
    
    /**
	 * Funkcija koja je zadužena za uništavanje sesije i preusmeravanje da odgovarajuću stranu kada se administrator izloguje
	 *
	 * @return void
	 *
	 *@version 1.0
	 */
    public function logout(){
        session_destroy();
        echo view("forme/logovanje");
    }
    
    /**
	 * Kada administrator pritiskom na odgovarajuće dugme odluči da prijavljeni recept treba da se ostavi,
	 * poziva se funkcija koja iz baze uklanja prijavu
	 *
	 * @return void
	 *
	 * @version 1.0
	 */
    public function ostavi()
    {
          
        $prijavaModel=new PrijavaModel();
        $id=$_GET['id'];
        $prijavaModel->where('idR',$id);
        $prijavaModel->delete();

        $this->prikaz_stranice();          
            

    }
    
    /**
	 * Kada administrator pritiskom na odgovarajuće dugme odluči da prijavljeni recept treba da se ukloni,
	 * poziva se funkcija koja iz baze uklanja prijavu i sam prijavljeni recept
	 *
	 * @return void
	 *
	 * @version 1.0
	 */
    public function izbaci(){
            
        $prijavaModel=new PrijavaModel();
        $receptiModel=new ReceptiModel();
        $id=$_GET['id'];
        $prijavaModel->where('idR',$id);
        $prijavaModel->delete();
        $receptiModel->delete($id);

        $this->prikaz_stranice();
            
        
    }

    //--------------------------------------------------------------------
}
