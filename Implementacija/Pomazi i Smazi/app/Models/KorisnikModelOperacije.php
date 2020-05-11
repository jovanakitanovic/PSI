<?php namespace App\Models;

use CodeIgniter\Model;

class KorisnikModelOperacije extends Model
{
        protected $table      = 'korisnik';
        protected $primaryKey = 'id';
        protected $returnType = 'object';
        
        protected $allowedFields = ['ime', 'prezime', 'username', 'sifra', 'admin','ocena'];
        
        public function pretragaUsername($username) {
            return $this->where('username', $username)->findAll();
        }
}