<?php 
namespace App\Models;

use CodeIgniter\Model;

class homeModel extends Model
{
    public function clientes_list(){
        $sql = "select * from seguridad.usuario u ";
        $query = $this->db->query($sql);
        $resultado = $query->getResult();

        if(count($resultado)>=1){
            return $resultado;
        }else{
            return null;
        }
    }
}