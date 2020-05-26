<?php namespace App\Controllers;

/**
 *  Autor: Jovana Kitanovic 0603/17 i Maja Licina 17/0506
 *
 */

use App\Models\KorisnikModelOperacije;
use App\Models\ReceptiModel;
use App\Models\KorisnikModel;
use App\Models\KorisnikOcenaModel;
use App\Models\SacuvanoModel;
use App\Models\PrijavaModel;

/**
 * Gost - klasa zadužena za prikaz odgovarajuće početne stranice neprivilegovanog korisnika i obavljanja logovanja i registracije novog korisnika
 *
 * @version 1.5
 */

class Gost extends BaseController
{
    	
    /**
     * Funkcija koja prikazuje index stranicu 
     *
     * @version 1.0
     */
    
    public function index_stranica(){
         echo view("forme/logovanje");
    }
   
    /**
     * Funkcija zadužena za proveru unetih kredencijala prilikom logovanja 
     * U slučaju uspeha preusmerava korisnika na odgovarajuću početnu stranu, a u slučaju neuspeha ispisuje odgovarajuću poruku
     *
     * @return RedirectResponse|void
     *
     * @version 1.2
     *
     */
    
    public function login_provera() {
        
        if(!$this->validate(['username'=>'required', 'password'=>'required'])) {
            $GLOBALS['error']=$this->validator->getErrors();
            return $this->index_stranica();
        }
        
        $korisnikModel=new KorisnikModel();
        $korisnik=$korisnikModel->pretragaUsername($this->request->getVar('username'));
        
        if(empty($korisnik)) {
            $GLOBALS['error']['user']="Korisnik ne postoji.";
            return $this->index_stranica();
        }
        
        if($korisnik[0]['sifra']!=hash('sha512',$this->request->getVar('password'))) {
            $GLOBALS['error']['pass']="Pogresna lozinka.";
            return $this->index_stranica();
        }
        
        $this->session->set('korisnik', $korisnik[0]); 
        $this->id=$korisnik[0]['id'];    
        $_SESSION['id']=$korisnik[0]['id'];
        
        if($korisnik[0]['admin']==0){
           
            $_GET['meni']='meni_pocetna';
            $_GET['body']='body';
            $_GET['izbor']='main';

        return redirect()->to(site_url('Korisnik/prikaz_stranice'));
        } else {
            return redirect()->to(site_url('Admin/prikaz_stranice'));
        }
    }

    /**
     * Funkcija koja dodaje novog korisnika u bazu na osnovu unetih podataka
     *
     * @return void
     *
     * version 1.0
     *
     */

        public function pravljenje_naloga() {
        if(!$this->validate(['username'=>'required', 'password'=>'required', 'ime'=>'required', 'prezime'=>'required'])) {
            $GLOBALS['error']=$this->validator->getErrors();
            return $this->napravi_nalog();
        }
        
        $korisnikModel=new KorisnikModel();
        $korisnik=$korisnikModel->pretragaUsername($this->request->getVar('username'));
        
        if(!empty($korisnik)) {
            $GLOBALS['error']['user']="Korisnik vec postoji.";
            return $this->napravi_nalog();
        }
        
        $korisnikModel->save([
            'ime'=>$this->request->getVar('ime'),
            'prezime'=>$this->request->getVar('prezime'),
            'username'=>$this->request->getVar('username'),
            'sifra'=>hash('sha512',$this->request->getVar('password')),
            'admin'=>0
        ]);
        
        $this->index_stranica();
        
    }
    
    /**
    * Funkcija koja otvara formu za pravljenje novog naloga
    * 
    *
    * @version 1.0
    */
    
    public function napravi_nalog() {

        echo view("forme/novi_korisnik");
    }
    	
    /**
    * Funkcija koja vrsi odabir potrebnih delova pocetne stranice gosta 
    *
    * @version 1.0
     */
    
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
    * @version 1.3
    */
        
