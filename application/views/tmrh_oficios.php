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

    <?php echo form_open_multipart('tmrh_oficios'); ?>


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
                              } 
                            ?>    
                        </select>

                    </div>



                    <div class="input-group">
                        <input type="submit" class="col-md-6 " name="enviar_oficio" id="btnEliminarOficio" value="Eliminar" >
                        <input type="submit" class="col-md-6" name="enviar_oficio" id="btnAgregarOficio" value="Agregar">  
                    </div>

                    <select id="lstOficioExperienciAgregados"  Multiple  name="lstOficioExperienciAgregados" Class="form-control selectpicker" >
                    </select>

                        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                        <select id="cboOficiosOtros" name="cboOficiosOtros" Class="form-control selectpicker">
                            <option value="0">Seleccione el oficio Ud. destaca</option>
                            <?php 
                            
                                foreach ($oficio_item as $value) { 
                                    if(set_value('cboOficiosOtros')== $value)
                                    {
                                        echo "\t\t\t\t\t<option value='".$value."' selected>".$value."</option>\n";
                                    }

                              } 
                            ?>     
                        </select>


                </div>

    
                <input type="submit"   class="btn btn-primary btn-lg" value="enviar">
   

                <button type="button"  onclick="openTab('settings');" class="btn btn-primary btn-lg">Siguiente Paso</button>


</form>
    
    
    
</body>
    
</html>