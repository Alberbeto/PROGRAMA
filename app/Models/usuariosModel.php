<?php

namespace App\Models;

use CodeIgniter\Model;

class usuariosModel extends Model
{

    
    public function obtenerUsuario($p_usuario,$p_password){

        $usuario=$this->db->table("seguridad.usuario");
        $usuario->where(['usuario'=>$p_usuario,'clave'=>$p_password]);
        return $usuario->get()->getResultArray();
    }

    public function obtenerSectores(){
        
        $sql=$this->db->table("registro.psector");
        return $sql->get()->getResultArray();
    }

    public function obtenerTipo(){
    $tipo= $this->db->query("select * from public.mconten r where cidtabl ='1000000025'");
    $resultado = $tipo->getResultArray();
    return $resultado;
        
    }

    public function ListaCentroPoblado(){
        $sql=$this->db->query("select m.idsigma as ID, p.vobserv as TIPO,p.vdescri as descri, m.vnombre as NOMBRE ,
                                m.cidzona as ZONA, h.vdescrip  as SECTOR, concat(p.vobserv ,' - ',h.vdescrip) as NOMBRE_COMPLETO,
                                date_part('year',m.dfecdes) as DESDE , date_part ('year',m.dfechas) as HASTA, m.nestado as ESTADO
                                from registro.mpoblad m
                                inner join public.mconten p
                                on m.ctipcen  = p.idsigma 
                                inner join registro.psector h 
                                on m.nsector = h.cid_sector 
                                order by m.vnombre asc");
        $resultado = $sql->getResultArray();
        return $resultado;
    }

    public function obtenerFecha() {

        //variales de años desde 1996 hasta 2024
        $incioYear=1996;
        $finYear=2024;

        // realizamos el rango de años
        $years=range($incioYear,$finYear);
        //lo agremaos a una lista array 
        $fecha=[];
        
        //recoremos dentro de un foreach el array de datos fecha
        foreach($years as $year){

            //agregamos el años seleccioando al array con su mes y horario
            $fecha[]= $year;
         
        }

        //lo retornamos 
        return $fecha;

        
    }

   //tabla registro.mpoblad 

    protected $table='registro.mpoblad';// nombre de la tabla ()
    protected $primaryKey  = 'idsigma';// nombre de la llave primaria
    protected $returnType  = 'array';// ripo de dato devuelto
    protected $useAutoIncrement = false;
    protected $allowedFields  = ['idsigma','ccodcen','vnombre','cdistri',
    'ctipcen','cidzona','dfecdes','dfechas','nestado','vhostnm','vusernm','ddatetm',
    'nsector']; // campos permitidos para la insercion

    public function InsertarNuevaId($data){

        //$sql=$this->db->table("registro.psector");
        //trataremos de obtnener de forma descendete el primera fila
        $EntradaUltima = $this->orderBy('idsigma','DESC')->first();
        //verificamos si esa ultima entrada existe si es asi , me la devukve en entero si no 
        // un 0
        $IdUltimo=isset($EntradaUltima['idsigma'])?(int)$EntradaUltima['idsigma'] :0;
        // rellena los campos de la ziquiera con 0 10 veces
        $IdNuevo = str_pad($IdUltimo + 1,10,'0',STR_PAD_LEFT);

        //agregar el nuevo idsigma al array de datos 
        $data['idsigma'] = $IdNuevo;
        $data['ccodcen'] = $IdNuevo;

        //insertar los datos a la tabla 

        $this->protect(false)->insert($data,false);

        return $this->db->affectedRows() > 0;
    }

    public function BuscarPorIdModel($id){
       
        //$obj_cp= $this->find($id);
        $obj_cp= $this->select(" idsigma,vnombre,ctipcen,cidzona,nsector,nestado,date_part('year',dfecdes) as dfecdes , date_part ('year',dfechas) as dfechas") // Extraer solo el año
        ->where('idsigma', $id)
        ->first();
    
        return $obj_cp;
        

    }

    public function EditarId($data){
       
        if(!isset($data['idsigma']) || empty($data['idsigma'])){
            return false;
        }
       

        $idsigma = $data['idsigma'];
        unset($data['idsigma']); 

        $this->protect(false)
            ->where('idsigma',$idsigma)
            ->set($data)
            ->update();

        return $this->db->affectedRows() > 0;
    }
 
    /*public function EliminarId($data){
        if(!isset($data['idsigma']) || empty($data['idsigma'])){
            return false;
        }
       
        $this->protect(false)
            ->where('idsigma',$data)
            ->set($data)
            ->update();



        return $this->db->affectedRows() > 0;
    }*/

}

   
