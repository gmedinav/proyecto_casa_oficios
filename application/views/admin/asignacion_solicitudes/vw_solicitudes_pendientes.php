<div>
    <table class="table borderless" style="border: none;" align="center">
        <tr>
            <td>
                <label for="cbo_tipo_estado">Tipo Estado:</label>
            </td>
            <td></td>
            <td>
                <label for="cbo_tipo_averia">Tipo Avería:</label>
            </td>
            <td></td>
            <td>
                <label for="cbo_distrito">Distrito:</label>
            </td>          
            <td></td>
            <td></td>                
        </tr>
        <tr>
            <td>
                <select class="form-control" id="cbo_tipo_estado">
                    <option value="0">- Todos -</option>
                    <?php 
                        if(isset($tipo_estados)){
                            foreach ($tipo_estados as $key => $value) {
                                echo '<option value="'.$value['cod_estado'].'">'.$value['descripcion']."</option>";
                            }                             
                        }
                    ?>
                </select>

            </td>
            <td></td>
            <td>
                <select class="form-control" id="cbo_tipo_averia">
                    <option value="0">- Todos -</option>
                    <?php 
                        if(isset($tipo_averias)){
                            foreach ($tipo_averias as $key => $value) {
                                echo '<option value="'.$value['COD_TIPAVERIA'].'">'.$value['DES_TIPO_AVERIA']."</option>";
                            }                             
                        }
                    ?>
                </select>
            </td>
            <td></td>
            <td><select class="form-control" id="cbo_distrito">
                <option value="0">- Todos -</option>
                    <?php 
                        if(isset($distritos)){
                            foreach ($distritos as $key => $value) {
                                echo '<option value="'.$value['cod_ubigeo'].'">'.$value['des_ubigeo']."</option>";
                            }                             
                        }
                    ?>
            </select>
            </td>
            <td></td>
            <td>
                <button type="button" class="btn btn-primary btn-md" onclick="filtrar()">
                    <span class="glyphicon glyphicon-filter"></span>Filtrar Solicitudes de Trabajo
                </button>
            </td>            
        </tr>
           
    </table>
</div>
<p><br></p>

<table width"100%" style="display: block; overflow-x: scroll;" id="grid-data" class="table table-condensed table-hover table-striped" width="60%" cellspacing="0" data-toggle="bootgrid">
    <thead>
        <tr>

            <th data-column-id="COD_SOLICITUD" data-type="numeric" data-identifier="true">Código Solicitud</th> 
            <th align="center" data-column-id="COD_SOLICITUD" data-formatter="link_asignar">Buscar Trabajador</th>        
            <th data-column-id="DES_TIPO_AVERIA" data-formatter="link_detalle">Tipo Avería</th>
            <th data-column-id="ESTADO_ASIGNACION" >Estado Asignación</th>     
            <th data-column-id="NOMBRE_CLIENTE" >Nombre Cliente</th>            
            <th data-column-id="DISTRITO_CLI" >Distrito</th>            
            <!--th data-column-id="DIR_CLI" >Dirección</th-->   
            <!--th data-column-id="FONO_CLI" >Fono Cliente</th-->                           
            <!--th data-column-id="DESCRIP_CASO" >Descripción</th-->
            <th data-column-id="FEC_REGISTRO" >Fecha Registrado</th>                           
            <th data-column-id="DURACION" >Duración</th>                        
            <!--th data-column-id="link" data-formatter="link" data-sortable="false">Apellido Paterno</th-->
        </tr>

    </thead>

</table>
<script type="text/javascript">

url_web="<?php echo base_url()."admin/Asignacion_solicitudes/";?>";



$("#grid-data").bootgrid({
    ajax: true,
    requestHandler : function (request) {
        request.tipo_estado = $('#cbo_tipo_estado').val();
        request.distrito = $('#cbo_distrito').val();
        request.tipo_averia= $('#cbo_tipo_averia').val();
        return request;
    }, 
    post: function ()
    {
        /* To accumulate custom parameter with the request object */
        return {
            id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
        };
    },

    url: url_web+"json_listar_solicitudes_x_asignar/",    
    selection: false,

    multiSelect: false,
    labels: {
        noResults: 	"No se encontró algún resultado.",
        loading: 	"Cargando...",
        infos: 		"Mostrando {{ctx.start}} a {{ctx.end}} de {{ctx.total}} registros.",
        search: 	"Buscar"

    },
    formatters: {
        "link_detalle": function(column, row)
        {
            return "<a href=\"#\" onclick=\"detalle_averia('"+row.DES_TIPO_AVERIA+"','"+row.FONO_CLI+"','"+row.DISTRITO_CLI+"','"+row.FEC_REGISTRO+"','"+row.DURACION+"','"+row.NOMBRE_CLIENTE+"','"+row.DIR_CLI+"','"+ row.DESCRIP_CASO + "')\">" + row.DES_TIPO_AVERIA + "</a>";
        },   
        "link_asignar": function(column, row)
        {
            return "<a href=\"<?php echo base_url()."admin/Asignacion_solicitudes/tmrh_x_asignar/";?>"+row.COD_SOLICITUD+"\" >"+ "<img align='middle' src='<?php echo site_url('assets/grocery_crud/themes/flexigrid/css/images/worker.png'); ?>'"+"</a>";
        },                
    }
}).on("selected.rs.jquery.bootgrid", function(e, rows)
{
    var rowIds = [];
    for (var i = 0; i < rows.length; i++)
    {
        rowIds.push(rows[i].id);
    }
    alert("Select: " + rowIds.join(","));
}).on("deselected.rs.jquery.bootgrid", function(e, rows)
{
    var rowIds = [];
    for (var i = 0; i < rows.length; i++)
    {
        rowIds.push(rows[i].id);
    }
    alert("Deselect: " + rowIds.join(","));
});


