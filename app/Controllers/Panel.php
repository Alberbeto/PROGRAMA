<?php 
namespace App\Controllers;

use CodeIgniter\Controller;

class Panel extends Controller
{
    public function index()
    {
        $session = session();
        if (!$session->get('logeo')) {
            return redirect()->to('login');
        }

        echo view('inicio'); // Asegúrate de tener una vista llamada 'dashboard.php'
    }
}