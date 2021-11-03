<?php
    include_once('Conexion.php');
    //RETOMAMOS LA SESION QUE ESTA INICIADA
    session_start();
    //SI NO HAY INICIADA UNA SESION REDIRIGIRA AL INDEX
    if(!isset($_SESSION["usuario"])){
        header('Location: index.html');
    }
    $back = 0;
    $myId=$_SESSION['id'];
    include_once('inactividad.php');
    include_once('permisoEdit.php');
    include_once('refresh.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Alumnos-UTSV">
  <meta name="author" content="Luis Valentin">

  <title>Alumnos - UTSV</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/modern-business.css" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">

</head>
<script type="text/javascript">
 function tiempoReal() {
    var tabla = $.ajax({
      url: 'recibidas.php',
      dataType: 'text',
      async: false,
    }).responseText;

    document.getElementById("notif").innerHTML = tabla;
  } 
  setInterval(tiempoReal, 1000);
</script>
<style>
  body{
    font-family: 'Roboto', sans-serif;
  }
  h1, h2, h3, h4, h5, h6 {
    font-family: 'Roboto', sans-serif;
  }
  strong{font-family: 'Roboto', sans-serif;}
  .box{
    width: 50%;
    word-wrap: break-word;
    height: 60px;
    border: 1px solid;
    border-radius: 30px;
    outline-style: none;
    padding-left: 10px;
  }
  .box1{
    width: 20%;
    border-radius: 20px;
    padding-left: 10px;
  }
  .bordes{
      border-radius: 15px;
  }
  .imagen{
    width: 190px;
    height: 190px;
  }
  /*.margenes{
    padding-top: 15px;
    padding-left: 15px;
    padding-right: 15px;
    padding-block-end: 15px;
  }*/
  .margenP{
      margin-top: 2%;
      margin-bottom: 2%;
      margin-left: 0;
      margin-right: 3%;
      width: 35vh;
      height: auto;
      max-height: 52vh;
      border-radius: 10px;
    }
    .tarjeta{
        margin-block-end: 2%;
        height: auto;
        max-height: 50vh;
        padding: 0;
    }
  .pad{
    margin-left: 20px;
  }
  .archivo{
      /*margin-block-end: 2%;*/
      /*margin-top: 5%;*/
      /*width: 20vh;*/
      height: 33vh;
      /*height: 12em;*/
      /*display: block;*/
      background-size: cover;
      background-position: 100% 50%;
      background-repeat: no-repeat;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
      margin-bottom: 5%;
    }
    .archivo:hover{
      opacity: 0.8;
    }
    .nombres{
        font-family: Helvetica;
        font-size: 13px;
        /*margin-left: 0;
        margin-right: 0;
        margin-top: 0;
        margin-bottom: 6%;*/
    }
  a{
      color: black;
      text-decoration:none;
  }a:hover { color:#00A0C6; text-decoration:none; cursor:pointer; }

  .limite{
    width: 50px;
    height: 50px;
    background-size: 100%;
    background-position: 100% 50%;
  }
  #seccion{
    width: 45%;
  }
  .datosU{
    margin-left: 3%;
    margin-right: 3%;
    margin-bottom: 5%;
  }
  .email{
    margin-left: 3%;
    margin-right: 3%;
    margin-bottom: 3%;
  }/*.cuerpoo{background-color: gray;}*/
  @media screen and (max-width: 900px){
    #seccion{
      width: 100%;
    }
    select{
      max-width: 50%;
    }
    .margenP{width: 18vh; max-height: 35vh;margin-right: 3%;}
    .archivo{height: 17vh;}
    .tarjeta{max-height: 35vh;}
    .cuerpoo{max-width: 100%;}
  }
