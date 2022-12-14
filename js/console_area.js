var tbl_area;
function listar_area(){
    tbl_area = $("#tabla_area").DataTable({
        "ordering":false,   
        "bLengthChange":true,
        "searching": { "regex": false },
        "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
        "pageLength": 10,
        "destroy":true,
        "async": false ,
        "processing": true,
        "ajax":{
            "url":"../controller/area/controller_listar_area.php",
            type:'POST'
        },
        "columns":[
            {"defaultContent":""},
            {"data":"AREA"},
            {"data":"DESCRIPCION"},
            {"data":"UNIDAD"},
            {"data":"SIGLAS"},
            {"data":"GERENCIA"},
            {"defaultContent":"<button class='btn btn-primary'><i class='fa fa-edit'></i></button>"}
            
        ],
  
        "language":idioma_espanol,
        select: true
    });
    tbl_area.on('draw.td',function(){
      var PageInfo = $("#tabla_area").DataTable().page.info();
      tbl_area.column(0, {page: 'current'}).nodes().each(function(cell, i){
        cell.innerHTML = i + 1 + PageInfo.start;
      });
    });
  
}