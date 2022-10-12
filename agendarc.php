<?php
require_once 'conexion.php';
?>

<?php
if (isset($_POST['enviar']))
    {

        $nombre=$_POST['nombre'];
        $apellidos=$_POST['apellidos'];
        $edad=$_POST['edad'];
        $email=$_POST['email'];
        $numero=$_POST['numero'];
        $mensaje=$_POST['mensaje'];

       
        //recibir ip del servidor
        $ip = $_SERVER['REMOTE_ADDR'];
        //recibir campo de captcha
        $captcha = $_POST['g-recaptcha-response'];
        //clave secreta del captcha
        $secretkey = "6LdtmkQgAAAAAPS_oxsi7Ys76Wb-f81_5mtcnMJd";
        //url de vali recapcha

        $respuestaa = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$captcha&remoteip=$ip");

        $atributos = json_decode($respuestaa, TRUE);

        $errors = array();



//if(!$atributos['success']){
            //$errors[]='Verificar Captcha';
        //} 

if(empty($captcha)){
    $errors[]='El campo de captcha es obligatorio';
}

if(empty($nombre)){
    $errors[]='El campo de nombre es obligatorio';
}

if(empty($apellidos)){
    $errors[]='El campo de apellidos es obligatorio';
}

if(empty($edad)){
    $errors[]='El campo de edad es obligatorio';
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[]='La introduccion de correo no es valida';
}

if(empty($numero)){
    $errors[]='El campo de Whatssap es obligatorio';
}

if(empty($mensaje)){
    $errors[]='El campo de mensaje es obligatorio';
}

if (count($errors) == 0){

        $respuestaa = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$captcha&remoteip=$ip");

        $atributos = json_decode($respuestaa, TRUE);

        if(!$atributos['success']){

            //inser datos en una tabla de la db
    $sql=$cnnPDO->prepare("INSERT INTO Clientes
        (nombre, apellidos, edad, email, numero, mensaje) VALUES
        (:nombre, :apellidos, :edad, :email, :numero, :mensaje)");

    //asignar las variables a los campos de la tabla
    $sql->bindParam(':nombre',$nombre);
    $sql->bindParam(':apellidos',$apellidos);
    $sql->bindParam(':edad',$edad);
    $sql->bindParam(':email',$email);
    $sql->bindParam(':numero',$numero);
    $sql->bindParam(':mensaje',$mensaje);

    //Ejecutar la variable $sql
    $sql->execute();
    unset($sql);
    unset($cnnPDO);

        
        } else {

            $errors[] = 'error al comprobar captcha';
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
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.html">Comienza una terapia Psicológica</a>
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
        <header class="masthead" style="background-image: url('assets/img/contacto.jpg')">
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

        <?php
        if(isset($errors)){
            if(count($errors) > 0) {
        ?>

        <div class="row">
            <div class="col-lg-6 col-md-12">
                <center><div  class="alert alert-danger alert-dismissible" role ="alert">
                    <?php
                    foreach ($errors as $error) {
                        echo $error. '<br>';
                    }

                    ?>
                </div></center>
            </div>
        </div>


        <?php
    }
}

        ?>
     
        <main class="mb-4">
            <div class="container px-4 px-lg-5">
                 <form name="contactForm" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <center><h3>Agenda una tu cita aqui</h3></center>
                        <p>Nos pondremos en contacto contigo via telefónica para comenzar el proceso personalizado de asignarte con un psicólogo acorde a tu perfil, necesidades y posibilidades economicas</p>
                        <div class="my-5">

                                <div class="form-floating">
                                    <input class="form-control" name="nombre" id="nombre" type="text" placeholder="..." required/>

                                    <label for="nombre">Ingresa Tu Nombre </label>
    
                                </div>

                                <div class="form-floating">
                                    <input class="form-control" name="apellidos" id="apellidos" type="text" placeholder="..." required/>

                                    <label for="nombre">Ingresa Tus apellidos</label>
    
                                </div>

                                <div class="form-floating">
                                    <input class="form-control" name="edad" id="edad" type="number" placeholder="..."  required/>

                                    <label for="edad">Ingresa Tu Edad</label>
    
                                </div>
 
                                <div class="form-floating">
                                    <input class="form-control" name="email" id="email" type="email" placeholder="..." required/>

                                    <label for="correo">Ingresa Tu Correo Electronico</label>
    
                                </div>

                                <div class="form-floating">
                                    <input class="form-control" name="numero" id="numero" type="number" placeholder="..." required/>

                                    <label for="numero">Ingresa Tu Número de Celular</label>
    
                                </div>

                                <div class="form-floating">
                                    <input class="form-control" name="mensaje" id="mensaje" type="text" placeholder="..." />

                                    <label for="mensaje">Comentario</label><br>
    
                                </div>

                                <!--boton de reCaptcha-->
                                <center><div class="form-floating">
                                    <div class="g-recaptcha" data-sitekey=" 6LdtmkQgAAAAAEb8Am_wtCxYvKu9ivMY4v_JcV_y" ></div>
                                </div><br> 

                                <!--boton de enviar formulario-->
                                 <button  type="submit" name="enviar" value="enviar" class="btn btn-primary text-uppercase">Agendar Cita </button></center><br><br>

                                 <center><h4>Nuestra Ubicación</h4>
                                 <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3599.407065949522!2d-100.93898508590247!3d25.558120483729617!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x868814c0002295ff%3A0x5c622cc711957b03!2sUniversidad%20Tecnologica%20de%20Coahuila!5e0!3m2!1ses!2smx!4v1654390641540!5m2!1ses!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></center>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
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
