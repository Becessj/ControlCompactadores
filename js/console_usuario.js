function Iniciar_Sesion(){
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
            Swal.fire({
                icon: 'success',
                 text: 'Mensaje de confirmación',
                 heightAuto: false}
               
            )
          
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
                title: 'UPS...',
                 text: 'Mensaje de error',
                 heightAuto: false}
               
            )
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
            {"data":"EMAIL"},
            {"data":"USUARIO_CREA",render: function(data,type,row){
                if(data=='ADMIN'){
                return '<span class="badge bg-success">ADMIN</span>';
                }else{
                return '<span class="badge bg-danger">RENTAS</span>';
                }
        }   
    },

            {"defaultContent":"<button class='btn btn-primary'><i class='fa fa-edit'></i></button>"}
            
        ],
  
        "language":idioma_espanol,
        select: true
    });
    tbl_usuario.on('draw.td',function(){
      var PageInfo = $("#tabla_usuario").DataTable().page.info();
      tbl_usuario.column(0, {page: 'current'}).nodes().each(function(cell, i){
        cell.innerHTML = i + 1 + PageInfo.start;
      });
    });
  
}