</style>
<body>

  <!-- Navigation -->
  <?php
    include_once('header.php');
  ?>

  <!-- Page Content -->
  <div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">Alumnos -
      <small> <?php ?>UTSV</small>
    </h1>

    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="alumnos.php">Inicio</a>
      </li>
      
        <?php
          
          if(isset($_POST['usuario']) || isset($_POST['rol']) || isset($_POST['cuatri'])){
            if(isset($_POST['usuario']) && $_POST['usuario']!=""){
              echo '<li class="breadcrumb-item active">'.$_POST['usuario'].'</li>';
            }
            if(isset($_POST['rol']) && $_POST['rol']!=""){
              $ar="SELECT id,nombreArea FROM area WHERE id = '". $_POST['rol']."';";
                $selec= mysqli_query($Conexion,$ar);
                while ($mostrar= mysqli_fetch_array($selec)) {
                  echo '<li class="breadcrumb-item active">'.$mostrar['nombreArea'].'</li>';
                }
            }
            if(isset($_POST['cuatri']) && $_POST['cuatri']!=""){
              $ar="SELECT id,nombre FROM cuatrimestre WHERE id = '". $_POST['cuatri']."';";
                $selec= mysqli_query($Conexion,$ar);
                while ($mostrar= mysqli_fetch_array($selec)) {
                  echo '<li class="breadcrumb-item active">'.$mostrar['nombre'].'</li>';
                }
            }
          }else{
            echo '<li class="breadcrumb-item active">Alumnos'.'</li>';
            //https://ddtech.mx/producto/computadora-pride-gaming-badger-geforce-rtx-3060-amd-ryzen-5-5600x-16gb-ram-500gb-ssd-nvme-disipador-rgb-solo-1-pieza-por-cliente?id=9726
          }
          
        ?>
      </li>
    </ol>

            <div class="container">
                <form  action="alumnos.php" method="POST" class="row g-3" >
                
                <input  type="text" style ="background: transparent; width: auto;" class="form-control" name="usuario" placeholder="Nombre" 
                value="<?php if(isset($_POST['usuario'])){ echo $_POST['usuario'];} ?>">&nbsp;&nbsp;
            <select class="form-control" style ="width: auto" name="rol" id="rol">
            <?php 
            

              //<option value="<?php if(isset($_POST['rol'])){ echo $_POST['rol'];}else{ echo ""; } ?>"><?php //if(isset($_POST['rol'])){ echo $mostrar['nombreArea'];}else{ echo "Area"; } ? ></option>
              if(isset($_POST['rol']) && $_POST['rol']!=""){
                $ar="SELECT id,nombreArea FROM area WHERE id = '". $_POST['rol']."';";
                $selec= mysqli_query($Conexion,$ar);
                while ($mostrar= mysqli_fetch_array($selec)) {
                  echo '<option value="'.$_POST["rol"] .'">'. $mostrar["nombreArea"].'</option>';
                }
              }
              if($_POST['rol']==""){
                echo '<option value="">Área</option>';
              }

                $select6="SELECT id,nombreArea FROM area";
                $ejecutar1= mysqli_query($Conexion,$select6);
                while ($area= mysqli_fetch_array($ejecutar1)) {
            ?>
                <option value=<?php echo $area['id'] ?> > <?php echo $area['nombreArea'] ?></option>
            <?php } ?>
          </select>&nbsp;&nbsp;
          <select class="form-control" style ="width: auto" name="cuatri" id="cuatri">
              <?php
              if(isset($_POST['cuatri']) && $_POST['cuatri']!=""){
                $ar="SELECT id,nombre FROM cuatrimestre WHERE id = '". $_POST['cuatri']."';";
                $selec= mysqli_query($Conexion,$ar);
                while ($mostrar= mysqli_fetch_array($selec)) {
                  echo '<option value="'.$_POST["cuatri"] .'">'. $mostrar["nombre"].'</option>';
                }
              }elseif($_POST['cuatri']==""){
                echo '<option value="">Cuatrimestre</option>';
              }

                $select60="SELECT id,nombre FROM cuatrimestre;";
                $ejecutar10= mysqli_query($Conexion,$select60);
                while ($cuatri= mysqli_fetch_array($ejecutar10)) {
            ?>
                <option value=<?php echo $cuatri['id'] ?> > <?php echo $cuatri['nombre'] ?></option>
            <?php } ?>
          </select>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3" name="submit" style="background-color:#005F40; border-color:white; ">Buscar</button>
            </div>
            </form>
