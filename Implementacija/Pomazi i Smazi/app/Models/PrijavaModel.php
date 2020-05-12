<?php namespace App\Models;

/**
 * Autor: Jovana Kitanovic 0603/17
 *
 * @version 1.0
 */

use CodeIgniter\Model;

/**
 * Klasa koja predstavlja konekciju sa bazom, konkretno, tabelom prijava, takođe, sadrži funkcije za rad sa tabelom
 *
 * @version 1.1
 */

class PrijavaModel extends Model
{
        protected $table      = 'prijava';
       // protected $primaryKey = 'id';

        protected $returnType = 'object';
        protected $allowedFields = ['idR', 'idK'];

/**
*	funkcija koja dihvata sve redove tabele prijava
*
*	@return stdObject[]
*	@version 1.0
*/		
		        
        public function dohvati_sve_prijave(){
            return $this->findAll();
        }
        
/**
*	funkcija koja dihvata sve redove tabele gde je idR i idK jedako 
* 	prosleđenim vrednostima
*
*	@ param int idK, int idR
*	@return stdObject[]
*	@version 1.0
*/	
		
        public function provera_prijavljeno($idr,$idk) {
            $this->where('idK',$idk);
            $this->where('idR',$idr);
            return $this->findAll();
        }
		
/**
*	funkcija koja dihvata sve redove tabele gde je idK jedako 
* 	prosleđenoj vrednosti (vraca sve korisnike)
*
*	@ param int idK
*	@return stdObject[]
*	@version 1.0
*/	
			
		
        
        public function dohvati_po_id_korisnika($idK)
        {
            $this->where('idK',$idk);
            return $this->findAll();
        }
		
/**
*	funkcija koja dihvata sve redove tabele gde je idR jedako 
* 	prosleđenoj vrednosti (vraca sve recepte)
*
*	@ param int idK
*	@return stdObject[]
*	@version 1.0
*/			
		
        
        public function dohvati_po_id_recepta($idR)
        {
            $this->where('idR',$idR);
            return $this->findAll();        
        }
}