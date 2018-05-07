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
                    <a class="navbar-brand" href="<?php echo base_url('solicitar_trabajo'); ?>"><img src="<?php echo base_url("assets/images/logo.png"); ?>" alt="logo"></a>
                </div>
                
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li ><a href="<?php echo base_url('solicitar_trabajo'); ?>">Inicio</a></li>
                       <li><a href="<?php echo base_url('trabaja_con_nosotros'); ?>">Trabaja con Nosotros</a></li>
                        <!--li><a href="#feature">Servicios</a></li-->                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Servicios <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                
                                <li><a href="<?php echo base_url('oficio_albanil'); ?>">Albañilería</a></li>
                                <li><a href="<?php echo base_url('oficio_carpintero'); ?>">Carpintería</a></li>
                                <li class="active"><a href="<?php echo base_url('oficio_gasfitero'); ?>">Gasfitería</a></li>
                                <li><a href="<?php echo base_url('oficio_jardinero'); ?>">Jardinería</a></li>
                                <li><a href="<?php echo base_url('solicitar_trabajo#feature'); ?>">Otros</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo base_url('contactenos'); ?>">Contactenos</a></li>                        
                    </ul>
                </div><!--/.container-->
        </nav><!--/nav-->
 
    </header>
