<?php

namespace App\Models\personasModel;

use CodeIgniter\Model;

class personasModelo extends Model
{

    protected $table ='public.mperson';
    protected $primaryKey ='idsigma';
    protected $useAutoIncrement = false;
    protected $returnType='array';
    protected $allowedFields = ['idsigma','vpatern' ,'vmatern' ,'vnombre','ctipper','nestado',
    'vhostnm','vusernm','ddatetm','ntipers','ntipper','cdenomi','vdirecc','vnumero','vlote',
'vmanzan','vdpto','vreferen','ctipdoc','vnrodoc','dfecnac','csexo','dfecinic','cestciv',
'codMod','ctelfij','ctelmov','vcorreo','vobserv','mubigeo','mpredio','mviadis','mpoblad',
'vinterior','vletra','vestacionto','vdeposito','vbloque','vseccion','vunidinmob',
'tdoccony','doccony','nomcony','vdeclaracion','ccodcat','sector','departamento','provincia'];



public function ListarPersonasModel(){

$sql = $this->db->query("select idsigma as codigo, vnombre as nombre, concat(cdenomi,'- MZA. ',vmanzan,' LTE. ',vlote) as direccion from public.mperson");
$resultado = $sql->getResultArray();

return $resultado;


}

public function ListarTipoPersonaModel(){
    $sql = $this->db->query("select idsigma,vdescri from public.mconten m where cidtabl='1000000092'");

    $resultado = $sql->getResultArray();
    return $resultado;
}

public function LitarTipoDocumento(){
    $sql = $this->db->query("select idsigma, vdescri from public.mconten m where cidtabl='1000000528'");

    $resultado = $sql->getResultArray();
    return $resultado;
    
}

public function ListarTipoEstadoCivil(){
    $sql = $this->db->query("select idsigma, vdescri from public.mconten m where cidtabl='0000000250'");

    $resultado = $sql->getResultArray();
    return $resultado;
}
public function ListarDepartamento(){

    $sql = $this->db->query("select idsigma , vnombres from registro.mubigeo where idprovincia='00' and nestado='1' AND iddepartamento!='00' ORDER BY vnombres ASC");

    $resultado = $sql->getResultArray();
    return $resultado;
}

public function ListarProvinciaModel(){
    $sql = $this->db->query("select idsigma,vnombres from registro.mubigeo where idprovincia!='00' ORDER BY vnombres ASC");
    $resultado = $sql->getResultArray();

    return $resultado;
}

public function ListarDistritoModel(){
    $sql = $this->db->query("select idsigma,vnombres from registro.mubigeo where idprovincia!='00' ORDER BY vnombres ASC");
    $resultado = $sql->getResultArray();

    return $resultado;
}

public function SexoModel(){

    return [

        1=>"MASCULINO",
        2=>"FEMENINO"

    ];
}
    
public function GuardarRegistroModel($data){

    $entradaUltima = $this->orderBy('idsigma','DESC')->first();
    $entradaUltimaDecl = $this->orderBy('vdeclaracion','DESC')->first();

    $idultimo = isset($entradaUltima['idsigma'])?(int)$entradaUltima['idsigma']:0; 
    $idUltimoDecl= isset($entradaUltimaDecl['vdeclaracion'])?(int)$entradaUltimaDecl['vdeclaracion']:0;

    $nuevo_id = str_pad($idultimo+1,10,'0',STR_PAD_LEFT);
    $nuevo_id_decl = ($idUltimoDecl+1);

    $data['idsigma']=$nuevo_id;
    $data['vdeclaracion']=$nuevo_id_decl;

    $this->protect(false)->insert($data,false);

    return $this->affectedRows()>0;

}

public function EditarRegistroPersonaModel($data){

    if(!isset($data['idsigma'])||empty($data['idsigma'])){

		return false;
	}

    $idsigma = $data['idsigma'];

    unset($data['idsigma']);

    $this->protect(false)
    ->where('idsigma',$idsigma)
    ->set($data)
    ->update();

    return $this->db->affectedRows()>0;
    

}

public function BuscarRegistroPersonaModel($idsigma){

   $obje_persona= $this->select("idsigma,ctipper,ctipdoc,vdeclaracion,vnrodoc,vnombre,csexo,cestciv,dfecnac,ctelfij,ctelmov,vcorreo,vobserv,departamento,provincia,mubigeo,
   cdenomi,vnumero,vdpto,vmanzan,vlote,vinterior,vletra,vestacionto,vdeposito,vbloque,vseccion,vunidinmob,sector,ccodcat,vreferen")
   ->where('idsigma',$idsigma)
   ->first();

   return $obje_persona;

}

}


