<?php namespace App\Models;
/**
 * Autor: Jovana Kitanovic 0603/17
 *
 * @version 1.1
 */
use CodeIgniter\Model;
/**
 * Klasa koja predstavlja konekciju sa bazom, konkretno, tabelom korsnik, takođe, sadrži funkcije za rad sa tabelom
 *
 * @version 1.1
 */

class KorisnikModelOperacije extends Model
{
        protected $table      = 'korisnik';
        protected $primaryKey = 'id';
        protected $returnType = 'object';
        
        protected $allowedFields = ['ime', 'prezime', 'username', 'sifra', 'admin','ocena'];

/**
*	funkcija koja dohvata korisnika po korisnickom imenu
*
*	@param String usrename
*	@return stdObject[]
*	@version 1.0
*/        
        public function pretragaUsername($username) {
            return $this->where('username', $username)->findAll();
        }
/**
*	funkcija koja dohvata sve korisnike iz baze korisnik
*	@version 1.0
*/        
        public function dohvati_sve_korisnike() {
            return $this->findAll();
        }
        
        
}