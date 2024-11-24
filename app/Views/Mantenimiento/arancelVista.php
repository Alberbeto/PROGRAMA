<?= $this->extend('tema/template')?>
<?= $this->section('content')?>
<!-- Button trigger modal -->
<!-- Button trigger modal -->

<div class="card mt-4">
    <div class="card-header">
        <li class="breadcrumb-item active"><i class="fa fa-road"></i>ARANCEL </li>
    </div>
    <div class="container-fluid px-4 mt-4 mb-4">
        
            <button type="button" class="btn btn-primary" data-bs-toggle="modal"  onclick="abrirmodal(null)">
                    CREAR NUEVA ARANCEL
            </button>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="row"> <!-- Filas para organizar horizontalmente -->
                <div class="col-lg-6 col-md-12 mb-3"> <!-- Columna para la primera tabla -->
                    <div class="table-responsive"> <!-- Contenedor responsivo -->
                        <table class="table table-bordered table-striped" id="miTabla">
                            <thead class="table-dark">
                            <tr>
                                <th>Codigo</th>
                                <th>Centro Poblado</th>
                                <th>Codigo Via</th>
                                <th>Via</th>
                                <th>Pred</th>
                            </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí se llenarán las filas dinámicamente -->
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="col-lg-6 col-md-12"> <!-- Columna para la segunda tabla -->
                    <div class="table-responsive"> <!-- Contenedor responsivo -->
                        <table class="table table-bordered table-striped" id="miTabla2">
                            <thead class="table-dark">
                            <tr>
                                <th>Codigo</th>
                                <th>Lado Via</th>
                                <th>Cuadra 1</th>
                                <th>Cuadra Fin</th>
                                <th>Arancel</th>
                                <th>Factor Bar</th>
                                <th>Periodo</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí se llenarán las filas dinámicamente -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- Fin de la fila -->
        </div>
    </div>
   
    
</div>

