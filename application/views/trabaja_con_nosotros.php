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
        var arrayFonos = [];

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
                //case '':
                //    day = "Tuesday";
                //    return;

                //case '':
                //    day = "Saturday";
                //    return;
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
        

        

        

        function AgregarItem(id) {
            telefono = $.trim($('#txtTelefono').val());
            codigonItem = $.trim($('#cboProveedorTelf option:selected').val());
            descripcionItem = $.trim($('#cboProveedorTelf option:selected').text());
            
            nuevoCodigo = codigonItem + '-' + telefono;
            descri = descripcionItem + '-' + telefono;
        
            //Validación de Número de Telefono
            if ($.isNumeric(telefono) == false) {
                alert("El teléfono '" + telefono + "' no es númerico: .");
                return;
            }

            //Validación de Longitud de Telefono
            if (telefono.length == 9 && telefono.substring(0, 1) == 9) {
                //alert("El número descrito es celular correcto.");
            } else {            
                if (telefono.length == 7 && (telefono.substring(0, 1) != 9 || telefono.substring(0, 1) != 0)) {
                    //alert("El número descrito es fono domicilio correcto.");
                } else {                                
                    alert("El número telefónico '" + telefono + "' no es correcto.");
                    return;
                }            
            }


            //Validacion Existencia de teléfono
            for (var i = 0; i < arrayFonos.length; i++)
            {
                if (arrayFonos[i] == telefono)
                {
                    alert("Ya existe este teléfono registrado.");
                    return;
                }            
            }
            arrayFonos.push(telefono);

            document.getElementById('txtTelefono').value = '';

            addCustomItem(id, descri, nuevoCodigo);
        }


        /*---------------------------------------------------------------------------*/



       




        function borrarItemTelefono()
        {

            //if( confirm("¿Está seguro que desea eliminar el item seleccionado?") == true)
            //{                
            //    $('#lstTelefonoAgregados :selected').each(function (i, selected) {
            //        if (arrayFonos[i] == telefono) {                        
            //            $("#lstTelefonoAgregados option:selected").remove();
            //            arrayFonos.splice(i);
            //        }                    
            //    });
            //}

            if( confirm("¿Está seguro que desea eliminar el item seleccionado?") == true)
            {  
                var dropDownListRef = document.getElementById('lstTelefonoAgregados');
               
                var optionsList = '';
                var itemIndex = dropDownListRef.selectedIndex;
                if (itemIndex>=0){
                    var txt= []
                    txt = (document.getElementById('lstTelefonoAgregados').value).split("-");
                   

                
             
                    dropDownListRef.remove(itemIndex);
                    for (var i=0; i<arrayFonos.length; i++){
                        //alert(arrayFonos[i]);
                        //alert(txt[1]);
                        if (arrayFonos[i] == txt[1]){
                            
                            arrayFonos.splice(i,1);
                        }
                       
                                    }

               
                }
            }

        }



        function borrarItemOficio()
        {

            //if( confirm("¿Está seguro que desea eliminar el item seleccionado?") == true)
            //{                
            //    $('#lstTelefonoAgregados :selected').each(function (i, selected) {
            //        if (arrayFonos[i] == telefono) {                        
            //            $("#lstTelefonoAgregados option:selected").remove();
            //            arrayFonos.splice(i);
            //        }                    
            //    });
            //}

            if( confirm("¿Está seguro que desea eliminar el item seleccionado?") == true)
            {  
                var dropDownListRef = document.getElementById('lstOficioExperienciAgregados');
               
                var optionsList = '';
                var itemIndex = dropDownListRef.selectedIndex;
                if (itemIndex>=0){
                    var txt= []
                    txt = (document.getElementById('lstOficioExperienciAgregados').value).split("-");
                   

                
             
                    dropDownListRef.remove(itemIndex);
                    for (var i=0; i<arrayOficios.length; i++){
                        //alert(arrayOficios[i]);
                        //alert(txt[0]);
                        if (arrayOficios[i] == txt[0]){
                            
                            arrayOficios.splice(i,1);
                        }
                       
                                    }

               
                }
            }

        }



        /////////////////////////

        var arrayOficios = [];
        function agregarItemOficio(id) {

            //declaración de variables

            //telefono = $.trim($('#txtTelefono').val());
            codigoPerfilLaboral = $.trim($('#cboOficiosOtros option:selected').val());
            codigoPeriodolLaboral = $.trim($('#cboPeriodoExpeOtros option:selected').val());

            descripPerfilLaboral = $.trim($('#cboOficiosOtros option:selected').text());
            descripPeriodoLaboral = $.trim($('#cboPeriodoExpeOtros option:selected').text());

            nuevoCodigo = codigoPerfilLaboral + '-' + codigoPeriodolLaboral;
            //activarSalida = false;



            //Seleccionar al menos un Perfil Laboral

            //if (codigoPerfilLaboral == '00') {
            //    alert("Debe seleciconar un perfil laboral.");
            //    return;
            //}

            ////Seleccionar al menos un Perfil Laboral
            //if (codigoPeriodolLaboral == '00') {
            //    alert("Debe seleciconar un periodo laboral.");
            //    return;
            //}



            //Validacion Existencia de teléfono
            for (var i = 0; i < arrayOficios.length; i++) {

                if (arrayOficios[i] == codigoPerfilLaboral) {
                    alert("Ya existe el oficio '" + descripPerfilLaboral + "' registrado.");
                    return;
                }

            }
            arrayOficios.push(codigoPerfilLaboral);


            //AgregarItem de Lista
            //$('#lstOficioExperienciAgregados').append($('<option>', {
            //    value: nuevoCodigo,
            //    text: descripPerfilLaboral + ': ' + descripPeriodoLaboral
            //}));


            var descriptotal = descripPerfilLaboral + ': ' + descripPeriodoLaboral;

            //Preparar los controles para la siguientes inserción.
            //$("#lstPerfilLaboral ").get(0).selectedIndex
            //$("#listPeriodoExperiencia ").get(0).selectedIndex

            addCustomItem(id, descriptotal, nuevoCodigo);

        }


        //function borrarItemOficio() {

        //    if (confirm("¿Está seguro que desea eliminar el item seleccionado?") == true) {

        //        $('#lstOficioExperienciAgregados :selected').each(function (i, selected) {
        //            if (arrayOficios[i] == codigoPerfilLaboral) {
        //                $("#lstOficioExperienciAgregados option:selected").remove();
        //                arrayOficios.splice(i);
        //            }
        //        });



        //    }
        //}




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
<?php echo form_open_multipart('trabaja_con_nosotros/formulario'); ?>
<!-- Form Name -->
<?php if($guardado==TRUE){ ?>

<div class="alert alert-success">
  <strong>Guardado: </strong> Nos contactataremos pronto con Ud.
</div>

<?php } ?>





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
                                        <a href="#messages" aria-controls="messages" role="tab" data-toggle="tab"> 
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
                                            <input type="text" name='TxtNombres'  id="TxtNombres" value="Edgar" Class="form-control" PlaceHolder="Nombres">
                                        </div>
                                        <?php echo form_error('TxtNombres', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>   
                                    </div>
                                    <!-- Text input-->
                                    <div class="form-group">
                                        <label for="Apellidos">Apellidos  Paterno: </label>
                                        <div class="input-group">
                                          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                          <input type="text" name='txtApePa'  id="txtApePa" value="Ligarda Estrada" Class="form-control" PlaceHolder="Apellidos">
                                        </div>
                                        <?php echo form_error('txtApePa', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>
                                   </div>
                                   <div class="form-group"> 
                                        <label for="Apellidos">Apellidos Materno: </label>
                                        <div class="input-group">
                                          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                          <input type="text" name='txtApeMa' id="txtApeMa" value="Ligarda Estrada" Class="form-control" PlaceHolder="Apellidos">
                                        </div>
                                        <?php echo form_error('txtApeMa', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>
                                   </div>
                                   <div class="form-group">
                                        <label for="Apellidos">Genero: </label>
                                        <div class="input-group">
                                          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                <select name='cboTipoGenero'  ID="cboTipoGenero" Class="form-control selectpicker">
                                                    <option value='0'>Seleccione</option>
                                                        <?php foreach ($sexos as $key => $value) { 

                                                                if(set_value('cboTipoGenero') == $value['COD_TIPO_MAESTRO']){
                                                                    echo "\t\t\t\t\t<option value='".$value['COD_TIPO_MAESTRO']."' selected>".$value['DES_TIPO_MAESTRO']."</option>\n";
                                                                }else{                            
                                                                    echo "\t\t\t\t\t<option value='".$value['DES_TIPO_MAESTRO']."'>".$value['DES_TIPO_MAESTRO']."</option>\n";
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
                                                <select name='CboTipoDocumento'  ID="CboTipoDocumento" Class="form-control selectpicker">
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
      
                                    <div class="form-group">

                                        <label for="FotoCarnet">Foto Carnet : </label>  

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                            <input type="file" id="FotoCarnet" name="FotoCarnet" Class="form-control" placeholder="Foto">
                                        </div>

                                 
                                        <?php echo form_error('FotoCarnet', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>
                                    </div>
                                        

                                    <button type="button"  onclick="openTab('profile');" class="btn btn-primary btn-lg">Siguiente Paso</button>

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
                                                               <input type="text" value="Calle Monterrey 341 - Chacarrilla - Santiago de Surco" name="txtDireccion" id="txtDireccion" Class="form-control" PlaceHolder="Dirección">
                                                        </div>
                                                        <?php echo form_error('txtDireccion', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>
                                                    </div>


                                                    <!-- Text input-->
                                                    <div class="form-group">

                                                        <label for="txtEmail">Correo Electrónico : </label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                                            <input type="text" name="txtEmail" id="txtEmail" Text="<?php echo set_value('txtEmail'); ?>"  Class="form-control" PlaceHolder="Correo Electrónico">
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

                                                                    if(empty($array_telefonos)==false && empty($array_tiempo_experiencia)==false)
                                                                    {                                                                        
                                                                        foreach ($array_telefonos as $mdaKey => $mdaData) 
                                                                        {
                                                                            if(empty($mdaData)== false)
                                                                            {
                                                                                echo "\t\t\t\t\t<option value='".$mdaKey."-".$mdaData."'>".$array_tiempo_experiencia[$mdaKey]."</option>\n";
                                                                            }
                                                                        }
                                                                    }
                                                                ?>    
                                                            </select>
                                                        
                                                            <?php 
                                                            
                                                            //Parte del testing
                                                            //echo "<pre>";
                                                            //print_r($array_telefonos);
                                                            //echo "</pre>";
                                                            echo form_error('lstTelefonoAgregados', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>
                                                  


                               
                                                    </div>
                                                    
                                                    
                                                    
                                             <div class="form-group">

                                                        <label for="txtTelefono">Celular Principal de Contacto : </label>
                                                        <div class="input-group">

                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                                            <select id="cboCompaniaPrincipal" name="cboCompaniaPrincipal" Class="form-control selectpicker">                                                                                                                              
                                                                <option value="0">Selecione el teléfono principal</option>
                                                                <?php 
                                                                    if(empty($array_telefonos)==false)
                                                                    {
                                                                        foreach ($array_telefonos as $mdaKey => $mdaData) 
                                                                        {
                                                                            if(empty($mdaData)== false){                                                                                
                                                                                echo "\t\t\t\t\t<option value='".$mdaKey."'>".$mdaData."</option>\n";
                                                                            }
                                                                            
                                                                            //echo $mdaKey . ": " . $mdaData["value"];
                                                                            
                                                                        }
                                                                    }
                                                                    
                                                                    
                                                                ?>                                                                                                                                             
                                                            </select>


                                                        </div>

                                             </div>
                                                    
                                                    
                                      <button type="button"  onclick="openTab('messages');" class="btn btn-primary btn-lg">Siguiente Paso</button>
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
                                                                        foreach ($array_oficios as $mdaKey => $mdaData) 
                                                                        {
                                                                            if(empty($mdaData)== false)
                                                                            {
                                                                                if(empty($array_tiempo_experiencia)==false){
                                                                                                                                                                        
                                                                                     echo "\t\t\t\t\t<option value='".$mdaKey."-".$mdaData."-".$array_tiempo_experiencia[$mdaKey]."'>";
                                                                                     echo $mdaData."-".$array_tiempo_experiencia[$mdaKey];
                                                                                     echo "</option>\n";   
                                                                                }
                                                                                
                                                                            }
                                                                        }
                                                                    }
                                                                ?>    
                                                        </select>
                                                        
                                                            <?php 

                                                            echo form_error('lstOficioExperienciAgregados', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>');
                                                            
                                                            ?>

                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                                            <select id="cboOficiosPreferencial" name="cboOficiosPreferencial" Class="form-control selectpicker">
                                                                <option value="0">Seleccione el oficio Ud. destaca</option>
                                                                <?php 
                                                                    if(empty($array_oficios)==false)
                                                                    {
                                                                        foreach ($array_oficios as $mdaKey => $mdaData) 
                                                                        {
                                                                            if(empty($mdaData)== false){                                                                                
                                                                                echo "\t\t\t\t\t<option value='".$mdaKey."'>".$mdaData."</option>\n";
                                                                            }
                                                                            
                                                                            //echo $mdaKey . ": " . $mdaData["value"];
                                                                        }
                                                                    }
                                                                    
                                                                    
                                                                ?>     
                                                            </select>


                                                    </div>



                                                    <button type="button"  onclick="openTab('settings');" class="btn btn-primary btn-lg">Siguiente Paso</button>






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
                                                    <input type="file" id="fileReciboResidencia" name="fileReciboResidencia" Class="form-control" placeholder="Foto">
                                                    

                                                </div>
                                                <?php echo form_error('fileReciboResidencia', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>
                                                


                                            </div>

                                            <!-- Text input-->
                                            <div class="form-group">

                                                <label for="fileAntecedentePenales">Antecendentes Penales Escaneado : </label>
                                                <div class="input-group">

                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                                    <input type="file"  ID="fileAntecedentePenales" runat="server" Class="form-control" placeholder="Foto">                                                                                                       

                                                </div>
                                                <?php echo form_error('fileAntecedentePenales', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>  

                                            </div>

                                            <!-- Text input-->                         
                                            <div class="form-group">

                                                 <label for="fileAntecendentesPoliciales">Antecedentes Policiales Escaneado : </label>
                                                 <div class="input-group">

                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                                    <input type="file" id="fileAntecendentesPoliciales"  name="fileAntecendentesPoliciales" Class="form-control" placeholder="Foto">
                                                    
                                                </div>
                                                <?php echo form_error('fileAntecendentesPoliciales', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>
                                                
                                                

                                            </div>

                                            <!-- Text input-->
                                            <div class="form-group">


                                                <label for="fileDocumentoIdentidad">Documento de Identidad Escaneado : </label>
                                                <div class="input-group">

                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                                    <input type="file" id="fileDocumentoIdentidad" name="fileDocumentoIdentidad" Class="form-control" placeholder="Foto">
                                                    
                                                </div>
                                                <?php echo form_error('fileDocumentoIdentidad', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>
                                                

                                            </div>

                                            <!--Fin: Tab panes05-->

                                        <button type="button"  onclick="openTab('enviar');" class="btn btn-primary btn-lg">Siguiente Paso</button>


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



             <div class="modal fade" id="myModal">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content modal-sm">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">
                                <b>Mensaje de Confirmación</b>
                            </h4>
                        </div>
                        <div class="modal-body modal-sm">
                            <asp:Label ID="lblMessage" runat="server" />
                        </div>
                        <div class="modal-footer modal-sm">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->  

            <button type="button" style="display: none;" id="btnShowPopup" class="btn btn-primary btn-lg"
                data-toggle="modal" data-target="#myModal">
                Launch demo modal
            </button>    
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
