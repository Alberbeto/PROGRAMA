<?php

namespace App\Models\viasModel;

use CodeIgniter\Model;

class viasModelo extends Model
{
    protected $table ='registro.mviadis';
    protected $primaryKey ='idsigma';
    protected $useAutoIncrement = false;
    protected $returnType='array';
    protected $allowedFields = ['idsigma','ccodvia','ctipvia','vnombre','dfecdes','dfechas','nestado',
    'vhostnm','vusernm','ddatetm','descripcion'];

    
    public function ListarVias(){

        $sql=$this->db->query("select m.idsigma as codigo,P.vobserv as tipo_via,m.vnombre as via, concat(p.vobserv ,'  ', m.vnombre) as nombre_via,date_part('year',m.dfecdes) as desde,
                                date_part ('year',m.dfechas)  as hasta , m.nestado  as estado from registro.mviadis m 
                                inner join public.mconten p
                                on m.ctipvia = p.idsigma 
                                order by m.vnombre asc");

        $resultado = $sql->getResultArray();
      
        return $resultado;
    }


    public function obtenerFechas(){

        $inicio=1996;
        $fin=2024;

        $years= range($inicio,$fin);
        $fecha=[];

        foreach($years as $year){
            
            $fecha[]=$year;   
        }

        return $fecha;
    }

    public function obtenerTipos(){

        $sql = $this->db->query("select * from mconten m where cidtabl ='1000000070'");

        $resultado = $sql->getResultArray();
        return $resultado;
    }

    


    public function InsertarNuevaVia($data){

        $EntradaUltima = $this->orderBy('idsigma','DESC')->first();

        $idUltimo = isset($EntradaUltima['idsigma'])?(int)$EntradaUltima['idsigma']:0;

        $nuevoId = str_pad($idUltimo+1,10,'0',STR_PAD_LEFT);

        $data['idsigma']=$nuevoId;
        $data['ccodvia']=$nuevoId;

        $this->protect(false)->insert($data,false);

        return $this->db->affectedRows() > 0;
    }

    public function BuscarPorId($idsigma){

        $obj_via = $this->select("idsigma,ctipvia,vnombre,nestado,date_part('year',dfecdes) as dfecdes , date_part('year',dfechas) as dfechas")
        ->where('idsigma',$idsigma)
        ->first();

        return $obj_via;
    }


    public function EditarVia($data){
    if(!isset($data['idsigma']) || empty($data['idsigma'])){

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

}