<?php namespace App\Models;

/**
 * Autor: Jovana Kitanovic 0603/17
 *
 * @version 1.0
 */

use CodeIgniter\Model;

/**
 * Klasa koja predstavlja konekciju sa bazom, konkretno, tabelom recepti, takođe, sadrži funkcije za rad sa tabelom
 *
 * @version 1.0
 */


class ReceptiModel extends Model
{
        protected $table      = 'recepti';
        protected $primaryKey = 'id';
        protected $returnType = 'object';
        protected $allowedFields = ['slika', 'sastojci', 'priprema','k1','k2','k3','autor','ime','ocena','brocena'];

}