<?= $this->extend('tema/template')?>
<?= $this->section('content')?>
<!-- Button trigger modal -->
<!-- Button trigger modal -->

<div class="card mt-4">
    <div class="card-header">
        <li class="breadcrumb-item active"><i class="fa-solid fa-file-pen"></i>PERSONAS </li>
    </div>
    <div class="container-fluid px-4 mt-4 mb-4">
        
            <button type="button" class="btn btn-success" data-bs-toggle="modal"  onclick="abrirmodal(null)">
                    CREAR NUEVA PERSONA
            </button>
    </div>
    <div class="card-body">
            <table id="miTabla" class="table table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>CODIGO</th>
                        <th>ADMINISTRADO</th>
                        <th>DIRECCION FISCAL</th>
                        <th>ACCIONES</th>
                        
                    </tr>
                </thead>
                <tbody>
                   
                </tbody>
            </table>
    </div>
</div>


<!-- Modal -->
<form action="<?php echo base_url('vias') ?>" method="post" id="insertar">
    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel" style="color:#1b66fa ;font-weight: bold">MANTENIMIENTO PERSONA</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel" style="color:#1b66fa;font-weight: bold">
                            IDENTIFICACION DE LA PERSONA
                        </h1>
                    </div>
                    <div class="row">
                    <!--<input type="hidden" class="form-control"  id="idsigma" name="idsigma" required>-->
                        <div class="col-sm-6">
                                <label for="txtNombres" class="form-label" >CODIGO</label>
                                <input type="text" readonly  class="form-control" id="idsigma" name="idsigma" required>
                        </div>
                        <div class="col-sm-6">
                                <label for="txtNombres" class="form-label" >DECLARACION</label>
                                <input type="text" readonly  class="form-control" id="vdeclaracion" name="vdeclaracion" required>
                        </div>
                            <div class="col-sm-4">
                                <label for="tipoPersona" class="form-label" >TIPO PERSONA</label>
                                <select class="form-select" aria-label="Default select example" id="ctipper" name="ctipper" required>
                                <?php if(!empty($personasTipos)){ ?> 
                                    <?php foreach($personasTipos as $personasTipo){ ?>
                                        <option value="<?php echo $personasTipo["idsigma"];?>"><?php echo $personasTipo["vdescri"];?></option>
                                    <?php }?> 
                                    <?php }else{?>
                                            <option value="">No hay sectores disponibles</option>
                                        <?php } ?>
                                    
                                </select>
                        </div>
                            <div class="col-sm-4">
                                <label for="tipoDocumento" class="form-label" >TIPO DOCUMENTO</label>
                                <select class="form-select" aria-label="Default select example" id="ctipdoc" name="ctipdoc">
                                <?php if(!empty($dniTipos)){ ?> 
                                    <?php foreach($dniTipos as $dniTipo){ ?>
                                        <option value="<?php echo $dniTipo["idsigma"];?>"><?php echo $dniTipo["vdescri"] ?></option>
                                    <?php }?> 
                                    <?php }else{?>
                                            <option value="">No hay sectores disponibles</option>
                                        <?php } ?>
                                    
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="txtNombres" class="form-label" >NRO. DOCUMENTO</label>
                                <input type="text" class="form-control" id="vnrodoc" name="vnrodoc" required>
                            </div>
                            <div class="col-sm-12">
                                <label for="txtNombres" class="form-label" >NOMBRE Y/O RAZON SOCIAL</label>
                                <input type="text" class="form-control" id="vnombre" name="vnombre" required>
                            </div>
                            <div class="col-sm-4">
                                <label for="Sexo" class="form-label" >SEXO</label>
                                <select class="form-select" aria-label="Default select example" id="csexo" name="csexo">
                                        <option value="1">MASCULINO</option>
                                        <option value="2">FEMENINO</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="TipoEstadoCivil" class="form-label" >ESTADO CIVIL</label>
                                <select class="form-select" aria-label="Default select example" id="cestciv" name="cestciv">
                                <?php if(!empty($civilTipos)){ ?> 
                                    <?php foreach($civilTipos as $civilTipo){ ?>
                                        <option value="<?php echo $civilTipo["idsigma"]; ?>"><?php echo $civilTipo["vdescri"] ?></option>
                                    <?php }?> 
                                    <?php }else{?>
                                            <option value="">No hay sectores disponibles</option>
                                        <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="fecha" class="form-label">FECHA DE NACIMIENTO</label>
                                <input type="date" class="form-control" id="dfecnac" name="dfecnac">
                            </div>
                            <div class="col-sm-4">
                                <label for="txtNombres" class="form-label" >NRO. DE TELEFONO</label>
                                <input type="text" class="form-control" id="ctelfij" name="ctelfij" required>
                            </div>
                            <div class="col-sm-4">
                                <label for="txtNombres" class="form-label" >NRO. DE MOVIL</label>
                                <input type="text" class="form-control" id="ctelmov" name="ctelmov" required>
                            </div>
                            <div class="col-sm-4">
                                <label for="txtNombres" class="form-label" >CORREO ELECTRONICO</label>
                                <input type="text" class="form-control" id="vcorreo" name="vcorreo" required>
                            </div>
                            <div class="col-sm-12">
                                <label for="vobserv" class="form-label" >OBSERVACIONES</label>
                                <textarea class="form-control" id="vobserv" name="vobserv" rows="5"></textarea>
                            </div>
                </div>
            </div>


            <!--Direccion fiscal-->

            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel" style="color:#1b66fa;font-weight: bold">
                            DIRECCION FISCAL
                        </h1>
                    </div>
                    <div class="row">
                        
                            <div class="col-sm-4">
                                <label for="Departamento" class="form-label" >DEPARTAMENTO</label>
                                <select class="form-select" aria-label="Default select example" id="departamento" name="departamento" required>
                                <?php if(!empty($departamentos)){ ?> 
                                    <?php foreach($departamentos as $departamento){ ?>
                                        <option value="<?php echo $departamento["idsigma"];?>"><?php echo $departamento["vnombres"];?></option>
                                    <?php }?> 
                                    <?php }else{?>
                                            <option value="">No hay sectores disponibles</option>
                                        <?php } ?>
                                    
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="Provincias" class="form-label" >PROVINCIA</label>
                                <select class="form-select" aria-label="Default select example" id="provincia" name="provincia">
                                <?php if(!empty($provincias)){ ?> 
                                    <?php foreach($provincias as $provincia){ ?>
                                        <option value="<?php echo $provincia["idsigma"];?>"><?php echo $provincia["vnombres"]; ?></option>
                                    <?php }?> 
                                    <?php }else{?>
                                            <option value="">No hay sectores disponibles</option>
                                        <?php } ?>
                                    
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="Distrito" class="form-label" >DISTRITO</label>
                                <select class="form-select" aria-label="Default select example" id="mubigeo" name="mubigeo">
                                <?php if(!empty($distritos)){ ?> 
                                    <?php foreach($distritos as $distrito){ ?>
                                        <option value="<?php echo $distrito["idsigma"];?>"><?php echo $distrito["vnombres"] ?></option>
                                    <?php }?> 
                                    <?php }else{?>
                                            <option value="">No hay sectores disponibles</option>
                                        <?php } ?>
                                    
                                </select>
                            </div>
                            <div class="col-sm-12">
                                <label for="txtNombres" class="form-label" >URBANIZACION, ASENTAMIENTO HUMANO, ETC</label>
                                <input type="text" class="form-control" id="cdenomi" name="cdenomi" required>
                            </div>
                            <div class="col-sm-2">
                                <label for="vnumero" class="form-label" >NRO.</label>
                                <input type="text" class="form-control" id="vnumero" name="vnumero" required>
                            </div>
                            <div class="col-sm-2">
                                <label for="vdpto" class="form-label" >DPTO.</label>
                                <input type="text" class="form-control" id="vdpto" name="vdpto" required>
                            </div>
                            <div class="col-sm-2">
                                <label for="vmanzan" class="form-label" >MZ.</label>
                                <input type="text" class="form-control" id="vmanzan" name="vmanzan" required>
                            </div>
                            <div class="col-sm-2">
                                <label for="vlote" class="form-label" >LOTE</label>
                                <input type="text" class="form-control" id="vlote" name="vlote" required>
                            </div>
                            <div class="col-sm-2">
                                <label for="vinterior" class="form-label" >INTERIOR</label>
                                <input type="text" class="form-control" id="vinterior" name="vinterior" required>
                            </div>
                            <div class="col-sm-2">
                                <label for="vletra" class="form-label" >LETRA</label>
                                <input type="text" class="form-control" id="vletra" name="vletra" required>
                            </div>
                            <div class="col-sm-2">
                                <label for="vestacionto" class="form-label" >ESTABLECIMIENTO</label>
                                <input type="text" class="form-control" id="vestacionto" name="vestacionto" required>
                            </div>
                            <div class="col-sm-2">
                                <label for="vdeposito" class="form-label" >DEPOSITO</label>
                                <input type="text" class="form-control" id="vdeposito" name="vdeposito" required>
                            </div>
                            <div class="col-sm-2">
                                <label for="vbloque" class="form-label">Bloque</label>
                                <input type="text" class="form-control" id="vbloque" name="vbloque" required>
                            </div>
                            <div class="col-sm-2">
                                <label for="vseccion" class="form-label" >SECCION</label>
                                <input type="text" class="form-control" id="vseccion" name="vseccion" required>
                            </div>
                            <div class="col-sm-2">
                                <label for="vunidinmob" class="form-label" >UNID. INMOBILIARIA</label>
                                <input type="text" class="form-control" id="vunidinmob" name="vunidinmob" required>
                            </div>
                            <div class="col-sm-2">
                                <label for="sector" class="form-label" >SECTOR</label>
                                <input type="text" class="form-control" id="sector" name="sector" required>
                            </div>
                            <div class="col-sm-4">
                                <label for="ccodcat" class="form-label" >COD. CATASTRAL</label>
                                <input type="text" class="form-control" id="ccodcat" name="ccodcat" required>
                            </div>
                            <div class="col-sm-12">
                                <label for="vreferen" class="form-label" >REFERENCIA</label>
                                <textarea class="form-control" id="vreferen" name="vreferen" rows="5"></textarea>
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
                            <input type="hidden" class="form-control"  id="nestado" name="nestado" required>          
                            <input type="hidden" class="form-control"  id="ntipers" name="ntipers" required>
                            <input type="hidden" class="form-control"  id="ntipper" name="ntipper" required>
                            <input type="hidden" class="form-control"  id="dfecinic" name="dfecinic" required>
                            <input type="hidden" class="form-control"  id="vpatern" name="vpatern" required>
                            <input type="hidden" class="form-control"  id="vmatern" name="vmatern" required>
                        </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CERRAR</button>
                    <button type="button" class="btn btn-primary" id="insertarDatos" onclick="Guardar()">GUARDAR</button>
                </div>
         
            </div>                            
                                    <!--FINAL-->
        </div>
    </div>
  
</form>

<script>

    var filaseleccionada;
    var tabladata;

 

    function abrirmodal(json){
           $('#idsigma').val(0),
            $('#vdeclaracion').val(0),        
            $('#vnrodoc').val(""),
            $('#vpatern').val(""),
            $('#vmatern').val(""),
            $('#vnombre').val(""), 
            $('#ctelfij').val(""),
            $('#ctelmov').val(""),
            $('#vcorreo').val(""),
            $('#vobserv').val(""),
            $('#cdenomi').val(""),
            $('#vnumero').val(""),
            $('#vdpto').val(""),
            $('#vmanzan').val(""),
            $('#vlote').val(""),
            $('#vinterior').val(""),
            $('#vletra').val(""),
            $('#vestacionto').val(""),
            $('#vdeposito').val(""),
            $('#vbloque').val(""),
            $('#vseccion').val(""),
            $('#vunidinmob').val(""),
            $('#sector').val(""),
            $('#ccodcat').val(""),
            $('#vreferen').val(""),
            
           
        
        $('#mensajeError').hide()

        if(json!=null){

            $('#idsigma').val(json.idsigma),
            $('#ctipper').val(json.ctipper),
             $('#ctipdoc').val(json.ctipdoc),
            $('#vdeclaracion').val(json.vdeclaracion),        
            $('#vnrodoc').val(json.vnrodoc),
            $('#vnombre').val(json.vnombre), 
            $('#csexo').val(json.csexo),
            $('#cestciv').val(json.cestciv),

            /*crea un nuevea fecha. luego lo el objeto a una cdena en ISO 8601 que generalmente
            es de forma  'YYYY-MM-DDTHH:mm:ss.sssZ' con split('T') delimitaor 
            qeu los agrega a un array que contiene dos elementos 
            ['YYYY-MM-DDTHH','mm:ss.sssZ'] y accedemos al primero elemento[0]*/
            $('#dfecnac').val(new Date(json.dfecnac).toISOString().split('T')[0]), 
            
            $('#ctelfij').val(json.ctelfij),
            $('#ctelmov').val(json.ctelmov),
            $('#vcorreo').val(json.vcorreo),
            $('#vobserv').val(json.vobserv),
            $('#departamento').val(json.departamento),
            $('#provincia').val(json.provincia),
            $('#mubigeo').val(json.mubigeo),
            $('#cdenomi').val(json.cdenomi),
            $('#vnumero').val(json.vnumero),
            $('#vdpto').val(json.vdpto),
            $('#vmanzan').val(json.vmanzan),
            $('#vlote').val(json.vlote),
            $('#vinterior').val(json.vinterior),
            $('#vletra').val(json.vletra),
            $('#vestacionto').val(json.vestacionto),
            $('#vdeposito').val(json.vdeposito),
            $('#vbloque').val(json.vbloque),
            $('#vseccion').val(json.vseccion),
            $('#vunidinmob').val(json.vunidinmob),
            $('#sector').val(json.sector),
            $('#ccodcat').val(json.ccodcat),
            $('#vreferen').val(json.vbvreferen) 
        }
       
        $('#formModal').modal("show");

    }

//editar centro poblado
  $(document).ready(function(){
   var tabla=$('#miTabla').DataTable({

            "pagueLength": 20,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json" // Traducir a español
            }
    });
    
    listar(tabla);
   
  });

   function listar(tabla){
    $.ajax({
        url:'personas',
        dataType:'json',
        type:'GET',
        
        success:function(response){
            var data = response.datos;
            
            tabla.clear();
            data.forEach(function(item){

         
           var fila = $('<tr></tr>');

            fila.append('<td>' + item.codigo + '</td>');
            fila.append('<td>' + item.nombre + '</td>');
            fila.append('<td>' + item.direccion + '</td>');
            fila.append('<td><button type="button" class="btn btn-primary btn-sm btn-editar" onclick="editar(\''+item.codigo+'\')"><i class="fas fa-pen"></i></button></td>');

            

           tabla.row.add($(fila)[0]);

           });

           tabla.draw();
          
        }
        
    })
  };


  //guardar centro poblado
  function Guardar(){
         $.ajax({

            url:'InsertarPersonas',
            type: 'POST',
            data:$('#insertar').serialize(),
            dataType:'json',
            success:function(data){

                    if(data.status=="success"){

                       $('#formModal').modal("hide");
                                            Swal.fire({
                        title: "REGISTRO GUARDADO EXITOSAMENTE!",
                        icon: "success"
                        });
                       listar();
                       $('#idsigma').val(0);
                        $('#vdeclaracion').val(0);        
                        $('#vnrodoc').val("");
                        $('#vnombre').val(""); 
                        $('#ctelfij').val("");
                        $('#ctelmov').val("");
                        $('#vcorreo').val("");
                        $('#vobserv').val("");
                        $('#cdenomi').val("");
                        $('#vnumero').val("");
                        $('#vdpto').val("");
                        $('#vmanzan').val("");
                        $('#vlote').val("");
                        $('#vinterior').val("");
                        $('#vletra').val("");
                        $('#vestacionto').val("");
                        $('#vdeposito').val("");
                        $('#vbloque').val("");
                        $('#vseccion').val("");
                        $('#vunidinmob').val("");
                        $('#sector').val("");
                        $('#ccodcat').val("");
                        $('#vreferen').val("");
                        
              
                    }else if(data.status=="ok"){

                            $('#formModal').modal("hide");
                                                Swal.fire({
                            title: "REGISTRO ACTUALIZADO EXITOSAMENTE",
                            icon: "success"
                            });
                            listar();
                            $('#idsigma').val(0);
                            $('#vdeclaracion').val(0);        
                            $('#vnrodoc').val("");
                            $('#vnombre').val(""); 
                            $('#ctelfij').val("");
                            $('#ctelmov').val("");
                            $('#vcorreo').val("");
                            $('#vobserv').val("");
                            $('#cdenomi').val("");
                            $('#vnumero').val("");
                            $('#vdpto').val("");
                            $('#vmanzan').val("");
                            $('#vlote').val("");
                            $('#vinterior').val("");
                            $('#vletra').val("");
                            $('#vestacionto').val("");
                            $('#vdeposito').val("");
                            $('#vbloque').val("");
                            $('#vseccion').val("");
                            $('#vunidinmob').val("");
                            $('#sector').val("");
                            $('#ccodcat').val("");
                            $('#vreferen').val("");
                            

                            }
                    
            }
        })

    }


