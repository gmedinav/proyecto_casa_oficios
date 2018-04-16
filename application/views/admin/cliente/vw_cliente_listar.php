
<table style="display: block; overflow-x: scroll;" id="grid-data" class="table table-condensed table-hover table-striped" width="60%" cellspacing="0" data-toggle="bootgrid">
    <thead>
        <tr>

            <th data-column-id="COD_CLIENTE" data-type="numeric" data-identifier="true">Código Cliente</th>         
            <th data-column-id="NOM_CLIENTE" >Nombres</th>
            <th data-column-id="APE_PATERNO" >Apellido Paterno</th>
            <th data-column-id="APE_MATERNO" >Apellido Materno</th>
            <th data-column-id="TIPO_DOCUMENTO" >Tipo Documento</th>     
            <th data-column-id="NUM_DOCUMENTO" >Número de Documento</th>            
            <th data-column-id="GENERO" >Sexo</th>            
            <th data-column-id="DISTRITO" >Distrito</th>   
            <th data-column-id="DIRECCION" >Dirección</th>                           
            <th data-column-id="CEL_1" >Celular 1</th>
            <th data-column-id="CEL_2" >Celular 2</th>                           
            <th data-column-id="ESTADO" >Estado</th>     
            <th data-column-id="FEC_REGISTRO" >Fecha Registro</th>                       
            <!--th data-column-id="link" data-formatter="link" data-sortable="false">Apellido Paterno</th-->
        </tr>

    </thead>

</table>
<script type="text/javascript">

url_web="<?php echo base_url()."admin/cliente/";?>";

$("#grid-data").bootgrid({
    ajax: true,
    post: function ()
    {
        /* To accumulate custom parameter with the request object */
        return {
            id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
        };
    },

    url: url_web+"json_listar_clientes",    
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

