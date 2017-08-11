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
<?php echo form_open_multipart('solicitar_trabajo/formulario'); ?>
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
    	<select name="cboOficios" ID="cboOficios" Class="form-control selectpicker">    	
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
  		<input  name="contacto" placeholder="Contacto" class="form-control" value="<?php echo set_value('contacto'); ?>"  type="text">
        </div>
        <?php echo form_error('contacto', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>      
  </div>
</div>

<div class="form-group" style="padding-top:10px   "> 
    <div class="col-md-11 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
        <input name="telefono" placeholder="Teléfono" class="form-control"  value="<?php echo set_value('telefono'); ?>" type="text">        
    </div>
    <?php echo form_error('telefono', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>      
  </div>
</div>

<div class="form-group" style="padding-top:10px   "> 

    <div class="col-md-11 inputGroupContainer">
    	<div class="input-group">
        	<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
        	<input name="email" placeholder="Correo Electrónico" class="form-control" value="<?php echo set_value('email'); ?>"  type="text">        
    	</div>
        <?php echo form_error('email', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>      
    </div>
</div>
      
<div class="form-group" style="padding-top:10px   "> 
    <div class="col-md-11 inputGroupContainer">
    	<div class="input-group">
        	<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
           	<input name="direccion" placeholder="Dirección" value="<?php echo set_value('direccion'); ?>" class="form-control" type="text">
    	</div>
        <?php echo form_error('direccion', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>  
  </div>
</div>

<div class="form-group" style="padding-top:10px   "> 
    <div class="col-md-11 selectContainer">
                <div class="input-group">
        	<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
    			<select name="cboDistrito" ID="cboDistrito" Class="form-control selectpicker">
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
                <textarea class="form-control" name="descripcionUrgencia" placeholder="Describenos de urgencia"><?php echo set_value('descripcionUrgencia'); ?></textarea>           
  	</div>
         <?php echo form_error('descripcionUrgencia', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>         
    </div>

</div>
     
<div class="form-group" style="padding-top:10px"> 
    <div class="col-md-11 inputGroupContainer">
    	<div class="input-group">
        	<span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                <input  name="foto" value="<?php echo set_value('foto'); ?>" placeholder="Fotos" class="form-control" type="file">
	    </div>
        <?php echo form_error('foto', '<div class="alert alert-danger"><strong>Advertencia:</strong> ', '</div>'); ?>  
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