
<table style="display: block; overflow-x: scroll;" id="grid-data" class="table table-condensed table-hover table-striped" width="60%" cellspacing="0" data-toggle="bootgrid">
    <thead>
        <tr>

            <th data-column-id="COD_SOLICITUD" data-type="numeric" data-identifier="true">Código Cliente</th>         
            <th data-column-id="DES_TIPO_AVERIA" >Tipo Avería</th>
            <th data-column-id="ESTADO_ASIGNACION" >Estado Asignación</th>     
            <th data-column-id="NOMBRE_CLIENTE" >Nombre Cliente</th>            
            <th data-column-id="DISTRITO_CLI" >Distrito</th>            
            <th data-column-id="DIR_CLI" >Dirección</th>   
            <th data-column-id="FONO_CLI" >Fono Cliente</th>                           
            <th data-column-id="DESCRIP_CASO" >Celular 1</th>
            <th data-column-id="FEC_REGISTRO" >Fecha Registrado</th>                           
            <th data-column-id="DURACION" >Duración</th>                        
            <!--th data-column-id="link" data-formatter="link" data-sortable="false">Apellido Paterno</th-->
        </tr>

    </thead>

</table>
<script type="text/javascript">

url_web="<?php echo base_url()."admin/solicitudes_trabajo/";?>";

$("#grid-data").bootgrid({
    ajax: true,
    post: function ()
    {
        /* To accumulate custom parameter with the request object */
        return {
            id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
        };
    },

    url: url_web+"json_listar_solicitudes/1",    
    selection: false,
    multiSelect: false,
    labels: {
        noResults: 	"No encontró algun resultado",
        loading: 	"Cargando...",
        infos: 		"Mostrando {{ctx.start}} a {{ctx.end}} de {{ctx.total}} registros.",
        search: 	"Buscar"

    },
    formatters: {
        "link": function(column, row)
        {
            return "<a href=\"#\">" + column.id + ": " + row.id + "</a>";
        }      
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





</script>   

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" onclick="reseteo()" class="close" data-dismiss="modal">&times;</button>
          <strong style="color:blue"><h4 class="modal-title" id="titulo_popup">Cargando...</h4></strong>
        </div>
        <div class="modal-body">
          <p id="p_mensaje"> Cargando... </p>
        </div>
        <div class="modal-footer">
          
          <button type="submit" onclick="reseteo()" class="btn btn-danger btn-default " data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>               &nbsp; &nbsp;           
          <button type="submit" class="btn btn-default btn-success pull-right" id="btn_aceptar"><span class="glyphicon glyphicon-ok"></span> Aceptar</button>           
          
        </div>
      </div>
      
    </div>
  </div>

