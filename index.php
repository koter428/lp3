<?php
session_start();
if ($_SESSION){
    session_destroy();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Acceso al Sistema</title>
        <meta name="viewport" content="width=device-width,inicial-scale=1"/>
              <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>
              <!-- CSS personalizado-->
              <style>
                  body{
                      padding-top: 40px;
                      padding-bottom: 40px;
                  }
                  
                  body, html {
                      background: url(img/pc) no-repeat center center fixed;
                      -webkit-background-size: cover;
                      -moz-background-size: cover;
                      -o-background-size: cover;
                      background-size: cover;
                  }
                  .login{
                      max-width: 330px;
                      padding: 15px;
                      margin: 0 auto;
                  }
                  #avatar{
           /*ancho*/  width: 96px;
            /*altura*/ height: 96px;
            /*margen*/ margin: 0px auto 10px;
                      display: block;
                      border-radius: 50%;
                  }
                  #sha{
                      max-width: 340px;
                      -webkit-box-shadow:0px opx 18px opx rgba(48,50,50,0,48);
                      moz-box-shadow:0px opx 18px opx rgba(48,50,50,0,48);
                      box-shadow:0px opx 18px opx rgba(48,50,50,0,48);
                      border-radius: 6%;
                      
                  }
              </style>
    </head>
    <body>
        <div class="container well" id="sha"/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col col-xs-12"/>
                <img src="img/avatar_1.jpg" class="img-responsive" id="avatar"/>
                </div>
         </div>
        <form class="login" action="acceso.php" method="get"/>
            <div class="form-group has-feedback"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                <input type="text" class="form-control" name="usuario" required="" 
                       placeholder="Ingrese su usuario" autofocus=""/>
               
            </div> 
            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="clave" 
                       placeholder="Ingrese su clave" required=""/>
                <span class="glyphicon glyphicon-lock form-control-feedback">
               </span>
            </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">
            iniciar Sesion</button>
        <div class="checkbox">
            <label class="checkbox">
                <input type="checkbox" value="1" name="recuerdame" />No cerrar sesion
            </label>
            <p class="help-block"><a href="#">¿No puede acceder a su cuenta?</a></p>
        </div>
        <?PHP if(!empty($_SESSION['error'])) {?>
        <div class="alert alert-danger">
            <span class="glyphicon glyphicon-exclamation-sign"></span>
            <?php echo $_SESSION['error'];?>
        </div>
        <?PHP }?>
        </form>
        </div>
         <!----aqui van los archivos js-->
        <script src="js/jquery-1.12.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
