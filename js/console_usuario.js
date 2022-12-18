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
            if(data[0][3] != "ARBITRIOS"){
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
            {"data":"TELEFONO"},
           // {"data":"EMAIL"},
            {"data":"TIPO",render: function(data,type,row){
                if(data=='A'){
                    return '<span class="badge bg-success">ADMINISTRADOR</span>';
                }else{
                    return '<span class="badge bg-danger">USUARIO</span>';
                }
        }   
    },

            {"defaultContent":"<button class='btn btn-primary'><i class='fa fa-edit'></i></button>"}
            
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