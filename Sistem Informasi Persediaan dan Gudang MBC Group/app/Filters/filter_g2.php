<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class filter_g2 implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        //filter before sebelum menrima req-
        // Do something here
        if (session()->get('log') == FALSE) {
            return redirect()->to('/');
        } elseif (session()->get('gudang') != 'g2') {
            return redirect()->to('/');
        }
    }


    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
        // $session = session();
        // if (session()->get('log') == TRUE) {
        //     session()->setFlashdata('textlogin', 'Hallo ' . session()->get('nama'));
        //     return redirect()->to('/dashboard');
        // }
    }
}
