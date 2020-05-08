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

class KorisnikModel extends Model
{
        protected $table      = 'korisnik';
        protected $primaryKey = 'id';
        protected $returnType = 'array';
        
        protected $allowedFields = ['ime', 'prezime', 'username', 'sifra', 'admin'];
        
        public function pretragaUsername($username) {
            return $this->where('username', $username)->findAll();
        }
}