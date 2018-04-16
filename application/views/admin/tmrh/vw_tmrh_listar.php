<!--script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script> 

<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.css" />
<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid-theme.min.css" />
 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js"></script>

<div id="jsGrid"></div>

<script type="text/javascript">


$(function() {
 
    $("#jsGrid").jsGrid({
        height: "auto",
        width: "100%",
 
        sorting: true,
        paging: true,
        autoload: true,

        filtering: true,
        filterable:true,

        editing: false,
    	editButton: false,
    	deleteButton: false, 


	    clearFilterButton: true,                        // show clear filter button
	    modeSwitchButton: false,   



		noDataContent: "No se encontró resultado.",
		loadMessage: "Por favor, espere...",

	    pageIndex: 1,
	    pageSize: 10,
	    pageButtonCount: 5,
	    pagerFormat: "Página(s): {first} {prev} {pages} {next} {last}    {pageIndex} de {pageCount}",
	    pagePrevText: "<",
	    pageNextText: ">",
	    pageFirstText: "<<",
	    pageLastText: ">>",  
	    height: "70%",
        width: "100%",
 
        controller: {


			loadData: function(filter) {
			    var d = $.Deferred();

			    // server-side filtering
			    $.ajax({
			        type: "GET",
			        url: "http://localhost:8081/proyecto_casa_oficios/tmrh/json_listar_todo_tmrh",
			        data: filter,
			        dataType: "json"
			    }).done(function(result) {
			        // client-side filtering
			        result = $.grep(result, function(item) {
			             return item.SomeField === filter.SomeField;
			        });

			        d.resolve(result);
			    })

			    return d.promise();
			}

        	/*
            loadData: function(filter) {
                var d = $.Deferred();
 
                $.ajax({
                    url: "http://localhost:8081/proyecto_casa_oficios/tmrh/json_listar_todo_tmrh",
                    data: filter,
                    dataType: "json"
                }).done(function(response) {

			        // client-side filtering
			        response = $.grep(response, function(item) {
			             return item.SomeField === filter.SomeField;
			        });

                    d.resolve(response);
                });
 

                return d.promise();
            }

            */
        },
 
        fields: [
            { name: "COD_TMRH", type: "number", width: 150, title: "Código TMRH" },
            { name: "NOM_TMRH", type: "text", width: 150, title: "Nombres" },
            { name: "APE_PATERNO", type: "text", width: 200, title: "Apellido Paterno" },
            { name: "APE_MATERNO", type: "text", width: 200, title: "Apellido Materno" },
            { name: "EMAIL", type: "text",width: 200, title: "E-mail" },
            { type: "control", 	editButton: false, deleteButton: false }
            
        ]

    });
 
});


/*

    var clients = [
        { "Name": "Otto Clay", "Age": 25, "Country": 1, "Address": "Ap #897-1459 Quam Avenue", "Married": false },
        { "Name": "Connor Johnston", "Age": 45, "Country": 2, "Address": "Ap #370-4647 Dis Av.", "Married": true },
        { "Name": "Lacey Hess", "Age": 29, "Country": 3, "Address": "Ap #365-8835 Integer St.", "Married": false },
        { "Name": "Timothy Henson", "Age": 56, "Country": 1, "Address": "911-5143 Luctus Ave", "Married": true },
        { "Name": "Ramona Benton", "Age": 32, "Country": 3, "Address": "Ap #614-689 Vehicula Street", "Married": false }
    ];
 
    var countries = [
        { Name: "", Id: 0 },
        { Name: "United States", Id: 1 },
        { Name: "Canada", Id: 2 },
        { Name: "United Kingdom", Id: 3 }
    ];
 
    $("#jsGrid").jsGrid({
        width: "100%",
        height: "400px",
 
        inserting: true,
        editing: true,
        sorting: true,
        paging: true,
 
        data: clients,
 
        fields: [
            { name: "Name", type: "text", width: 150, validate: "required" },
            { name: "Age", type: "number", width: 50 },
            { name: "Address", type: "text", width: 200 },
            { name: "Country", type: "select", items: countries, valueField: "Id", textField: "Name" },
            { name: "Married", type: "checkbox", title: "Is Married", sorting: false },
            { type: "control" }
        ]
    })

*/
</script-->

<!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.3.1/jquery.bootgrid.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.3.1/jquery.bootgrid.min.js"></script-->


<table style="display: block; overflow-x: scroll;" id="grid-data" class="table table-condensed table-hover table-striped" width="60%" cellspacing="0" data-toggle="bootgrid">
    <thead>
        <tr>

            <th data-column-id="COD_TMRH" data-type="numeric" data-identifier="true">Código TMRH</th>
            <th data-column-id="commands" data-formatter="commands" data-sortable="false" >Ver Detalle</th>            
            <th data-column-id="NOM_TMRH" >Nombres</th>
            <th data-column-id="APE_PATERNO" >Apellido Paterno</th>
            <th data-column-id="APE_MATERNO" >Apellido Materno</th>
            <th data-column-id="SEXO" >Sexo</th>     
            <th data-column-id="EDAD" >Edad</th>            
            <th data-column-id="DESCRIP_DOCUMENTO" >Tipo Documento</th>            
            <th data-column-id="NUM_DOCUMENTO" >Número Documento</th>   
            <th data-column-id="DISTRITO" >Distrito de Residencia</th>                           
            <th data-column-id="EMAIL" >E-mail</th>
            <!--th data-column-id="link" data-formatter="link" data-sortable="false">Apellido Paterno</th-->
        </tr>

    </thead>

</table>
<script type="text/javascript">

url_web="<?php echo base_url()."admin/tmrh/";?>";


$("#grid-data").bootgrid({
    ajax: true,
    post: function ()
    {
        /* To accumulate custom parameter with the request object */
        return {
            id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
        };
    },

    url: url_web+"json_nuevo_listar_tmrh",    
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
        },
        "commands": function(column, row)
        {
            return "<button title='Teléfonos de Contacto' onclick=\"abrir_telefonos("+ row.COD_TMRH + ",'" + row.NOM_TMRH+" "+row.APE_PATERNO+" "+row.APE_MATERNO+"')\" type=\"button\" class=\"btn btn-xs btn-default command-edit\" data-row-id=\"" + row.id + "\"><span class=\"glyphicon glyphicon-earphone\"></span></button> " + 
                   "<button title='Oficios y Experiencia' onclick=\"abrir_oficios("+ row.COD_TMRH + ",'" + row.NOM_TMRH+" "+row.APE_PATERNO+" "+row.APE_MATERNO+"')\" type=\"button\" class=\"btn btn-xs btn-default command-delete\" data-row-id=\"" + row.id + "\"><span class=\"glyphicon glyphicon-briefcase\"></span></button>";
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



function abrir_telefonos(id,info){

    $("#btn_aceptar").hide();
	$('#myModal').modal('show');

	$.get(url_web+"ajax_vista_telefonos/"+id, {}, 
		function(htmlexterno){

    		$("#p_mensaje").html(htmlexterno);
    		$("#titulo_popup").html("Teléfonos de Contactos :<br><i>"+ info+"</i>");

    		});
}


function abrir_oficios(id,info){

    $("#btn_aceptar").hide();
	$('#myModal').modal('show');

	$.get(url_web+"ajax_vista_oficios/"+id, {}, 
		function(htmlexterno){

    		$("#p_mensaje").html(htmlexterno);
    		$("#titulo_popup").html("Oficios y Experiencia :<br><i>"+ info+"</i>");

    		});
}


function reseteo(){

	$("#p_mensaje").html("Cargando...");
    $("#titulo_popup").html("Cargando...");
}

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

