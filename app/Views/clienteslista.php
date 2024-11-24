<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Listado de Clientes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h1>Listado de Clientes</h1>
    <table class="table table-bordered" id="clientesTable">
        <thead>
            <tr>
                <th>IDCliente</th>
                <th>NombreCompañia</th>
                <th>NombreContacto</th>
                <th>CargoContacto</th>
                <th>Dirección</th>
                <th>Ciudad</th>
                <th>Pais</th>
                <th>Telefono</th>
            </tr>
        </thead>
        <tbody>
            <!-- Datos de clientes serán insertados aquí -->
        </tbody>
    </table>
</div>
<script>
$(document).ready(function() {
    $.ajax({
        url: '<?= base_url('public/clientelista') ?>',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            var clientesTable = $('#clientesTable tbody');
            clientesTable.empty();
            $.each(data, function(index, objcliente) {
                var row = $('<tr>');
                row.append($('<td>').text(objcliente.IdCliente));
                row.append($('<td>').text(objcliente.NombreCompañía));
                row.append($('<td>').text(objcliente.NombreContacto));
                row.append($('<td>').text(objcliente.CargoContacto));
                row.append($('<td>').text(objcliente.Dirección));
                row.append($('<td>').text(objcliente.Ciudad));
                row.append($('<td>').text(objcliente.País));
                row.append($('<td>').text(objcliente.Teléfono));
                clientesTable.append(row);
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error al obtener los datos: ' + textStatus);
        }
    });
});
</script>
</body>
</html>