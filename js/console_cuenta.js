var tbl_periodo;
//var agno;

function listar_periodo(agno){
    console.log(agno)
    document.getElementById('select_agno').innerHTML=agno;
    tbl_periodo = $("#tabla_periodo").DataTable({
        "ordering":false,   
        "pageLength": 10,
        "destroy":true,
        "async": false ,
        "responsive": true,
    	"autoWidth": false,
        "ajax":{
            "url":"../controller/cuenta/controller_listar_periodo.php",
            type:'POST',
            data:{
                agno1:agno
            }
        },
        "columns":[
            {"defaultContent":""},
            {"data":"PERIODO"},
            {"data":"GENERADOR"},
            {"data":"AGNO"},
            {"data":"DESCRIPCION"},
            {"data":"NRO_PERIODO"},
            {"data":"FECHA_VCTO"},
            {"data":"OBS"},
            {"data":"ES_FRACCION"},
            {"data":"USUARIO_CREA", visible: false},
            {"data":"F_CREA", visible: false},
            {"data":"USUARIO_MODIFICA", visible: false},
            {"data":"F_MODIFICA", visible: false},
            {"data":"ES_FRACCION", visible: false}
        ],
  
        "language":idioma_espanol,
        select: false
    });
    tbl_periodo.on('draw.td',function(){
      var PageInfo = $("#tabla_periodo").DataTable().page.info();
      tbl_periodo.column(0, {page: 'current'}).nodes().each(function(cell, i){
        cell.innerHTML = i + 1 + PageInfo.start;
      });
    });
}
/* function getAgno(){
    return new Date().getFullYear();
} */
function Cargar_Select_Agno(agno){
    $.ajax({
        "url":"../Controller/usuario/controller_cargar_select_agno.php",
        type:'POST'
    }).done(function(resp){
        let data=JSON.parse(resp);
        if(data.length>0){
            let cadena="";
            for(let i=0;i<data.length;i++){
                cadena +=  "<option value='"+data[i][0]+"'>"+data[i][0]+"</option>";
            }
            document.getElementById('select_agno').innerHTML=cadena;
            document.getElementById('select_agno').value = agno;
        }
        else{
            cadena +=  "<option value=''>No hay años</option>";
            document.getElementById('select_agno').innerHTML=cadena;
        }
    })		
	
}

function selectedSubjectName() {
    var subjectIdNode = document.getElementById('select_agno');
    var value = subjectIdNode.options[subjectIdNode.selectedIndex].text;
    //console.log(value);
    var agno = value;
    console.log(agno);
    document.ready = document.getElementById("select_agno").value = agno;
    listar_periodo(agno);
/*     $('#select_agno').val(agno);
    $('#select_agno').trigger('change'); */
    //document.ready = document.getElementById("select_agno").value = agno;
    // Cargar_Select_Agno(agno)

 }


 function GenerarDeuda() { 
    $("#modal_generar_deuda").modal({backdrop: 'static',keyboard:false})
    $("#modal_generar_deuda").modal('show');
  }
  