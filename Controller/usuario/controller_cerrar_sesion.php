<?php
    session_start();
    $clave=2221152;
    echo $clave;
    //echo eliminar_seleccion_contribuyente();
    //var_dump();
    session_destroy();
    //header("Location: ../controller/cuenta/controller_eliminar_clave.php");
   header("Location: ../../index.php");

?>
<script>
    function eliminar_seleccion_contribuyente(){ 
        $.ajax({
            url : "../controller/cuenta/controller_eliminar_clave.php",
            type : "POST", 
            data : { 
                clave_resp: 2221152
                }, 
            success : function(json) {
            console.log('eliminado');

                //Almacena el resultado en algún lado

            },

            error : function(xhr,errmsg,err) {
            console.log(xhr.status + ": " + xhr.responseText);
            }
        });
       

    }
   
eliminar_seleccion_contribuyente();

</script>