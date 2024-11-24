<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Clientes extends ResourceController
{
    public function listado_cliente()
    {
        $data = [
            ['id' => 1, 'name' => 'Cliente 1', 'email' => 'cliente1@example.com'],
            ['id' => 2, 'name' => 'Cliente 2', 'email' => 'cliente2@example.com'],
            ['id' => 3, 'name' => 'Cliente 3', 'email' => 'cliente3@example.com']
        ];

        return $this->respond($data);
    }

   /* public function index()
    {
        return view('listadoclientes');
    }
*/
    //contrunctor 
    public $modelHome = null;
    public function __construct()
    {
        //cargar modelo
        $this->modelHome = model('homeModel');
    }

    public function indexu()
    {
        //cargar la funcion de modelo
        $data = $this->modelHome->clientes_list();
        //tipo de dato que esta imprimiendo y si contenido
        echo var_dump($data);
        
    }
}