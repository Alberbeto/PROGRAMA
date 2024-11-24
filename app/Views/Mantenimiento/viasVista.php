<?= $this->extend('tema/template')?>
<?= $this->section('content')?>
<!-- Button trigger modal -->
<!-- Button trigger modal -->

<div class="card mt-4">
    <div class="card-header">
        <li class="breadcrumb-item active"><i class="fa fa-truck-fast"></i>VIAS </li>
    </div>
    <div class="container-fluid px-4 mt-4 mb-4">
        
            <button type="button" class="btn btn-success" data-bs-toggle="modal"  onclick="abrirmodal(null)">
                    CREAR NUEVA VIA
            </button>
    </div>
    <div class="card-body">
            <table id="miTabla" class="table table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>CODIGO</th>
                        <th>TIPO VIA</th>
                        <th>VIA </th>
                        <th>NOMBRE VIA</th>
                        <th>DESDE</th>
                        <th>HASTA</th>
                        <th>ESTADO</th>
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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">NUEVO VIA</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" class="form-control"  id="idsigma" name="idsigma" required>

                            <div class="col-sm-6">
                                <label for="tipo" class="form-label">TIPO</label>
                                <select class="form-select" aria-label="Default select example" id="ctipvia" name="ctipvia" required>
                                <?php if(!empty($tipos)){ ?> 
                                    <?php foreach($tipos as $tipo){ ?>
                                        <option value="<?php echo $tipo["idsigma"];?>"><?php echo $tipo["vdescri"];?></option>
                                    <?php }?> 
                                    <?php }else{?>
                                            <option value="">No hay sectores disponibles</option>
                                        <?php } ?>
                                    
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="txtNombres" class="form-label">VIA</label>
                                <input type="text" class="form-control" id="vnombre" name="vnombre" required>
                            </div>
                            <div class="col-sm-6">
                                <label for="desdeyear" class="form-label">DESDE</label>
                                <select class="form-select" aria-label="Default select example" id="dfecdes" name="dfecdes">
                                <?php if(!empty($anios)){ ?> 
                                    <?php foreach($anios as $anio){ ?>
                                        <option value="<?= esc($anio) ?>"><?= esc($anio) ?></option>
                                    <?php }?> 
                                    <?php }else{?>
                                            <option value="">No hay sectores disponibles</option>
                                        <?php } ?>
                                    
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="hastayear" class="form-label">HASTA</label>
                                <select class="form-select" aria-label="Default select example" id="dfechas" name="dfechas">
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

    var filaseleccionada;
    var tabladata;

 

    function abrirmodal(json){
           $('#idsigma').val(0),
            $('#vnombre').val(""),        
            $('#cdistri').val(22),
            $('#cidzona').val(1),
            $('#nestado').prop('checked', true);
           
          
            
        
        $('#mensajeError').hide()

        if(json!=null){

            $('#idsigma').val(json.idsigma);
            $('#vnombre').val(json.vnombre);        
            $('#ctipvia').val(json.ctipvia);
            
            $('#dfecdes').val(json.dfecdes);   
            $('#dfechas').val(json.dfechas);  
            $('#ddatetm').val(json.ddatetm);   
            $('#vusernm').val(json.vusernm);   
            $('#vhostnm').val(json.vhostnm);   
            $('#nestado').prop('checked',json.nestado==1); 
        }
       
        $('#formModal').modal("show");

    }

//listar centro poblado
  $(document).ready(function(){

    var tabla= $('#miTabla').DataTable({
        "pagueLength":20,
        "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json" // Traducir a español
            }
    });
    listar(tabla);
   
  })

   function listar(tabla){
    $.ajax({
        url:'vias',
        dataType:'json',
        type:'GET',
        
        success:function(response){
            var data = response.data;
            
            //$('#miTabla tbody').empty();
            tabla.clear();
           data.forEach(function(item){

            var fila = $('<tr></tr>');

            fila.append('<td>'+item.codigo+'</td>');
            fila.append('<td>'+item.tipo_via +'</td>');
            fila.append('<td>'+item.via +'</td>');
            fila.append('<td>'+item.nombre_via +'</td>');
            fila.append('<td>'+item.desde +'</td>');
            fila.append('<td>'+item.hasta +'</td>');
            fila.append('<td>'+item.estado+'</td>');
            fila.append('<td><button type="button" class="btn btn-primary btn-sm btn-editar" onclick="editar(\'' + item.codigo + '\')"><i class="fas fa-pen"></i></button></td>');

            if(item.estado=='0'){
                fila.addClass('fila-roja');
            }
            
            //$('#miTabla tbody').append(fila);
            
            tabla.row.add($(fila)[0]);


           });

           tabla.draw();
        }
        
    })
  }


  //guardar centro poblado
  function Guardar(){
         $.ajax({

            url:'InsertarVia',
            type: 'POST',
            data:$('#insertar').serialize(),
            dataType:'json',
            success:function(data){

                    if(data.status=="success"){

                       $('#formModal').modal("hide");
                       listar();
                       $('#idsigma').val(0);
                        $('#vnombre').val("");        
                        $('#nestado').val(1);
              
                    }else {
                              $('#mensajeError').text(data.mensaje).show();
                               
                        }   
                    
            }
        })

    }


//editar

function editar(id){
    $.ajax({

    url:'BuscarId',
    type:'POST',
    data:{

         id_via: id
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