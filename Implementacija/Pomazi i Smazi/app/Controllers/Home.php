<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
           // session_start();
		///echo view("stranice/header");
                // echo view("stranice/meni");
               // echo view("stranice/body");
                
            echo view("forme/logovanje");
	}

	//--------------------------------------------------------------------

}