function abrir_oficios(id,info){

    $("#btn_aceptar").hide();
    $('#myModal').modal('show');

    $.get(url_web+"ajax_vista_oficios/"+id, {}, 
        function(htmlexterno){

            $("#p_mensaje").html(htmlexterno);
            $("#titulo_popup").html("Oficios y Experiencia :<br><i>"+ info+"</i>");

            });
}

function filtrar(){

    $('#grid-data').bootgrid('reload');
}


function detalle_averia(tipo_averia, fono_cli, distrito, fec_registro, duracion, nombre, direccion, comentario){

    $("#btn_aceptar").hide();
    $('#myModal').modal('show');

    $("#txt_tipo_averia").val(tipo_averia);    
    $("#txt_telefono_cliente").val(fono_cli);
    $("#txt_distrito").val(distrito);
    $("#txt_fecha_ingreso").val(fec_registro);
    $("#txt_duracion").val(duracion);    
    $("#txt_nom_cliente").val(nombre);
    $("#txt_direccion").val(direccion);
    $("#txt_comentario").val(comentario);
    //alert("comentario:"+comentario);
    //document.getElementById("txt_comentario").innerHTNL =comentario;
}

</script>   

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" onclick="reseteo()" class="close" data-dismiss="modal">&times;</button>
          <strong style="color:blue"><h4 class="modal-title" id="titulo_popup">Detalle de la Avería</h4></strong>
        </div>
        <div class="modal-body">
          <p id="p_mensaje"> 
            <table class="table responsive" align="center">
                <tr align="left">
                    <td align="left"><label for="txt_tipo_averia">Tipo de Averia:</label></td>
                    <td>&nbsp;</td>
                    <td align="left"><label>Nombre Cliente:</label></td>
                    <td></td>
                    <td align="left"><label>Teléfono Cliente:</label></td>                 
                </tr>
                <tr align="left">
                    <td ><input readonly="readonly" size="35" type="text" id="txt_tipo_averia" class="form-control" value=""></td>
                    <td width="5%">&nbsp;</td>
                    <td><input readonly="readonly" size="35" type="text" id="txt_nom_cliente" class="form-control" value=""></td>  
                    <td width="5%"></td>                    
                    <td><input readonly="readonly" size="35" type="text" id="txt_telefono_cliente" class="form-control" value=""></td>               
                </tr> 
                <tr><td colspan="5"></td></tr>      
                <tr align="left">
                    <td colspan="3" align="left"><label>Dirección:</label></td>   
                    <td></td>
                    <td align="left"><label>Distrito:</label></td>              
                </tr>     
                <tr align="left">
                    <td colspan="3"><input readonly="readonly" size="35" type="text" id="txt_direccion" class="form-control" value=""></td>    
                    <td ></td>
                    <td><input readonly="readonly" size="35" type="text" id="txt_distrito" class="form-control" value=""></td>
                </tr>    
                <tr><td colspan="5"></td></tr>      
                <tr align="left"><td colspan="5"><label>Comentario:</label></td></tr>  
                <tr align="left"><td colspan="5"><textarea class="form-control" rows="3" id="txt_comentario" readonly="readonly" value=""></textarea></td></tr>         
                <tr><td colspan="5"></td></tr>
                <tr align="left">
                    <td align="left"><label>Fecha ingreso:</label></td>
                    <td></td>
                    <td></td>
                    <td></td>     
                    <td align="left"><label>Duracion:</label></td>          
                     
                </tr>   
                <tr align="left">
                    <td align="left"><input width="100%" type="text" id="txt_fecha_ingreso" size="36" disabled="disabled" class="form-control" value=""></td>
                    <td></td>
                    <td></td>
                    <td></td>  
                    <td align="left"><input  width="100%" type="text" id="txt_duracion" size="15" disabled="disabled" class="form-control" value=""></td>                                  
                </tr>                   
            </table>
          </p>
        </div>
        <div class="modal-footer">
          
          <button type="submit" onclick="reseteo()" class="btn btn-danger btn-default " data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>               &nbsp; &nbsp;           
          <button type="submit" class="btn btn-default btn-success pull-right" id="btn_aceptar"><span class="glyphicon glyphicon-ok"></span> Aceptar</button>           
          
        </div>
      </div>
      
    </div>
  </div>

