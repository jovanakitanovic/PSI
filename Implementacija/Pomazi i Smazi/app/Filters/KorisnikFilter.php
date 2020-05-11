<?php namespace App\Filters;
/**
 * Autor: Maja Ličina 17/0506
 */

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

/**
 * KorisnikFilter - klasa zadužena za filtiriranje zahteva za prikaz stranica koje generiše kontroler Korisnik
 *
 * @version 1.0
 */
class KorisnikFilter implements FilterInterface {
	
	/**
	 * Funkcija koja vrši filtriranje pre poziva traženog kontrolera
	 *
	 * @return RedirectResponse
	 *
	 * @param RequestInterface $request
	 *
	 */
    public function before(RequestInterface $request)
    {
        $session=session();
        if($session->has('id')) {
            $korisnikModel=new \App\Models\KorisnikModel();
            $korisnik=$korisnikModel->find($session->get('id'));
            if($korisnik['admin']==1) {
				// ako poziv vrši ulogovani korisnik, i ako je taj korisnik admin, vršiće se redirekcija na početnu stranu administratora
                return redirect()->to(site_url('Admin/prikaz_stranice'));
            } 
        } else {
			// ako poziv vrši neulogovani korisnik, vršiće se redirekcija na login formu
            return redirect()->to(site_url('Gost/index_stranica'));
        }
    }

    //--------------------------------------------------------------------

}