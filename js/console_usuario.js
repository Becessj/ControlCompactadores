function Iniciar_Sesion(){
    recuerdame();
    let usuario = document.getElementById('txt_usuario').value;
    let contra = document.getElementById('txt_contra').value;
    if (usuario.length == 0 || contra.length ==0){
        return Swal.fire({
            icon: 'error',
            title: 'UPS...',
            text: 'Los campos están vacíos',
            heightAuto: false
          })
    }
    $.ajax({
        url:'Controller/usuario/controller_iniciar_sesion.php',
        type: 'POST',
        data:{
            u:usuario,
            c:contra
        }

    }).done(function(resp){
        let data = JSON.parse(resp);
        if(data.length>0){
            if(data[0][4] == "C"){
                return Swal.fire({
                    icon: 'warning',
                    title:'Mensaje de advertencia',
                    text: 'El usuario '+data[0][0]+' se encuentra inactivo',
                     heightAuto: false}
                ).then((result) => {
                    // Reload the Page
                    location.reload();
                  });
            }
            if(data[0][3] != "PREDIAL"){
                return Swal.fire({
                    icon: 'warning',
                    title:'Mensaje de advertencia',
                    text: 'El usuario '+data[0][0]+' no pertenece al área de limpieza publica',
                     heightAuto: false}
                ).then((result) => {
                    // Reload the Page
                    location.reload();
                  });
            }
   
            $.ajax({
                url:'Controller/usuario/controller_crear_sesion.php',
                type: 'POST',
                data:{
                    usuario:data[0][0],
                    nombre:data[0][1],
                    rol: data[0][3],
                }
    
            }).done(function(resp){
                let timerInterval
                Swal.fire({
                title: 'Bienvenido al sistema ',
                html: 'Serás redireccionado en <b></b> milliseconds.',
                timer: 2000,
                timerProgressBar: true,
                heightAuto:false,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                    b.textContent = Swal.getTimerLeft()
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
                }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    location.reload();
                }
                })
            
            })
        }
        else{           
            Swal.fire({
                icon: 'error',
                title: 'ERROR!',
                 text: 'Los datos son incorrectos',
                 heightAuto: false}
            ).then((result) => {
                // Reload the Page
                location.reload();
              });
        }
    })

}
var tbl_usuario;
function listar_usuario(){
    tbl_usuario = $("#tabla_usuario").DataTable({
        "ordering":false,   
        "bLengthChange":true,
        "searching": { "regex": false },
        "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
        "pageLength": 10,
        "destroy":true,
        "async": false ,
        "processing": true,
        "ajax":{
            "url":"../controller/usuario/controller_listar_usuario.php",
            type:'POST'
        },
        "columns":[
            {"defaultContent":""},
            {"data":"USUARIO"},
            {"data":"NOMBRE"},
            {"data":"DIRECCION"},
            //{"data":"AREA"},
            {"data":"TIPO",render: function(data,type,row){
                if(data=='A'){
                    return '<span class="badge bg-success">ADMINISTRADOR</span>';
                }else{
                    return '<span class="badge bg-danger">USUARIO</span>';
                }
        }   
    },

            {"defaultContent":"<button class='editar btn btn-primary'><i class='fa fa-edit'></i></button>"}
            
        ],
  
        "language":idioma_espanol,
        select: false
    });
    tbl_usuario.on('draw.td',function(){
      var PageInfo = $("#tabla_usuario").DataTable().page.info();
      tbl_usuario.column(0, {page: 'current'}).nodes().each(function(cell, i){
        cell.innerHTML = i + 1 + PageInfo.start;
      });
    });
  
}
$('#tabla_usuario').on('click','.editar',function(){
    var data = tbl_usuario.row($(this).parents('tr')).data();//Detecta a que fila hago click y me captura los datos en la variable data.
    if(tbl_usuario.row(this).child.isShown()){//Cuando esta en tamaño responsivo
        var data = tbl_usuario.row(this).data();
       }   
      
       $("#modal_editar_usuario").modal('show');
      // document.getElementById('txt_idarea').value = data.AREA;
       document.getElementById('txt_nombres_editar').value = data.NOMBRE;
       document.getElementById('txt_direccion_editar').value = data.DIRECCION;
       document.getElementById('txt_usu_editar').value = data.USUARIO;
       document.getElementById('txt_con_editar').value = data.CLAVE;
       document.getElementById('select_rol_editar').value = data.TIPO;
       document.getElementById('select_estado_editar').value = data.E;
  })