//editar

function editar(id){
    $.ajax({

    url:'BuscarPersona',
    type:'POST',
    data:{

        id_persona: id
    },
    dataType:'json',
    success:function(res){

            if(res.status=='success'){ 

                    $('#idsigma').val(res.data),
                    
                    abrirmodal(res.data);
                   

                    //codigo:$('#idsigma').val(id_cp)

            }else {
                        $('#mensajeError').text(data.mensaje).show();
                }   
            }

           
        })
}

/*function eliminar(id) {
    // Confirmar la eliminación con SweetAlert
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás recuperar este registro!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {// interaccion del iusaurio con el cuadro de dialogo 
        if (result.isConfirmed) {
            // Realizar la solicitud AJAX si se confirma la eliminación
            $.ajax({
                url: 'EliminarId',
                type: 'POST',
                dataType: 'json',
                data: {
                    idsigma: id
                },
                success: function (res) {
                    if (res.status == 'success') {
                        Swal.fire(
                            'Eliminado!',
                            res.mensaje,
                            'success'
                        );
                        $('#formModal').modal("hide");
                    } else {
                        Swal.fire(
                            'Error!',
                            res.mensaje,
                            
                            'error'
                        );
                    }
                },
                error: function () {
                    Swal.fire(
                        'Error!',
                        'Hubo un problema con la solicitud.',
                        'error'
                    );
                }
            });
        }
    });
}*/

/*$('#miTabla tbody').on('click','.btn-editar',function(){

filaseleccionada = $(this).closest('tr');
 var dataeditar={
        codigo: filaseleccionada.find('td:eq(0)').text(),
        tipo: filaseleccionada.find('td:eq(1)').val(),
        nombre: filaseleccionada.find('td:eq(2)').text(),
        zona: filaseleccionada.find('td:eq(3)').text(),
        sector: filaseleccionada.find('td:eq(4)').text(),
        
        desde: filaseleccionada.find('td:eq(6)').text(),
        hasta: filaseleccionada.find('td:eq(7)').text(),
       
 }
 abrirmodal(dataeditar);

})*/

    
</script>

<?= $this->endSection('content')?>