        public function prikaz_stranice() {
       
            
        if(isset($_GET['izbor'])){
            $izbor=$_GET['izbor'];
        }
        else if(isset($_SESSION['izbor']))
            $izbor=$_SESSION['izbor'];
        else 
            $izbor='svi_recepti';
        $_SESSION['izbor']=$izbor;
        
        if(isset($_GET['meni'])){
            $meni=$_GET['meni'];
        }
        else if(isset($_SESSION['meni']))
            $meni=$_SESSION['meni'];
        else
            $meni='meni_pocetna';
        $_SESSION['meni']=$meni;
        
        $recepti=array();
        
        $receptiModel=new ReceptiModel();
        $svi_recepti=$receptiModel->dohvati_sve_recepte();

        
        switch ($izbor){
            
            case 'slatko_cose':
                $i=0;
              $recepti_kategorija=$receptiModel->dohvati_recepte_slatko();
            foreach($recepti_kategorija as $recept)
            {
               
                $recepti[$i]=$recept;
                $i++;
                
            }
            $body='body_B';
            break;
            
            case 'za_mesojede':
                $i=0;
            $recepti_kategorija=$receptiModel->dohvati_recepte_meso();
            foreach($recepti_kategorija as $recept)
            {
               
                $recepti[$i]=$recept;
                $i++;
                
            }
            $body='body_B';
            break;    
          
            case 'svakojaka_testa':
                $i=0;
            $recepti_kategorija=$receptiModel->dohvati_recepte_testo();
            foreach($recepti_kategorija as $recept)
            {
               
                $recepti[$i]=$recept;
                $i++;
                
            }
            $body='body_B';
            break;    
             
            case 'izvrsni_kuvar':
                $i=0;
                
            $korisnikModel=new KorisnikModelOperacije();                       
             $kuvar= $korisnikModel->dohvati_sve_korisnike();
            foreach($kuvar as $k)
            {
                
                if($k->ocena>4){
                   
                    $recept=$receptiModel->dohvati_po_id_autora($k->id);  
                    
                  foreach ($recept as $r){
                       
                    $recepti[$i]=$r;
                    $i++;
                    }
                }
            }
            
             $body='body_B';
            break;    

            
            case 'odlicni_kuvar':
               $i=0;
                
            $korisnikModel=new KorisnikModelOperacije();                       
            $kuvar= $korisnikModel->dohvati_sve_korisnike();

            foreach($kuvar as $k)
            {
                
                if($k->ocena>2 && $k->ocena<=4){
                 
                     $recept=$receptiModel->dohvati_po_id_autora($k->id);
                    
                  foreach ($recept as $r){
                      
                    $recepti[$i]=$r;
                    $i++;
                    }
                }
            }
                        
                        
            $body='body_B';
            break;  
            
            case 'solidni_kuvar':
               $i=0;
                
            $korisnikModel=new KorisnikModelOperacije();                       
             $kuvar= $korisnikModel->dohvati_sve_korisnike();

            foreach($kuvar as $k)
            {
                
                if($k->ocena<=2 ){
                 
                   $recept=$receptiModel->dohvati_po_id_autora($k->id);
                    
                  foreach ($recept as $r){
                      
                    $recepti[$i]=$r;
                    $i++;
                    }
                }
            }
            
             $body='body_B';
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
        echo view("stranice/headers/header_gost");
        echo view("stranice/meni_stranice/".$_GET['meni']);
        echo view("stranice/body/".$body,$data);       //nisam sigurna kako ovo da napravim.
        }
 
    /**
    * Funkcija koja otvara stranicu za logovanje
    *
    * @version 1.1
    */
        
        public function login(){                    // u suštini isto kao i Korisnik/logout samo što je ovako lepše spakovano
             $_SESSION['izbor']='sva_jela';
            $_SESSION['meni']='meni_pocetna';
            return $this->index_stranica();
        }

	//--------------------------------------------------------------------

}
