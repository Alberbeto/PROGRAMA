<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/estilo.css');?>">
	<link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/bootstrap.css');?>">
</head>
<body>
<form action="" class="form-inline d-flex justify-content-center flex-column flex-md-row">
    <div class="form-group mx-2 my-2">
			<label class="d-none d-md-block" for="">Codigo</label>
			<input type="text" class="form-control" placeholder="Codigo">
		</div>
		<div class="form-group mx-2 my-2">
			<label class="d-none d-md-block" for="">Nombre</label>
			<input type="text" class="form-control" placeholder="Nombre">
		</div>
		<div class="form-group mx-2 my-2">
			<label class="d-none d-md-block" for="">Apellido</label>
			<input type="text" class="form-control" placeholder="Apellido">
		</div>
		<div class="form-group mx-2 my-2">
			<button class="btn btn-outline-primary">Consultar</button>
		</div>
        <div class="form-group mx-2 my-2">
			<button class="btn btn-outline-primary"><a href="<?= base_url('login');?>">Salir</a></button>
		</div>
	</form>
    <script src="<?= base_url('assets/fontawesome/js/jquery-3.3.1.slim.min.js');?>"></script>
	<script src="<?= base_url('assets/fontawesome/js/popper.min.js');?>"></script>
	<script src="<?= base_url('assets/fontawesome/js/bootstrap.min.js');?>"></script>
</body>

</html>