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
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>




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
      <li><a tabindex="-1" href='<?php echo site_url('Administrar/clientes')?>'>Clientes</a></li>
      <li><a tabindex="-1" href="#">Solicitud Trabajo</a></li>          
      <li class="divider"></li>  
      <li><a tabindex="-1" href="#">Tipo Avería</a></li>  
    </ul>
  </div>
  <td>

  <td>                         
  <div class="dropdown">
    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Trabajadores &nbsp;<span class="caret"></span></button>
    <ul class="dropdown-menu">

      <li class="dropdown-header">Mantenimiento/li>      
      <li class="dropdown-submenu">
        <a class="test" tabindex="-1" href="#">Oficio <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li class="dropdown-header">Mantenimiento</li>      
          <li><a tabindex="-1" href='<?php echo site_url('Administrar/tiempo_experiencia')?>'>Tiempo Experiencia</a></li>
          <li><a tabindex="-1" href='<?php echo site_url('Administrar/oficio_especialidades')?>'>Especialidades</a></li>    
        </ul>
      </li>      

      <li><a tabindex="-1" href='<?php echo site_url('Administrar/paquete_grupal_administrar')?>'>Paquete Grupal</a></li>      


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
  
      <li class="dropdown-submenu">
        <a class="test" tabindex="-1" href="#">Comercial &nbsp;<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li class="dropdown-header">Mantenimiento</li>    
          <li><a tabindex="-1" href='<?php echo site_url('Administrar/modalidad_pago_administrar')?>'>Modalidad de Pagos</a></li>      
          <li><a tabindex="-1" href='<?php echo site_url('Administrar/canal_administrar')?>'>Canal</a></li>
          <li><a tabindex="-1" href='<?php echo site_url('Administrar/ciudades_dirigidas_administrar')?>'>Ciudades Dirigidas</a></li>
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
        </ul>
      </li>  

      <li class="dropdown-submenu">
        <a class="test" tabindex="-1" href="#">Info Prestablecido &nbsp;<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li class="dropdown-header">Mantenimiento</li>    
      <li><a tabindex="-1" href='<?php echo site_url('Administrar/sexo')?>'>Sexo</a></li>      
      <li><a tabindex="-1" href='<?php echo site_url('Administrar/tipo_operadora')?>'>Tipo Operadora</a></li>    
        </ul>
      </li> 

  



    </ul>
  </div>


  </td>   


  </table>

      <hr>
    <a tabindex="-1" href='<?php echo site_url('Administrar/columna_ficha_administrar')?>'>Columna Ficha</a>
  <div>






<!--hr-->

   </div>
   <div style='height:20px;'></div>  
    <div>
    <?php echo $output; ?>
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


 



</body>
</html>
