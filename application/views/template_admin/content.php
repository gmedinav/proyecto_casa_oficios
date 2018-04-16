  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php
        if (isset($titulo))
        {
          echo $titulo;
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
	   </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->