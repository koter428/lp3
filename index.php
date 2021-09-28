<?php
session_start();
if ($_SESSION) {
    session_destroy();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Acceso al Sistema</title>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>
        <!-- CSS personalizado-->
        <style>
            body{
                padding-top: 40px;
                padding-bottom: 40px;
            }
            body, html {
                 background: url(img/pc.png) no-repeat center center fixed; 
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
                width: 96px;
                height: 96px;
                margin: 0px auto 10px;
                display: block;
                border-radius: 50%;
            }
            #sha{
                max-width: 340px;
                -webkit-box-shadow: 0px 0px 18px 0px rgba(48,50,50,0.48);
                -moz-box-shadow:0px 0px 18px 0px rgba(48,50,50,0.48);
                box-shadow: 0px 0px 18px 0px rgba(48,50,50,0.48);
                border-radius: 6%;
            }
        </style>
    </head>
    <body>
        <div class="container well" id="sha">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <img src="img/yo.jpg" class="img-responsive" id="avatar"/>
                </div>               
            </div>
            <form class="login" action="acceso.php" method="post">                
                <div class="form-group input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                  <input type="text" class="form-control" name="usuario" placeholder="Ingrese su usuario" autofocus="">
                </div>                
                    <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="clave" 
                           placeholder="Ingrese su clave" required=""/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    Iniciar Sesión</button>
                <div class="checkbox">
                    <label class="checkbox">
                        <input type="checkbox" value="1" name="recuerdame" />No cerrar Sesión
                    </label>
                    <p class="help-block"><a href="#">No puede acceder a su cuenta?</a></p>
                </div>
                <?php if(!empty($_SESSION['error'])){ ?>
                <div class="alert alert-danger">
                    <span class="glyphicon glyphicon-exclamation-sign"></span>
                    <?php echo $_SESSION['error'];?>
                </div>
                <?php } ?>
            </form>
        </div>
        
        
        
        <!-- Aqui van los archivos js-->
        <script src="js/jquery-1.12.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