<!-- Modal -->
<form action="<?php echo base_url('vias') ?>" method="post" id="insertar">
    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">NUEVO ARANCEL</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" class="form-control"  id="idsigma" name="idsigma" required>

                            <div class="col-sm-6">
                                <label for="tipo" class="form-label">CENTRO POBLADO</label>
                                <select class="form-select" aria-label="Default select example" id="mpoblad" name="mpoblad" required>
                                <?php if(!empty($centros_pobla)){ ?> 
                                    <?php foreach($centros_pobla as $centro_pobla){ ?>
                                        <option value="<?php echo $centro_pobla["codigo"];?>"><?php echo $centro_pobla["nombre"];?></option>
                                    <?php }?> 
                                    <?php }else{?>
                                            <option value="">No hay sectores disponibles</option>
                                        <?php } ?>
                                    
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="txtNombres" class="form-label">VIA</label>
                                <select class="form-select" aria-label="Default select example" id="mviadis" name="mviadis">
                                <?php if(!empty($vias)){ ?> 
                                    <?php foreach($vias as $via){ ?>
                                        <option value="<?php echo $via["codigovia"];?>"><?php echo $via["nombrevia"];?></option>
                                    <?php }?> 
                                    <?php }else{?>
                                            <option value="">No hay sectores disponibles</option>
                                        <?php } ?>
                                    
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="txtLado" class="form-label">LADO</label>
                                <input type="text" class="form-control" id="nladvia" name="nladvia" required>
                            </div>
                            <div class="col-sm-6">
                                <label for="txtArancel" class="form-label">ARANCEL</label>
                                <input type="text" class="form-control" id="narance" name="narance" required>        
                            </div>
                            <div class="col-sm-6">
                                <label for="txtCuadra" class="form-label">CUADRA</label>
                                <input type="text" class="form-control" id="ncuaini" name="ncuaini" required>
                            </div>
                            <div class="col-sm-6">
                                <label for="txtCuadraInicio" class="form-label">CUADRA INICIO</label>
                                <input type="text" class="form-control" id="ncuafin" name="ncuafin" required>        
                            </div>
                            <div class="col-sm-6">
                                <label for="txtFactoBarrido" class="form-label">FACTOR BARRIDO</label>
                                <input type="text" class="form-control" id="nfacbar" name="nfacbar" required>
                            </div>
                            <div class="col-sm-6">
                                <label for="periodo" class="form-label">PERIODO</label>
                                <select class="form-select" aria-label="Default select example" id="cperiod" name="cperiod">
                                <?php if(!empty($anios)){ ?> 
                                    <?php foreach($anios as $anio){ ?>
                                        <option value="<?= esc($anio) ?>"><?= esc($anio) ?></option>
                                    <?php }?> 
                                    <?php }else{?>
                                            <option value="">No hay sectores disponibles</option>
                                        <?php } ?>
                                    
                                </select>
                            </div>
                          
                    <div class="col-12 checkbox-container" style="width: 100%;">
                        <label for="nestado" class="form-label mb-0">ESTADO</label>
                        <input type="checkbox" class="form-check-input ms-4" id="nestado" name="nestado" value="1" <?= isset($usuario['nestado']) && $usuario['nestado'] == 1 ? 'checked' : '' ?>>
                    </div>
                        <div class="col-12 mt-4">
                                <div id="mensajeError" class="alert alert-danger" role="alert">
                                    A simple danger alert—check it out!
                                </div>
                            
                        </div>
                        
                        <div class="col-12 mt-4">
                            <!--<input type="hidden" class="form-control"  id="descripcion" name="descripcion" required>-->
                            <input type="hidden" class="form-control"  id="ddatetm" name="ddatetm" required>
                            <input type="hidden" class="form-control"  id="vusernm" name="vusernm" required>
                            <input type="hidden" class="form-control"  id="vhostnm" name="vhostnm" required>
                            <input type="hidden" class="form-control"  id="nfrebar" name="nfrebar" required>
                            <input type="hidden" class="form-control"  id="nfacbar_casa" name="nfacbar_casa" required>           


                           
                        </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CERRAR</button>
                    <button type="button" class="btn btn-primary" id="insertarDatos" onclick="Guardar()">GUARDAR</button>
                </div>
         
            </div>
        </div>
    </div>
</form>


<script>

function abrirmodal(json){

    $('#idsigma').val(0),
    $('#nladvia').val(1),
    $('#ncuaini').val(1),
    $('#nestado').prop('checked',true),
    $('#ncuafin').val(999),
    $('#nfrebar').val(0),
    $('#nfacbar_casa').val(0),

    $('#mensajeError').hide()

    if(json!=null){

        $('#idsigma').val(json.idsigma);
        $('#mpoblad').val(json.mpoblad);
        $('#mviadis').val(json.mviadis);
        $('#nladvia').val(json.nladvia);
        $('#ncuaini').val(json.ncuaini);
        $('#ncuafin').val(json.ncuafin);
        $('#narance').val(json.narance);
        $('#nfacbar').val(json.nfacbar);
        $('#cperiod').val(json.cperiod);
        $('#vhostnm').val(json.vhostnm);
        $('#vusernm').val(json.vusernm);
        $('#ddatetm').val(json.ddatetm);
       
        $('#nestado').prop('checked',json.nestado==1);

       
        
    }


    $('#formModal').modal("show")

    
}

$(document).ready(function(){
    
    var  tabla=$('#miTabla').DataTable({
            "pagueLength": 20, // Mostrar 20 filas por página
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json" // Traducir a español
            }
        });
    listar(tabla);
});



function listar(tabla){


    $.ajax({
        url:'ListarCompleta',
        dataType:'json',
        type:'GET',
        success:function(response){
            var data = response.data;

            tabla.clear();
            
            data.forEach(function(item){
                var fila = $("<tr style='cursor:pointer;' onclick='javascript:VerDetalle(\""+item.cod_centro+"\",\""+item.cod_via+"\")'></tr>");

                fila.append('<td>'+item.cod_centro+'</td>');
                fila.append('<td>'+item.centro_poblado+'</td>');
                fila.append('<td>'+item.cod_via+'</td>');
                fila.append('<td>'+item.via+'</td>');
                fila.append('<td>'+item.totpred+'</td>');
                
                tabla.row.add($(fila)[0]);

            });

            tabla.draw();
        }
    })


}


