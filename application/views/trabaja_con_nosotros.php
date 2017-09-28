<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Casa Oficios</title>

    <script src="<?php echo base_url("assets/js/jquery.js"); ?>" type="text/javascript"></script>
    <link href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url("assets/css/font-awesome.min.css"); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url("assets/css/animate.min.css"); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url("assets/css/prettyPhoto.css"); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url("assets/css/main.css"); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url("assets/css/responsive.css"); ?>" rel="stylesheet" type="text/css">
    
     <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css" />
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

    <link href="<?php echo base_url("assets/css/bootstrap-datetimepicker.min.css"); ?>" rel="stylesheet" media="screen">
    <script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap-datetimepicker.js"); ?>" charset="UTF-8"></script>
    <link rel="shortcut icon" href="<?php echo base_url("assets/images/favicon.ico"); ?>" />


 <script language="javascript">
      
        //variable global para fx AgregarItem

        /*---------------------------------------------------------------------------*/
                    function addCustomItem(id, text, val) {
                        var vlist = document.getElementById(id);
                        if (vlist != null) {
                            if (navigator.appName == 'Microsoft Internet Explorer') {
                                var newOption = document.createElement('OPTION');
                                newOption.value = val;
                                newOption.innerText = text;
                                vlist.options.appendChild(newOption);
                            }
                            else {
                                var newOption = new Option(text, val);
                                vlist.options.add(newOption);
                            }
                        }
                    }

        function selectAllElements(id,id2) {

            var oList = document.getElementById(id);
            if (oList != null) {
            for (i = 0; i < oList.options.length; i++)
                oList.options[i].selected = true;
            }
            var oList2 = document.getElementById(id2);
            if (oList2 != null) {
                for (e = 0; e < oList2.options.length; e++)
                    oList2.options[e].selected = true;
            }

        }

                    //function selectAllElements2(id) {
                    //    var oList = document.getElementById(id);
                    //    if (oList != null) {
                    //        for (i = 0; i < oList.options.length; i++)
                    //            oList.options[i].selected = true;
                    //    }
                    //}

        function openTab(tab){
            //Obtiene el nombre del UL
            //var tabName2 = $('.nav-tabs .active').text();
            // eSTE JAVA SCRIPT LLAMA EL BOTON SIGUIENTE PASO..
            // AQUI CAPTURA EN ESTA VARIABLE CUAL ES EL TABPANEL ACTIVO...
            // AQUI RECUPERA EL ID QUE LE HAYAS PUESTO AL TABPANEL
            var tabName2 = $(".tab-content").find(".active").attr('id');
            // CON ESTE SWITCH VALIDAS LOS DATOS POR CADA TAB
            var bol = true;
            switch (tabName2) {
                case 'home':
                    //Este metodo esta en Funciones_Val_TMRH.js que esta en la Carpeta js....
                    // Esto gracias a que lo he instanciado al ultimo y cuando lo instancias puedes llamar a metodos de ese javascript
                   
                    bol = ValidarElementosHome();
                    tabName2 = 'home';
                    break;
                    
                case 'profile':
                    ValidarElementosContacto();
                    tabName2 = 'profile';
                    break;

            }
            if(bol == false){
                return;           
            }
            // LUEGO DE ESTO SI TODO ESTA BIEN PASA A EL TAB QUE REQUIERA EL BOTON..
            $('#Tabs a[href="#' + tab + '"]').tab('show');
            $("#Tabs a").click(function () {
                $("[id*=TabName]").val($(this).attr("href").replace("#", ""));
            });
        
        }
        

       
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
            $('#myModal').modal('show');            
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
            $('#myModal').modal('show');
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
            $('#myModal').modal('show');            
            return false;
        }

    }


    function msj_value_es_cero(valor,campo){
        //val= $.isNumeric(
        if(valor === 0 || valor =="0"){
            //alert("Debe seleccionar un tipo en el campo '" + campo + "'.");
            document.getElementById("btn_aceptar").disabled  = true;
            document.getElementById("p_mensaje").innerHTML = "Debe seleccionar un tipo en el campo '" + campo + "'.";
            $('#myModal').modal('show');            
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
            $('#myModal').modal('show');            
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
            $('#myModal').modal('show');            
            return false;        
        }

    }


    function msj_value_longitud_max(valor,max,campo){

        longitud = valor.length;
        if(longitud>max){
            //alert("La longitud de caracteres para el campo '" + campo + "' debe ser como máximo de "+max+" caracteres.");
            document.getElementById("btn_aceptar").disabled  = true;
            document.getElementById("p_mensaje").innerHTML = "La longitud de caracteres para el campo '" + campo + "' debe ser como máximo de "+max+" caracteres.";
            $('#myModal').modal('show');            
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
            $('#myModal').modal('show');            
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
            $('#myModal').modal('show');            
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
            $('#myModal').modal('show');            
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
            $('#myModal').modal('show');            
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
                $('#myModal').modal('show');                
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
                $('#myModal').modal('show');                
                return false;          

            }

    }

    function valida_tab_1er(){

        Nombres         = $.trim($('#TxtNombres').val());
        ApePa           = $.trim($('#txtApePa').val());
        ApeMa           = $.trim($('#txtApeMa').val());
        TipoGenero      = $.trim($('#cboTipoGenero').val());
        TipoDocumento   = $.trim($('#CboTipoDocumento').val());
        NroDocumento    = $.trim($('#txtNroDocumento').val());
        FecNaci         = $.trim($('#txtFecNaci').val());

        if (msj_value_vacio(Nombres, 'Nombres')==false){return false;}
        if (msj_value_es_texto(Nombres, 'Nombres')==false){return false;}

        if (msj_value_vacio(ApePa, 'Apellido Paterno')==false){return false;}
        if (msj_value_es_texto(ApePa, 'Apellido Paterno')==false){return false;}

        if (msj_value_vacio(ApeMa, 'Apellido Materno')==false){return false;}
        if (msj_value_es_texto(ApeMa, 'Apellido Materno')==false){return false;}

        if (msj_value_es_cero(TipoGenero, 'Tipo género')==false){return false;}   
        if (msj_value_es_cero(TipoDocumento, 'Tipo documento')==false){return false;}             

        if (msj_value_vacio(NroDocumento, 'Número de Documento')==false){return false;}

        //if (msj_value_es_fecha(FecNaci, 'Fecha Nacimiento')==false){return false;}

        valor = NroDocumento.valueOf();

        if (msj_value_es_entero(valor, 'Número de Documento')==false){return false;}

        campo = "Número de Documento";
        //valor = NroDocumento;
        valor = valor.toString();

        if(TipoDocumento == 1){

            max = 8;
            if(msj_value_longitud_exacta(valor,max,campo)==false) 
            {
                    document.getElementById("btn_aceptar").disabled  = true;
                    document.getElementById("p_mensaje").innerHTML="Tipo de documento 'DNI' debe poseer 8 caracteres.";                   
                    $('#myModal').modal('show');                    
                    return false;
            }else{
                //return true;
            }

        }else{

            if(TipoDocumento == 2){
                max = 12;
                if(msj_value_longitud_exacta(valor,max,campo)==false) 
                {
                    document.getElementById("btn_aceptar").disabled  = true;
                    document.getElementById("p_mensaje").innerHTML="Tipo de documento 'Carnet de Extranjería' debe poseer 12 caracteres.";      
                    $('#myModal').modal('show');                    
                    return false;
                }else{
                    //return true;
                }
            }else{
                document.getElementById("btn_aceptar").disabled  = true;
                document.getElementById("p_mensaje").innerHTML="Tipo de documento no definido.";
                $('#myModal').modal('show');                                
                //alert("Tipo de documento no definido");
                return false;
            }

        }


        if (msj_value_vacio(FecNaci, 'Fecha Nacimiento')==false){return false;}


        openTab('profile');
        return true;

    }




    function pre_valida_tab_2do(){

        TelefonoPrincipal       = $.trim($('#cboCompaniaPrincipal').val());
        Distrito                = $.trim($('#cboDistrito').val());
        Email                   = $.trim($('#txtEmail').val());
        Direccion               = $.trim($('#txtDireccion').val());
        nroTelefonoAgregados    = $('#lstTelefonoAgregados option').length;

        //alert('nroTelefonoAgregados:' + nroTelefonoAgregados);
        if (msj_value_es_cero(Distrito, 'Distrito')==false){return false;}    

        if (msj_value_vacio(Direccion, 'Dirección')==false){return false;}

        if (msj_value_vacio(Email, 'Correo Electrónico')==false){return false;}
        if (msj_value_es_email(Email, 'Correo Electrónico')==false){return false;}            

        if(nroTelefonoAgregados != 0){
            if (msj_value_es_negativo(TelefonoPrincipal, 'Celular Principal de Contacto')==false){return false;}           
        }

        return true;

    }



    function valida_tab_2do(){

        if(pre_valida_tab_2do()==false){return false;}

        openTab('messages');
        return true;

    }

    function pre_valida_tab_3er(){

        OficioPreferencial   = $.trim($('#cboOficiosPreferencial').val());
        nroOficiosAgregados    = $('#lstOficioExperienciAgregados option').length;    

        if(nroOficiosAgregados != 0){
            if (msj_value_es_negativo(OficioPreferencial, 'Oficio Preferencial')==false){return false;}           
        }    
        return true;

    }



    function valida_tab_3er(){

        if(pre_valida_tab_3er()==false){return false;}
     
        openTab('settings');
        return true;

    }



    function pre_valida_tab_4to(){

        nroOficiosAgregados    = $('#lstOficioExperienciAgregados option').length;  
        nroTelefonoAgregados    = $('#lstTelefonoAgregados option').length;
            
        ReciboResidencia            = $.trim($('#fileReciboResidencia').val());
        AntecendentesPoliciales     = $.trim($('#fileAntecendentesPoliciales').val());
        AntecendentesPenales        = $.trim($('#fileAntecedentePenales').val());
        DocumentoIdentidad          = $.trim($('#fileDocumentoIdentidad').val());         
        Foto_Carnet                 = $.trim($('#FotoCarnet').val());       


        if(nroOficiosAgregados>0 && nroTelefonoAgregados >0){

            if (msj_value_vacio(ReciboResidencia, 'Recibo Luz o Agua')==false){return false;}
            if (msj_value_vacio(AntecendentesPoliciales, 'Antecendentes Penales Escaneado')==false){return false;}
            if (msj_value_vacio(AntecendentesPenales, 'Antecendentes Policiales Escaneado')==false){return false;}
            if (msj_value_vacio(DocumentoIdentidad, 'Documento de Identidad Escaneado')==false){return false;}
            if (msj_value_vacio(Foto_Carnet, 'Foto Carnet')==false){return false;}       
               
        }
            
        return true;

    }

    function valida_tab_4to(){

        if(pre_valida_tab_4to()==false){return false;}
        openTab('enviar');
        return true;

    }




    function validar_submit(){

        if(valida_tab_1er() == false){ return false;}
        if(pre_valida_tab_2do() == false){ return false;}
        if(pre_valida_tab_3er() == false){ return false;}
        if(pre_valida_tab_4to() == false){ return false;}

        return true;

    }



