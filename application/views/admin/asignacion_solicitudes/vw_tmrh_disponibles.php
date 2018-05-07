<?php
    if(isset($detalle_solicitud)){

            foreach ($detalle_solicitud as $row) {}

    }else{

        $row['COD_SOLICITUD']   ="0";
        $row['DISTRITO_CLI']    ="";
        $row['COD_TIPO_AVERIA'] = "0";
        $row['DES_TIPO_AVERIA'] ="";
        $row['NOMBRE_CLIENTE']  ="";
    }

?>

<div>
    <table class="table borderless" style="border: none;" align="center">
        <tr>
            <td colspan="7">Información de Solictud:</td>
        </tr>
        <tr>
            <td><label for="#">Código Solicitud:</label></td>
            <td></td>
            <td><label for="#">Tipo Avería:</label></td>
            <td></td>
            <td><label for="#">Distrito:</label></td>          
            <td></td>
            <td><label for="#">Nombre Cliente:</label></td>                
        </tr>

        <tr>
            <td>
                <input readonly="readonly" value="<?php echo $row['COD_SOLICITUD']; ?>" class="form-control" type="text">
            </td>
            <td></td>
            <td>
                <input readonly="readonly" value="<?php echo $row['DES_TIPO_AVERIA']; ?>" class="form-control" type="text">
            </td>
            <td></td>
            <td>
                <input readonly="readonly" value="<?php echo $row['DISTRITO_CLI']; ?>" class="form-control" type="text">
            </td>          
            <td></td>
            <td><input readonly="readonly" value="<?php echo $row['NOMBRE_CLIENTE']; ?>" class="form-control" type="text"></td>                
        </tr>
        <tr>
            <td colspan="7"> </td>
        </tr>
        <tr>
            <td colspan="7">Filtro de Búsqueda:</td>
        </tr>

        <tr>
            <td>
                <label for="cbo_sexo">Sexo:</label>
            </td>
            <td></td>
            <td>
                <label for="cbo_rango_edad">Rango de Edad</label>
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
                <select class="form-control" id="cbo_sexo">
                    <option value="0">- Todos -</option>
                    <?php 
                        if(isset($sexo)){
                            foreach ($sexo as $key => $value) {
                                echo '<option value="'.$value['COD_TIPO_MAESTRO'].'">'.$value['DES_TIPO_MAESTRO']."</option>";
                            }                             
                        }
                    ?>
                </select>

            </td>
            <td></td>
            <td>
                <select class="form-control" id="cbo_rango_edad">
                    <option value="0">- Todos -</option>
                    <option value="1">Menor de 25 años</option>
                    <option value="2">Entre 26 y 35 años</option>
                    <option value="3">Entre 36 y 45 años</option>
                    <option value="4">Entre 46 y 55 años</option>
                    <option value="5">Mayor de 56 años</option>
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

            <th data-column-id="COD_TMRH" data-type="numeric" data-identifier="true">Código TMRH</th> 
            <th data-column-id="COD_TMRH" data-formatter="link_asignar">Asignar TMRH</th> 
            <th align="center" data-column-id="NOM_APE_TMRH">Nombre Apellido TMRH</th>        
            <th data-column-id="SEXO">Sexo</th>            
            <th data-column-id="DES_OFICIO">Oficio</th>     
            <th data-column-id="DESCRIP_TIEMPO_EXPERIENCIA">Experiencia Oficios</th>    
            <th data-column-id="OFICIO_PRIORIDAD">Prioridad Oficio</th>         
            <th data-column-id="DISTRITO" >Distrito de Residencia</th>            
            <th data-column-id="EDAD" >Edad</th>                           
            <th data-column-id="FEC_REGISTRO" >Fecha Registrado</th>                           
                      
            <!--th data-column-id="link" data-formatter="link" data-sortable="false">Apellido Paterno</th-->
        </tr>

    </thead>

</table>
<script type="text/javascript">

url_web="<?php echo base_url()."admin/Asignacion_solicitudes/";?>";



$("#grid-data").bootgrid({
    ajax: true,
    requestHandler : function (request) {
        request.sexo = $('#cbo_sexo').val();
        request.distrito = $('#cbo_distrito').val();
        request.rango_edad = $('#cbo_rango_edad').val();
        request.id_oficio = <?php echo $row['COD_TIPO_AVERIA']; ?>;


        return request;
    }, 
    post: function ()
    {
        /* To accumulate custom parameter with the request object */
        return {
            id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
        };
    },

    url: url_web+"json_listar_tmrh_disponible/",    
    selection: false,

    multiSelect: false,
    labels: {
        noResults: 	"No se encontró algún resultado.",
        loading: 	"Cargando...",
        infos: 		"Mostrando {{ctx.start}} a {{ctx.end}} de {{ctx.total}} registros.",
        search: 	"Buscar"

    },
    formatters: { 
        "link_asignar": function(column, row)
        {
            return "<a href=\"#\" onclick=\"confirmar_asignacion('"+row.COD_TMRH+"')\">"+ "<img align='middle' src='<?php echo site_url('assets/grocery_crud/themes/flexigrid/css/images/asignar.png'); ?>'"+"</a>";
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


function confirmar_asignacion(cod_tmrh){

   $("#btn_aceptar").hide();

   rpta= confirm("¿Está seguro que desea asignar?");

   if(rpta==true){

        $('#myModal').modal('show');
        cod_sol = <?php echo $row['COD_SOLICITUD']; ?>;

        url = url_web + "asignacion";

        $.get(url+"/"+cod_sol+"/"+cod_tmrh, {}, 
            function(htmlexterno){

                $("#p_mensaje").html(htmlexterno);
                
                });

   }

}

function redirect(){

    window.location.href = "<?php echo site_url('admin/Asignacion_solicitudes/solicitudes_x_asignar')?>";
}

</script>   

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" onclick="redirect()" class="close" data-dismiss="modal">&times;</button>
          <strong style="color:blue"><h4 class="modal-title" id="titulo_popup">Confirmar Asignación de TMRH</h4></strong>
        </div>
        <div class="modal-body">
          <p id="p_mensaje"> 

          </p>
        </div>
        <div class="modal-footer">
          
          <button type="submit" onclick="redirect()" class="btn btn-danger btn-default " data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>               &nbsp; &nbsp;           
          <button type="submit" onclick="redirect()" class="btn btn-default btn-success pull-right" id="btn_aceptar"><span class="glyphicon glyphicon-ok"></span> Aceptar</button>           
          
        </div>
      </div>
      
    </div>
  </div>

