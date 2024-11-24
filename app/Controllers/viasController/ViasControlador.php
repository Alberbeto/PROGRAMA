<?php

namespace App\Controllers\viasController;

use App\Models\viasModel\viasModelo;
use CodeIgniter\RESTful\ResourceController;
use Kint\Zval\Value;

class ViasControlador extends ResourceController
{
    public function Vias(){
        if($this->request->isAjax()){

            $model = new viasModelo(); 
            $data = $model->ListarVias();
            
            return $this->response->setJSON(['data'=>$data]);
        }

        $model = new viasModelo(); 
        $data['anios']= $model->obtenerFechas();
        $data['tipos']= $model->obtenerTipos();

        return view('Mantenimiento/viasVista',$data);
    }

    public function InsertarVia(){

        $model = new viasModelo();
        $session = session();
        $ipAdress= $this->request->getIPAddress();
        $fechaActual = date('Y-m-d H:i:s');
        $nombre_usuario = $session->get('usuario');

        if(empty($this->request->getPost('vnombre'))|| trim($this->request->getPost('vnombre'))===''){
            return $this->response->setJson(['status'=>'error','mensaje'=>'EL NOMBRE DE LA VIA ESTA VACIA']);
        }

        $nestado = $this->request->getPost('nestado')?1:0;
        $idsigma = $this->request->getPost('idsigma');
        $data =[


            'ctipvia' => $this->request->getPost('ctipvia'),
            'vnombre' => $this->request->getPost('vnombre'),
            'dfecdes'=>$this->request->getPost('dfecdes').'-01-01 00:00:00',
            'dfechas'=>$this->request->getPost('dfechas').'-12-31 00:00:00',
            'nestado'=>$nestado,
            'vhostnm'=>$ipAdress,
            'vusernm'=>$nombre_usuario,
            'ddatetm'=>$fechaActual,
           
        ];

        if(empty($idsigma)){
            if($model->InsertarNuevaVia($data)){
                return $this->response->setJson(['status'=>'success','mensaje'=>'Se Guardo correctamente el registro']);
            }else {
                return $this->response->setJson(['status'=>'success','error'=>'error al guardar el registro']);
            }
        }else{
            $data['idsigma']=$idsigma ;
            if($model->EditarVia($data)){
                return $this->response->setJson(['status'=>'success','mensaje'=>'Se actualizo correctamente el registro']);
            }else {
                return $this->response->setJson(['status'=>'success','error'=>'error al actulizar el registro']);
            }
        }


        

    }


    public function BuscarId(){
        $model = new viasModelo();

        $id_via = $this->request->getPost('id_via');
        $obj_via = $model->BuscarPorId($id_via);

        if(isset($obj_via)){

            return $this->response->setJson(['status'=>'success','data'=>$obj_via]);
        }else {
            return $this->response->setJson(['status'=>'error','data'=>$obj_via]);

        }
    }


  
}