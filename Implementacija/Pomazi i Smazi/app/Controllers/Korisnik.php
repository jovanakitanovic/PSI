<?php namespace App\Controllers;

/**
 *	Autori: Jovana Kitanovic 0603/17, Maja Licina 0506/17
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
 * @version 1.2
 */

class Korisnik extends BaseController {

    /**
	 * Funkcija zadužena za proveru unetih kredencijala prilikom logovanja 
	 * U slučaju uspeha preusmerava korisnika na odgovarajuću početnu stranu, a u slučaju neuspeha ispisuje odgovarajuću poruku
	 *
	 * @return RedirectResponse|void
	 *
	 * @version 1.1
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
        if($korisnik[0]['admin']==0){
            
        $this->id=$korisnik[0]['id'];    
        

        $_SESSION['id']=$korisnik[0]['id'];
        
        $_GET['meni']='meni_pocetna';
        $_GET['body']='body';
        $_GET['izbor']='main';

            return $this->prikaz_stranice();
        } else {
            header("Location: ".site_url("Admin/prikaz_stranice"));
            exit;
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
 * Funkcija koja na osnovu izbora kategorije filtriranja prikuplja podatke i otvara odgovaarajucu stranicu
 *
 * varijanta ULOGOVANI KORISNIK
 *
 * @version 1.1
 */	
    
    public function prikaz_stranice(){
        
       // $image = \Config\Services::image() ->withFile('/image/patka.jpg');
     if(isset($_SESSION['id']))  {
        if(isset($_GET['izbor'])){
        $izbor=$_GET['izbor'];
        $_SESSION['izbor']=$izbor;
        }
        else
       $izbor=$_SESSION['izbor'];
        
        if(isset($_GET['meni'])){
        $meni=$_GET['meni'];
        $_SESSION['meni']=$meni;
        }
        else
            $meni=$_SESSION['meni'];
        
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
                $id=$_SESSION['id'];
            foreach($svi_recepti as $recept)
            {
                if($recept->autor==$id ){
                $recepti[$i]=$recept;
                $i++;
                }
            }
             $body='body_B';  //
            break; 
            
           case 'sacuvana_jela':                     //za ovo treba da popunim tabelu sa receptima koje cuvam da bih mogla da uzmem recepte
                $i=0;
               $id=$_SESSION['id'];
              
            $sacuvano = ['idK' => $id];
            $sacuvanoModel=new SacuvanoModel();
            $sacuvani= $sacuvanoModel->getWhere($sacuvano);
             $sacuvani = $sacuvani->getResultObject();
            
            foreach($sacuvani as $s)
            {
                $recept=$receptiModel->find($s->idR);
                $recepti[$i]=$recept;
                $i++;
                
            }
             $body='body_sacuvano';  //
            break; 
            
           case 'moj_nalog':           //treba mi tabela recepara koje cuvam jer se tu listaju svi recepti i moji i sacuvani
                $i=0;
                 $id=$_SESSION['id'];
                 
                            
            $sacuvano = ['idK' => $id];
            $sacuvanoModel=new SacuvanoModel();
            $sacuvani= $sacuvanoModel->getWhere($sacuvano);
            $sacuvani = $sacuvani->getResultObject();  
            
            foreach($sacuvani as $s)
            {
                $recept=$receptiModel->find($s->idR);
                $recepti[$i]=$recept;
                $i++;
                
            }
                 
            foreach($svi_recepti as $recept)
            {
                if($recept->autor==$id ){
                $recepti[$i]=$recept;
                $i++;
                }
            }
            
             $body='body_B';  
            break; 
            
            
        default :
            $body='body';
            $recepti=$svi_recepti;
            break;
        }
        

        
        $data=['recepti'=>$recepti];
        echo view("stranice/headers/header");
        echo view("stranice/meni_stranice/".$meni);
        echo view("stranice/body/".$body,$data);       //nisam sigurna kako ovo da napravim.
        
     }else
         $this->index_stranica ();
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
 * @version 1.1
 */	
   
