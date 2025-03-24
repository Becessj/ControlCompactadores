var tbl_responsable;
var tbl_estado_cuenta;
var tbl_deudas_generadas;
var tbl_predios;
var tbl_predios2;
var tbl_cuentas_pendientes
var respons;
var predio;
var tiporesp;
var responsable1;
var estado;
var clave;
var periodoini;
var periodofin;
var resp;



function listar_responsable(){
    tbl_responsable = $("#tabla_responsable").DataTable({
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
      "ordering":false,   
      "pageLength": 10,
      "destroy":true,
      "async": false ,
      "responsive": true,
    "autoWidth": false,
        "ajax":{
            "url":"../controller/responsable/controller_listar_responsable.php",
            type:'POST'
        },
        "columns":[
            {"defaultContent":""},
            {"data":"RESPONSABLE"},
            {"data":"NOMBRE_COMPLETO"},
            {"data":"DIRECCION_FISCAL"},
            {"defaultContent":"<button class='editar btn btn-primary'><i class='fa fa-edit'></i></button>"}
            
        ],
  
        "language":idioma_espanol,
        "scrollX": true,
        select: true
    });
    $('#tabla_responsable').on( 'click', 'tr', function () {
      var data = tbl_responsable.row(this).data();
      console.log( tbl_responsable.row(this).data());
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
    tbl_responsable.on('draw.td',function(){
      var PageInfo = $("#tabla_responsable").DataTable().page.info();
      tbl_responsable.column(0, {page: 'current'}).nodes().each(function(cell, i){
        cell.innerHTML = i + 1 + PageInfo.start;
      });
    });
    $('#tabla_responsable').on('click','.editar',function(){
      var data = tbl_responsable.row($(this).parents('tr')).data();//Detecta a que fila hago click y me captura los datos en la variable data.
      if(tbl_responsable.row(this).child.isShown()){//Cuando esta en tamaño responsivo
          var data = tbl_responsable.row(this).data();
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


function listar_tbl_estado_cuenta(re){
  console.log(re)
  tbl_estado_cuenta = $("#tabla_estado_cuenta").DataTable({
    "createdRow": function( row, data, dataIndex ) {
      if ( data["E"] == "C" ) {
          $( row ).css( "background-color", "#BC786A" );
          $( row ).addClass( "warning" );
      }
      else{
        $( row ).css( "background-color", "white" );
        $( row ).addClass( "success" );
      }
  },
    aoColumns: [
     null,
     null,
     null,
     null,
     null,
     null,
     null,
     null,
     null,
     null,
     null,
     null,
     null,
     null,
     null,
     null
  ],
    dom: 'Bfrtip',
    buttons: [
      {
          extend: 'print',
          extend: 'csv',
          extend: 'print',
          messageTop: 'This print was produced using the Print button for DataTables',
          
      }
  ],
  fixedColumns: true,
      scrollX: true,
      scrollY: '50vh',
      scrollCollapse: true,
      paging: true,
      "ordering":true,   
      "bLengthChange":true,
      "searching": { "regex": false },
      "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"] ],
      "pageLength":50,
      "destroy":true,
      "async": false ,
      "processing": true,
      "ajax":{
          "url":"../controller/cuenta/controller_listar_estado_cuenta.php",
          type:'POST',
          data:{
            responsable1: re
          }
      },
      "columns":[
         // {"data":"CONTRIBUYENTE"},
          {"data":"PREDIO", visible: true, searchable: true},
          {"data":"CUENTA"},
          {"data":"E", render: function (data, type, row ) {
            if(data=='C'){
              return '<span class="badge bg-danger bg-lg">'+'CANCELADA'+'</span>';
            }else{
              return '<span class="badge bg-success bg-lg">'+'ACTIVA'+'</span>';
            }
          }},
          {"data":"GENERADOR"},
          {"data":"PERIODO"},
          {"data":"MONTO"},
          {"data":"SERENAZGO"},
          {"data":"INTERES"},
          {"data":"DESCUENTO"},
          {"data":"SUBTOTAL"},
          {"data":"CUENTA_PADRE"},
          {"data":"OBS"},
          {"data":"FECHA"},
          {"data":"DESCRIPCION"},
          {"data":"USUARIO"},
          {"data":"_"}
      ],
      
      "language":idioma_espanol,
      select: true
  });


  document.getElementById('txt_responsable').value = responsable1;
}
function Registrar_Responsable(){
  var apaterno = $("#txt_apaterno").val();;
  var amaterno = $("#txt_amaterno").val();
  var nomb = $("#txt_nombres").val();
  var direc = $("#txt_direccion").val();
  var ndoc = $("#txt_ndoc").val();
  var usu = $("#txt_usuario").val();
  var tpersona = $("#select_tipopersona").val();

  console.log(apaterno+'-'+amaterno+'-'+nomb+'-'+direc+'-'+ndoc+'-'+usu+'-'+tpersona)
if(apaterno.length==0 ||amaterno.length==0 ||nomb.length==0 ||direc.length==0 ||ndoc.length==0||usu.length==0 ||tpersona.length==0 ){
  //ValidacionInput("area");
  return Swal.fire("Mensaje de advertencia","Tiene algunos campos vacios","warning");
}
  $.ajax({
      "url":"../Controller/responsable/controller_registro_responsable.php",
      type:'POST',
      data:{
          apaterno:apaterno,
          amaterno:amaterno,
          nomb:nomb,
          direc:direc,
          ndoc:ndoc,
          usu:usu,
          tpersona:tpersona
          
      }
  }).done(function(resp){
      if(resp>0){
              if(resp==1){
                  Swal.fire("Mensaje De Confirmaci\u00F3n",
                            "Nuevo responsable registrado",
                            "success").then((value)=>{
                              document.getElementById('txt_apaterno').value="";
                              document.getElementById('txt_amaterno').value="";
                              document.getElementById('txt_nombres').value="";
                              document.getElementById('txt_direccion').value="";
                              document.getElementById('txt_ndoc').value="";
                              tbl_responsable.ajax.reload();
                              $("#modal_registro_responsable").modal('hide');

                  });
                  //document.getElementById('txt_area').value="";
        
                  
              }else{
                  //LimpiarCampos();
                  Swal.fire("Mensaje De Advertencia","El usuario ingresado ya se encuentra en la base de datos","warning");   
              }
      }else{
          Swal.fire("Mensaje De Error","Lo sentimos el registro no se pudo completar","error");
      }
  })		

}
function Modificar_Responsable(){
  var responsable_editar = $("#txt_responsable_editar").val();
  var apaterno_editar = $("#txt_apaterno_editar").val();
  var amaterno_editar = $("#txt_amaterno_editar").val();
  var nomb_editar = $("#txt_nombres_editar").val();
  var direc_editar = $("#txt_direccion_editar").val();
  var ndoc_editar = $("#txt_ndoc_editar").val();
  var tpersona_editar = $("#select_tipopersona_editar").val();
  var usu_editar = $("#txt_usuario").val();

  
  console.log(responsable_editar+'-'+apaterno_editar+'-'+amaterno_editar+'-'+nomb_editar+'-'+direc_editar+'-'+ndoc_editar+'-'+usu_editar+'-'+tpersona_editar)
	if(responsable_editar.length==0   || apaterno_editar.length==0   || amaterno_editar.length  == 0||nomb_editar.length==0   || direc_editar.length  == 0||ndoc_editar.length==0   || tpersona_editar.length  == 0 || usu_editar.length  == 0){
		//ValidacionInput("area");
		return Swal.fire("Mensaje de advertencia","Tiene algunos campos vacios","warning");
	}
    $.ajax({
        "url":"../Controller/responsable/controller_modificar_responsable.php",
        type:'POST',
        data:{
            responsable_editar:responsable_editar,
            apaterno_editar:apaterno_editar,
            amaterno_editar:amaterno_editar,
            nomb_editar:nomb_editar,
            direc_editar:direc_editar,
            ndoc_editar:ndoc_editar,
            tpersona_editar:tpersona_editar,
            usu_editar:usu_editar
        }
    }).done(function(resp){
        if(resp>0){
                if(resp==1){
                    Swal.fire("Mensaje De Confirmaci\u00F3n",
                              "Datos actualizados correctamente",
                              "success").then((value)=>{
                                tbl_responsable.ajax.reload();
                                $("#modal_editar_responsable").modal('hide');

                    }); 
                }else{
                    //LimpiarCampos();
                    Swal.fire("Mensaje De Advertencia","El nombre del area ya existe en nuestra base de datos","warning");  
                }
        }else{
            Swal.fire("Mensaje De Error","No se completó la modificación","error");
        }
    })		
	
}
function traerResponsable(responsable1){
  console.log(responsable1);
}

function Estado_Cuenta(){
  console.log(responsable1);
  if(responsable1 === undefined){
    Swal.fire(
      'ERROR!',
      'Debes seleccionar un responsable',
      'error'
    )
  }
  listar_tbl_estado_cuenta(responsable1);
 
  $("#modal_estado_cuenta").modal({backdrop: 'static',keyboard:false})
  $("#modal_estado_cuenta").modal('show');
}
function Cancelar_Recibo() { 
  listar_tbl_predios2(responsable1);
  console.log(responsable1);
  listar_cuentas_pendientes(responsable1)
  $("#modal_cancelar_recibo").modal({backdrop: 'static',keyboard:false})
  $("#modal_cancelar_recibo").modal('show');
}
function RegistroResponsable() { 
  $("#modal_registro_responsable").modal({backdrop: 'static',keyboard:false})
  $("#modal_registro_responsable").modal('show');
}

function listar_tbl_predios(re){
  tbl_predios = $("#tabla_predios").DataTable({
    "createdRow": function( row, data, dataIndex ) {
      if ( data["E"] == "C" ) {
          $( row ).css( "background-color", "#BC786A" );
          $( row ).addClass( "warning" );
      }
      else{
        $( row ).css( "background-color", "white" );
        $( row ).addClass( "success" );
      }
  },
  "bPaginate": false,
        "bFilter": false,
        "bInfo": false,
      scrollY:        "300px",
      scrollX:        true,
      scrollCollapse: true,
      paging:         false,
      fixedColumns:   {
          left: 2
      },
      "ordering":true,   
      "bLengthChange":true,
      "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"] ],
      "pageLength":50,
      "destroy":true,
      "async": false ,
      "processing": true,
      "ajax":{
          "url":"../controller/cuenta/controller_listar_predios.php",
          type:'POST',
          data:{
            responsable1: re
          }
      },
      "columns":[
          {"data":"RESPONSABLE"},
          {"data":"PREDIO_U"},
          {"data":"DIRECCION"},
          {"data":"AREA_TERRENO"},
          {"data":"TIPO_RESP"},
          {"data":"TIPO"}
      ],
      
      "language":idioma_espanol,
      select: true
  });
  $('#tabla_predios').on( 'click', 'tr', function () {
    var data = tbl_predios.row(this).data();
    console.log( tbl_predios.row(this).data());
    respons = data.RESPONSABLE;
    resp = data.RESPONSABLE;
    predio = data.PREDIO_U;
    tiporesp = data.TIPO;
    console.log(respons + periodoini + periodofin + predio);
 

    
   //btn_generar_deuda();
} );

  }
  function listar_tbl_predios2(re){
  tbl_predios2 = $("#tabla_predios2").DataTable({
  "bPaginate": false,
        "bFilter": false,
        "bInfo": false,
      scrollY:        "300px",
      scrollX:        true,
      scrollCollapse: true,
      paging:         false,
      fixedColumns:   {
          left: 2
      },
      "ordering":true,   
      "bLengthChange":true,
      "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"] ],
      "pageLength":50,
      "destroy":true,
      "async": false ,
      "processing": true,
      "ajax":{
          "url":"../controller/cuenta/controller_listar_predios2.php",
          type:'POST',
          data:{
            responsable1: re
          }
      },
      "columns":[
          {"data":"PREDIO"},
          {"data":"DIRECCION"}
      ],
      
      "language":idioma_espanol,
      select: true
  });
  $('#tabla_predios2').on( 'click', 'tr', function () {
    var data = tbl_predios2.row(this).data();
    console.log( tbl_predios2.row(this).data());
    respons = data.RESPONSABLE;
    resp = data.RESPONSABLE;
    predio = data.PREDIO_U;
    tiporesp = data.TIPO;
  
 

    
   //btn_generar_deuda();
} );

  }

