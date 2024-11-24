<?php

namespace App\Controllers;

use App\Models\usuariosModel;
use CodeIgniter\RESTful\ResourceController;
use Kint\Zval\Value;

class Autentificacion extends ResourceController
{

    public function login(){

        //metodos de ayuda relacionados con formaluarios
        helper(['form']);
        $mensaje=session('mensaje');
        return view('login',["mensaje"=>$mensaje]);
    }

    public function inicio(){

        //metodos de ayuda relacionados con formaluarios
        helper(['form']);

        return view('dasbord/inicio');
    }

    public function centroPoblado(){

        if ($this->request->isAJAX()) {
            $usuarioModel = new usuariosModel();
            $data = $usuarioModel->ListaCentroPoblado();

            return $this->response->setJSON(['data' => $data]);
        }

        //metodos de ayuda relacionados con formaluarios
        $model= new usuariosModel();
        $data['sectores'] = $model->obtenerSectores();

        $data['tipos'] = $model->obtenerTipo();
     
        $data['anios']=$model->obtenerFecha();
        
        return view('Mantenimiento/centroPoblado',$data);
      

    }

    public function consulta(){

        //metodos de ayuda relacionados con formaluarios
        helper(['form']);

        return view('consulta');
    }
    public function ingresar(){

            $session = session();
            $p_usuario = $this->request->getPost('usuario');
            $p_password = $this->request->getPost('clave');

        
                $Usuario = new usuariosModel(); 
                $datosUsuario =$Usuario->obtenerUsuario($p_usuario,$p_password);
               
                    if(count($datosUsuario)> 0){
                            $data =[
                                "usuario"=>$datosUsuario[0]['usuario'],
                                "logged_in" => true
                            ];
                           
                            $session->set($data);
                            return view('dasbord/inicio');
                        }else {
                            $session->setFlashdata('error', 'Usuario o contraseña incorrectos');
                            return redirect()->to(base_url('login'));
                        }  
            
    }

    public function salir(){
        $session= session();
        $session->destroy();
        return redirect()->to(base_url('login'));
    }

    public function InsertarData(){

        $model = new usuariosModel();
    
        //inicio de sesion
        $session = session();
        //obtener la direccion Ip del cliente 
        $ipAdress= $this->request->getIPAddress();
        //obetener la fecha actual 
        $fechaActual = date('Y-m-d H:i:s');
        //obtener el nombre dek inicio de sesion
        $nombreUsuario = $session->get('usuario');
      

      if(empty($this->request->getPost('vnombre'))|| trim($this->request->getPost('vnombre'))===''){
        return $this->response->setJson(['status'=>'error','mensaje'=>'EL NOMBRE DEL CENTRO POBLADO ESTA VACIO']);
        }
       if (empty($this->request->getPost('cidzona'))|| trim($this->request->getPost('cidzona'))===''){
           return $this->response->setJson(['status'=>'error','mensaje'=>'LA ZONA ESTA VACIO']);
      }
      
        $estado = $this->request->getPost('nestado') ? 1 : 0;
        $idsigma =$this->request->getPost('idsigma');

        $data = [
            
            'vnombre'=> $this->request->getPost('vnombre'),
            'cdistri'=> $this->request->getPost('cdistri'),
            'ctipcen'=>$this->request->getPost('ctipcen'),
            'cidzona'=>$this->request->getPost('cidzona'),
            'dfecdes'=>$this->request->getPost('dfecdes').'-01-01 00:00:00',
            'dfechas'=>$this->request->getPost('dfechas').'-12-31 00:00:00',
            'nestado'=>$estado,
            'vhostnm'=>$ipAdress,
            'vusernm'=>$nombreUsuario,
            'ddatetm'=>$fechaActual,
            'nsector'=>$this->request->getPost('nsector')

        ];
        
        if(empty($idsigma)){
            if($model->InsertarNuevaId($data)){
                return $this->response->setJson(['status'=>'success','mensaje'=>'datos ingresados correctamente']);
            }else {
                return $this->response->setJson(['status'=>'error','mensaje'=>'error al ingresar correctamente']);

            }
        }else {
            $data['idsigma']=$idsigma;//añalisdo a la array de datos
            
            if($model->EditarId($data)){
                return $this->response->setJson(['status'=>'success','mensaje'=>'datos actualizo correctamente']);
                
            }else {
                return  $this->response->SetJson(['status'=>'error','mensaje'=>'error al actualizor correctamente']);
            }
        }

       
    }

    /*public function EliminarId(){
        $model = new usuariosModel();

        $idsigma =$this->request->getPost('idsigma');

        if(empty($idsigma)){
            return $this->response->setJSON(['status' => 'error', 'mensaje' => 'ID no proporcionado']);
        }

        if ($model->EliminarId(['idsigma'=>$idsigma])) {
            return $this->response->setJSON(['status' => 'success', 'mensaje' => 'Datos eliminados correctamente']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'mensaje' => 'No se pudo eliminar el registro']);
        }
    }*/
    

   


    public function BuscarPorId()  {

        $model = new usuariosModel();
        $id_cp=$this->request->getPost('id_cp');
        $obj_centro = $model->BuscarPorIdModel($id_cp);
       
       
        if(isset($obj_centro)){
            return $this->response->setJSON(['status'=>'success','data'=> $obj_centro]);
        }else {
            return $this->response->setJSON(['status'=>'error','data'=>$obj_centro]);
        }

    }



    //listado de centro poblados 

   
   /*public function ValoresTipo(){
    $modal = new usuariosModel();
    $data['tipo']=$modal->obtenerTipo();

    return view('mantenimiento/centroPoblado',$data);
   }*/

}

/*<?php if (session()->get('logged_in')): ?>
    Bienvenido, <?= session()->get('usuario'); ?>
  <?php endif; ?>*/