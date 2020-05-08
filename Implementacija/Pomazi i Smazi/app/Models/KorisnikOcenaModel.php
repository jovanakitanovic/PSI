<?php namespace App\Models;

/**
 * Autor: Jovana Kitanovic 0603/17
 *
 * @version 1.1
 */

use CodeIgniter\Model;

/**
 * Klasa koja predstavlja konekciju sa bazom, konkretno, tabelom korisnikocena, takođe, sadrži funkcije za rad sa tabelom
 *
 * @version 1.1
 */

class KorisnikOcenaModel extends Model
{
        protected $table      = 'korisnikocena';
       // protected $primaryKey = 'id';

        protected $returnType = 'object';
        protected $allowedFields = ['idR', 'idK'];

}