    public function logout(){
        echo view("forme/logovanje");
        session_destroy();
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
 * @version 1.2
 */	
    
    public function sacuvaj()
    {
      if(isset($_SESSION['id']))  {
          
        $sacuvanoModel=new SacuvanoModel();  
        $idk=$_SESSION['id'];
        $id=$_GET['id'];

        
       $sacuvano = ['idK' => $idk, 'idR' => $id];

         $provera = $sacuvanoModel->getWhere($sacuvano);
         $provera = $provera->getResultObject();

            $i = 0;

         foreach ($provera as $p) {
               if ($p->idK == $idk && $p->idR) {
                   $i++;
               }
            }
            
         if($i==0){
           
           $sacuvanoModel->insert($sacuvano);
         }   
          else echo "<script>alert('recept je vec sacuvan');</script>";

        $this->prikaz_stranice();          
            
        } else
            $this->index_stranica();

    }
   
/**
 * Funkcija zaduzena za izbacivanje recepta iz tabele sacuvanih recepata
 *
 * @version 1.1
 * 
 */
    
     public function izbaci(){
        if(isset($_SESSION['id']))  {
            
            $sacuvanoModel=new SacuvanoModel();
            
            $idk=$_SESSION['id'];
            $idr=$_GET['id'];

            
            $sacuvano=['idK'=>$idk,'idR'=>$idr];


            $provera = $sacuvanoModel->getWhere($sacuvano);
            $provera = $provera->getResultObject();
            
           $sacuvanoModel->where('idK', $idk); 
           $sacuvanoModel->where('idR', $idr); 
           $sacuvanoModel->delete();
            
            $this->prikaz_stranice();
            
        }
          else
          $this->index_stranica ();
    }

/**
 * Funkcija koja pamti u bazi koji korisnik je sacuvao koji recept. 
 * Funkcija se poziva sa bilo koje stranice gde korisnik ima opciju "sacuvaj" 
 * Upamceni recepti ce biti prikazani na stranici "sacuvano"
 *
 *
 * @version 1.2
 */	
    
     public function ocenjivanje() {
       if(isset($_SESSION['id']))  {
       $receptModel=new ReceptiModel();
       $ocenjenoModel=new KorisnikOcenaModel();
        
     
        $idk=$_SESSION['id'];
        $id=$_GET['id'];
        $o=$_GET['o'];
        $sacuvano=['idK'=>$idk,'idR'=>$id];
        $recept=$receptModel->find($id);
        
       if($recept->autor==$idk){
           echo "<script>alert('ne možete oceniti vaš recept');</script>";
            $this->prikaz_stranice();
       }else{
        
        $provera=$ocenjenoModel->getWhere($sacuvano);
        $provera=$provera->getResultObject();

        $i=0;
        
        foreach ($provera as $p){
            //echo "lala";
            if($p->idK==$idk && $p->idR=$id){
                $i++;
            }
        }
        
       if($i==0){ 
        $recepti=$receptModel->findAll();
        $rec=$receptModel->find($id);
        
        $sum=0;
        $cnt=0;
                       
        
        $object=$receptModel->find($id);       
        $br=$object->brocena+1;
        $oc=$object->ocena+$o;
        
        
        $data=['ocena'=>$oc,'brocena'=>$br];
        $receptModel->update($id, $data);
    
        $ocenjenoModel->insert($sacuvano);
       
       
        foreach ($recepti as $recept){
            if($recept->autor==$rec->autor)
            {
                if($recept->brocena>0)
                $sum=$sum+($recept->ocena/$recept->brocena); 
                $cnt++;
            }
        }

        
        $korisnikModel=new KorisnikModelOperacije();

       $ocena=['ocena'=>$sum/$cnt];
       $korisnikModel->update($rec->autor,$ocena);
       
        }else echo "<script>alert('recept je vec ocenjen');</script>";
                
        $this->prikaz_stranice();
        }
         
       }
          else
          $this->index_stranica ();
    }
    
    
    //--------------------------------------------------------------------
}
