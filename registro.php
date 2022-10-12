<?php
    
    require 'funcs/conexion.php';
    require 'funcs/funcs.php';
    
    $errors = array();
    
    //Aqui va el código PHP del Vídeo¨ []

    if(!empty($_POST))

    {
        $nombre = $mysqli->real_escape_string($_POST['nombre']);
        $usuario = $mysqli->real_escape_string($_POST['usuario']);
        $password = $mysqli->real_escape_string($_POST['password']);
        $con_password = $mysqli->real_escape_string($_POST['con_password']);
        $email = $mysqli->real_escape_string($_POST['email']);
        $captcha = $mysqli->real_escape_string($_POST['g-recaptcha-response']);


        $activo = 0;
        $tipo_usuario = 2;
        $secret = '6LdtmkQgAAAAAPS_oxsi7Ys76Wb-f81_5mtcnMJd';


        if(!$captcha){

            $errors [] ="Por favor verifica el captcha";
        } 

        if(isNull($nombre, $usuario, $password, $con_password, $email))

        {

$errors [] = "Debe llenar todos los campos";
        }


        if(!isEmail($email))

        {
$errors [] = "Dirreccion de Correo invalido";
        }

        if(!validaPassword($password, $con_password))
        {
            $errors[] = "Las contraseñas no coinciden";

        }


        if(usuarioExiste($usuario))
        {
            $errors[] = "El nombre de usuario $usuario ya existe";

        }

        if(emailExiste($email))
        {
            $errors[] = "El correo electronico $email ya existe";

        }





        if (count($errors) == 0)
        {

            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");

            $arr = json_decode($response, TRUE);

            if($arr['success'])
            {


                $pass_hash = hashPassword($password);

                $token = generateToken();

                $registro = registraUsuario($usuario, $pass_hash, $nombre, $email, $activo, $token, $tipo_usuario);

                if($registro > 0 )
                {


                    $url = 'http://localhost:8080/Psicologo/activarmail.php?id='.$registro.'&val='.$token;

                    $asunto = 'Activar Cuenta NEOPRAXIIIS';
                    $cuerpo = "Estimado $nombre: <br /><br />Para continuar con el proceso de registro, es indispensable dar click en la siguiente liga <a href='$url'>Activar Cuenta</a>";

                    if(enviarEmail($email, $nombre, $asunto, $cuerpo)){

                        echo "Para terminar el proceso de registro siga las instrucciones que le hemos enviado la direccion de correo electronico: $email";

                        echo "<br><a href='login.php'>Iniciar Sesion </a>";
                        exit;


                    } else {
                        $errors[] = "Error al Enviar correo electronico";
                    }



                } else {

    
                    $errors[] = "Error al Registrar";
                }

            } else {

                $errors[] = 'Error al comprobar captcha';
            }
        }

    }


    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Neopraxis</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
         <!-- envio Script de recaptcha-->
         <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />

        <!--LINKS DE LA PAGINA DE SISTEMAAS-->

        <link rel="stylesheet" href="css/bootstrap.min.css" >
        <link rel="stylesheet" href="css/bootstrap-theme.min.css" >
        <script src="js/bootstrap.min.js" ></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>

        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.html">Comienza una terapia Psicológicaa</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="index.html">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="blog.php">Blog</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="agendarc.php">Agendar cita</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="error1.html">Para empresas</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="registro.php">Registrate</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('assets/img/administrador.png')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="page-heading">

                            <!--<h1>Agendar Cita</h1>-->
                            <span class="subheading"></span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main Content-->

        <div class="container">
            <div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-title">Reg&iacute;strate</div>
                        <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="login.php">Iniciar Sesi&oacute;n</a></div>
                    </div>  
                    
                    <div class="panel-body" >
                        
                        <form id="signupform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
                            
                            <div id="signupalert" style="display:none" class="alert alert-danger">
                                <p>Error:</p>
                                <span></span>
                            </div>
                            
                            <div class="form-group">
                                <label for="nombre" class="col-md-3 control-label">Nombre:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?php if(isset($nombre)) echo $nombre; ?>" required >
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="usuario" class="col-md-3 control-label">Usuario</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="usuario" placeholder="Usuario" value="<?php if(isset($usuario)) echo $usuario; ?>" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="password" class="col-md-3 control-label">Password</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="con_password" class="col-md-3 control-label">Confirmar Password</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="con_password" placeholder="Confirmar Password" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="email" class="col-md-3 control-label">Email</label>
                                <div class="col-md-9">
                                    <input type="email" class="form-control" name="email" placeholder="Email" value="<?php if(isset($email)) echo $email; ?>" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="captcha" class="col-md-3 control-label"></label>
                                <div class="g-recaptcha col-md-9" data-sitekey=" 6LdtmkQgAAAAAEb8Am_wtCxYvKu9ivMY4v_JcV_y"></div>
                            </div>
                            
                            <div class="form-group">                                      
                                <div class="col-md-offset-3 col-md-9">
                                    <button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i>Registrar</button> 
                                </div>
                            </div>
                        </form>
                        <?php echo resultBlock($errors); ?>
                    </div>
                </div>
            </div>
        </div>


     
    
        <!-- Footer-->
        <footer class="border-top">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <ul class="list-inline text-center">
                            <li class="list-inline-item">
                                <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <div class="small text-center text-muted fst-italic">Copyright &copy; Your Website 2022</div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
