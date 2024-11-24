<?php

namespace App\Controllers\personasController;

use App\Models\personasModel\personasModelo;
use CodeIgniter\RESTful\ResourceController;
use Kint\Zval\Value;

class PersonasControlador extends ResourceController
{

    public function ListarPersonasController(){

        if($this->request->isAjax()){

            $model = new personasModelo();
            $data = $model->ListarPersonasModel();
           

            return $this->response->setJSON(['datos'=>$data]);
            
        }

        $model = new personasModelo();
        $data['personasTipos']=  $model->ListarTipoPersonaModel();
        $data['dniTipos']=$model->LitarTipoDocumento();
        $data['civilTipos']=$model->ListarTipoEstadoCivil();
        $data['departamentos']=$model->ListarDepartamento();
        $data['provincias']=$model->ListarProvinciaModel();
        $data['distritos']=$model->ListarDistritoModel();
        $data['sexos']=$model->SexoModel();

        return view('Mantenimiento/personasvista',$data);
    }

    public function GuardarRegistroController(){

        $model = new personasModelo();

        if(empty($this->request->getPost('vnrodoc'))||trim($this->request->getPost('vnrodoc'))===''){

            return $this->response->setJson(['status'=>'error','mensaje'=>'EL NUMERO DE DOCUMENTO NO PUEDO ESTAR VACIO']);
        }

        if(empty($this->request->getPost('vnombre'))||trim($this->request->getPost('vnombre'))===''){
            return $this->response->setJson(['status'=>'error','mensaje'=>'EL NOMBRE Y/O RAZON SOCIAL NO PUEDE ESTAR VACIO']);
        }

        $ipAdress= $this->request->getIPAddress();
        $session = session();
        $nombre_usuario=$session->get('usuario');
        $fechaActual=date('Y-m-d H:i:s');
        $fechaNacimiento=$this->request->getPost('dfecnac');
       
        $idsigma=$this->request->getPost('idsigma');
        $vdeclaracion=$this->request->getPost('vdeclaracion');
       /* 'idsigma','vpatern' ,'vmatern' ,'vnombre','ctipper','nestado',
    'vhostnm','vusernm','ddatetm','ntipers','ntipper','cdenomi','vdirecc','vnumero','vlote',
'vmanzan','vdpto','vreferen','ctipdoc','vnrodoc','dfecnac','csexo','dfecinic','cestciv',
'codMod','ctelfij','ctelmov','vcorreo','vobserv','mubigeo','mpredio','mviadis','mpoblad',
'vinterior','vletra','vestacionto','vdeposito','vbloque','vseccion','vunidinmob',
'tdoccony','doccony','nomcony','vdeclaracion','ccodcat','sector','departamento','provincia'*/

        $data=[

            'ctipper'=>$this->request->getPost('ctipper'),
            'ctipdoc'=>$this->request->getPost('ctipdoc'),
            'vpatern'=>$this->request->getPost('vpatern'),
            'vmatern'=>$this->request->getPost('vmatern'),
            'vnrodoc'=>$this->request->getPost('vnrodoc'),
            'vnombre'=>$this->request->getPost('vnombre'),
            'csexo'=>$this->request->getPost('csexo'),
            'nestado'=>1,
            'vhostnm'=>$ipAdress,
            'vusernm'=>$nombre_usuario,
            'ddatetm'=>$fechaActual,
            'ntipers'=>1,
            'ntipper'=>1,
            'cdenomi'=>$this->request->getPost('cdenomi'),
            'vnumero'=>$this->request->getPost('vnumero'),
            'vdirecc'=>$this->request->getPost('vdirecc'),
            'vlote'=>$this->request->getPost('vlote'),
            'vmanzan'=>$this->request->getPost('vmanzan'),
            'vdpto'=>$this->request->getPost('vdpto'),
            'vreferen'=>$this->request->getPost('vreferen'),
            'dfecnac'=>$fechaNacimiento.' 00:00:00',
            'csexo'=>$this->request->getPost('csexo'),
            'dfecinic'=>$fechaActual,
            'cestciv'=>$this->request->getPost('cestciv'),
            'ctelfij'=>$this->request->getPost('ctelfij'),
            'ctelmov'=>$this->request->getPost('ctelmov'),
            'vcorreo'=>$this->request->getPost('vcorreo'),
            'vobserv'=>$this->request->getPost('vobserv'),
            'mubigeo'=>$this->request->getPost('mubigeo'),
            'mpredio'=>$this->request->getPost('mpredio'),
            'mviadis'=>$this->request->getPost('mviadis'),
            'mpoblad'=>$this->request->getPost('mpoblad'),
            'vinterior'=>$this->request->getPost('vinterior'),
            'vletra'=>$this->request->getPost('vletra'),
            'vestacionto'=>$this->request->getPost('vestacionto'),
            'vdeposito'=>$this->request->getPost('vdeposito'),
            'vbloque'=>$this->request->getPost('vbloque'),
            'vseccion'=>$this->request->getPost('vseccion'),
            'vunidinmob'=>$this->request->getPost('vunidinmob'),
            'tdoccony'=>$this->request->getPost('tdoccony'),
            'doccony'=>$this->request->getPost('doccony'),
            'nomcony'=>$this->request->getPost('nomcony'),
            'ccodcat'=>$this->request->getPost('ccodcat'),
            'sector'=>$this->request->getPost('sector'),
            'departamento'=>$this->request->getPost('departamento'),
            'provincia'=>$this->request->getPost('provincia'),

        ];


        if(empty($idsigma)){

            if($model->GuardarRegistroModel($data)){
                return $this->response->setJson(['status'=>'success','mensaje'=>'se ha registrado de forma correcta']);
            }else{
                return $this->response->setJson(['status'=>'error','mensaje'=>'error en el registro']);
            }
        }else
            {
                    $data['idsigma']=$idsigma;
                    //var_dump($data);
                    if($model->EditarRegistroPersonaModel($data)){
                        return $this->response->setJson(['status'=>'ok','mensaje'=>'Se actualizo correctamente el registro']);

                    }else {
                        return $this->response->setJson(['status'=>'error','mensaje'=>'error al actulizar el registro']);
                    }
            }
           
    }


    public function BuscarRegistroPersonaController(){

        $model = new personasModelo();
        $id_persona = $this->request->getPost('id_persona');
        $obje_person = $model->BuscarRegistroPersonaModel($id_persona);


        if(isset($obje_person)){

            return $this->response->setJson(['status'=>'success','data'=>$obje_person]);
        }else {
            return $this->response->setJson(['status'=>'error','no se encontro ese registro']);
        }
    }


}