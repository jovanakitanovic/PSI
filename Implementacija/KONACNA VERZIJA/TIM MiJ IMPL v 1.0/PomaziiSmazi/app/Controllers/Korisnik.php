<?php namespace App\Controllers;

/**
 *	Autori: Jovana Kitanovic 0603/17, Maja Licina 0506/17
 *
 */

use App\Models\ReceptiModel;
use App\Models\KorisnikModel;
use App\Models\KorisnikModelOperacije;
use App\Models\KorisnikOcenaModel;
use App\Models\SacuvanoModel;
use App\Models\PrijavaModel;

/**
 * Korisnik - klasa zadužena za prikaz odgovarajuće početne stranice privilegovanpg korisnika i obrade objave novog recepta, 
 * čuvanja recepata, uklanjanja recepata iz sačuvanih, prijave nepoželjnog sadržaja i ocenjivanja recepata
 *
 * @version 1.6
 */


class Korisnik extends BaseController {

 /**
 * Funkcija koja na osnovu izbora kategorije filtriranja prikuplja podatke i otvara odgovaarajucu stranicu
 *
 * varijanta ULOGOVANI KORISNIK
 *
 * @version 1.3
 */	   
    public function prikaz_stranice(){
        
       // $image = \Config\Services::image() ->withFile('/image/patka.jpg');
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
            $body='body';
            break;
            
            case 'za_mesojede':
                $i=0;
            $recepti_kategorija=$receptiModel->dohvati_recepte_meso();
            foreach($recepti_kategorija as $recept)
            {
               
                $recepti[$i]=$recept;
                $i++;
                
            }
            $body='body';
            break;    
          
            case 'svakojaka_testa':
                $i=0;
            $recepti_kategorija=$receptiModel->dohvati_recepte_testo();
            foreach($recepti_kategorija as $recept)
            {
               
                $recepti[$i]=$recept;
                $i++;
                
            }
            $body='body';
            break;    
            
            case 'izvrsni_kuvar':
                $i=0;
                
            $korisnikModel=new KorisnikModelOperacije();                       
            $kuvar= $korisnikModel->dohvati_sve_korisnike();

            foreach($kuvar as $k)
            {
                
                if($k->ocena>4){
                   
                    $recept=$receptiModel->dohvati_po_id_autora($k->id);
                    //$uslov=['autor'=>$k->id];
                   // $recept=$receptiModel->getWhere($uslov);
                   // $recept = $recept->getResultObject();  
                    
                  foreach ($recept as $r){
                       
                    $recepti[$i]=$r;
                    $i++;
                    }
                }
            }
            
             $body='body';
            break;    

            
            case 'odlicni_kuvar':
               $i=0;
                
            $korisnikModel=new KorisnikModelOperacije();                       
            $kuvar= $korisnikModel->dohvati_sve_korisnike();

            foreach($kuvar as $k)
            {
                
                if($k->ocena>2.1 && $k->ocena<=4){
                 
                    $recept=$receptiModel->dohvati_po_id_autora($k->id);
                    
                  //  $uslov=['autor'=>$k->id];
                   // $recept=$receptiModel->getWhere($uslov);
                    //$recept = $recept->getResultObject();  
                    
                  foreach ($recept as $r){
                      
                    $recepti[$i]=$r;
                    $i++;
                    }
                }
            }
            
                        
            $body='body';
            break;  
            
            case 'solidni_kuvar':
               $i=0;
                
            $korisnikModel=new KorisnikModelOperacije();                       
             $kuvar= $korisnikModel->dohvati_sve_korisnike();

            foreach($kuvar as $k)
            {
                
                if($k->ocena<=2 ){
                 
                    $recept=$receptiModel->dohvati_po_id_autora($k->id);
                   // $uslov=['autor'=>$k->id];
                   // $recept=$receptiModel->getWhere($uslov);
                    //$recept = $recept->getResultObject();  
                    
                  foreach ($recept as $r){
                      
                    $recepti[$i]=$r;
                    $i++;
                    }
                }
            }
            
             $body='body';
            break;  
            
            case 'moja_jela':
                $i=0;
                $id=$_SESSION['id'];
                $recepti_autor=$receptiModel->dohvati_po_id_autora($id);
            foreach($recepti_autor as $recept)
            {
                
                $recepti[$i]=$recept;
                $i++;
                
            }
             $body='body_B';  //
            break; 
            
           case 'sacuvana_jela':                     //za ovo treba da popunim tabelu sa receptima koje cuvam da bih mogla da uzmem recepte
                $i=0;
               $id=$_SESSION['id'];
              
          //  $sacuvano = ['idK' => $id];
            $sacuvanoModel=new SacuvanoModel();
           // $sacuvani= $sacuvanoModel->getWhere($sacuvano);
            // $sacuvani = $sacuvani->getResultObject();
               $sacuvani=$sacuvanoModel->dohvati_sacuvano_po_id_korisnika($id);
            
            foreach($sacuvani as $s)
            {
                //$recept=$receptiModel->find($s->idR);
                $recept=$receptiModel->dohvati_recept_po_id_recepta($s->idR);
                $recepti[$i]=$recept;
                $i++;
                
            }
             $body='body_sacuvano';  //
            break; 
            
           case 'moj_nalog':           //treba mi tabela recepara koje cuvam jer se tu listaju svi recepti i moji i sacuvani
                $i=0;
                 $id=$_SESSION['id'];
                 
                            

               $sacuvanoModel=new SacuvanoModel();
               $sacuvani=$sacuvanoModel->dohvati_sacuvano_po_id_korisnika($id);  
            
            foreach($sacuvani as $s)
            {
                 $recept=$receptiModel->dohvati_recept_po_id_recepta($s->idR);
                $recepti[$i]=$recept;
                $i++;
                
            }
            $recepti_autor=$receptiModel->dohvati_po_id_autora($id);
            foreach($recepti_autor as $recept)
            {
                
                $recepti[$i]=$recept;
                $i++;
                
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
 * Funkcija koja je zadužena za napustanje naloga ulogovanog korisnika
 *
 *
 * @version 1.1
 */	
    
    public function logout(){
        session_destroy();
        echo view("forme/logovanje");
    }
    
/**
 * Funkcija koja pamti u bazi koji korisnik je sacuvao koji recept. 
 * Funkcija se poziva sa bilo koje stranice gde korisnik ima opciju "sacuvaj" 
 * Upamceni recepti ce biti prikazani na stranici "sacuvano"
 *
 *
 * @version 1.4
 */	
    
    public function sacuvaj()
    {
        $res="";
        $sacuvanoModel=new SacuvanoModel();  
        $idk=$_SESSION['id'];
        $id=$_GET['id'];

        
       $sacuvano = ['idK' => $idk, 'idR' => $id];

       
        // $provera = $sacuvanoModel->getWhere($sacuvano);
       //  $provera = $provera->getResultObject();
        $provera=$sacuvanoModel->provera_sacuvano($id, $idk);

           

         if($provera==null){
           
           $sacuvanoModel->insert($sacuvano);
         }   
          else {
            $response_array='recept je već sačuvan';
            echo json_encode($response_array);
            $res="ok"; 
          }
          
          if($res==""){
            $response_array='recept je sačuvan';
            echo json_encode($response_array);
          }
         

        //$this->prikaz_stranice();          
            

    }
    
    	
/**
* Kada korisnki pritisne dugme 'prijavi', poziva se funkcija koja proverava 
* da li je isti recept vec prijavljen od strane istog korisnika i ako nije, ubacuje novu prijavu u bazu
*
* @return void
*
* @version 1.1
*/
    
     public function prijavi()
    {
        $res="";
        $prijavaModel=new PrijavaModel();  
        $idk=$_SESSION['id'];
        $id=$_GET['id'];
        
        $receptiModel = new ReceptiModel();
        $recept = $receptiModel->dohvati_recept_po_id_recepta($id);
        
        if($recept->autor!=$idk) {
        
       $prijava = ['idK' => $idk, 'idR' => $id];

          $provera=null;
          $provera=$prijavaModel->provera_prijavljeno($id, $idk);
  
            
         if($provera==null){
           
           $prijavaModel->insert($prijava);
         }   
          else{ 
            $response_array='recept je vec prijavljen';
            echo json_encode($response_array);
            $res="ok"; 
          }
        }
        else {
            $response_array='ne mozete prijaviti svoj recept';
            echo json_encode($response_array);
            $res="ok"; 
        }
         
        
        if($res==""){
            $response_array='recept je prijavljen';
            echo json_encode($response_array);
          }
        
       // $this->prikaz_stranice();    
    }
    
/**
 * Funkcija zaduzena za izbacivanje recepta iz tabele sacuvanih recepata
 *
 * @version 1.3
 * 
 */    
    
    public function izbaci(){
            
            $sacuvanoModel=new SacuvanoModel();
            
            $idk=$_SESSION['id'];
            $idr=$_GET['id'];

            
            $sacuvano=['idK'=>$idk,'idR'=>$idr];
            
            $sacuvanoModel->obrisi_sacuvano($idk, $idr);            

            $response_array='recept je izbacen';
            echo json_encode($response_array);
        
    }

/**
 * Funkcija koja pamti u bazi koji korisnik je ocenio koji rcept, takođe,  
 * preracunava ocenu za korisnika i za konkretni ocenjeni recept, ali samo u slučaju da  
 * korisnik taj recept već ranije nije ocenio i da nije njegov
 *
 *
 * @version 1.3
 */	
    
    public function ocenjivanje() {
       $receptModel=new ReceptiModel();
       $ocenjenoModel=new KorisnikOcenaModel();
        $res="";
     
        $idk=$_SESSION['id'];
        $id=$_GET['id'];
        $o=$_GET['o'];
        $sacuvano=['idK'=>$idk,'idR'=>$id];
        $recept=$receptModel->dohvati_recept_po_id_recepta($id);
       if($recept->autor==$idk){
            $response_array='ne možete oceniti vaš recept';
            echo json_encode($response_array);
            $res="ok";

       }else{
        
        $provera=null;

          $provera=$ocenjenoModel->provera_ocenjeno($idk, $id);

        
       if($provera==null){ 

        $sum=0;
        $cnt=0;
                       
        
        $object=$receptModel->dohvati_recept_po_id_recepta($id);    
        $br=$object->brocena+1;
        $oc=$object->ocena+$o;
        
        
        $data=['ocena'=>$oc,'brocena'=>$br];
        $receptModel->update($id, $data);
    
        $ocenjenoModel->insert($sacuvano);
        
        $recepti=$receptModel->dohvati_sve_recepte();
        $rec=$receptModel->dohvati_recept_po_id_recepta($id);
        
       
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
       
        }else{ 
            $response_array = 'recept je već ocenjen';
              echo json_encode($response_array);
              $res="ok";
        }
        if($res==""){
             $response_array = 'uspesno ste ocenili recept';
              echo json_encode($response_array);    
              }
       // $this->prikaz_stranice();
        }

       
    }
/**
 * Funkcija zadužena za dodavanje novog recepta u bazu, na osnovu podataka unetih preko odgovarajue forme
 *
 * @return void
 *
 * @version 1.0
 */  
    
    public function pravljenje_recepta() {
        if(!isset($_POST['odustani'])) {
   
            if(!$this->validate([
                'naziv'=>'required',
                'sastojci'=>'required|max_length[1000]',
                'priprema'=>'required|max_length[2000]',
                'slika'=>'uploaded[slika]'
                ])){
                    $GLOBALS['error']=$this->validator->getErrors();
            } else 
            if(!$this->validate([
                'slika'=>'mime_in[slika,image/jpg,image/jpeg,image/gif,image/png]'
            ])) {
                $GLOBALS['error']['sl']="Izabrali ste neadekvatan format slike!";
            }
            if($this->request->getVar('kategorija1')==null&&$this->request->getVar('kategorija2')==null&&$this->request->getVar('kategorija3')==null) {
                $GLOBALS['error']['kategorija']="Niste odabrali ni jednu od kategorija!";
            }
            if($this->request->getVar('kategorija1')!=null&&$this->request->getVar('kategorija2')!=null&&$this->request->getVar('kategorija3')!=null) {
                $GLOBALS['error']['kategorija']="Odabrali ste previse kategorija!";
            }
            if(!empty($GLOBALS['error']))
                return $this->novi_recept();

            $k1=0;
            $k2=0;
            $k3=0;

            if($this->request->getVar('kategorija1')!=null) $k1=1;
            if($this->request->getVar('kategorija2')!=null) $k2=1;
            if($this->request->getVar('kategorija3')!=null) $k3=1;

            $korisnik=$this->session->get('korisnik');

            $slika=$this->request->getFile('slika');
            $slika->move(WRITEPATH . '../uploads');


            $receptiModel=new ReceptiModel();
            $receptiModel->save([
                'slika'=>"uploads/".$slika->getClientName(),
                'sastojci'=>$this->request->getVar('sastojci'), 
                'priprema'=>$this->request->getVar('priprema'),
                'k1'=>$k1,
                'k2'=>$k2,
                'k3'=>$k3,
                'autor'=>$korisnik['id'],
                'ime'=>$this->request->getVar('naziv'),
                'ocena'=>0,
                'brocena'=>0
                ]);
            
        }    
    
        $_GET['meni']='moj_nalog';
        $_GET['body']='body_B';
        $_GET['izbor']='moj_nalog';

        $this->prikaz_stranice();
        
    }
    
    //--------------------------------------------------------------------
}