$(document).ready(function(){
    
    var tabla2= $('#miTabla2').DataTable({
             "pagueLength": 20, // Mostrar 20 filas por página
             "language": {
                 "url": "//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json" // Traducir a español
             }
         });
         listarArancel(tabla2);
 });

function listarArancel(tabla2){
    $.ajax({

        url:'ListarCompletaArancel',
        dataType:'json',
        type:'GET',
        success:function(response){

            var data = response.datos;
            
            tabla2.clear();

            data.forEach(function(item){

                var fila = $('<tr></tr>');

                fila.append('<td>'+item.codigo+'</td>');
                fila.append('<td>'+item.lado_via+'</td>');
                fila.append('<td>'+item.cuadra_ini+'</td>');
                fila.append('<td>'+item.cuadra_fin+'</td>');
                fila.append('<td>'+item.arancel+'</td>');
                fila.append('<td>'+item.factor_bar+'</td>');
                fila.append('<td>'+item.periodo+'</td>');
                fila.append('<td>'+item.estado+'</td>');
                fila.append('<td><button class="btn btn-primary" onclick="editarRegistro(\'' + item.codigo + '\')"><i class="fas fa-pen"></i></button></td>');


                tabla2.row.add($(fila)[0]); 
                console.log(data);   
                
            });

            tabla2.draw();
        }
    })
}



function VerDetalle(cod_centro,cod_via){

    /*console.log(cod_centro)*/
   $.ajax({

            url:'BuscarIdCenVia',
            type:'POST',
            data:{

                id_centro: cod_centro,
                id_vias:cod_via
            },
            dataType:'json',
            success:function(response){
                if(response.status=='success'){
                    var data=response.data;
                    var tabla3=  $('#miTabla2').DataTable();
                    tabla3.clear();
                    

                    data.forEach(function(item){

                        var fila = $('<tr></tr>');
                            fila.append('<td>'+item.codigo+'</td>');
                            fila.append('<td>'+item.lado_via+'</td>');
                            fila.append('<td>'+item.cuadra_inicio+'</td>');
                            fila.append('<td>'+item.cuadra_fin+'</td>');
                            fila.append('<td>'+item.arancel+'</td>');
                            fila.append('<td>'+item.factor_bar+'</td>');
                            fila.append('<td>'+item.periodo+'</td>');
                            fila.append('<td>'+item.estado+'</td>');
                            fila.append('<td><button class="btn btn-primary" onclick="editarRegistro(\'' + item.codigo + '\')"><i class="fas fa-pen"></i></button></td>');
                           
                        tabla3.row.add($(fila)[0]);
                    


                });

                tabla3.draw();
                }
                
            }

                
        })
}




function Guardar() {
    $.ajax({

        url:'InsertarArancel',
        type:'POST',
        dataType:'json',
        data:$('#insertar').serialize(),
        success:function(data){
            if(data.status=="success"){
                
                $('#formModal').modal("hide");
                listarArancel();
                $('#idsigma').val(0);
                $('#narance').val("");
                $('#nfrebar').val("");
                $('#nestado').val(1);
                
            }else {

                $('#mensajeError').text(data.mensaje).show();
               
            }

        }




    })
}


function editarRegistro(id){

    $.ajax({

        url:'BuscarIdArancel',
        type:'POST',
        dataType:'json',
        data:{

            id_arancel:id
        },
        success:function(res){

            if(res.status="success"){
                $('#idsigma').val(res.data);

                abrirmodal(res.data);
            }else {
                        $('#mensajeError').text(data.mensaje).show();
                }   
        }

    })
}



</script>

<?= $this->endSection('content')?>