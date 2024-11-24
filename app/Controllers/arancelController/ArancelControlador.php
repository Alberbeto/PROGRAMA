<?php

namespace App\Controllers\arancelController;

use App\Models\arancelModel\arancelModelo;
use CodeIgniter\RESTful\ResourceController;
use Kint\Zval\Value;

class ArancelControlador extends ResourceController
{

    public function ListarCenViasController(){


        if($this->request->isAjax()){

            $model = new arancelModelo();
            $data = $model->ListarCentViasModel();
            

            return $this->response->setJSON(['data'=>$data]);

            
            
        }
        $model = new arancelModelo();

        $data['centros_pobla']= $model->ListarCentropobladoModel();
        $data['vias']=$model->ListarViasModel();
        $data['anios'] = $model->ObtenerFechasModel();

        return view('Mantenimiento/arancelVista',$data);

       

    }

    public function ListarArancelNetoController(){
        if($this->request->isAjax()){

            $model = new arancelModelo();
            
            $data = $model->ListarArancelNetoModel();

            return $this->response->setJSON(['datos'=>$data]);
        }

    }


    public function ListarArancelController(){

        
            $model = new arancelModelo();

            $id_centro = $this->request->getPost('id_centro');
            $id_vias = $this->request->getPost('id_vias');

            $objarancel = $model->ListarArancelesModel($id_centro,$id_vias);
           
            if(isset($id_centro)&&isset($id_vias)){

                return $this->response->setJSON(['status'=>'success','data'=>$objarancel]);
            }else {
                return $this->response->setJSON(['status'=>'success','mensaje'=>'datos']);
            }

        
    }


    public function InsertarNuevoArancelController(){

        $model = new arancelModelo();
        $session = session();
        $ipAdress= $this->request->getIPAddress();
        $fechaActual = date('Y-m-d H:i:s');
        $nombre_usuario = $session->get('usuario');

        if(empty($this->request->getPost('narance'))||trim($this->request->getPost('narance'))===''){
            return $this->response->setJson(['status'=>'error','mensaje'=>'EL NOMBRE DLE ARANCEL ESTA VACIO']);
        }
        if(empty($this->request->getPost('nfacbar'))||trim($this->request->getPost('nfacbar'))===''){
            return $this->response->setJson(['status'=>'error','mensaje'=>'EL FACTOR BARRIDO ESTA VACIO']);
        }

        $nestado = $this->request->getPost('nestado')?1:0;
        $idsigma = $this->request->getPost('idsigma');

        $data=[

            'mpoblad' => $this->request->getPost('mpoblad'),
            'mviadis' => $this->request->getPost('mviadis'),
            'nladvia' => $this->request->getPost('nladvia'),
            'ncuaini' => $this->request->getPost('ncuaini'),
            'ncuafin' => $this->request->getPost('ncuafin'),
            'narance' => $this->request->getPost('narance'),
            'nfacbar' => $this->request->getPost('nfacbar'),
            'cperiod' => $this->request->getPost('cperiod'),
            'nestado' => $nestado,
            'vhostnm' => $ipAdress,
            'vusernm' => $nombre_usuario,
            'ddatetm' => $fechaActual,
            'nfrebar' => $this->request->getPost('nfrebar'),
            'nfacbar_casa' => $this->request->getPost('nfacbar_casa')
        ];


        if(empty($idsigma)){
            if($model->InsertarNuevoArancelModel($data)){
                return $this->response->setJson(['status'=>'success','mensaje'=>'SE INSERTO CORRECTAMENTE EL REGISTRO']);
            }else {
                return $this->response->setJson(['status'=>'success','error'=>'NO SE PUDO INSERTAR EL REGISTRO']);
            }

        }else 
        {
            $data['idsigma']=$idsigma;
            if($model->EditarArancelModel($data)){

                return $this->response->setJson(['status'=>'success','mensaje'=>'Se actualizo correctamente el registro']);
                
            }else {
                return $this->response->setJson(['status'=>'success','error'=>'error al actulizar el registro']);
            }
        }


    }


    public function BuscarPorIdController(){

        $model = new arancelModelo();
        $id_arancel = $this->request->getPost('id_arancel');
        $objeto_arancel = $model->BuscarPorIdModel($id_arancel);

        if(isset($objeto_arancel)){

            return $this->response->setJson(['status'=>'success','data'=>$objeto_arancel]);
        }else{
            return $this->response->setJson(['status'=>'error','data'=>$objeto_arancel]);
        }



    }

  
   




}