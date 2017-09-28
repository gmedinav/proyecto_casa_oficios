


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js" type="text/javascript"></script>
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Inicio | CasaOficios</title>

    <link href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url("assets/css/font-awesome.min.css"); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url("assets/css/animate.min.css"); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url("assets/css/prettyPhoto.css"); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url("assets/css/main.css"); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url("assets/css/responsive.css"); ?>" rel="stylesheet" type="text/css" />
     <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"
        rel="stylesheet" type="text/css" />
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript">

    function fileValidation(nom_input_file){

        var fileInput = document.getElementById(nom_input_file);
        var filePath = fileInput.value;
        var allowedExtensions = /(.jpg|.jpeg|.png|.gif)$/i;

        if(!allowedExtensions.exec(filePath)){
            
            document.getElementById("btn_aceptar").disabled  = true;
            document.getElementById("p_mensaje").innerHTML = 'Por favor, el archivo debe tener alguna de las extensiones siguientes: .jpeg/.jpg/.png/.gif.'; 
            $('#myModal').modal('show');
            
            //document.getElementById(id_imagen).src = "";

            document.getElementById("div_"+nom_input_file).innerHTML="";
            fileInput.value = '';
            return false;
        }else{

            //alert("size:"+document.getElementById(nom_input_file).files[0].size);
            size_file= document.getElementById(nom_input_file).files[0].size;

            if(size_file>2097152){

                //alert('Por favor, el archivo no debe superar de los 2Mb de espacio físico.');
                document.getElementById("btn_aceptar").disabled  = true;
                document.getElementById("p_mensaje").innerHTML = 'Por favor, el archivo no debe superar de los 2Mb de espacio físico.';
                ('#myModal').modal('show');
                
                fileInput.value = '';
                document.getElementById("div_"+nombre_id).innerHTML="";
                return false;

            }

            //Image preview
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    /*document.getElementById('imagePreview').innerHTML = '<img src="'+e.target.result+'"/>';*/
                    crear_visor_img(nom_input_file);
                    document.getElementById("img_"+nom_input_file).src = e.target.result;


                };
                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    }


    function crear_visor_img(nombre_id){

        objeto = "";
        objeto = objeto + '<div class="row">';
        objeto = objeto + '<div class="col-sm-5">';
        objeto = objeto + '<p align="center"><strong>Archivo Adjunto</strong></p>';
        objeto = objeto + '</div>';
        objeto = objeto + '<div class="col-sm-5">';
        objeto = objeto + '<p align="center"><strong>Remover</strong></p>';
        objeto = objeto + '</div>';
        objeto = objeto + '</div>';
        objeto = objeto + '';
        objeto = objeto + '<div class="row">';
        objeto = objeto + '<div class="col-sm-5">';
        objeto = objeto + '<p align="center">';
        objeto = objeto + '<img src="" id="img_'+nombre_id+'" width="80px" height="80px" alt="nombre_archivo">';
        objeto = objeto + '</p>';
        objeto = objeto + '</div>';
        objeto = objeto + '<div class="col-sm-5">';
        objeto = objeto + '<p align="center">';
        objeto = objeto + '<button type="button" class="btn btn-default" onclick="borrar_visor_img('+"'"+nombre_id+"'"+')">';
        objeto = objeto + '<span class="glyphicon glyphicon-trash"></span>';
        objeto = objeto + '</button></p>';
        objeto = objeto + '</div>';
        objeto = objeto + '</div>';

        document.getElementById("div_"+nombre_id).innerHTML= objeto;

    }


    function borrar_visor_img(nombre_id){

        document.getElementById("div_"+nombre_id).innerHTML= "";
        document.getElementById(nombre_id).value= "";

    }

    function msj_value_vacio(valor, campo){

        if(valor == ""){
            //alert("El '" + campo + "'' está vació.");
            btn_aceptar
            document.getElementById("btn_aceptar").disabled  = true;
            document.getElementById("p_mensaje").innerHTML = "El '" + campo + "'' está vació.";
            return false;

        }else{
            return true;
        }

    }


    function msj_value_select(valor, campo){

        if(valor == "000000000"){
            //alert("El '" + campo + "'' está vació.");
            btn_aceptar
            document.getElementById("btn_aceptar").disabled  = true;
            document.getElementById("p_mensaje").innerHTML = "Debe seleccionar un tipo en el campo '" + campo + "'.";
            return false;

        }else{
            return true;
        }

    }




    function msj_value_es_texto(valor,campo){
        //val= $.isNumeric(

        if(typeof valor === 'string' || valor instanceof String){
            return true;
        }else{
            //alert("El '" + campo + "' no es un valor textual.");
            document.getElementById("btn_aceptar").disabled  = true;
            document.getElementById("p_mensaje").innerHTML="El '" + campo + "' no es un valor textual.";
            return false;
        }

    }


    function msj_value_es_cero(valor,campo){
        //val= $.isNumeric(
        if(valor === 0 || valor =="0"){
            //alert("Debe seleccionar un tipo en el campo '" + campo + "'.");
            document.getElementById("btn_aceptar").disabled  = true;
            document.getElementById("p_mensaje").innerHTML = "Debe seleccionar un tipo en el campo '" + campo + "'.";
            return false;
        }else{

            return true;
        }
    }

    function msj_value_es_negativo(valor,campo){
        //val= $.isNumeric(
        if(valor === -1 || valor =="-1"){
            //alert("Debe seleccionar un tipo en el campo '" + campo + "'.");
            document.getElementById("btn_aceptar").disabled  = true;
            document.getElementById("p_mensaje").innerHTML ="Debe seleccionar un tipo en el campo '" + campo + "'.";
            return false;

        }else{

            return true;
        }
    }


    function msj_value_es_entero(valor,campo){
        //val= $.isNumeric(
        if(Math.floor(valor) == valor && $.isNumeric(valor)){
            return true;
        }else{
            //alert("Debe escribir un número entero en el campo '" + campo + "'.");
            document.getElementById("btn_aceptar").disabled  = true;
            document.getElementById("p_mensaje").innerHTML = "Debe escribir un número entero en el campo '" + campo + "'.";
            return false;        
        }

    }


    function msj_value_longitud_max(valor,max,campo){

        longitud = valor.length;
        if(longitud>max){
            //alert("La longitud de caracteres para el campo '" + campo + "' debe ser como máximo de "+max+" caracteres.");
            document.getElementById("btn_aceptar").disabled  = true;
            document.getElementById("p_mensaje").innerHTML = "La longitud de caracteres para el campo '" + campo + "' debe ser como máximo de "+max+" caracteres.";
            return false;

        }else{
            return true;
        }

    }


    function msj_value_longitud_min(valor,min,campo){

        longitud = valor.length;
        if(longitud<min){
            //alert("La longitud de caracteres para el campo '" + campo + "' debe ser como mínimo de "+min+" caracteres.");
            document.getElementById("btn_aceptar").disabled  = true;
            document.getElementById("p_mensaje").innerHTML = "La longitud de caracteres para el campo '" + campo + "' debe ser como mínimo de "+min+" caracteres.";
            return false;

        }else{
            return true;
        }

    }

    function msj_value_longitud_exacta(valor,nro_exacto,campo){

        longitud = valor.length;
        if(longitud==nro_exacto){

            return true;
        }else{
            //alert("La longitud de caracteres para el campo '" + campo + "' no es correcta, debería ser "+nro_exacto+" caracteres."); 
            document.getElementById("btn_aceptar").disabled  = true;
            document.getElementById("p_mensaje").innerHTML = "La longitud de caracteres para el campo '" + campo + "' no es correcta, debería ser "+nro_exacto+" caracteres."
            return false;
        }

    }


    function msj_value_es_email(valor,campo) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if(re.test(valor)==true){
            return true;
        }else{
            //alert("Debe escribir un correo electrónico correcto en el campo '" + campo + "'.");
            document.getElementById("btn_aceptar").disabled  = true;
            document.getElementById("p_mensaje").innerHTML = "Debe escribir un correo electrónico correcto en el campo '" + campo + "'."
            return false;
        }

    }

    function msj_value_es_texto(valor,campo) {
        var re = /^[A-Z a-zñáéíóúü]+$/;
        if(re.test(valor)==true){
            return true;
        }else{
            //alert("Debe escribir palabras de caracter textual en el campo '" + campo + "'.");
            document.getElementById("btn_aceptar").disabled  = true;
            document.getElementById("p_mensaje").innerHTML = "Debe escribir palabras de caracter textual en el campo '" + campo + "'.";
            return false;
        }

    }


    function msj_value_es_fecha(valor, campo){

            alert("Object.prototype.toString.call(valor) = "+Object.prototype.toString.call(valor))
            if ( Object.prototype.toString.call(valor) === "[object Date]" ) {
              // it is a date
              alert("isNaN(valor.getTime()) = "+isNaN(valor.getTime() ) )
              if ( isNaN(valor.getTime() ) ) {  // d.valueOf() could also work
                // date is not valid
                //alert("El valor del campo '" + campo + "' no es correcto.");
                document.getElementById("btn_aceptar").disabled  = true;
                document.getElementById("p_mensaje").innerHTML="El valor del campo '" + campo + "' no es correcto.";
                return false;
              }
              else {
                // date is valid
              }
            }
            else {
              // not a date
                //alert("El valor del campo '" + campo + "' no es correcto.");
                document.getElementById("btn_aceptar").disabled  = true;
                document.getElementById("p_mensaje").innerHTML="El valor del campo '" + campo + "' no es correcto.";
                return false;          

            }

    }

    function submit_form(){

        Oficio                  = $.trim($('#cboOficios').val());
        Contacto                = $.trim($('#contacto').val());
        Telefono                = $.trim($('#telefono').val());
        Direccion               = $.trim($('#direccion').val());
        Email                   = $.trim($('#email').val());
        DescripcionUrgencia     = $.trim($('#descripcionUrgencia').val());
        Foto                    = $.trim($('#foto').val());
        Distrito                = $.trim($('#cboDistrito').val());

        if (msj_value_es_cero(Oficio, 'Oficio')==false) {return false;}   

        if (msj_value_vacio(Contacto, 'Contacto')==false) {return false;}  
        if (msj_value_es_texto(Contacto, 'Contacto')==false) {return false;}  

        if (msj_value_vacio(Telefono, 'Teléfono')==false) {return false;}  
        if (msj_value_es_entero(Telefono, 'Teléfono')==false) {return false;}  

        if (msj_value_vacio(Email, 'Correo Electrónico')==false) {return false;}  
        if (msj_value_es_email(Email, 'Correo Electrónico')==false) {return false;}  

        if (msj_value_vacio(Direccion, 'Dirección')==false) {return false;}  
        if (msj_value_longitud_min(Direccion,10, 'Dirección')==false) {return false;}      
        
        if (msj_value_select(Distrito, 'Distrito')==false) {return false;}   

        if (msj_value_longitud_min(DescripcionUrgencia,30, 'Descripición de Urgencia')==false) {return false;}  
        if (msj_value_longitud_max(DescripcionUrgencia,300, 'Descripición de Urgencia')==false) {return false;}  

        if (msj_value_vacio(Foto, 'Foto')==false) {return false;}  
            
        document.getElementById("btn_aceptar").disabled  = false;
        document.getElementById("p_mensaje").innerHTML="¿Está seguro que desea registrar su urgencia?";    

    }

