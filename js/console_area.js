var tbl_area;
function listar_area(){
    tbl_area = $("#tabla_area").DataTable({
        "ordering":false,   
        "pageLength": 10,
        "destroy":true,
        "async": false ,
        "processing": true,
        "ajax":{
            "url":"../Controller/area/controller_listar_area.php",
            type:'POST'
        },
        "columns":[
            {"defaultContent":""},
            {"data":"AREA"},
            {"data":"F_CREA"},
            {"data":"E",  
            render: function (data, type, row ) {
              if(data=='C'){
                return '<span class="badge bg-danger bg-lg">'+'INACTIVO'+'</span>';
              }else{
                return '<span class="badge bg-success bg-lg">'+'ACTIVO'+'</span>';
              }
            }
            },
            {"defaultContent":"<button class='editar btn btn-primary'><i class='fa fa-edit'></i></button>"} 
          ],
          "language":idioma_espanol,
        select: false
    });
    tbl_area.on('draw.td',function(){
      var PageInfo = $("#tabla_area").DataTable().page.info();
      tbl_area.column(0, {page: 'current'}).nodes().each(function(cell, i){
        cell.innerHTML = i + 1 + PageInfo.start;
      });
    });
}
$('#tabla_area').on('click','.editar',function(){
  var data = tbl_area.row($(this).parents('tr')).data();//Detecta a que fila hago click y me captura los datos en la variable data.
  if(tbl_area.row(this).child.isShown()){//Cuando esta en tamaño responsivo
      var data = tbl_area.row(this).data();
     }   
    
     $("#modal_editar").modal('show');
    // document.getElementById('txt_idarea').value = data.AREA;
     document.getElementById('txt_area_editar').value = data.AREA;
     document.getElementById('select_estatus').value = data.E;
})
function AbriRegistro() { 
  $("#modal_registro").modal({backdrop: 'static',keyboard:false})
  $("#modal_registro").modal('show');
}
function Registrar_Area(){
	var area = $("#txt_area").val();
	if(area.length==0){
		//ValidacionInput("area");
		return Swal.fire("Mensaje de advertencia","Tiene algunos campos vacios","warning");
	}
    $.ajax({
        "url":"../Controller/area/controller_registro_area.php",
        type:'POST',
        data:{
            area:area
        }
    }).done(function(resp){
        if(resp>0){
                if(resp==1){
                    Swal.fire("Mensaje De Confirmaci\u00F3n",
                              "Datos guardados correctamente",
                              "success").then((value)=>{
                                tbl_area.ajax.reload();
                                $("#modal_registro").modal('hide');

                    });
                    document.getElementById('txt_area').value="";
          
                    
                }else{
                    //LimpiarCampos();
                    Swal.fire("Mensaje De Advertencia","El nombre del area ya existe en nuestra base de datos","warning");  
                }
        }else{
            Swal.fire("Mensaje De Error","Lo sentimos el registro no se pudo completar","error");
        }
    })		
	
}
function Modificar_Area(){
	//var id = $("#txt_idarea").val();
  var area = $("#txt_area_editar").val();
  var estatus = $("#select_estatus").val();
	if(area.length==0   || estatus.length  == 0){
		//ValidacionInput("area");
		return Swal.fire("Mensaje de advertencia","Tiene algunos campos vacios","warning");
	}
    $.ajax({
        "url":"../Controller/area/controller_modificar_area.php",
        type:'POST',
        data:{
            //id:id,
            area:area,
            estatus:estatus
        }
    }).done(function(resp){
        if(resp>0){
                if(resp==1){
                    Swal.fire("Mensaje De Confirmaci\u00F3n",
                              "Datos actualizados correctamente",
                              "success").then((value)=>{
                                tbl_area.ajax.reload();
                                $("#modal_editar").modal('hide');

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

function AbriRegistro(){
      $("#modal_registro").modal({backdrop: 'static',
     keyboard: false})
    $("#modal_registro").modal('show');
}
