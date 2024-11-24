<?php

namespace App\Models\arancelModel;

use CodeIgniter\Model;

class arancelModelo extends Model
{

	protected $table ='registro.marance';
    protected $primaryKey ='idsigma';
	protected $useAutoIncrement = false;
    protected $returnType='array';
    protected $allowedFields = ['idsigma','mpoblad' ,'mviadis' ,'nladvia','ncuaini','ncuafin','narance','nfacbar','cperiod','nestado'];


public function ListarCentViasModel(){

    $sql = $this->db->query("Select a.mpoblad as Cod_centro, b.tnompob as Centro_Poblado, a.mviadis as Cod_Via, c.tnomvia as Via  ,
			(select count(*) from registro.marance where mpoblad = a.mpoblad and  mviadis = a.mviadis and nestado = 1) cantidad, 
			COALESCE(d.totpred,0)totpred
	from (select mpoblad,mviadis from registro.marance group by mpoblad,mviadis) a
		inner join  registro.vwpoblad b on a.mpoblad=b.mpoblad
		inner join registro.vwviadis c on a.mviadis=c.mviadis
		left  join 
			(select p.mpoblad,p.mviadis,count(*) totpred
				from registro.mhresum h 
				inner join registro.dpredio dp on h.idsigma=dp.mhresum 
				inner join registro.mpredio p  on dp.mpredio=p.idsigma
				where dp.nestado='1' and h.nestado='1'
				group by p.mpoblad,p.mviadis
			) d on d.mpoblad = a.mpoblad and d.mviadis = a.mviadis 
		group by a.mpoblad, b.tnompob, a.mviadis, c.tnomvia  , d.totpred
		order by c.tnomvia,b.tnompob");
    
    $resulado = $sql->getResultArray();

    return $resulado;


} 

public function ListarArancelNetoModel(){
	$sql = $this->db->query("select m.idsigma as codigo,m.nladvia as lado_via,m.ncuaini as cuadra_ini,
m.ncuafin cuadra_fin, m.narance as arancel,m.nfacbar factor_bar,m.cperiod as periodo,
m.nestado as estado from registro.marance m ");

$resultado = $sql->getResultArray();
return $resultado;
}


public function ListarArancelesModel($mpoblad,$mviavia){

	$obj_arancer=$this->select("idsigma as codigo,nladvia as lado_via,ncuaini as cuadra_inicio,ncuafin as cuadra_fin,narance as arancel,nfacbar as factor_bar,cperiod as periodo,nestado as estado")
	->where('mpoblad',$mpoblad)
	->where('mviadis',$mviavia)
	->findAll();

	return $obj_arancer;
	
}


public function ListarCentropobladoModel(){

	$sql = $this->db->query("select m.idsigma as codigo, concat( m.ccodcen,'-',p.vobserv,' ', m.vnombre) as nombre from registro.mpoblad m
							inner join public.mconten p
							on m.ctipcen = p.idsigma");
	$resultado = $sql->getResultArray();
	return $resultado;
}

public function ListarViasModel(){

	$sql = $this->db->query("select m.idsigma as codigovia, concat( m.ccodvia,'-',p.vobserv,' ', m.vnombre) as nombrevia from registro.mviadis m
							inner join public.mconten p
							on m.ctipvia = p.idsigma ");
	$resultado = $sql->getResultArray();
	return $resultado;
}


public function ObtenerFechasModel(){

	$inicio = 1996;
	$fin = 2024;

	$years= range($inicio,$fin);
	$fecha=[];

	foreach($years as $year){
		$fecha[]=$year;
	}

	return $fecha;

}

public function InsertarNuevoArancelModel($data){

$EntradaUltima= $this->orderBy('idsigma','DESC')->first(); 

$idUltimo = isset($EntradaUltima['idsigma'])?(int)$EntradaUltima['idsigma']:0;

$nuevo_id=str_pad($idUltimo+1,10,'0',STR_PAD_LEFT);

$data['idsigma']=$nuevo_id;

$this->protect(false)->insert($data,false);

return $this->db->affectedRows()>0;



}

/*obtener los registros al aprtar el boton editar */

public function BuscarPorIdModel($idsigma){


	$obj_arancel = $this->select("idsigma,mpoblad,mviadis,nladvia,narance,ncuaini,ncuafin,nfacbar,cperiod,nestado")
	->where('idsigma',$idsigma)
	->first();

	return $obj_arancel;

}


public function EditarArancelModel($data){

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


}

