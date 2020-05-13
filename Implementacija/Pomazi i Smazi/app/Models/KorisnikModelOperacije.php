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
        
        public function pretragaUsername($username) {
            return $this->where('username', $username)->findAll();
        }
		
		public function dohvati_sve_korisnike() {
            return $this->findAll();
        }
}