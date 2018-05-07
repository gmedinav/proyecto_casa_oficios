  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url()."assets/admin_panel/";?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>
                <?php 
                  if(isset($_SESSION['sesion_usuario'])){
                    echo $_SESSION['sesion_usuario'];
                  }

                ?>

          </p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Buscar...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">NEGOCIO</li>
        <!-- Optionally, you can add icons to the links -->
        <!--li><a href="<?php echo site_url('Administrar/solicitud_trabajo')?>"-->
        <li><a href="<?php echo site_url('admin/Asignacion_solicitudes/solicitudes_x_asignar')?>">
          <i class="fa fa-link"></i> <span>Solicitudes de Trabajo</span></a>
        </li>



        <li class="treeview">
          <a href="#"><i class="fa fa-crosshairs"></i> <span>Monitoreo de Solicitudes</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
      
            <li><a href="<?php echo site_url('admin/solicitudes_trabajo/pendientes')?>">Pendientes</a></li>
            <li><a href="<?php echo site_url('admin/solicitudes_trabajo/canceladas')?>">Cancelados</a></li>
            <li><a href="<?php echo site_url('admin/solicitudes_trabajo/asignadas')?>">Asignados</a></li>

          </ul>
        </li>



        <li><a href="<?php echo site_url('admin/tmrh')?>">
          <i class="glyphicon glyphicon-wrench"></i> <span>Trabajadores</span></a>
        </li>

        <li><a href="<?php echo site_url('admin/cliente')?>">
          <i class="fa fa-users"></i> <span>Clientes</span></a>
        </li>
    
        <li class="header">SISTEMA</li>

        <li class="treeview">
          <a href="#"><i class="fa fa-id-card-o"></i> <span>Gestión Laboral</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
      
            <li><a href="<?php echo site_url('admin/Entidades_negocio/tiempo_experiencia')?>">Tiempo Experiencia</a></li>
            <li><a href="<?php echo site_url('admin/Entidades_negocio/oficio_especialidades')?>">Oficios/Especialidades</a></li>

          </ul>
        </li>



        <li class="treeview">
          <a href="#"><i class="glyphicon glyphicon-briefcase"></i> <span>Gestión Sistema </span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href='<?php echo site_url('admin/Entidades_negocio/tipo_usuario')?>'>Tipo Usuario</a></li>
            <li><a href='<?php echo site_url('admin/Entidades_negocio/tipo_registro')?>'>Tipo Registro</a></li>
            <li><a href='<?php echo site_url('admin/Entidades_negocio/tipo_prioridad')?>'>Tipo Prioridad</a></li>     
            <li><a href='<?php echo site_url('admin/Entidades_negocio/tipo_canal_contacto')?>'>Tipo Canal Contacto</a></li>        
          </ul>
        </li>


        <li class="treeview">
          <a href="#"><i class="fa fa-database"></i> <span>Info Preestablecida </span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href='<?php echo site_url('admin/Entidades_negocio/sexo')?>'>Tipo de Sexo</a></li>  
            <li><a href='<?php echo site_url('admin/Entidades_negocio/tipo_operadora')?>'>Tipo Operadora</a></li>
            <li><a href='<?php echo site_url('admin/Entidades_negocio/tipo_documento')?>'>Tipo Documento</a></li>         
          </ul>
        </li>


        <li class="active"><a href="<?php echo site_url('admin/Login/cerrar_session')?>">
          <i class="fa fa-sign-out"></i> <span>Cerrar Sesión</span></a>
        </li>   

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>