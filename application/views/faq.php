<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Casa &amp; Oficios </title>
    <link href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url("assets/css/font-awesome.min.css"); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url("assets/css/animate.min.css"); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url("assets/css/prettyPhoto.css");?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url("assets/css/main.css");?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url("assets/css/responsive.css");?>" rel="stylesheet" type="text/css" />
     <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"
        rel="stylesheet" type="text/css" />
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/favicon.ico" />
</head>
<body>
    <form id="form1">
    <header id="header">
    <div class="top-bar">
    <div class="container">
    <div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
      <div class="top-number"><p><i class="fa fa-thumbs-up"></i> Su mejor opción... </p></div>
    </div>
     <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
      <div class="social">
     <ul class="social-share">
        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>        
        <li><a href="#"><i class="fa fa-skype"></i></a></li>
     </ul>     
       
    </div>
    </div>
    </div>
      </div><!-- container-->
        </div><!--/top-bar-->
      <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url('index.php/solicitar_trabajo'); ?>"><img src="<?php echo base_url("assets/images/logo.png"); ?>" alt="logo"></a>
                </div>
                
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li ><a href="<?php echo base_url('index.php/solicitar_trabajo'); ?>">Inicio</a></li>
                       <li><a href="<?php echo base_url('index.php/trabaja_con_nosotros'); ?>">Trabaja con Nosotros</a></li>
                        <!--li><a href="#feature">Servicios</a></li-->                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Servicios <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                
                                <li><a href="<?php echo base_url('index.php/oficio_albanil'); ?>">Albañilería</a></li>
                                <li><a href="<?php echo base_url('index.php/oficio_carpintero'); ?>">Carpintería</a></li>
                                <li class="active"><a href="<?php echo base_url('index.php/oficio_gasfitero'); ?>">Gasfitería</a></li>
                                <li><a href="<?php echo base_url('index.php/oficio_jardinero'); ?>">Jardinería</a></li>
                                <li><a href="<?php echo base_url('index.php/solicitar_trabajo#feature'); ?>">Otros</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo base_url('index.php/contactenos'); ?>">Contactenos</a></li>                        
                    </ul>
                </div><!--/.container-->
        </nav><!--/nav-->
 
    </header>

    <section id="feature">
        <div class="container">
           <div class="wow fadeInDown" >

                <div class="col-sm-7">

                    <h1 style="color:black;">FAQ (Frequently Asked Questions/preguntas respuestas frecuentes)</h1><br>
                    <p  class="lead" style="color:black;">
                    
                    Para las diversas tareas que tiene en mente para su casa.<br>
                    <ol class="list-group">

                        <li><strong>¿Qué me ofrece el servicio Casa &amp; Oficios?</strong></li>
                         Un servicio que te propone una relación de candidatos para la nececidad que desea cubrir. <br><br>
                        
                        
                        <li><strong>¿Qué ventajas ofrece este servicio como usuario?</strong></li>
                        Tener mejor retroalimentación de la experiencia de otros usuarios del servicio. Además, los colaboradores poseen
                       información´de su datos personales que son cotejados<br><br>

                        <li><strong>¿Cómo puedo inscribirme como trabajador?</strong></li>
                        Dirijase a la sección de "Trabaje con Nosotros", donde Ud. registrar su datos personales para empeza con el proceso. <br><br>


                    </ol>

                    </p>

                </div>                  

            </div>
       

        </div><!--/.container-->
    </section>

    <!--/#contact-page-->
    <section id="bottom">
        <div class="container wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3>Compañía</h3>
                        <ul>
                            <li><a href="<?php echo base_url('index.php/acerca_nosotros'); ?>">Acerca de Nosotros</a></li>
                            <!--li><a href="#">We are hiring</a></li-->
                            <!--li><a href="#">Conozca el equipo</a></li-->                            
                            <li><a href="<?php echo base_url('index.php/terminos_uso'); ?>">Términos de uso</a></li>
                            <!--li><a href="#">Privacy policy</a></li-->
                            <li><a href="<?php echo base_url('index.php/contactenos'); ?>">Contactenos</a></li>
                            <li><a href="#">Copyright</a></li>
                        </ul>
                    </div>    
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3>Soporte</h3>
                        <ul>
                            <li><a href="<?php echo base_url('index.php/faq'); ?>">Faq</a></li>
                            <!--li><a href="#">Documentación</a></li-->
                            <li><a href="http://www.dectersoluciones.com/">Decter Soluciones</a></li>

                        </ul>
                    </div>    
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3>Servicios</h3>
                        <ul>
                            <li><a href="<?php echo base_url('index.php/oficio_albanil'); ?>">Albañilería</a></li>
                            <li><a href="<?php echo base_url('index.php/oficio_carpintero'); ?>">Carpintería</a></li>                            
                            <li><a href="<?php echo base_url('index.php/oficio_jardinero'); ?>">Jardinería</a></li>
                            <li><a href="<?php echo base_url('index.php/oficio_gasfitero'); ?>">Gasfitería</a></li>
                            <li><a href="<?php echo base_url('index.php/solicitar_trabajo#feature'); ?>">Otros</a></li>                            

                        </ul>
                    </div>    
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3>Nuestro Equipo</h3>
                        <ul>
                            <li><a href="http://www.dectersoluciones.com/">Decter Soluciones</a></li>
                            <li><a href="<?php echo base_url('index.php/solicitar_trabajo'); ?>">Casa Oficios Corp</a></li>

                        </ul>
                    </div>    
                </div><!--/.col-md-3-->
            </div>
        </div>
    </section>
    <!--/#bottom-->
    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2017 <a target="_blank" href="http://aspxtemplates.com/" title="Free Twitter Bootstrap asp.net templates">aspxtemplates</a>. All Rights Reserved.
                </div>
                <div class="col-sm-6">
                    <ul class="pull-right">
                        <li><a href="<?php echo base_url('index.php/solicitar_trabajo'); ?>">Inicio</a></li>
                        <li><a href="<?php echo base_url('index.php/acerca_nosotros'); ?>">Acerca de Nosotros</a></li>
                        <li><a href="<?php echo base_url('index.php/contactenos'); ?>">Contactenos</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <a href="#" class="back-to-top"><i class="fa fa-2x fa-angle-up"></i></a>
    </footer>
    <!--/#footer-->
    <!-- Back To Top -->
    <script type="text/javascript">
        jQuery(document).ready(function () {
            var offset = 300;
            var duration = 500;
            jQuery(window).scroll(function () {
                if (jQuery(this).scrollTop() > offset) {
                    jQuery('.back-to-top').fadeIn(duration);
                } else {
                    jQuery('.back-to-top').fadeOut(duration);
                }
            });

            jQuery('.back-to-top').click(function (event) {
                event.preventDefault();
                jQuery('html, body').animate({ scrollTop: 0 }, duration);
                return false;
            })
        });
    </script>
    <!-- /top-link-block -->
    <!-- Jscript -->
    <script src="<?php echo base_url("assets/js/jquery.js");?>" type="text/javascript"></script>
    <script src="<?php echo base_url("assets/js/bootstrap.min.js");?>" type="text/javascript"></script>
    <script src="<?php echo base_url("assets/js/jquery.prettyPhoto.js");?>" type="text/javascript"></script>
    <script src="<?php echo base_url("assets/js/jquery.isotope.min.js");?>" type="text/javascript"></script>
    <script src="<?php echo base_url("assets/js/main.js");?>" type="text/javascript"></script>
    <script src="<?php echo base_url("assets/js/wow.min.js");?>" type="text/javascript"></script>
    </form>
</body>
</html>
