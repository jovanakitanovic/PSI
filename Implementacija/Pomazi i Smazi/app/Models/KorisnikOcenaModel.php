<?php namespace App\Models;

/**
 * Autor: Jovana Kitanovic 0603/17
 *
 * @version 1.2
 */

use CodeIgniter\Model;

/**
 * Klasa koja predstavlja konekciju sa bazom, konkretno, tabelom korisnikocena, takođe, sadrži funkcije za rad sa tabelom
 *
 * @version 1.2
 */

class KorisnikOcenaModel extends Model
{
        protected $table      = 'korisnikocena';
        protected $primaryKey = 'idK';

        protected $returnType = 'object';
        protected $allowedFields = ['idR', 'idK'];

        
                
        public function dohvati_sve_korisnik_ocena(){
            return $this->findAll();
        }
        
        public function dohvati_korisnik_ocena_po_id_korisnika($id){
            $this->where('idK',$id);
            return $this->findAll();
        }
        
        public function dohvati_korisnik_ocena_po_id_recepta($id){
            $this->where('idR',$id);
            return $this->findAll();
        }
        
        public function provera_ocenjeno($idK,$idR){
            $this->where('idR',$idR);
            $this->where('idK',$idK);
            return $this->findAll();
        }
        
        
}