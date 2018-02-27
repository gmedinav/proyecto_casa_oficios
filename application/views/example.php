<!DOCTYPE html>
<html>
<head>

<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


   <?php

      if(isset($data['id_asignacion'])){
   ?>

    <script type="text/javascript">

    function confirmar_asignacion(codigo){


      rpta=confirm('¿Está seguro de asignar al trabajador?');

      if(rpta==true){

        window.location.href = "<?php 
            echo site_url('asignacion_trabajo/').$data['id_asignacion'].'/';
        ?>"+codigo;

      }



    }
    </script>

    <?php
    }
    ?>

  <style>
  .dropdown-submenu {
      position: relative;
  }

  .dropdown-submenu .dropdown-menu {
      top: 0;
      left: 100%;
      margin-top: -1px;
  }
  </style>



	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


<?php
if(isset($css_files)){
?>

<?php 
foreach($css_files as $file): ?>
  <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>

<?php

}

?>    



<?php
if(isset($js_files)){
?>


<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>


<?php

}

?>    


</head>
<body>


<div class="container">
  <h2>Sistema Casa Oficios</h2>
  <p>Módulo encargado de actualizar y visualizar el contenido existente del manejo del personal y tickets de atención</p>

  
  <hr>
  <table>
  <tr> 

  <td>                           
  <div class="dropdown">
    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Trabajo &nbsp;
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li class="dropdown-header">Mantenimiento</li>
      <li><a tabindex="-1" href='<?php echo site_url('Administrar/solicitud_trabajo')?>'>Solicitud Trabajo</a></li> 
      <li><a tabindex="-1" href='<?php echo site_url('Administrar/monitor_solicitudes')?>'>Monitoreo de Solicitudes</a></li>
      <li><a tabindex="-1" href='<?php echo site_url('Administrar/asignacion_estado')?>'>Cambiar Estado</a></li> 
      <li class="divider"></li>  
      <li><a tabindex="-1" href="<?php echo site_url('Administrar/tipo_averia')?>">Tipo Avería</a></li>  
    </ul>
  </div>
  <td>

  <td>                           
  <div class="dropdown">
    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Clientes &nbsp;
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li class="dropdown-header">Mantenimiento</li>
      <li><a tabindex="-1" href='<?php echo site_url('Administrar/clientes')?>'>Cliente</a></li>
    </ul>
  </div>
  <td>


  <td>                         
  <div class="dropdown">
    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">TMRH &nbsp;<span class="caret"></span></button>
    <ul class="dropdown-menu">

      <li class="dropdown-header">Mantenimiento</li>      
      <li class="dropdown-submenu">
        <a class="test" tabindex="-1" href="#">Oficio <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li class="dropdown-header">Mantenimiento</li>      
          <li><a tabindex="-1" href='<?php echo site_url('Administrar/tiempo_experiencia')?>'>Tiempo Experiencia</a></li>
          <li><a tabindex="-1" href='<?php echo site_url('Administrar/oficio_especialidades')?>'>Especialidades</a></li>    
        </ul>
      </li>      

      <li><a tabindex="-1" href='<?php echo site_url('Administrar/trabajador')?>'>Trabajadores</a></li>      


      <li class="divider"></li>  
      <li class="dropdown-header">Alcances &nbsp;</li>    
      <li class="dropdown-submenu">
        <a class="test" tabindex="-1" href="#">Técnico &nbsp;<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li class="dropdown-header">Mantenimiento</li>    
          <li><a tabindex="-1" href='<?php echo site_url('Administrar/cobertura_administrar')?>'>Cobertura</a></li>
          <li><a tabindex="-1" href='<?php echo site_url('Administrar/tecnologia_administrar')?>'>Tecnología</a></li>
        </ul>
      </li>      
  

    </ul>
  </div>

  </td>   



  <td>                         
  <div class="dropdown">
    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Sistema &nbsp;
    <span class="caret"></span></button>
    <ul class="dropdown-menu">   
      <li class="dropdown-header">Mantenimiento</li>     

      <li class="dropdown-submenu">
        <a class="test" tabindex="-1" href="#">Funcional Sistema &nbsp;<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li class="dropdown-header">Mantenimiento</li>    
          <li><a tabindex="-1" href='<?php echo site_url('Administrar/tipo_usuario')?>'>Tipo Usuario</a></li>
          <li><a tabindex="-1" href='<?php echo site_url('Administrar/tipo_registro')?>'>Tipo Registro</a></li>
          <li><a tabindex="-1" href='<?php echo site_url('Administrar/tipo_prioridad')?>'>Tipo Prioridad</a></li>         
          <li><a tabindex="-1" href='<?php echo site_url('Administrar/tipo_canal_contacto')?>'>Tipo Canal Contacto</a></li>   
        </ul>
      </li>  

      <li class="dropdown-submenu">
        <a class="test" tabindex="-1" href="#">Info Prestablecido &nbsp;<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li class="dropdown-header">Mantenimiento</li>    
            <li><a tabindex="-1" href='<?php echo site_url('Administrar/sexo')?>'>Sexo</a></li>      
            <li><a tabindex="-1" href='<?php echo site_url('Administrar/tipo_operadora')?>'>Tipo Operadora</a></li>    
            <li><a tabindex="-1" href='<?php echo site_url('Administrar/tipo_documento')?>'>Tipo Documento</a></li>    
        </ul>
      </li> 

  
      <li class="divider"></li>  
      <li><a tabindex="-1" href="<?php echo site_url('Login/cerrar_session')?>">Cerrar Sesión</a></li>  


    </ul>
  </div>


  </td>   


  </table>


  <div>






<!--hr-->

   </div>
   <div style='height:20px;'></div>  

   <?php

      if(isset($data['id_asignacion'])){
   ?>

   <table width="750px">
      <tr>
        <td width="20%"><strong>Código de Solicitud:</strong></td>        
        <td align="center"><?php echo $data['COD_SOLICITUD']; ?></td>
        <td width="20%"> </td>     
        <td><strong>Distrito:</strong></td>     
        <td><?php echo $data['DES_UBIGEO']; ?></td>   
      </tr>

      <tr>
        <td><strong>Tipo Avería:</strong></td>        
        <td><?php echo $data['DES_TIPO_AVERIA']; ?></td>
        <td> </td>     
        <td><strong>Dirección:</strong></td>     
        <td><?php echo $data['DIRECCION']; ?></td>           
      </tr>

      <tr>
        <td><strong>Descripción:</strong></td>        
        <td colspan="3"><?php echo $data['DESCRIPCION']; ?></td>
      </tr>
                      
   </table>
 </p>


   <?php
      }

   ?>

    <div>
    <?php 

    if(isset($output)){

      echo $output; 

    }


    ?>
    </div>



</div>


<script>
$(document).ready(function(){
  $('.dropdown-submenu a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
</script>


  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Confirmar</h4>
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


</body>
</html>
