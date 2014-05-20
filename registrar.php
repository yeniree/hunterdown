<?php $caru=true; include("header.php"); ?>
<?php include("funciones.php"); ?>
<div class="container" style="margin: 70px auto;">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="well well-lg">

        <?php
        //error_reporting(E_ALL);
        //ini_set('display_errors', 'On');
        $nombre_error = "";
        $usuario_error = "";
        $email_error = "";
        $veremail_error = "";
        $passwd_error = "";
        $verpasswd_error = "";
        $sexo_error = "";
        $fecnac_error = "";
        $nombre = '';
        $usuario = '';
        $email = '';
        $veremail = '';
        $passwd = '';
        $verpasswd = '';
        $sexo = '';
        $dia = '';
        $mes = '';
        $ano = '';
        $fecnac = "";
        $visi = true;


        if (isset($_POST['btn-ok'])) {
          $nombre = trim($_POST['nombre']);
          $usuario = trim($_POST['usuario']);
          $email = trim($_POST['email']);
          $veremail = trim($_POST['veremail']);
          $passwd = trim($_POST['passwd']);
          $verpasswd = trim($_POST['verpasswd']);
          $sexo = trim($_POST['sexo']);
          $dia = trim($_POST['dia']);
          $mes = trim($_POST['mes']);
          $ano = trim($_POST['ano']);
          $errores = 0;

          /* Nombre */
          if (isset($nombre) && $nombre!='') {
            if (!validaAlfa($nombre)) {
              $nombre_error = mensajeError("Debe ingresar un nombre valido"); $errores = 1;
            }
          }else{
            $nombre_error = mensajeError("Debe ingresar un nombre"); $errores = 1;
          }
          /* usuario */
          if (isset($usuario) && $usuario!='') {
            if(!validaUser($usuario)){
              $usuario_error = mensajeError("Debe ingresar un nombre de usuario valido"); $errores = 1;
            }
          }else{
            $usuario_error = mensajeError("Debe ingresar un nombre de usuario"); $errores = 1;
          }
          /* email */
          if (isset($email) && $email!='') {
            if (!validarDirCorreoElec($email)) {
              $email_error = mensajeError("Debe ingresar un correo valido"); $errores = 1;
            }
          }else{
            $email_error = mensajeError("Debe ingresar un correo electronico"); $errores = 1;
          }
          /* Verificar Email */
          if (isset($veremail) && $veremail!='') {
            if ($veremail!=$email) {
              $veremail_error = mensajeError("Los correos ingresados no coinciden"); $errores = 1;
            }
          }else{
            $veremail_error = mensajeError("Debe Re-ingresar el correo electronico"); $errores = 1;
          }
          /* Password */
          if (isset($passwd) && $passwd!='') {
            if (!validarPass($passwd)) {
              $passwd_error = mensajeError("debe ingresar una contraseña valida"); $errores = 1;
            }
          }else{
            $passwd_error = mensajeError("Debe ingresar una contraseña"); $errores = 1;
          }
          /* Verificar Contraseña */
          if (isset($verpasswd) && $verpasswd!='') {
            if ($verpasswd != $passwd) {
              $verpasswd_error = mensajeError("Las contraseñas ingresadas no coinciden"); $errores = 1;
            }
          }else{
            $verpasswd_error = mensajeError("debe re-ingresar la contraseña"); $errores = 1;
          }
          /* Fecha de Nacimiento */
          $fecnac = $ano."-".$mes."-".$dia;
          if (datecheck($fecnac,"Ymd")===false) {
            $fecnac_error = mensajeError("Fecha invalida, por favor verifique la fecha ingresada"); $errores = 1;
          }

          if (!$errores) {
            require 'conexion.php';

            $existe = false;

            $sql = "SELECT * FROM usuarios WHERE usuario = '".strtolower($usuario)."'";

            $rs = $conn->query($sql);

            $fecha = "";
            if($rs->num_rows > 0){
              $usuario_error = mensajeError("El usuario ".$usuario." ya esta en uso");
              $existe = true;
            }

            if (!$existe) {

              $sql = "SELECT * FROM usuarios WHERE email = '".strtolower($email)."'";
              $rs = $conn->query($sql);

              if ($rs->num_rows > 0) {
                $email_error = mensajeError("El correo ".$email." ya esta registrado");
              }else{

                $stmt = $conn->prepare("INSERT INTO usuarios(nombre,usuario,email,passwd,sexo,fecnac) 
                  VALUES (?, ?, ?, ?, ?, ?) ");

                $stmt->bind_param("ssssss",$nombre,strtolower($usuario),strtolower($email),md5($passwd),$sexo,$fecnac);
                $stmt->execute();

                if($stmt->affected_rows > 0){ 
                  $visi = false; ?>
                  <div class='alert alert-info'>
                    <strong>Registro Guardado Exitosamente</strong>
                  </div>
                  <div class="text-center">
                    <a href="login.php" class="btn btn-default">Iniciar Sesión</a>
                    <a href="index.php" class="btn btn-default">Continuar</a>
                  </div>
                  <?php }else{ ?>
                  <div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <strong>Problemas al registrar al usuario.</strong>
                  </div>
                  <?php }

                  $stmt->close();
                }
              }

              $conn->close();
            }

          }

          if ($visi) {
            ?>

            <form id="form-registro" class="form-horizontal" method="post" 
            action="<?php echo $_SERVER['PHP_SELF'].'#form-registro'; ?>">
            <fieldset>

              <!-- Form Name -->
              <legend>Registro de Usuario</legend>

              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-4 control-label" for="nombre">Nombre</label>  
                <div class="col-md-8">
                  <input id="nombre" name="nombre" type="text" placeholder="Nombre para mostrar" 
                  class="form-control input-md" required="" autocomplete="off" value="<?php echo $nombre; ?>">
                  <?php if (strlen($nombre_error)>0) {echo $nombre_error;} ?>
                  <span class="help-block">El nombre que se mostrara para identificarte.</span>
                </div>
              </div>

              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-4 control-label" for="usuario">Usuario</label>  
                <div class="col-md-8">
                  <input id="usuario" name="usuario" type="text" placeholder="Nombre de usuario"
                  class="form-control input-md" required="" autocomplete="off" value="<?php echo $usuario; ?>">
                  <?php if (strlen($usuario_error)>0) {echo $usuario_error;} ?>
                  <span class="help-block">El nombre con el que te conectarás, entre 3 y 30 caracteres.</span>  
                </div>
              </div>

              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-4 control-label" for="email">E-Mail</label>  
                <div class="col-md-8">
                  <input id="email" name="email" type="text" placeholder="Correo Electronico"
                  class="form-control input-md" required="" autocomplete="off" value="<?php echo $email; ?>">
                  <?php if (strlen($email_error)>0) {echo $email_error;} ?>
                  <span class="help-block">Para que podamos verificar tu identidad, y te podamos mantener al día</span>  
                </div>
              </div>

              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-4 control-label" for="veremail">Re-ingresa e-mail</label>  
                <div class="col-md-8">
                  <input id="veremail" name="veremail" type="text" placeholder="Reingresar correo electronico"
                  class="form-control input-md" required="" autocomplete="off" value="<?php echo $veremail; ?>">
                  <?php if (strlen($veremail_error)>0) {echo $veremail_error;} ?>
                  <span class="help-block">Debe coincidir con el e-mail ingresado anteriormente.</span>  
                </div>
              </div>

              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-4 control-label" for="passwd">Contraseña</label>  
                <div class="col-md-8">
                  <input id="passwd" name="passwd" type="password" placeholder="Ingresa una contraseña"
                  class="form-control input-md" required="" autocomplete="off" value="<?php echo $passwd; ?>">
                  <?php if (strlen($passwd_error)>0) {echo $passwd_error;} ?>
                  <span class="help-block">Has de escoger una contraseña, entre 3 y 20 caracteres</span>  
                </div>
              </div>

              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-4 control-label" for="verpasswd">Re-ingresa contraseña</label>  
                <div class="col-md-8">
                  <input id="verpasswd" name="verpasswd" type="password" placeholder="Reingresa tu contraseña"
                  class="form-control input-md" required="" autocomplete="off" value="<?php echo $verpasswd; ?>">
                  <?php if (strlen($verpasswd_error)>0) {echo $verpasswd_error;} ?>
                  <span class="help-block">Debe coincidir con la contraseña ingresada anteriormente.</span>  
                </div>
              </div>

              <!-- Select Basic -->
              <div class="form-group">
                <label class="col-md-4 control-label" for="sexo">Sexo</label>
                <div class="col-md-3">
                  <select id="sexo" name="sexo" class="form-control">
                    <option value="Mujer" <?php echo ($sexo=="Mujer"?'selected':''); ?>>Mujer</option>
                    <option value="Hombre" <?php echo ($sexo=="Hombre"?'selected':''); ?>>Hombre</option>
                    <option value="Otro" <?php echo ($sexo=="Otro"?'selected':''); ?>>Otro</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label" for="dia">Fecha de Nacimiento</label>
                <div class="col-md-8" style="float: left;">
                  <select id="dia" name="dia" class="form-control " style="width: 70px; float:left; margin-right:10px;">
                    <?php 
                    for ($i=1; $i <= 31; $i++) {
                      $val = str_pad((int) $i,2,"0",STR_PAD_LEFT); 
                      $sel = $val==$dia? 'selected' : '' ;
                      print("<option value='".$val."'".$sel.">".$val."</option>");
                    }
                    ?>
                  </select>

                  <select id="mes" name="mes" class="form-control " style="width: 130px; float:left; margin-right:10px;">
                    <?php 
                    $meses = array ('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
                    $m=1;
                    foreach ($meses as $me) {
                      $ms = str_pad((int) $m,2,"0",STR_PAD_LEFT);
                      $sel = $ms==$mes? 'selected' : '' ;
                      print("<option value='".$ms."'".$sel.">".$me."</option>");
                      $m++;
                    }
                    ?>
                  </select>

                  <select id="ano" name="ano" class="form-control " style="width: 90px;">
                    <?php 
                    $hasta = date("Y")-10;
                    for ($i=$hasta; $i > $hasta-70; $i--) {
                      $sel = $i==$ano? 'selected' : '' ;
                      print("<option value='".$i."'".$sel.">".$i."</option>");
                    }
                    ?>
                  </select>
                  <?php if (strlen($fecnac_error)>0) {echo $fecnac_error;} ?>
                </div>
              </div>
              <div class="form-group" style="margin-top: 35px;">
                <div class="col-md-12 text-center">
                  <div class="btn-group">
                    <input type="submit" id="btn-ok" name="btn-ok" class="btn btn-default col-md-3" style="width: 120px;" value="Aceptar"/>
                    <button id="btn-cancel" name="btn-cancel" class="btn btn-primary col-md-3" style="width: 120px;" onClick="location.href = 'index.php';">Cancelar</button>
                  </div>
                </div>
              </div>
            </fieldset>
          </form>
          <?php } ?>

        </div>
      </div>
    </div>
  </div>
  <?php include("footer.php"); ?>