<div class="row cuerpoo">
      <!-- Bootstrap core JavaScript -->
      <?php
               if(isset($_POST['submit'])){
                $name = $_POST['usuario'];
                $tipo = $_POST['rol'];
                $grado = $_POST['cuatri'];
                
                /*$query = "SELECT  id,nombre,apellidoPaterno,apellidoMaterno,email,idRol
                FROM usuario WHERE nombre LIKE '%$name%' AND idRol LIKE '%$tipo%' AND id != '$myId'";*/
               $query = "SELECT  usuario.id, usuario.nombre, usuario.apellidoPaterno,usuario.apellidoMaterno,
               usuario.email,usuario.idRol,alumno.idArea,alumno.idCuatrimestre, usuario.foto
               FROM usuario INNER JOIN alumno ON usuario.id = alumno.idUsuario
               WHERE usuario.nombre LIKE '%$name%'
               AND usuario.idRol = '1' AND usuario.id != '$myId' 
               AND alumno.idArea LIKE '%$tipo%' AND alumno.idCuatrimestre LIKE '%$grado%';";
               
               
               if(!$resultado = mysqli_query($Conexion,$query)){
                exit(mysqli_error($Conexion));

                }
                
                if(mysqli_num_rows($resultado)==0){
                    echo "<br/>";
                  echo' <h1 class="text-center" style="font-size:50px; margin-left:30px;">
                  <p class="text-center" > No hubo ningún resultado parecido</p>
                 </h1>';
                 echo "<br/>";

                }
                
                $resultado = mysqli_query($Conexion,$query);
    
                while($fila=mysqli_fetch_array($resultado)  ){ 
                    $tipo= $fila['idRol'];
                    $imagen = $fila['foto'];
                
            ?>
                <!-- NUEVO DIV DE USUARIOS -->
                <div class="card margenP">
                    <div class="tarjeta">
                    <?php echo "<a href='tipoPErfil.php?id=".$fila['id']."' target='_blank'>";?>
                        <div class="archivo" style="background-image: url(<?php echo $imagen ?>);"></div>
                    <?php echo "</a>"; ?>
                        <div class="datosU">
                            <?php echo "<a href='tipoPErfil.php?id=".$fila['id']."' target='_blank'><strong class='nombres'>".$fila['nombre']." ".$fila['apellidoPaterno']." ".$fila['apellidoMaterno']."</strong></a>" ?> 
                            <!--<a href="#" class="btn btn-sm btn-success" style="width: 90%;">Correo</a>-->
                        </div>
                        <div class="email">
                            <?php echo "<a href='email.php?id=".$fila['email']."' class='btn btn-sm text-white' style='font-family: Helvetica;width:100%;margin-top:0; background-color:#005F40;'>E-mail</a>"?>
                        </div>
                        
                    </div>
                </div>
                <!-- NUEVO DIV DE USUARIOS -->
            <?php
                }
            }else{
              //id != '$myId' AND 
                $query = "SELECT  id,nombre,apellidoPaterno,apellidoMaterno,email,idRol,foto,portada
                FROM usuario WHERE id != '$myId' AND idRol='1';";
               
               
               
               if(!$resultado = mysqli_query($Conexion,$query)){
                exit(mysqli_error($Conexion));

                }
                
                if(mysqli_num_rows($resultado)==0){
                  echo' <h1 class="text-center" style="font-size:50px; margin-left:30px;">
                  <p class="text-center" > No hubo resultados, no hay má usuarios registrados.</p>
                 </h1>';


                }
                
                $resultado = mysqli_query($Conexion,$query);
    
                while($fila=mysqli_fetch_array($resultado)  ){ 
                    $tipo= $fila['idRol'];
                    $imagen = $fila['foto'];
                
            ?>
                <!--<div class='card bordes' id="seccion" style="margin-right: 5%;">
                    <div class='tarjeta'>
                        <!--<div class='izquierda margenes'><img src='imag/perfil.png' alt='' class='imagen'></div>
                        <div style="float: left; margin-right: 10px;">
                          <?php
                            echo '<img class=" limite" src="'.$imagen.'" alt="" style="border-radius: 50%;"<br/>';
                          ?>
                        </div>
                            <div class=''><strong class='color'><?php echo "<a href='tipoPErfil.php?id=".$fila['id']."' target='_blank'><strong>".$fila['nombre']." ".$fila['apellidoPaterno']." ".$fila['apellidoMaterno']."</strong></a>" ?> </strong>
                                <br><small>E-mail: </small><?php echo "<a href='email.php?id=".$fila['email']."'><small>".$fila['email']."</small></a>"?>
                            <?php //echo "<a href='email.php?id=".$fila['email']."' class='btn btn-primary'>Enviar Correo &rarr;</a>" ?>
                        </div>
                    </div>
                </div><br/>-->
                <!-- NUEVO DIV DE USUARIOS -->
                <div class="card margenP">
                    <div class="tarjeta">
                    <?php echo "<a href='tipoPErfil.php?id=".$fila['id']."' target='_blank'>";?>
                        <div class="archivo" style="background-image: url(<?php echo $imagen ?>);"></div>
                    <?php echo "</a>"; ?>
                        <div class="datosU">
                            <?php echo "<a href='tipoPErfil.php?id=".$fila['id']."' target='_blank'><strong class='nombres'>".$fila['nombre']." ".$fila['apellidoPaterno']." ".$fila['apellidoMaterno']."</strong></a>" ?> 
                            <!--<a href="#" class="btn btn-sm btn-success" style="width: 90%;">Correo</a>-->
                        </div>
                        <div class="email">
                            <?php echo "<a href='email.php?id=".$fila['email']."' class='btn btn-sm text-white' style='font-family: Helvetica;width:100%;margin-top:0; background-color:#005F40;'>E-mail</a>"?>
                        </div>
                        
                    </div>
                </div>
                <!-- NUEVO DIV DE USUARIOS -->
            <?php
                }
            }
            ?>
    <!-- /.row -->
</div></div></div>
  </div>
  <!-- /.container -->

  <!-- Footer -->
  <?php
    //include_once('footer.php');
  ?>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>