</script>
    <link rel="shortcut icon" href="<?php echo base_url("assets/images/favicon.ico"); ?>" />
    
</head>



<body>


    <header id="header" >
    
    <div class="top-bar">
    <div class="container">
    <div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
      <div class="top-number"><p><i class="fa fa-thumbs-up"></i> Estamos allí, para su hogar. </p></div>
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
      </div>
        </div>
      <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="*"><img src="<?php echo base_url("assets/images/logo.png"); ?>" alt="logo"></a>
                </div>
				
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="<?php echo base_url('index.php/solicitar_trabajo'); ?>">Inicio</a></li>
                       <li><a href="<?php echo base_url('index.php/trabaja_con_nosotros'); ?>">Trabaja con Nosotros</a></li>
                        <li><a href="#">Servicios</a></li>                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pages <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Blog Single</a></li>
                                <li><a href="#">Pricing</a></li>
                                <li><a href="#">404</a></li>
                                <li><a href="#">Shortcodes</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Blog</a></li> 
                        <li><a href="#">Contact</a></li>                        
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
         
 
   
   <!-- Fin de Cabecera HEADER-->
    <section id="main-slider" class="no-margin">


        <div class="carousel slide" >
            <ol class="carousel-indicators">
                <li data-target="#main-slider" data-slide-to="0" class="active"></li>
                <li data-target="#main-slider" data-slide-to="1"></li>
                <li data-target="#main-slider" data-slide-to="2"></li>
                <li data-target="#main-slider" data-slide-to="3"></li>
            </ol>

            <div class="carousel-inner">

                <div class="item active" style="background-image: url(<?php echo base_url("assets/images/slider/bg1.jpg"); ?>)">
                    <div class="container">
                        <div class="row slide-margin">
                            <div class="col-sm-6">
                                <div class="carousel-content">
                                    <h1 class="animation animated-item-1" style="color:Black">Gasfiteros</h1>
                                    <h2 class="animation animated-item-2" style="color:Black">
                                    Atentos para solucionar la fuga de agua en la tuberías, griferías averiadas, problemas con el desagüe, etc.</h2>
                                    <a class="btn-slide animation animated-item-3" href="#">Leer Más</a>
                                </div>
                            </div>

                            <div class="col-sm-6 hidden-xs animation animated-item-4">
                                <div class="slider-img">
                                    <img src="<?php echo base_url("assets/images/slider/img1.png"); ?>" class="img-responsive">
                                </div>
                            </div>

                        </div>
                    </div>
                </div><!--/.item-->

                <div class="item" style="background-image: url(<?php echo base_url("assets/images/slider/bg2.jpg"); ?>)">
                    <div class="container">
                        <div class="row slide-margin">
                            <div class="col-sm-6">
                                <div class="carousel-content">
                                    <h1 class="animation animated-item-1">Jardineros</h1>
                                    <h2 class="animation animated-item-2">
                                    Dispuestos para remover la maleza, podar las ramas del árbol, plantar un nuevo césped, fertilizar la tierra, etc.
                                    </h2>
                                    <a class="btn-slide animation animated-item-3" href="#">Leer Más</a>
                                </div>
                            </div>

                            <div class="col-sm-6 hidden-xs animation animated-item-4">
                                <div class="slider-img">
                                    <img src="<?php echo base_url("assets/images/slider/img2.png"); ?>" class="img-responsive">
                                </div>
                            </div>

                        </div>
                    </div>
                </div><!--/.item-->

                <div class="item" style="background-image: url(<?php echo base_url("assets/images/slider/bg3.jpg"); ?>)">
                    <div class="container">
                        <div class="row slide-margin">
                            <div class="col-sm-6">
                                <div class="carousel-content">
                                    <h1 class="animation animated-item-1" style="color:Black">Carpinteros</h1>
                                    <h2 class="animation animated-item-2" style="color:Black">
                                    Desea renovar las puertas de sus habitaciones, reparar la mesa o las sillas del comedor, construir un nuevo estante para su cocina, etc.
                                    </h2>
                                    <a class="btn-slide animation animated-item-3" href="#">Leer más</a>
                                </div>
                            </div>
                            <div class="col-sm-6 hidden-xs animation animated-item-4">
                                <div class="slider-img">
                                    <img src="<?php echo base_url("assets/images/slider/img3.png"); ?>" class="img-responsive">
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/.item-->


                <div class="item" style="background-image: url(<?php echo base_url("assets/images/slider/bg4.jpg"); ?>)">
                    <div class="container">
                        <div class="row slide-margin">
                            <div class="col-sm-6">
                                <div class="carousel-content">
                                    <h1 class="animation animated-item-1">Albañilería</h1>
                                    <h2 class="animation animated-item-2">
                                    In Bootstrap 3, mobile-first styles are part of the core framework
                                    </h2>
                                    <a class="btn-slide animation animated-item-3" href="#">Leer más</a>
                                </div>
                            </div>
                            <div class="col-sm-6 hidden-xs animation animated-item-4">
                                <div class="slider-img">
                                    <img src="<?php echo base_url("assets/images/slider/img4.png"); ?>" class="img-responsive">
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/.item-->


            </div><!--/.carousel-inner-->
        </div><!--/.carousel-->



        <a class="prev hidden-xs" href="#main-slider" data-slide="prev">
            <i class="fa fa-chevron-left"></i>
        </a>
        <a class="next hidden-xs" href="#main-slider" data-slide="next">
            <i class="fa fa-chevron-right"></i>
        </a>
    </section>
    <!--/#main-slider-->



        <!--Inicio de Franja Formulario -->

    <section id="middle0">


        <div class="container">
            <div class="row">
             

                <div class="col-sm-6 wow fadeInDown">


