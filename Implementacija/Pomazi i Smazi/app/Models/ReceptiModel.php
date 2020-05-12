<?php namespace App\Models;

/**
 * Autor: Jovana Kitanovic 0603/17
 *
 * @version 1.1
 */

use CodeIgniter\Model;

/**
 * Klasa koja predstavlja konekciju sa bazom, konkretno, tabelom recepti, takođe, sadrži funkcije za rad sa tabelom
 *
 * @version 1.1
 */

class ReceptiModel extends Model
{
        protected $table      = 'recepti';
        protected $primaryKey = 'id';
        protected $returnType = 'object';
        protected $allowedFields = ['slika', 'sastojci', 'priprema','k1','k2','k3','autor','ime','ocena','brocena'];

/**
*	funkcija koja dihvata sve redove tabele recepti
*
*	@return stdObject[]
*	@version 1.0
*/	
      
        public function dohvati_sve_recepte(){
            return $this->findAll();
        }

/**
*	funkcija koja dihvata sve redove tabele prijava po id autora
*
*	@param int id
*	@return stdObject[]
*	@version 1.0
*/			
        
        public function dohvati_po_id_autora($id){
            $this->where('autor',$id);
            return $this->findAll();
        }
   
/**
*	funkcija koja dihvata recept po odgovarajucem id-ju
*
*	@param int id
*	@return stdObject
*	@version 1.0
*/	
   
        public function dohvati_recept_po_id_recepta($id){
            $this->where('id',$id);
            $recept=$this->find();
            return $recept[0];
        }

/**
*	funkcija koja dihvata sve recepte kategorije "slatko ćoše"
*
*	
*	@return stdObject[]
*	@version 1.0
*/			
        
         public function dohvati_recepte_slatko(){
            $this->where('k2',1);
           return $this->findAll();
            
        }
 /**
*	funkcija koja dihvata sve recepte kategorije "za mesojede"
*
*	
*	@return stdObject[]
*	@version 1.0
*/	       
		
        public function dohvati_recepte_meso(){
            $this->where('k1',1);
           return $this->findAll();
            
        }
        
/**
*	funkcija koja dihvata sve recepte kategorije "svakojaka testa"
*
*	
*	@return stdObject[]
*	@version 1.0
*/			
		
        public function dohvati_recepte_testo(){
            $this->where('k3',1);
           return $this->findAll();
            
        }
        
}