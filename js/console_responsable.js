var tbl_responsable;
function listar_responsable(){
    tbl_responsable = $("#tabla_responsable").DataTable({
      rowCallback:function(row,data)
      {
        
        if(data[2] == "Excelente")
        {
          $($(row).find("td")[2]).css("background-color","green");
        }
        else if(data[2] == "Bueno"){
            $($(row).find("td")[2]).css("background-color","blue");
        }
        else{
            $($(row).find("td")[2]).css("background-color","red");
        }
        
      },
        "ordering":false,   
        "bLengthChange":true,
        "searching": { "regex": false },
        "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
        "pageLength": 10,
        "destroy":true,
        "async": false ,
        "processing": true,
        "ajax":{
            "url":"../controller/responsable/controller_listar_responsable.php",
            type:'POST'
        },
        "columns":[
            {"defaultContent":""},
            {"data":"RESPONSABLE"},
            {"data":"NOMBRE_COMPLETO"},
            {"data":"DIRECCION_FISCAL"},
            {"defaultContent":"<button class='btn btn-primary'><i class='fa fa-edit'></i></button>"}
            
        ],
  
        "language":idioma_espanol,
        select: false
    });
    tbl_responsable.on('draw.td',function(){
      var PageInfo = $("#tabla_responsable").DataTable().page.info();
      tbl_responsable.column(0, {page: 'current'}).nodes().each(function(cell, i){
        cell.innerHTML = i + 1 + PageInfo.start;
      });
    });
  
}