<!--inicio form-->


<!-- Form Name -->
                        <h2>Registre su Urgencia</h2>
                        <p>
                        ¡Nosotros te llamamos! Cuéntanos qué se te ha roto y te ofreceremos la mejor solución.
                        </p>

<!-- Select Basic -->
                        <?php if($guardado==TRUE){ ?>

                        <div class="alert alert-success alert-dismissable" aria-label="close">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                          <strong>Guardado: </strong> Nos contactataremos pronto con Ud.
                        </div>

                        <?php } ?>
                        <!--inicio form-->
                        <?php echo form_open_multipart('solicitar_trabajo/formulario', array('onsubmit' => 'return submit_form();')); ?>

                        <!-- Form Name -->
                        <div class="form-group" >

                            <div class="col-md-11 selectContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                <select name="cboOficios" id="cboOficios" Class="form-control selectpicker">        
                                    <option value="0">Necesito un...</option>
                                    <?php foreach ($oficios as $key => $value) { 
                                            if(set_value('cboOficios')==$value['COD_OFICIO']){
                                                echo "\t\t\t\t\t<option value='".$value['COD_OFICIO']."' selected>".$value['DES_OFICIO']."</option>\n";
                                            }else{
                                                echo "\t\t\t\t\t<option value='".$value['COD_OFICIO']."'>".$value['DES_OFICIO']."</option>\n";
                                            }
                                      } 
                                    ?>        
                            </select>
                            </div>
                            <?php echo form_error('cboOficios', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>      
                        </div>
                        </div>


                        <!-- Text input-->
                        <div class="form-group"  style="padding-top:10px"> 
                          <div class="col-md-11 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input  name="contacto" id="contacto" placeholder="Contacto" class="form-control" value="<?php echo set_value('contacto'); ?>"  type="text">
                                </div>
                                <?php echo form_error('contacto', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>      
                          </div>
                        </div>


                        <!-- Text input-->
                        <div class="form-group" style="padding-top:10px   "> 
                            <div class="col-md-11 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                <input name="telefono" id="telefono" placeholder="Teléfono" class="form-control"  value="<?php echo set_value('telefono'); ?>" type="text">        
                            </div>
                            <?php echo form_error('telefono', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>      
                          </div>
                        </div>       


                        <!-- Text input-->
                        <div class="form-group" style="padding-top:10px   "> 

                            <div class="col-md-11 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                    <input name="email" id="email" placeholder="Correo Electrónico" class="form-control" value="<?php echo set_value('email'); ?>"  type="text">        
                                </div>
                                <?php echo form_error('email', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>      
                            </div>
                        </div>


                        <!-- Text input-->
                        <div class="form-group" style="padding-top:10px   "> 
                            <div class="col-md-11 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                    <input name="direccion" id="direccion" placeholder="Dirección" value="<?php echo set_value('direccion'); ?>" class="form-control" type="text">
                                </div>
                                <?php echo form_error('direccion', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>  
                          </div>
                        </div>      


                        <!-- Select Basic -->
                           <div class="form-group" style="padding-top:10px   "> 
                            <div class="col-md-11 selectContainer">
                                        <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                        <select id="cboDistrito" name="cboDistrito" ID="cboDistrito" Class="form-control selectpicker">
                                                <option value="000000000">Distrito</option>
                                                <?php foreach ($distritos as $key => $value) { 
                                                    
                                                        if(set_value('cboDistrito')==$value['cod_ubigeo']){
                                                            echo "\t\t\t\t\t<option value='".$value['cod_ubigeo']."' selected>".$value['des_ubigeo']."</option>\n";
                                                        }else{                            
                                                            echo "\t\t\t\t\t<option value='".$value['cod_ubigeo']."'>".$value['des_ubigeo']."</option>\n";
                                                        }
                                                } 
                                                ?>                        
                                        </select>
                                </div>
                                <?php echo form_error('cboDistrito', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>   
                            </div>
                        </div>



                        <!-- Text area -->
                        <div class="form-group" style="padding-top:10px"> 
                            <div class="col-md-11 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                        <textarea class="form-control" id="descripcionUrgencia" name="descripcionUrgencia" placeholder="Describenos de urgencia"><?php echo set_value('descripcionUrgencia'); ?></textarea>           
                            </div>
                                 <?php echo form_error('descripcionUrgencia', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>         
                            </div>

                        </div>  


                        <!-- Text input-->
                        <div class="form-group" style="padding-top:10px"> 
                            <div class="col-md-11 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                        <input  name="foto" onchange="return fileValidation('foto')" id="foto" value="<?php echo set_value('foto'); ?>" placeholder="Fotos" class="form-control" type="file">
                                </div>
                                <?php echo form_error('foto', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>  
                             <div class="container-fluid" id="div_foto" style="background-color:lavenderblush;"></div>  
                            </div>
                                
                              
                        </div>      


                        <!-- Success message -->
                        <!--div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Thanks for contacting us, we will get back to you shortly.</!--div-->

                        <!-- Button -->
                        <div class="form-group"  > 
                            
                            <div class="col-md-11 inputGroupContainer" >
                                <p align="center">
                                    <button onclick="submit_form()" type="button"  class="btn btn-block btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                                    <span class="glyphicon glyphicon-send"></span>
                                        Enviar
                                    </button>
                                </p>
                            </div>
                            
                        </div>



                    </div>
                         <br>      <br>           

                <!--/.col-sm-6-->


<!--hasta aquí no más-->
                <div class="col-sm-6 wow fadeInDown">
                    <div class="accordion">
                        <h2 style="font-weight: 600;font-family: 'Open Sans', sans-serif;color: #4e4e4e;">Fases De Tu Atención</h2>
                        <div class="panel-group" id="accordion1">
                          <div class="panel panel-default">
                            <div class="panel-heading active">
                              <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne1">
                                  1: Busca Tu Especialista
                                  <i class="fa fa-angle-right pull-right"></i>
                                </a>
                              </h3>
                            </div>

                            <div id="collapseOne1" class="panel-collapse collapse in">
                              <div class="panel-body">
                                  <div class="media accordion-inner">
                                        <div class="pull-left">
                                            <img class="img-responsive" src="<?php echo base_url("assets/images/accordion1.png"); ?>">
                                        </div>
                                        <div class="media-body">
                                             <h4>¡Encuentralo!</h4>
                                             <p>
                                             Puedes buscar al especialista desde tu smartphone, tablet o PC y desde allí puedes comentarnos qué sucede en tu casa.
                                             </p>
                                        </div>
                                  </div>
                              </div>
                            </div>
                          </div>

                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo1">
                                  2: Contactate con el especialista.
                                  <i class="fa fa-angle-right pull-right"></i>
                                </a>
                              </h3>
                            </div>
                            <div id="collapseTwo1" class="panel-collapse collapse">

                              <div class="panel-body">

                              <div class="media accordion-inner">
                                        <div class="pull-left">
                                            <img class="img-responsive" src="<?php echo base_url("assets/images/accordion2.png"); ?>">
                                        </div>
                                             <h4>¡Coméntalo!</h4>
                                             <p>
                               Presentas a detalle con comentarios, como también fotografías acerca del tipo de avería o proyecto que tienes.
                               </p>
                              </div>
                              </div>

                            </div>
                          </div>

                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseThree1">
                                  3: Solucione el problema
                                  <i class="fa fa-angle-right pull-right"></i>
                                </a>
                              </h3>
                            </div>
                            <div id="collapseThree1" class="panel-collapse collapse">
                              <div class="panel-body">

                              <div class="media accordion-inner">
                                        <div class="pull-left">
                                            <img class="img-responsive" src="<?php echo base_url("assets/images/accordion3.png"); ?>">
                                        </div>
                                             <h4>¡Acuérdalo!</h4>
                                             <p>
                                Acuerda con el especialista descritos en el punto anterior, para que pongas fin a tu incidencia o avería y poder continuar sin preocupaciones en tu hogar.
                                </p>
                              </div>
                              </div>
                            </div>
                          </div>

                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseFour1">
                                   4: Califique el trabajo y listo!
                                  <i class="fa fa-angle-right pull-right"></i>
                                </a>
                              </h3>
                            </div>
                            <div id="collapseFour1" class="panel-collapse collapse">
                              <div class="panel-body">

                              <div class="media accordion-inner">
                                        <div class="pull-left">
                                            <img class="img-responsive" src="<?php echo base_url("assets/images/accordion4.png"); ?>">
                                        </div>
                                             <h4>¡Calificalo!</h4>
                                             <p>
                               Haga presente su experiencia y comparta el desempeño del especialista para su futura recomendación.
                              </div>
                            </div>
                            </div>
                          </div>
                        </div><!--/#accordion1-->
                    </div>
                </div>

            </div><!--/.row-->
        </div><!--/.container-->
        <br>
    </section>
        
       <!--Fin de Franja Formulario -->





    <section id="feature">
        <div class="container">
           <div class="center wow fadeInDown">
                <h2>Prestaciones</h2>
                <p class="lead">
                 Una manera fácil de encontrar diversos  <br />especialistas que necesita para resolver su problema en el hogar.
                </p>
            </div>

            <div class="row">
                <div class="features">
                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa fa-mobile"></i>
                            <h2>Fácil de ubicarlo</h2>
                            <h3>
                            Disponibles desde smartphone en Android.
                            </h3>
                        </div>
                    </div><!--/.col-md-4-->

                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa fa-briefcase"></i>
                            <h2>Diversos Especialistas</h2>
                            <h3>
                            Multiples especialistas para su necesidad en el hogar.
                            </h3>
                        </div>
                    </div><!--/.col-md-4-->

                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa fa-wrench"></i>
                            <h2>Fácil Acceso</h2>
                            <h3>Gestión inmediata para acoger el proyecto o avería. </h3>
                        </div>
                    </div><!--/.col-md-4-->
                
                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa fa-comment"></i>
                            <h2>Tus proyectos</h2>
                            <h3>Presenta el proyecto que tienes en mente para tu casa.</h3>
                        </div>
                    </div><!--/.col-md-4-->

                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa fa-users"></i>
                            <h2>Personal</h2>
                            <h3>Podrá encontrar de inmediato para su necesidad.</h3>
                        </div>
                    </div><!--/.col-md-4-->

                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa fa-heart"></i>
                            <h2>Testimonios</h2>
                            <h3>Tenemos el respaldo de nuestros usuarios.</h3>
                        </div>
                    </div><!--/.col-md-4-->
                </div><!--/.services-->
            </div><!--/.row-->    
        </div><!--/.container-->
    </section>
    <!--/#feature-->



    </p>

    <!--/#middle-->
    <section id="bottom">
        <div class="container wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3>Company</h3>
                        <ul>
                            <li><a href="#">About us</a></li>
                            <li><a href="#">We are hiring</a></li>
                            <li><a href="#">Meet the team</a></li>
                            <li><a href="#">Copyright</a></li>
                            <li><a href="#">Terms of use</a></li>
                            <li><a href="#">Privacy policy</a></li>
                            <li><a href="#">Contact us</a></li>
                        </ul>
                    </div>    
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3>Support</h3>
                        <ul>
                            <li><a href="#">Faq</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Forum</a></li>
                            <li><a href="#">Documentation</a></li>
                            <li><a href="#">Refund policy</a></li>
                            <li><a href="#">Ticket system</a></li>
                            <li><a href="#">Billing system</a></li>
                        </ul>
                    </div>    
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3>Developers</h3>
                        <ul>
                            <li><a href="#">Web Development</a></li>
                            <li><a href="#">SEO Marketing</a></li>
                            <li><a href="#">Theme</a></li>
                            <li><a href="#">Development</a></li>
                            <li><a href="#">Email Marketing</a></li>
                            <li><a href="#">Plugin Development</a></li>
                            <li><a href="#">Article Writing</a></li>
                        </ul>
                    </div>    
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3>Our Partners</h3>
                        <ul>
                            <li><a href="#">Adipisicing Elit</a></li>
                            <li><a href="#">Eiusmod</a></li>
                            <li><a href="#">Tempor</a></li>
                            <li><a href="#">Veniam</a></li>
                            <li><a href="#">Exercitation</a></li>
                            <li><a href="#">Ullamco</a></li>
                            <li><a href="#">Laboris</a></li>
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
                    &copy; 2017 <a target="_blank" href="#" title="Free Twitter Bootstrap asp.net templates">Decter Soluciones</a>. All Rights Reserved.
                </div>
                <div class="col-sm-6">
                    <ul class="pull-right">
                        <li><a href="#">Inicio</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Faq</a></li>
                        <li><a href="#">Contact Us</a></li>
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
    <script src="<?php echo base_url("assets/js/Funciones_Val_TMRH.js"); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url("assets/js/jquery.prettyPhoto.js"); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url("assets/js/jquery.isotope.min.js"); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url("assets/js/main.js"); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url("assets/js/wow.min.js"); ?>" type="text/javascript"></script>


    <script type="text/javascript">
        function ShowPopup() {
            $("#btnShowPopup").click();
        }
    </script>  


      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Formulario de la Urgencia</h4>
            </div>
            <div class="modal-body">
              <p id="p_mensaje">Some text in the modal.</p>
            </div>
            <div class="modal-footer">
              
              <button type="submit" class="btn btn-danger btn-default " data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>               &nbsp; &nbsp;           
              <button type="submit" class="btn btn-default btn-success pull-right" id="btn_aceptar"><span class="glyphicon glyphicon-ok"></span> Aceptar</button>           
              
            </div>
          </div>
          
        </div>
      </div>


    </form>

</body>
</html>
