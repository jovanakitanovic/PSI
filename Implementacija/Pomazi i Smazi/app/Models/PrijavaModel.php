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
}