/*   function btn_generar_deuda(){ 
    var agno = document.getElementById('select_agno').value;
    var cla = document.getElementById('txt_clave').value;
   // var agno='2023';
    var generador='LIMPPU';
    var fraccionar='N';
    let periodoini = document.getElementById('select_periodo_inicial').value;
    let periodofin = document.getElementById('select_periodo_final').value;
    var gastoadm = 0;      
    var clave = Math.floor(Math.random() * 100000) + 1;   
    var error = ''; 
    var nroerror = '';
    $.ajax({
      url: "../controller/cuenta/controller_generar_deuda.php",
      type: "post",
      data:{
        agno:agno,
        generador:generador,
        fraccionar:fraccionar,
        periodoini:periodoini,
        periodofin:periodofin,
        gastoadm:gastoadm,
        clave:clave,
        usuario:respons,
        error:error,
        nroerror:nroerror
      },
      success: function (response) {
        console.log(respons + ' '+periodoini + ' '+periodofin  + ' '+ predio);
        console.log(agno);
        console.log(cla);
        listar_deudas_generadas(respons,periodoini,periodofin,predio);
      },
      error: function(jqXHR, textStatus, errorThrown) {
         console.log(textStatus, errorThrown);
      }
  });
} */
function btn_generar_deuda(){ 
  var agno = document.getElementById('select_agno').value;
  var clave = document.getElementById('txt_clave').value;
 // var agno='2023';
  var generador='LIMPPU';
  var fraccionar='N';
  periodoini = document.getElementById('select_periodo_inicial').value;
  periodofin = document.getElementById('select_periodo_final').value;
  var gastoadm = 0;      
  //var clave = Math.floor(Math.random() * 100000) + 1;   
  var error = ''; 
  var nroerror = '';
  
  var promise = $.ajax({
    url : "../controller/cuenta/controller_insertar_clave.php",
    type : "POST", 
    data : { 
          clave_resp: clave,
          respons_resp: respons,
          predio_resp:predio,
          tipo_resp:tiporesp,
          A:'A'

          }, 
    success : function(json) {
      console.log('insertar -->' + clave+ ' '+respons+ ' '+predio+ ' '+tiporesp);

        //Almacena el resultado en algún lado

      },

    error : function(xhr,errmsg,err) {
      console.log(xhr.status + ": " + xhr.responseText);
    }
  });
  promise.then(function(){
      $.ajax({
        url: "../controller/cuenta/controller_generar_deuda.php",
        type: "post",
        data:{
          agno:agno,
          generador:generador,
          fraccionar:fraccionar,
          periodoini:periodoini,
          periodofin:periodofin,
          gastoadm:gastoadm,
          clave:clave,
          usuario:respons,
          error:error,
          nroerror:nroerror
        },
        success: function (response) {
          console.log(respons + ' '+periodoini + ' '+periodofin  + ' '+ predio);
          console.log(agno);
          //console.log(cla);
          listar_deudas_generadas();
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
        }
    });
  });
}
function btn_generar_deuda_select(){ 
  var agno = document.getElementById('select_agno').value;
  var clave = document.getElementById('txt_clave').value;
 // var agno='2023';
  var generador='LIMPPU';
  var fraccionar='N';
  periodoini = document.getElementById('select_periodo_inicial').value;
  periodofin = document.getElementById('select_periodo_final').value;
  var gastoadm = 0;      
  //var clave = Math.floor(Math.random() * 100000) + 1;   
  var error = ''; 
  var nroerror = '';
  
  var promise = $.ajax({
    url : "../controller/cuenta/controller_insertar_clave.php",
    type : "POST", 
    data : { 
          clave_resp: clave,
          respons_resp: respons,
          predio_resp:predio,
          tipo_resp:tiporesp,
          A:'A'

          }, 
    success : function(json) {
      console.log('insertar -->' + clave+ ' '+respons+ ' '+predio+ ' '+tiporesp);

        //Almacena el resultado en algún lado

      },

    error : function(xhr,errmsg,err) {
      console.log(xhr.status + ": " + xhr.responseText);
    }
  });
  listar_deudas_generadas();
}
  function listar_deudas_generadas(){
    tbl_deudas_generadas = $("#tabla_deudas_generadas").DataTable({
        "bPaginate": false,
        "bFilter": false,
        "bInfo": false,
        scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns:   {
            left: 2
        },
      "ordering":true,   
      "bLengthChange":true,
      "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"] ],
      "pageLength":50,
      "destroy":true,
      "async": false ,
      "processing": true,
      "ajax":{
          "url":"../controller/cuenta/controller_deudas_generadas.php",
          type:'POST',
          data:{
            resp: respons,
            periodoini: periodoini,
            periodofin: periodofin,
            predio: predio
          }
      },
      "columns":[
          {"data":"PERIODO"},
          {"data":"MONTO"},
          {"data":"GASTOADM"},
          {"data":"PREDIO"},
          {"data":"E"},
          {"data":"TIPO"}
      ],
      
      "language":idioma_espanol,
      select: true
  });
  $('#tabla_deudas_generadas').on( 'click', 'tr', function () {
    var data = tbl_deudas_generadas.row(this).data();
    //btn_generar_deuda();
    console.log(respons + periodoini + periodofin + predio);
    console.log( tbl_deudas_generadas.row(this).data());
    //respons = data.RESPONSABLE;
   //console.log(respons)
} );


  }  
  function listar_cuentas_pendientes(re){
    tbl_cuentas_pendientes = $("#tabla_cuentas_pendientes").DataTable({
        "bPaginate": false,
        "bFilter": false,
        "bInfo": false,
        scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns:   {
            left: 2
        },
      "ordering":true,   
      "bLengthChange":true,
      "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"] ],
      "pageLength":50,
      "destroy":true,
      "async": false ,
      "processing": true,
      "ajax":{
          "url":"../controller/cuenta/controller_cuentas_pendientes.php",
          type:'POST',
          data:{
            resp: re
          }
      },
      "columns":[
          {"data":"PREDIO"},
          {"data":"CUENTA"},
          {"data":"PERIODO"},
          {"data":"GENERADOR"},
          {"data":"Observacion"},
          {"data":"MONTO"},
          {"data":"DESCUENTO"},
          {"data":"SALDO"},
          {"data":"Gastos_Adm"},
          {"data":"Fecha_Emision"},
          {"data":"Fecha_Vencimiento"},
          {"data":"DIRECCION"}
      ],
      
      "language":idioma_espanol,
      select: true
  });
  $('#tabla_cuentas_pendientes').on( 'click', 'tr', function () {
    var data = tbl_cuentas_pendientes.row(this).data();
    //btn_generar_deuda();
    console.log(respons + periodoini + periodofin + predio);
    console.log( tbl_cuentas_pendientes.row(this).data());
    //respons = data.RESPONSABLE;
   //console.log(respons)
} );
$('#addRow').on('click', function () {
  t.row.add([counter + '.1', counter + '.2', counter + '.3', counter + '.4', counter + '.5']).draw(false);

  counter++;
});

