<?php namespace App\Filters;

/**
 * Autor: Maja Ličina 17/0506
 */
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
/**
 * 
 * GostFilter - klasa zadužena za filtiriranje zahteva za prikaz stranica koje generiše kontroler Gost
 *
 * @version 1.2
 */

class GostFilter implements FilterInterface
{
    
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
            if($korisnik['admin']==0) {
                $_GET['meni']='meni_pocetna';
                $_GET['body']='body';
                $_GET['izbor']='svi_recepti';
                return redirect()->to(site_url('Korisnik/prikaz_stranice'));
            } else {
                return redirect()->to(site_url('Admin/prikaz_stranice'));
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response) {
        
    }

    //--------------------------------------------------------------------

}