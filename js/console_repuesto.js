$(document).ready(function () {
    listar_repuesto();
 
});
var tbl_repuesto;


function listar_repuesto() {
  tbl_repuesto = $('#tabla_repuestos').DataTable({
         aoColumns: [
        null,
        null,
        null,
        null,
        null
     ],
        "ordering":true,   
        "bLengthChange":true,
        dom: 'Bfrtip',
        buttons: [
          {
            extend: 'print',
            title: 'REPORTE DE LISTADO DE RESPONSABLES',
            //permite imprimir solo las columnas seleccionadas cuando hay numeracion cuenta como 0
            exportOptions: {
              columns: [  1, 2, 3 ]
          },
            className: "pdf fa fa-print",
            customize: function ( win ) {
                $(win.document.body)
                    .css( 'font-size', '10pt' )
                    .prepend(
                      '<img src="http://datatables.net/media/images/logo-fade.png" style="position:absolute; top:0; left:0;" />'
                    );

                $(win.document.body).find( 'table' )
                    .addClass( 'compact' )
                    .css( 'font-size', 'inherit' );
            }
        },
        {
          extend: 'csv',
          className: "csv 	fas fa-file-csv",
          
      },
      {
        extend: 'excel',
        className: "excel fas fa-file-excel"
    }
      
      ],
      "ordering": true,
      "pageLength": 10,
      "destroy": true,
      "responsive": true,
      "autoWidth": false,
      "ajax":{
        "url":"../Controller/repuesto/controller_listar_repuesto.php",
        "type":"POST",
        "dataSrc": "data"
  },
      "columns": [
        {"data":"PRODUCTO"},
        {"data":"DESCRIPCION"},
        {"data":"UNIDAD"},
        {
          "data": "SALDO_ACTUAL",
          "render": function (data, type, row) {
              let badgeClass = "bg-dark"; // Color por defecto: Negro
      
              if (data <= 2) {
                  badgeClass = "bg-danger"; // Menos de 2 -> Rojo
              } else if (data <= 5) {
                  badgeClass = "bg-warning"; // Menos de 5 -> Ámbar
              } else if (data <= 8) {
                  badgeClass = "bg-success"; // Menos de 8 -> Verde
              } 
      
              return `<span class="badge ${badgeClass} bg-lg">${data}</span>`;
          }
      }
      
      ],
      "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
        $($(nRow).find("td")[0]).css('text-align', 'center');
        $($(nRow).find("td")[0]).css('font-weight', 'bold');
        $($(nRow).find("td")[1]).css('font-weight', '');
        $($(nRow).find("td")[3]).css('text-align', 'center');

    },
      "language":idioma_espanol,
  });

      $('#tabla_repuestos').on( 'click', 'tr', function () {
      var data = tbl_repuesto.row(this).data();
      console.log( tbl_repuesto.row(this).data());
      responsable1 = data.RESPONSABLE;
      traerResponsable(data.RESPONSABLE);
      console.log(responsable1)
        document.getElementById('txt_contribuyente').value = data.RESPONSABLE;
       document.getElementById('txt_nomcompleto').value = data.NOMBRE_COMPLETO;
       document.getElementById('txt_contribuyente2').value = data.RESPONSABLE;
       document.getElementById('txt_nomcompleto2').value = data.NOMBRE_COMPLETO;
       listar_tbl_predios(data.RESPONSABLE);
       
      
      
  } );
  //Sirve para enumerar las tuplas #
    // tbl_repuesto.on('draw.td',function(){
    //   var PageInfo = $("#tabla_repuestos").DataTable().page.info();
    //   tbl_repuesto.column(0, {page: 'current'}).nodes().each(function(cell, i){
    //     cell.innerHTML = i + 1 + PageInfo.start;
    //   });
    // });
    $('#tabla_repuestos').on('click','.editar',function(){
      var data = tbl_repuesto.row($(this).parents('tr')).data();//Detecta a que fila hago click y me captura los datos en la variable data.
      if(tbl_repuesto.row(this).child.isShown()){//Cuando esta en tamaño responsivo
          var data = tbl_repuesto.row(this).data();
         }   
         $("#modal_editar_responsable").modal('show');
         //document.getElementById('txt_idarea').value = data.AREA;
         document.getElementById('txt_responsable_editar').value = data.RESPONSABLE;
         document.getElementById('txt_apaterno_editar').value = data.AP;
         document.getElementById('txt_amaterno_editar').value = data.AM;
         document.getElementById('txt_nombres_editar').value = data.NOMBRES;
         document.getElementById('txt_direccion_editar').value = data.DIRECCION_FISCAL;
         document.getElementById('txt_ndoc_editar').value = data.NRO_DOC;
         document.getElementById('txt_usuario_editar').value = $("#txt_usuario").val();
    })

}