// Automatically add a first row of data
$('#addRow').click();

  }  
  
  function saveResponsable(r){
    return r;
  }
  function savePredio(p){
    return p;
  }
  function Cargar_Select_Periodo_Inicial(){
      $.ajax({
          "url":"../Controller/cuenta/controller_cargar_select_periodoinicial.php",
          type:'POST'
      }).done(function(resp){
          let data=JSON.parse(resp);
          if(data.length>0){
              let cadena="";
              for(let i=0;i<data.length;i++){
                  cadena +=  "<option value='"+data[i][0]+"'>"+data[i][0]+"</option>";
              }
              document.getElementById('select_periodo_inicial').innerHTML=cadena;
          }
          else{
              cadena +=  "<option value=''>No hay periodos</option>";
              document.getElementById('select_periodo_inicial').innerHTML=cadena;
          }
      })		
    
  }
  function Cargar_Select_Periodo_Final(){
    $.ajax({
        "url":"../Controller/cuenta/controller_cargar_select_periodofinal.php",
        type:'POST'
    }).done(function(resp){
        let data=JSON.parse(resp);
        if(data.length>0){
            let cadena="";
            for(let i=0;i<data.length;i++){
                cadena +=  "<option value='"+data[i][0]+"'>"+data[i][0]+"</option>";
            }
            document.getElementById('select_periodo_final').innerHTML=cadena;
        }
        else{
            cadena +=  "<option value=''>No hay periodos</option>";
            document.getElementById('select_periodo_final').innerHTML=cadena;
        }
    })		
  
}



