<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/bootstrap.css');?>">
   <link rel="stylesheet" type="text/css" href="<?= base_url('assets/fontawesome/css/style.css');?>">
   <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KyZXEAg3QhqLMpG8r+Knujsl+5hb7uj6Jn9gBI3D5ksl6k5s3U4X5MEogqxG2HPClO6yjztGv3N7mWwz/YQ0Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/bootstrap.min.css'); ?>">
   <link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/all.min.css'); ?>">
   <!-- <link rel="stylesheet" href="css/all.min.css"> -->
   <!-- <link rel="stylesheet" href="css/fontawesome.min.css"> -->
   <link href="https://tresplazas.com/web/img/big_punto_de_venta.png" rel="shortcut icon">
   <title>Inicio de sesión</title>
</head>

<body>
   <!--<img class="wave" src="img/wave.png">-->
   <!--<div class="container">
     
      <div class="row">
         <div class="col-sm-6">
         <div class="img">
            <img src="<?= base_url('img/miperulogo.jpg'); ?>" alt="Mi Peru Logo" width="580px">
            </div>
         </div>
         <div class="col-sm-6">
         <img src="<?= base_url('img/avatar.svg'); ?>" width="280px">
         <h1>BIENVENIDO</h1>
           
            <form action="<?php echo base_url('menu') ?>" method="POST" >
               <label for="usuario">USUARIO</label>
               <input type="text" name="usuario" id="usuario" class="form-control" required="">
               <label for="clave">PASSWORD</label>
               <input type="password" name="clave" id="clave"class="form-control" required="">
               <br>
               <button class="btn btn-primary">INGRESAR</button>
            </form>
            <br>
           
            <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
         </div>
         
      </div>
   </div>-->

   <div class="container">
      <div class="img">
         <img src=<?= base_url('img/miperulogo.jpg'); ?>>
      </div>
      <div class="login-content">
         <form method="POST" action="<?php echo base_url('menu') ?>">
            <img src="<?= base_url('img/avatar.svg'); ?>">
            <h2 class="title bg-red">BIENVENIDO</h2>           
            <div class="input-div one">
               <div class="i">
                  <i class="fas fa-user"></i>
               </div>
               <div class="div">
                  <h5>Usuario</h5>
                  <input id="usuario" type="text" class="input" name="usuario" required="">
               </div>
            </div>
            <div class="input-div pass">
               <div class="i">
                  <i class="fas fa-lock"></i>
               </div>
               <div class="div">
                  <h5>Contraseña</h5>
                  <input type="password" id="clave" class="input" name="clave" required="">
               </div>
            </div>
            <div class="view">
               <div class="fas fa-eye verPassword" onclick="vista()" id="verPassword"></div>
            </div>
            <br>
            <!--que indique el error en sesion-->
            <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
            <?php endif; ?>
           
            <input name="btningresar" class="btn" style="background-color:red;color:white" type="submit" value="INICIAR SESION">
         </form>
      </div>
   </div>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   <script src="<?= base_url('assets/fontawesome/js/bootstrap.bundle.min.js'); ?>"></script>
   <script src="<?= base_url('assets/fontawesome/js/fontawesome.js');?>"></script>
   <script src="<?= base_url('assets/fontawesome/js/main.js');?>"></script>
   <script src="<?= base_url('assets/fontawesome/js/main2.js');?>"></script>
   <script src="<?= base_url('assets/fontawesome/js/jquery.min.js');?>"></script>
   <script src="<?= base_url('assets/fontawesome/js/bootstrap.js');?>"></script>
   <script src="<?= base_url('assets/fontawesome/js/bootstrap.bundle.js');?>"></script>

</body>

</html>