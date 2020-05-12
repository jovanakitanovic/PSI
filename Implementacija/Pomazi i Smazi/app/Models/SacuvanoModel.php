<?php namespace App\Models;

/**
 * Autor: Jovana Kitanovic 0603/17
 *
 * @version 1.1
 */

use CodeIgniter\Model;

/**
 * Klasa koja predstavlja konekciju sa bazom, konkretno, tabelom sacuvano, takođe, sadrži funkcije za rad sa tabelom
 *
 * @version 1.1
 */

class SacuvanoModel extends Model                       
{
        protected $table      = 'sacuvano';
       // protected $primaryKey = 'id';

        protected $returnType = 'object';
        protected $allowedFields = ['idR', 'idK'];


/**
*	funkcija koja dihvata sve redove tabele sacuvano
*
*	@return stdObject[]
*	@version 1.0
*/
       
        public function dohvati_sve_sacuvano(){
            return $this->findAll();
        }

/**
*	funkcija koja dihvata sve sacuvane recepte po id-ju recepta
*
*	@param int id
*	@return stdObject[]
*	@version 1.0
*/			
      

  
        public function dohvati_sacuvano_po_id_recepta($id) {
            $this->where('idR',$id);
            return $this->findAll();
        }
        
/**
*	funkcija koja dihvata sve sacuvane recepte po id-ju korisnika
*
*	@param int id
*	@return stdObject[]
*	@version 1.0
*/			
    		
		
        public function dohvati_sacuvano_po_id_korisnika($id){
            $this->where('idK',$id);
            return $this->findAll();
        }
		
/**
*	funkcija koja dihvata sve sacuvane recepte po id-ju recepta i
*	id- ju korisnika (fukncija služi za proveru da li je dati korisnik
*	već sačuvao dati recept)
*
*	@param int idK, int idR
*	@return stdObject[]
*	@version 1.0
*/			
    		
        
        public function provera_sacuvano($idr,$idk){
            $this->where('idR',$idr);
            $this->where('idK',$idk);
            return $this->findAll();
        }
        
/**
*	funkcija koja uklanja recept koji je sacuvao dati korisnik
*
*	@param int idK, int idR
*	@return stdObject[]
*	@version 1.0
*/			
    		
        public function obrisi_sacuvano($idk,$idr){
           $this->where('idK', $idk); 
           $this->where('idR', $idr); 
           $this->delete();
        }
}