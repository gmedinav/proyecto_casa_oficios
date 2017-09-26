<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" />
<link rel="stylesheet" href="<?php echo base_url("assets/css/font-awesome.min.css"); ?>" />

<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?php echo base_url("assets/js/jquery-1.8.3.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>	

<script type="text/javascript">


       

function fileValidation(nom_input_file){

    var fileInput = document.getElementById(nom_input_file);
    var filePath = fileInput.value;
    var allowedExtensions = /(.jpg|.jpeg|.png|.gif)$/i;

    if(!allowedExtensions.exec(filePath)){
        alert('Por favor, el archivo debe tener alguna de las extensiones siguientes: .jpeg/.jpg/.png/.gif.');
        //document.getElementById(id_imagen).src = "";
        document.getElementById("div_"+nom_input_file).innerHTML="";
        fileInput.value = '';
        return false;
    }else{

        //alert("size:"+document.getElementById(nom_input_file).files[0].size);
        size_file= document.getElementById(nom_input_file).files[0].size;

        if(size_file>2097152){

            alert('Por favor, el archivo no debe superar de los 2Mb de espacio físico.');
            //document.getElementById(id_imagen).src = "";
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
        alert("El '" + campo + "'' está vació.");
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
        alert("El '" + campo + "' no es un valor textual.");
        return false;
    }

}


function msj_value_es_cero(valor,campo){
    //val= $.isNumeric(
    if(valor === 0 || valor =="0"){
        alert("Debe seleccionar un tipo en el campo '" + campo + "'.");
        return false;
    }else{

        return true;
    }
}

function msj_value_es_negativo(valor,campo){
    //val= $.isNumeric(
    if(valor === -1 || valor =="-1"){
        alert("Debe seleccionar un tipo en el campo '" + campo + "'.");
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
        alert("Debe escribir un número entero en el campo '" + campo + "'.");
        return false;        
    }

}


function msj_value_longitud_max(valor,max,campo){

    longitud = valor.length;
    if(longitud>max){
        alert("La longitud de caracteres para el campo '" + campo + "' debe ser como máximo de "+max+" caracteres.");
        return false;
    }else{
        return true;
    }

}


function msj_value_longitud_min(valor,min,campo){

    longitud = valor.length;
    if(longitud<min){
        alert("La longitud de caracteres para el campo '" + campo + "' debe ser como mínimo de "+min+" caracteres.");
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
        alert("La longitud de caracteres para el campo '" + campo + "' no es correcta, debería ser "+nro_exacto+" caracteres.");        
        return false;
    }

}


function msj_value_es_email(valor,campo) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(re.test(valor)==true){
        return true;
    }else{
        alert("Debe escribir un correo electrónico correcto en el campo '" + campo + "'.");
        return false;
    }

}

function msj_value_es_texto(valor,campo) {
    var re = /^[A-Z a-zñáéíóúü]+$/;
    if(re.test(valor)==true){
        return true;
    }else{
        alert("Debe escribir palabras de caracter textual en el campo '" + campo + "'.");
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
            alert("El valor del campo '" + campo + "' no es correcto.");
            return false;
          }
          else {
            // date is valid
          }
        }
        else {
          // not a date
            alert("El valor del campo '" + campo + "' no es correcto.");
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

    if (msj_value_es_cero(Oficio, 'Oficio')==false){return false;}  

    if (msj_value_vacio(Contacto, 'Contacto')==false){return false;}
    if (msj_value_es_texto(Contacto, 'Contacto')==false){return false;}

    if (msj_value_vacio(Telefono, 'Teléfono')==false){return false;}
    if (msj_value_es_entero(Telefono, 'Teléfono')==false){return false;}     

    if (msj_value_vacio(Email, 'Correo Electrónico')==false){return false;}
    if (msj_value_es_email(Email, 'Correo Electrónico')==false){return false;}     

    if (msj_value_vacio(Direccion, 'Dirección')==false){return false;}

   
    
    if (msj_value_longitud_min(DescripcionUrgencia,30, 'Descripición de Urgencia')==false){return false;}
    if (msj_value_longitud_max(DescripcionUrgencia,300, 'Descripición de Urgencia')==false){return false;}

    if (msj_value_vacio(Foto, 'Foto')==false){return false;}



    if(confirm("¿Está seguro que desea registrar su urgencia?")){

        return true;

    }else{

        return false;
    }



}



</script>
<title>Welcome to CodeIgniter</title>

	
</head>
<body>

<div id="container">




        <!--Inicio de Franja Formulario -->

    <section id="middle0">


        <div class="container">
            <div class="row">
             

                <div class="col-sm-6 wow fadeInDown">

                        <h2>Registre su Urgencia</h2>
                        <p>
                        ¡Nosotros te llamamos! Cuéntanos qué se te ha roto y te ofreceremos la mejor solución.
                        </p>
                        
                        

<!--inicio form-->
<?php //echo form_open('formulario/procesar'); ?>
<?php echo form_open_multipart('solicitar_trabajo/formulario', array('onsubmit' => 'return submit_form();')); ?>
<!-- Form Name -->
<?php if($guardado==TRUE){ ?>

<div class="alert alert-success">
  <strong>Guardado: </strong> Nos contactataremos pronto con Ud.
</div>

<?php } ?>



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

<div class="form-group"  style="padding-top:10px"> 
  <div class="col-md-11 inputGroupContainer">
  	<div class="input-group">
  		<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  		<input  name="contacto" id="contacto" placeholder="Contacto" class="form-control" value="<?php echo set_value('contacto'); ?>"  type="text">
        </div>
        <?php echo form_error('contacto', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>      
  </div>
</div>

<div class="form-group" style="padding-top:10px   "> 
    <div class="col-md-11 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
        <input name="telefono" id="telefono" placeholder="Teléfono" class="form-control"  value="<?php echo set_value('telefono'); ?>" type="text">        
    </div>
    <?php echo form_error('telefono', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>      
  </div>
</div>

<div class="form-group" style="padding-top:10px   "> 

    <div class="col-md-11 inputGroupContainer">
    	<div class="input-group">
        	<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
        	<input name="email" id="email" placeholder="Correo Electrónico" class="form-control" value="<?php echo set_value('email'); ?>"  type="text">        
    	</div>
        <?php echo form_error('email', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>      
    </div>
</div>
      
<div class="form-group" style="padding-top:10px   "> 
    <div class="col-md-11 inputGroupContainer">
    	<div class="input-group">
        	<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
           	<input name="direccion" id="direccion" placeholder="Dirección" value="<?php echo set_value('direccion'); ?>" class="form-control" type="text">
    	</div>
        <?php echo form_error('direccion', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>  
  </div>
</div>

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
  
<div class="form-group" style="padding-top:10px"> 
    <div class="col-md-11 inputGroupContainer">
    	<div class="input-group">
        	<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                <textarea class="form-control" id="descripcionUrgencia" name="descripcionUrgencia" placeholder="Describenos de urgencia"><?php echo set_value('descripcionUrgencia'); ?></textarea>           
  	</div>
         <?php echo form_error('descripcionUrgencia', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>         
    </div>

</div>
     
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

<div class="form-group" style="padding-top:10px"> 
  	<div class="col-md-11">
  		<div class="input-group">
    	<button type="submit" CssClass="btn btn-primary btn-block" id="btnEnviar"> Enviar</button > 
    	</div>
	</div>
</div>


                </div>

</div>
</form>
</body>
</html>