function recuerdame(){
    if(rmcheck.checked && usuarioInput.value!= "" && passInput.value!=""){
        localStorage.usuario = usuarioInput.value;
        localStorage.pass = passInput.value;
        localStorage.checkbox = rmcheck.value;
    }
    else{
            localStorage.usuario = "";
            localStorage.pass = "";
            localStorage.checkbox = "";
    }
}
function Cargar_Select_Usuario(){
    $.ajax({
        "url":"../Controller/usuario/controller_cargar_select_usuario.php",
        type:'POST'
    }).done(function(resp){
        let data=JSON.parse(resp);
        if(data.length>0){
            let cadena="";
            for(let i=0;i<data.length;i++){
                cadena +=  "<option value='"+data[i][0]+"'>"+data[i][0]+"</option>";
            }
            document.getElementById('select_usuario').innerHTML=cadena;
        }
        else{
            cadena +=  "<option value=''>No hay empleados</option>";
            document.getElementById('select_usuario').innerHTML=cadena;
        }
    })		
	
}
function Cargar_Select_Area(){
    $.ajax({
        "url":"../Controller/usuario/controller_cargar_select_area.php",
        type:'POST'
    }).done(function(resp){
        let data=JSON.parse(resp);
        if(data.length>0){
            let cadena="";
            for(let i=0;i<data.length;i++){
                cadena +=  "<option value='"+data[i][0]+"'>"+data[i][0]+"</option>";
            }
            document.getElementById('select_area').innerHTML=cadena;
        }
        else{
            cadena +=  "<option value=''>No hay empleados</option>";
            document.getElementById('select_area').innerHTML=cadena;
        }
    })		
	
}
function Registrar_Usuario(){
    var nomb = $("#txt_nombres").val();
    var apaterno = $("#txt_apaterno").val();
    var amaterno = $("#txt_amaterno").val();
    var direc = $("#txt_direccion").val();
	var usu = $("#txt_usu").val();
    var con = $("#txt_con").val();
    var ida = $("#select_area").val();
    var rol = $("#select_rol").val();
	if(nomb.length==0 ||apaterno.length==0 ||amaterno.length==0 ||direc.length==0 ||usu.length==0 || con.length==0 ||ida.length==0||rol.length==0){
		//ValidacionInput("area");
		return Swal.fire("Mensaje de advertencia","Tiene algunos campos vacios","warning");
	}
    $.ajax({
        "url":"../Controller/usuario/controller_registro_usuario.php",
        type:'POST',
        data:{
            nomb:nomb,
            apaterno:apaterno,
            amaterno:amaterno,
            direc:direc,
            usu:usu,
            con:con,
            ida:ida,
            rol:rol
        }
    }).done(function(resp){
        if(resp>0){
                if(resp==1){
                    Swal.fire("Mensaje De Confirmaci\u00F3n",
                              "Nuevo usuario registrado",
                              "success").then((value)=>{
                                document.getElementById('txt_nombres').value="";
                                document.getElementById('txt_apaterno').value="";
                                document.getElementById('txt_amaterno').value="";
                                document.getElementById('txt_direccion').value="";
                                document.getElementById('txt_usu').value="";
                                document.getElementById('txt_con').value="";
                                document.getElementById('select_area').value="";
                                document.getElementById('select_rol').value="";
                                tbl_usuario.ajax.reload();
                                $("#modal_registro_usuario").modal('hide');

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

function Modificar_Usuario(){
    var nomb = $("#txt_nombres_editar").val();
    var direc = $("#txt_direccion_editar").val();
	var usu = $("#txt_usu_editar").val();
    var con = $("#txt_con_editar").val();
    var rol = $("#select_rol_editar").val();
    var est = $("#select_estado_editar").val();
	if(nomb.length==0||direc.length==0 ||usu.length==0 || con.length==0 ||rol.length==0){
		//ValidacionInput("area");
		return Swal.fire("Mensaje de advertencia","Tiene algunos campos vacios","warning");
	}
    $.ajax({
        "url":"../Controller/usuario/controller_modificar_usuario.php",
        type:'POST',
        data:{
            nomb:nomb,
            direc:direc,
            usu:usu,
            con:con,
            rol:rol,
            est:est,
           
        }
    }).done(function(resp){
        if(resp>0){
                if(resp==1){
                    Swal.fire("Mensaje De Confirmaci\u00F3n",
                              "Datos del usuario actualizados",
                              "success").then((value)=>{
                                tbl_usuario.ajax.reload();
                                $("#modal_editar_usuario").modal('hide');

                    });
                    //document.getElementById('txt_area').value="";
          
                    
                }else{
                    //LimpiarCampos();
                    Swal.fire("Mensaje De Advertencia","El usuario ingresado ya se encuentra en la base de datos","warning");  
                }
        }else{
            Swal.fire("Mensaje De Error","No se completó el usuario","error");
        }
    })		
	
}
function AbrirModalRegistro() { 
    $("#modal_registro_usuario").modal({backdrop: 'static',keyboard:false})
    $("#modal_registro_usuario").modal('show');
  }

  function AbrirModalRegistro() { 
    $("#modal_registro_usuario").modal({backdrop: 'static',keyboard:false})
    $("#modal_registro_usuario").modal('show');
  }