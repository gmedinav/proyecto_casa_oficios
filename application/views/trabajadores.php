<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Services | Bootstrap .net Templates</title>

    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="css/animate.min.css" rel="stylesheet" type="text/css" />
    <link href="css/prettyPhoto.css" rel="stylesheet" type="text/css" />
    <link href="css/main.css" rel="stylesheet" type="text/css" />
    <link href="css/responsive.css" rel="stylesheet" type="text/css" />
     <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"
        rel="stylesheet" type="text/css" />
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->




    <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <link rel="shortcut icon" href="images/favicon.ico" />


    <script language="javascript">
      



       






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
        

        

        



        /*---------------------------------------------------------------------------*/



       




       







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
      </div>
        </div>
      <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><img src="images/logo.png" alt="logo"></a>
                </div>
				
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li><a href="Inicio.html">Inicio</a></li>
                       <li class="active"><a href="trabajadores.html">Trabaje con nosotros</a></li>
                        <li ><a href="#">Servicios</a></li>                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pages <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Blog Single</a></li>
                                <li><a href="#">Pricing</a></li>
                                <li><a href="#">404</a></li>
                                <li><a href="#">Shortcodes</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Blog</a></li> 
                        <li><a href="#">Contact</a></li>                        
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
 
    </header>


<body>
    








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
                                        <li role="presentation" class="active">
                                        <a href="#home" aria-controls="home" role="tab" data-toggle="tab"> 
                                        <i class="glyphicon glyphicon-user"></i> 
                                         Identidad
                                        </a>
                                        </li>
                                        <li role="presentation">
                                        <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"> 
                                        <i class="glyphicon glyphicon-map-marker"></i>                                         
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

                                            <input type="text" id="TxtNombres" Text="Edgar" Class="form-control" PlaceHolder="Nombres"/>
                                         </div>


                                    </div>


                                    <!-- Text input-->

                                    <div class="form-group">


                                        <label for="Apellidos">Apellidos  Paterno: </label>
                                        <div class="input-group">
                                          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        
                                            <input type="text" id="txtApePa" Text="Ligarda" Class="form-control" PlaceHolder="Apellidos" />

                                           
                                        </div>

                                                  <label for="Apellidos">Apellidos Materno: </label>
                                        <div class="input-group">
                                          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                         
                                            <input type="text" id="txtApeMa" Text="Estrada" Class="form-control" PlaceHolder="Apellidos" />

                                         </div>


                                                                 <label for="Apellidos">Genero: </label>
                                        <div class="input-group">
                                          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>

                                            <select id="cboTipoGenero" name="state" class="form-control selectpicker">
                                                <option>Masculino</option>
                                                <option>Felemino</option>
                                       
                                            </select></div>


                                    </div>


                                    <!-- Select Basic -->
   
                                    <div class="form-group"> 

                                            <label for="TipoDocumento">Tipo Documento : </label>
                                            <div class="input-group">

                                                <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                                
                                                <select id="CboTipoDocumento" name="state" class="form-control selectpicker">
                                                    <option>DNI</option>
                                                    <option>RUC</option>
                                      
                                                </select></div>


                                    </div>

                                    <!-- Text input-->

                                    <div class="form-group ">

                                        <label for="NroDocumento">Nro. Documento : </label>  
                                        <div class="input-group col-md-5">

                                                <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>


                                            <input type="text" id="txtNroDocumento" Text="44953781" Class="form-control" PlaceHolder="Nro. Documento" />

                                     
                                        </div>

                                    </div>







                                    <!-- Text input-->   





                                    <div class="form-group">
                                                    <label for="dtp_input2" >Fecha Nacimiento :</label>
                                                    <div class="input-group">
                                                    <div class="input-group date form_date col-md-12" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    
                                                        <input type="text" id="txtFecNaci" value="2017-05-20" size="16" Class="form-control"/>

                                                      <!--<input class="form-control" size="16" type="text" value="ss" readonly>-->
                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                    </div>
          
				                                     <input type="hidden" id="dtp_input2" value="" />
                                                    </div>
                                    </div>





                                    <!-- Text input-->
      
                                    <div class="form-group">

                                        <label for="FotoCarnet">Foto Carnet : </label>  

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>

                                            <input id="FotoCarnet" placeholder="Foto" Class="form-control" type="file" />

                                       </div>

                                 

                                    </div>
                                        

                                    <button type="button"  onclick="openTab('profile');" class="btn btn-primary btn-lg">Siguiente Paso</button>

                                    <!--fin: Tab panes01 -->                                      
                                        
                          </div>
                           






           
                          <div role="tabpanel" class="tab-pane" id="profile">
                                        <!--Inicio: Tab panes02-->



                                                    <!-- Select Basic -->
   
                                                    <div class="form-group"> 
                                                            <label for="Distrito">Distrito Dirección : </label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon" ><i class="glyphicon glyphicon-list"></i></span>

                                                                <select id="cboDistrito" class="form-control selectpicker">

                                                                    <option>Prueba1</option>
                                                                    <option>Prueba2</option>

                                                        

                                                                </select></div>  
                                                    </div>

                                                    <!-- Text input-->      
                                                    <div class="form-group">

                                                        <label  for="Direccion">Dirección : </label>
                                                        <div class="input-group">
                                                               <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                                            <input id="txtDireccion" placeholder="Contacto" class ="form-control" type="text" value="Calle Monterrey 341 - Chacarrilla - Santiago de Surco" />
                                                               
                                                        </div>

                                                    </div>


                                                    <!-- Text input-->
                                                    <div class="form-group">

                                                        <label for="Email">Correo Electrónico : </label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                                            
                                                            <input id="txtEmail" placeholder="Contacto" class="form-control" type="text" value="atencion@directv.com.pe" />

                                                            
                                                        </div>

                                                    </div>

                                             <div class="form-group">

                                                              <label for="txtTelefono">Celular Principal de Contacto : </label>
                                                        <div class="input-group">

                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                                            <select id="cboCompaniaPrincipal" class="form-control selectpicker">
                                                                <option>- Seleccione Compañía Telefónica -</option>
                                                                </select> 

                                                   

                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>

                                                            <input id="txtTelfPrinci" placeholder="Contacto" class="form-control" type="text" value="987379413"  />
                                                           




                                                        </div>

                                                    </div>


                                                    <!-- Text input-->

                                                    <div class="form-group">

                                                        <label for="txtTelefono">Otros Numeros Teléfonicos de Contacto : </label>
                                                        <div class="input-group">

                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                                            <select id="cboProveedorTelf" class="form-control selectpicker">
                                                                <option>- Seleccione Compañía Telefónica -</option>
                                                            </select> 



                                                      

                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>

                                                            <input id="txtTelefono" placeholder="Contacto" class="form-control" type="text"  placeHolder="Teléfono"/>


                                                       




                                                        </div>
                                                       
                                                        <input type="button" class="col-md-6" id="btnEliminar" value="Eliminar" />                                                   
                                                        <input type="button" class="col-md-6" id="btnAgregar" value="Agregar" />

                                

                                                        <select ID="lstTelefonoAgregados" multiple="multiple" class="form-control selectpicker">
                                                            <option>text1</option>
                                                            <option>text2</option>
                                                            <option>text3</option>
                                                            <option>text4</option>
                                                            <option>text5</option>
                                                        </select>


                                                      


                               
                                                    </div>

                                      <button type="button"  onclick="openTab('messages');" class="btn btn-primary btn-lg">Siguiente Paso</button>
                                <!--Fin : Tab panes02-->
                                </div>
       
                
                                   <div role="tabpanel" class="tab-pane" id="messages">

                                                    <!--inicio: Tab panes03 -->



                                                    <!-- Text input-->

                                                    <div class="form-group">

                                                           <label>Selecciona el Oficio en que se especializa y su Experiencia: </label>
                                                        <div class="input-group" style="padding-bottom:50px">

                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>


                                                            <select name="cboOficiDomin" class="form-control selectpicker">
                                                                <option>Oficios</option>

                                                    
                                                                </select>
                                                               

                                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>

                                                                <select name="cboPerioDomin" class="form-control selectpicker">
                                                                    <option>Periodos</option>
                                                                  


                                                                </select></div>



                                                        <label>Agregue Otros Oficios que domina: </label>
                                                        <div class="input-group">

                                                              

                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                                             <select name="cboOficiosOtros" class="form-control selectpicker">
                                                                 <option>Oficios Otros</option>
                                                  

                                                                   </select>

                                                                     

                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>

                                                                    <select name="cboPeriodoExpeOtros" class="form-control selectpicker">
                                                                        <option>Peridio Experi</option>
                                                      
                                                                   </select>

                                                        </div>
                                                        <input type="button" class="col-md-6" id="btnEliminarOficio" value="Eliminar">
                                                        <input type="button" class="col-md-6" id="btnAgregarOficio" value="Agregar">  
  

                                                      


                                                        <select ID="lstOficioExperienciAgregados" multiple="multiple" class="form-control selectpicker">
                                                            <option>text1</option>
                                                            <option>text2</option>
                                                            <option>text3</option>
                                                            <option>text4</option>
                                                            <option>text5</option>
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

                                            <button type="button" class="btn btn-primary center-block">Guardar Formulario</button>
                                         
                              </div>

                              <div role="tabpanel" class="tab-pane" id="settings">


                                            <!--Inicio: Tab panes05-->


                                            <!-- Text input-->                         
                                            <div class="form-group">

                                                <label for="fileReciboResidencia">Recibo Luz o Agua : </label>
                                                <div class="input-group">

                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                                    <input  id="fileReciboResidencia" placeholder="Foto" class="form-control" type="file"/>


                                                   
                                                </div>

                                            </div>

                                            <!-- Text input-->
                                            <div class="form-group">

                                                <label for="fileAntecedentePenales">Antecendentes Penales Escaneado : </label>
                                                <div class="input-group">


                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                                    <input id="fileAntecedentePenales" placeholder="Foto" class="form-control" type="file" />

                                                
                                                </div>

                                            </div>

                                            <!-- Text input-->                         
                                            <div class="form-group">

                                                 <label for="fileAntecendentesPoliciales">Antecedentes Policiales Escaneado : </label>
                                                <div class="input-group">


                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                                    <input id="fileAntecendentesPoliciales" placeholder="Foto" class="form-control" type="file" />

                                              
                                                </div>

                                            </div>

                                            <!-- Text input-->
                                            <div class="form-group">


                                                <label for="fileDocumentoIdentidad">Documento de Identidad Escaneado : </label>
                                                <div class="input-group">

                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                                    <input id="fileDocumentoIdentidad" placeholder="Foto" class="form-control" type="file" />

                                                  
                                                </div>

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
                    &copy; 2015 <a target="_blank" href="#" title="Free Twitter Bootstrap asp.net templates">aspxtemplates</a>. All Rights Reserved.
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
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/Funciones_Val_TMRH.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/jquery.prettyPhoto.js" type="text/javascript"></script>
    <script src="js/jquery.isotope.min.js" type="text/javascript"></script>
    <script src="js/main.js" type="text/javascript"></script>
    <script src="js/wow.min.js" type="text/javascript"></script>


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
                            <label>lblMessage</label>
                          
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







<script type="text/javascript" src="js/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="js/locales/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>

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