</script>




</head>


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
      </div><!--%--container--%-->
        </div><!--%--/top-bar--%-->

 
    </header>


<body>
    

<?php //echo form_open('formulario/procesar'); ?>
<?php echo form_open_multipart('trabaja_con_nosotros/formulario', array('onsubmit' => 'return validar_submit();')); ?>
    
    
    <?php 
        #echo validation_errors(); 
        if(empty($guardado)==false){
    ?>
<!-- Form Name -->
        <?php 
        if($guardado==TRUE){ 
        ?>

        <div class="alert alert-success">
          <strong>Guardado: </strong> Nos contactataremos pronto con Ud.
        </div>

        <?php
        }else{
        ?>
        
        <div class="alert alert-danger">
          <strong>Advertencia: </strong> No se pudo grabar el registro. Por favor, revise correctamente los datos.
        </div>
    <?php 
        }
    }
 ?>





    <div>
 

  


    <section id="feature">
        <div class="container">
           <div class="fadeInDown">



<div class="container">
  <div class="row">
        <div class="col-md-8">
                                    <!-- Nav tabs -->
                                    

                    <div id="Tabs" role="tabpanel">
                                    <ul  id="foo"  class="nav nav-tabs" role="tablist">

                                        <li role="presentation" class="active" >
                                        <a href="#home" aria-controls="home" role="tab" data-toggle="tab"> 
                                        <i class="glyphicon glyphicon-user"></i> 
                                         Identidad
                                        </a>
                                        </li>

                                        <li role="presentation">
                                        <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"> 
                                        <i class="glyphicon glyphicon-map-marker" ></i>                                         
                                         Contacto
                                        </a>
                                        </li>

                                        <li role="presentation">
                                        <a href="#messages"  aria-controls="messages" role="tab" data-toggle="tab"> 
                                        <i class="glyphicon glyphicon-briefcase"></i>                                         
                                        Experiencia
                                        </a>
                                        </li>

                                        <li role="presentation">
                                        <a href="#settings" aria-controls="settings" role="tab" data-toggle="tab"> 
                                        <i class="glyphicon glyphicon-file"></i>                                              
                                        Validación
                                        </a>
                                        </li>

                                        <li role="Enviar">
                                        <a href="#enviar" aria-controls="enviar" role="tab" data-toggle="tab"> 
                                        <i class="glyphicon glyphicon-send"></i>                                              
                                        Enviar
                                        </a>
                                        </li>

                                    </ul>
        
                                    <!-- Tab panes -->
                                    <div  class="tab-content" class="col-md-8 inputGroupContainer" >
                        
                          
                                        
                                <div role="tabpanel" class="tab-pane active" id="home">
                                    <!--inicio: Tab panes01 -->

                                    <div class="form-group">

                                        <label for="Nombres">Nombres : </label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                            <input type="text" name='TxtNombres'  id="TxtNombres" value="<?php echo set_value('TxtNombres'); ?>" Class="form-control" PlaceHolder="Nombres">
                                        </div>
                                        <?php echo form_error('TxtNombres', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>   
                                    </div>
                                    <!-- Text input-->
                                    <div class="form-group">
                                        <label for="Apellidos">Apellidos  Paterno: </label>
                                        <div class="input-group">
                                          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                          <input type="text" name='txtApePa'  id="txtApePa" value="<?php echo set_value('txtApePa'); ?>" Class="form-control" PlaceHolder="Apellidos">
                                        </div>
                                        <?php echo form_error('txtApePa', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>
                                   </div>
                                   <div class="form-group"> 
                                        <label for="Apellidos">Apellidos Materno: </label>
                                        <div class="input-group">
                                          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                          <input type="text" name='txtApeMa' id="txtApeMa" value="<?php echo set_value('txtApeMa'); ?>" Class="form-control" PlaceHolder="Apellidos">
                                        </div>
                                        <?php echo form_error('txtApeMa', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>
                                   </div>
                                   <div class="form-group">
                                        <label for="Apellidos">Genero: </label>
                                        <div class="input-group">
                                          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                <select name='cboTipoGenero'  id="cboTipoGenero" Class="form-control selectpicker">
                                                    <option value='0'>Seleccione</option>
                                                        <?php foreach ($sexos as $key => $value) { 
                                                                if(set_value('cboTipoGenero') == $value['COD_TIPO_MAESTRO']){
                                                                    echo "\t\t\t\t\t<option value='".$value['COD_TIPO_MAESTRO']."' selected>".$value['DES_TIPO_MAESTRO']."</option>\n";
                                                                }else{                            
                                                                    echo "\t\t\t\t\t<option value='".$value['COD_TIPO_MAESTRO']."'>".$value['DES_TIPO_MAESTRO']."</option>\n";
                                                                }
                                                        } 
                                                        ?>           
                                                </select>
                                         </div>
                                         <?php echo form_error('cboTipoGenero', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>
                                         
                                    </div>


                                    <!-- Select Basic -->
   
                                    <div class="form-group"> 

                                            <label for="CboTipoDocumento">Tipo Documento : </label>
                                            <div class="input-group">

                                                <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                                <select name='CboTipoDocumento'  id="CboTipoDocumento" class="form-control selectpicker">
                                                    <option value='0'>Seleccione Tipo de Documento</option>
                                                    <?php foreach ($documentos as $key => $value) { 
                                                            if(set_value('CboTipoDocumento')==$value['COD_TIPO_MAESTRO']){
                                                                echo "\t\t\t\t\t<option value='".$value['COD_TIPO_MAESTRO']."' selected>".$value['DES_TIPO_MAESTRO']."</option>\n";
                                                            }else{
                                                                echo "\t\t\t\t\t<option value='".$value['COD_TIPO_MAESTRO']."'>".$value['DES_TIPO_MAESTRO']."</option>\n";
                                                            }
                                                      } 
                                                    ?>     
                                                </select>

                                               <!--/select-->
                                            </div>
                                            <?php echo form_error('CboTipoDocumento', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>

                                    </div>

                                    <!-- Text input-->

                                    <div class="form-group ">

                                        <label for="txtNroDocumento">Nro. Documento : </label>  
                                        <div class="input-group">

                                                <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                                <input type="text" name="txtNroDocumento"  id="txtNroDocumento" value="<?php echo set_value('txtNroDocumento'); ?>" Class="form-control" PlaceHolder="Nro. Documento">

                                        </div>
                                        <?php echo form_error('txtNroDocumento', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>
                                    </div>

                                    <!-- Text input-->   


                                    <div class="form-group">
                                                    <label for="dtp_input2" >Fecha Nacimiento :</label>
                                                    <div class="input-group">
                                                        <div class="input-group date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">                    
                                                                                                             
                                                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                              <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                            <input class="form-control"  size="16" name="txtFecNaci"  id="txtFecNaci" value="<?php echo set_value('txtFecNaci'); ?>"  ReadOnly="true">  
                                                        </div>
          
                                             <input type="hidden" id="dtp_input2" value="" />
                                                    </div>
                                                    <?php echo form_error('txtFecNaci', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>
                                    </div>





                                    <!-- Text input-->
      

                                        

                                    <button type="button"  onclick="valida_tab_1er();" class="btn btn-primary btn-lg">Siguiente Paso</button>

                                    <!--fin: Tab panes01 -->                                      
                                        
                          </div>
                           

           
                          <div role="tabpanel" class="tab-pane" id="profile">

                                        <!--Inicio: Tab panes02-->

                                                    <!-- Select Basic -->
   
                                                    <div class="form-group"> 
                                                            <label for="cboDistrito">Distrito Dirección : </label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon" ><i class="glyphicon glyphicon-list"></i></span>

                                                                <select id="cboDistrito" name="cboDistrito" Class="form-control">
                                                                    <option value="0" selected="True">- Seleccione Distrito de Lima -</option>
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

                                                    <!-- Text input-->      
                                                    <div class="form-group">

                                                        <label  for="txtDireccion">Dirección : </label>
                                                        <div class="input-group">
                                                               <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                                               <input type="text" value="<?php echo set_value('txtDireccion'); ?>" name="txtDireccion" id="txtDireccion" Class="form-control" PlaceHolder="Dirección">
                                                        </div>
                                                        <?php echo form_error('txtDireccion', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>
                                                    </div>


                                                    <!-- Text input-->
                                                    <div class="form-group">

                                                        <label for="txtEmail">Correo Electrónico : </label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                                            <input type="email" name="txtEmail" id="txtEmail" value="<?php echo set_value('txtEmail'); ?>"  Class="form-control" PlaceHolder="Correo Electrónico">
                                                        </div>
                                                        <?php echo form_error('txtEmail', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>
                                                    </div>




                                                    <!-- Text input-->

                                                    <div class="form-group">

                                                        <label for="txtTelefono">Agregar números teléfonicos en la lista : </label>
                                                        <div class="input-group">

                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                                            <select id="cboProveedorTelf" name="cboProveedorTelf"   Class="form-control selectpicker">
                                                                <option value="0">Seleccione su Operador Telefónico</option>
                                                                <?php foreach ($operadoras as $key => $value) { 
                                                                        if(set_value('cboProveedorTelf')==$value['COD_TIPO_MAESTRO']){
                                                                            echo "\t\t\t\t\t<option value='".$value['COD_TIPO_MAESTRO']."' selected>".$value['DES_TIPO_MAESTRO']."</option>\n";
                                                                        }else{
                                                                            echo "\t\t\t\t\t<option value='".$value['COD_TIPO_MAESTRO']."'>".$value['DES_TIPO_MAESTRO']."</option>\n";
                                                                        }
                                                                  } 
                                                                ?>    
                                                            </select>
                                                            
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                                            <input type="text" name="txtTelefono" id="txtTelefono" value="<?php echo set_value('txtTelefono'); ?>" Class="form-control" PlaceHolder="Teléfono">

                                                        </div>
                                                        <?php echo form_error('txtTelefono', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>
                                                        <?php echo form_error('cboProveedorTelf', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>
                                                        
                                                        <div class="input-group">
                                                            <input type="submit" class="col-md-6" id="btnEliminarTelefono" name="btnAccionTelefono" value="Eliminar">                                                   
                                                            <input type="submit" class="col-md-6" id="btnAgregarTelefono" name="btnAccionTelefono" value="Agregar">
                                                        </div>        
                                                        
  
                                                                
                                                           <select id="lstTelefonoAgregados" name="lstTelefonoAgregados" Multiple  Class="form-control selectpicker" >
                                                                <?php 
                                                                    if(empty($array_telefonos)==false )
                                                                    {                                                                        
                                                                        foreach ($array_telefonos as $mdaKey => $mdaData) 
                                                                        {
                                                                            #if(empty($mdaData['telefono'])== false)
                                                                            #{
                                                                            echo "\t\t\t\t\t<option value='".$mdaKey."'>".$mdaData['telefono']."</option>\n";
                                                                            #}
                                                                        }
                                                                    }
                                                                ?>    
                                                            </select>                                                        
                                                            <?php                                                             
                                                            echo form_error('lstTelefonoAgregados', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); 
                                                            ?>
                                                                                
                                             </div>  

                                             <div class="form-group">

                                                        <label for="cboCompaniaPrincipal">Celular Principal de Contacto : </label>
                                                        <div class="input-group">

                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                                            <select id="cboCompaniaPrincipal" name="cboCompaniaPrincipal" Class="form-control selectpicker">                                                                                                                              
                                                                <option value="-1">Selecione el teléfono principal</option>
                                                                                                                                                                                                                                                                                                                                                                                             
                                                                <?php 
                                                                    if(empty($array_telefonos)==false)
                                                                    {
                                                                        foreach ($array_telefonos as $mdaKey => $mdaData) 
                                                                        {
                                                                            if(set_value('cboCompaniaPrincipal') == $mdaKey){
                                                                                echo "\t\t\t\t\t<option value='".$mdaKey."' selected>".$mdaData['telefono']."</option>\n";
                                                                            }else{
                                                                                echo "\t\t\t\t\t<option value='".$mdaKey."'>".$mdaData['telefono']."</option>\n";
                                                                            }                                                                                                                                        
                                                                            //echo $mdaKey . ": " . $mdaData["value"];                                                                            
                                                                        }
                                                                    }
  
                                                                ?>                                                                                                                                             
                                                            </select>                                                            
                                                        </div>
                                                        <?php echo form_error('cboCompaniaPrincipal', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>   

                                             </div>
       
                                      <button type="button"  onclick="valida_tab_2do();" class="btn btn-primary btn-lg">Siguiente Paso</button>
                                <!--Fin : Tab panes02-->
                                </div>
       
                
                                   <div role="tabpanel" class="tab-pane" id="messages">

                                                    <!--inicio: Tab panes03 -->



                                                    <!-- Text input-->

                                                    <div class="form-group">

                                                        <label>Agregue el oficio y el período de experiencia en la lista: </label>
                                                        <div class="input-group" style="padding-bottom:0px">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                                            <select id="cboOficiDomin" name="cboOficiDomin" Class="form-control selectpicker">
                                                                <option value="0">Seleccione Oficio</option>
                                                                <?php foreach ($oficios as $key => $value) { 
                                                                        if(set_value('cboOficios')==$value['COD_OFICIO']){
                                                                            echo "\t\t\t\t\t<option value='".$value['COD_OFICIO']."' selected>".$value['DES_OFICIO']."</option>\n";
                                                                        }else{
                                                                            echo "\t\t\t\t\t<option value='".$value['COD_OFICIO']."'>".$value['DES_OFICIO']."</option>\n";
                                                                        }
                                                                        
                                                                        $oficios_selecionado[$value['COD_OFICIO']]=$value['DES_OFICIO'];
                                                                  } 
                                                                ?>      
                                                            </select>
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                                            <select id="cboPerioDomin" name="cboPerioDomin"  Class="form-control selectpicker">
                                                                <option value="0">Seleccione Período de Experiencia</option>
                                                                <?php foreach ($experiencias as $key => $value) { 
                                                                        if(set_value('cboPerioDomin')==$value['COD_TIPO_MAESTRO']){
                                                                            echo "\t\t\t\t\t<option value='".$value['COD_TIPO_MAESTRO']."' selected>".$value['DES_TIPO_MAESTRO']."</option>\n";
                                                                        }else{
                                                                            echo "\t\t\t\t\t<option value='".$value['COD_TIPO_MAESTRO']."'>".$value['DES_TIPO_MAESTRO']."</option>\n";
                                                                        }
                                                                        $experiencias_selecionada[$value['COD_TIPO_MAESTRO']]=$value['DES_TIPO_MAESTRO'];
                                                                  } 
                                                                ?>    
                                                            </select>

                                                        </div>

                                                        

                                                        <div class="input-group">
                                                            <input type="submit" class="col-md-6 " name="btnAccionOficio" id="btnEliminarOficio" value="Eliminar">
                                                            <input type="submit" class="col-md-6" name="btnAccionOficio" id="btnAgregarOficio" value="Agregar" >  
                                                        </div>

                                                        <select id="lstOficioExperienciAgregados"  size="6" name="lstOficioExperienciAgregados" Class="form-control selectpicker" >
                                                                <?php 
                                                                    
                                                                        
                                                                    if(empty($array_oficios)==false)
                                                                    {                     
                                                                        foreach ($array_oficios as $k=> $valor){
                                                                            //echo "<option>k:".$k."</option>";
                                                                                $id =$k."-".$array_oficios[$k]."-".$array_tiempo_experiencia[$k];
                                                                                echo "\t\t\t\t\t<option value='".$id."'>";
                                                                                echo $array_descrip_tiempo_experiencia[$k]." - ".$array_descrip_oficio_experiencia[$k] ;
                                                                                echo "</option>";     
                                                                        }
                                                                    }
                                                                ?>    
                                                        </select>
                                                        
                                                            <?php 
                                                            echo form_error('lstOficioExperienciAgregados', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>');
                                                            
                                                            ?>

                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                                            <select id="cboOficiosPreferencial" name="cboOficiosPreferencial" Class="form-control selectpicker">
                                                                <option value="-1">Seleccione el oficio Ud. destaca</option>
                                                                <?php 
                                                                    if(empty($array_descrip_oficio_experiencia)==false)
                                                                    {
                                                                        foreach ($array_descrip_oficio_experiencia as $mdaKey => $mdaData) 
                                                                        {
                                                                            if(empty($mdaData)== false){     
                                                                                
                                                                                if(set_value('cboOficiosPreferencial')==$mdaKey){
                                                                                    echo "\t\t\t\t\t<option value='".$mdaKey."' selected>".$mdaData."</option>\n";
                                                                                }else{
                                                                                    echo "\t\t\t\t\t<option value='".$mdaKey."'>".$mdaData."</option>\n";
                                                                                }                                                                                                                                                                                                                                                                                                                                
                                                                            }
                                                                        }
                                                                    }
                                                                    
                                                                    
                                                                ?>     
                                                            </select>
                                                            <?php 
                                                            echo form_error('cboOficiosPreferencial', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>');
                                                            
                                                            ?>

                                                    </div>



                                                    <button type="button" onclick="valida_tab_3er();" class="btn btn-primary btn-lg">Siguiente Paso</button>






                                                    <!--Fin : Tab panes03-->
                               </div>


                               <div role="tabpanel" class="tab-pane" id="enviar">



                                            <p>
                                           DECLARO BAJO JURAMENTO:

                                           <ul>
                                        <li> No haber sido condenado por los delitos consignados en la Ley Nº 29988.</li>
                                        <li> No haber sido condenado por delito doloso, ni encontrarme inhabilitado judicialmente o con
                                        cese temporal. </li>

                                           </ul>

                                            </p>
                                   <input type='submit' name="ConfirmacionEnvio"  Class="btn btn-primary center-block" id="btnEnviar" value="Guardar Formulario">

                              </div>

                              <div role="tabpanel" class="tab-pane" id="settings">


                                            <!--Inicio: Tab panes05-->


                                            <!-- Text input-->                         
                                            <div class="form-group">

                                                <label for="fileReciboResidencia">Recibo Luz o Agua : </label>
                                                <div class="input-group">

                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                                    <input type="file" id="fileReciboResidencia" onchange="return fileValidation('fileReciboResidencia')" name="fileReciboResidencia" value="" Class="form-control" placeholder="Foto">                                                    

                                                </div>


                                                <div class="container-fluid" id="div_fileReciboResidencia" style="background-color:lavenderblush;">
                                                </div>    

                                                <?php echo form_error('fileReciboResidencia', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>
                                                
                                            </div>

                                            <!-- Text input-->
                                            <div class="form-group">

                                                <label for="fileAntecedentePenales">Antecendentes Penales Escaneado : </label>
                                                <div class="input-group">

                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                                    <input type="file"  id="fileAntecedentePenales" onchange="return fileValidation('fileAntecedentePenales')" name="fileAntecedentePenales" value="" Class="form-control" placeholder="Antecedentes penales">                                                                                                       

                                                </div>

                                                <div class="container-fluid" id="div_fileAntecedentePenales" style="background-color:lavenderblush;">
                                                </div>      


                                                <?php echo form_error('fileAntecedentePenales', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>  

                                            </div>

                                            <!-- Text input-->                         
                                            <div class="form-group">

                                                 <label for="fileAntecendentesPoliciales">Antecedentes Policiales Escaneado : </label>
                                                 <div class="input-group">

                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                                    <input type="file" id="fileAntecendentesPoliciales" onchange="return fileValidation('fileAntecendentesPoliciales')" name="fileAntecendentesPoliciales" value="" Class="form-control" placeholder="Foto">
                                                    
                                                </div>


                                                <div class="container-fluid" id="div_fileAntecendentesPoliciales" style="background-color:lavenderblush;">
                                                </div>     



                                                <?php echo form_error('fileAntecendentesPoliciales', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>
                                                
                                                

                                            </div>

                                            <!-- Text input-->
                                            <div class="form-group">


                                                <label for="fileDocumentoIdentidad">Documento de Identidad Escaneado : </label>
                                                <div class="input-group">

                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                                    <input type="file" id="fileDocumentoIdentidad" onchange="return fileValidation('fileDocumentoIdentidad')" value="" name="fileDocumentoIdentidad" Class="form-control" placeholder="Foto">
                                                    
                                                </div>


                                                <div class="container-fluid" id="div_fileDocumentoIdentidad" style="background-color:lavenderblush;">
                                                </div>    



                                                <?php echo form_error('fileDocumentoIdentidad', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>
                                                

                                            </div>


                                    <div class="form-group">

                                        <label for="FotoCarnet">Foto Carnet : </label>  

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                            <input type="file" id="FotoCarnet" name="FotoCarnet" onchange="return fileValidation('FotoCarnet')" value="" Class="form-control" placeholder="Foto">
                                        </div>

                                        <div class="container-fluid" id="div_FotoCarnet" style="background-color:lavenderblush;">
                                        </div>      

                                        <?php echo form_error('FotoCarnet', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>
                                    </div>

                                            <!--Fin: Tab panes05-->

                                        <button type="button"  onclick="valida_tab_4to();" class="btn btn-primary btn-lg">Siguiente Paso</button>


                                  </div>
                             
                          
    
                                    
                                    </div>
       
                    
                     </div>
          </div>
  </div>
</div>










      


</div>
        </div><!--/.container-->
    </section>
    <!--/#feature-->
 


    


</div>




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
    <!--/#bottom-->
    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2015 <a target="_blank" href="http://aspxtemplates.com/" title="Free Twitter Bootstrap asp.net templates">aspxtemplates</a>. All Rights Reserved.
                </div>
                <div class="col-sm-6">
                    <ul class="pull-right">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Faq</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <a href="#" class="back-to-top"><i class="fa fa-2x fa-angle-up"></i></a>
    </footer
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






<script type="text/javascript" src="<?php echo base_url("assets/js/jquery-1.8.3.min.js"); ?>" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap-datetimepicker.js"); ?>" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/locales/bootstrap-datetimepicker.es.js"); ?>" charset="UTF-8"></script>

<script type="text/javascript">
//in this line of code, to display the datetimepicker,  we used â€˜form_datetimeâ€™ as an argument to be 
    //passed in javascript. This is for Date and Time.
    // Esta función sirve para que despues de realizar el submit puedas mantenerte en tu panel
    $(function () {
        var tabName = $("[id*=TabName]").val() != "" ? $("[id*=TabName]").val() : "home";
        $('#Tabs a[href="#' + tabName + '"]').tab('show');
        $("#Tabs a").click(function () {
            $("[id*=TabName]").val($(this).attr("href").replace("#", ""));
        });
    });
    $('.form_datetime').datetimepicker({
        language:  'es',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    forceParse: 0,
        showMeridian: 1
    });
//this is for Date only 
  $('.form_date').datetimepicker({
        language:  'es',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
    });
//this is for Time Only 
  $('.form_time').datetimepicker({
        language:  'es',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 1,
    minView: 0,
    maxView: 1,
    forceParse: 0
    });
</script>

</body>
</html>