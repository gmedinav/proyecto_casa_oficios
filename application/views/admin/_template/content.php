  <!-- Content Wrapper. Contains page content -->

<!---Grocery CRUD-->
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

<!---Grocery CRUD-->


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php
        if (isset($titulo))
        {
          echo $titulo;
        }

        if (isset($data['titulo']))
        {
          echo $data['titulo'];
        }
        ?>
        <small><!-- Optional description --></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Nivel</a></li>
        <li class="active">Administrador</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <!--
        | Your Page Content Here |
        -->
	   <div style='height:20px;'></div>  
	    <!--div-->
	    <div>
	      <?php 

	      if(isset($vista_incluida)){
	      		$this->load->view($vista_incluida);
	      }
	      ?>

      <?php 

      if(isset($output)){

        echo $output; 

      }

      ?>        
	   </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->