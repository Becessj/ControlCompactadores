<?php
    require_once 'model_conexion.php';
    class Modelo_Mantenimiento extends conexionBD{
        public function Listar_Mantenimiento(){
            $c = conexionBD::conexionPDO();
            $sql = "SELECT 
                        m.ID, 
						cpt.ID_COMPACTADOR AS ID_COMPACTADOR,
                        cpt.CODIGO AS PLACA,  -- Se obtiene la placa del compactador
						m.CODIGO,
                        m.DESCRIPCION, 
                        m.FECHA_PROGRAMADA,
                        m.ESTADO, 
                        m.TIPO, 
                        m.FECHA, 
                        COALESCE(cat.CATEGORIA, 'Sin categoría') AS CATEGORIA,
						m.ID_CATEGORIA
                    FROM 
                        MANTENIMIENTOS m
                    LEFT JOIN 
                        CATEGORIAS cat ON m.ID_CATEGORIA = cat.ID
                    LEFT JOIN 
                        INVENTARIO_COMPACTADORES cpt ON m.CODIGO = cpt.ID_COMPACTADOR  -- Relacionamos el ID del compactador con MANTENIMIENTOS
                    ORDER BY 
                        m.FECHA DESC;";
            $query = $c->prepare($sql);
            $query->execute();
            $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
            $arreglo = ["data" => $resultado];
            return json_encode($arreglo);
        }

        public function Registrar_Mantenimiento($codigo, $tipo, $categoria, $fecha, $descripcion) {
            try {
                $c = conexionBD::conexionPDO();
                $sql = "INSERT INTO MANTENIMIENTOS (CODIGO, ID_CATEGORIA, DESCRIPCION, FECHA_PROGRAMADA, TIPO, ESTADO) 
                        VALUES (?, ?, ?, ?, ?, 'ACTIVO')";
                $query = $c->prepare($sql);
                return $query->execute([$codigo, $categoria, $descripcion, $fecha, $tipo]);
            } catch (Exception $e) {
                return false; // Enviar false en caso de error
            }
        }

        public function Editar_Mantenimiento($id, $placa, $categoria, $fecha, $descripcion, $estatus) {
            try {
                $c = conexionBD::conexionPDO();
                $sql = "UPDATE mantenimientos 
                        SET CODIGO=?, ID_CATEGORIA=?, FECHA_PROGRAMADA=?, DESCRIPCION=?, ESTADO=? 
                        WHERE ID=?";
                $query = $c->prepare($sql);
                $resultado = $query->execute([$placa, $categoria, $fecha, $descripcion, $estatus, $id]);
                
                return $resultado; // Devuelve true si se ejecutó correctamente, false si hubo error.
            } catch (Exception $e) {
                return false; // Si hay error, devolver false
            }
        }
        
            // 🔹 LISTAR MANTENIMIENTOS PARA EL CALENDARIO
            public function Listar_Eventos() {
                $c = conexionBD::conexionPDO();
                $sql = "SELECT 
                            m.ID, 
                            cpt.CODIGO AS PLACA,  
                            m.CODIGO,
                            m.DESCRIPCION, 
                            m.FECHA_PROGRAMADA,
                            m.ESTADO, 
                            m.TIPO, 
                            m.FECHA, 
                            COALESCE(cat.CATEGORIA, 'Sin categoría') AS CATEGORIA,
                            m.ID_CATEGORIA
                        FROM 
                            MANTENIMIENTOS m
                        LEFT JOIN 
                            CATEGORIAS cat ON m.ID_CATEGORIA = cat.ID
                        LEFT JOIN 
                            INVENTARIO_COMPACTADORES cpt ON m.CODIGO = cpt.ID_COMPACTADOR
                        WHERE 
                            m.FECHA_PROGRAMADA IS NOT NULL 
                            AND m.ESTADO = 'ACTIVO'
                        ORDER BY 
                            m.FECHA DESC";
                            
                $query = $c->prepare($sql);
                $query->execute();
                $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
                
                $eventos = [];
                $hoy = date('Y-m-d');
            
                foreach ($resultado as $fila) {
                    $tipo = strtoupper($fila['TIPO']); // Convertir a mayúsculas para evitar errores
            
                    if ($tipo === "DESINFECCIÓN") {
                        // 🔥 Si es desinfección y la fecha está en el futuro o es hoy → NARANJA
                        // 🔥 Si la fecha ya pasó → ROJO
                        $color = ($fila['FECHA_PROGRAMADA'] >= $hoy) ? "#FFA500" : "#FF0000"; 
                    } else {
                        // 🔥 Para otros tipos: ROJO si vencido, VERDE si en el futuro
                        $color = ($fila['FECHA_PROGRAMADA'] < $hoy) ? '#FF0000' : '#28a745';
                    }
            
                    $eventos[] = [
                        'id' => $fila['ID'],
                        'title' => $fila['PLACA'] . " - " . $fila['CATEGORIA'],
                        'start' => $fila['FECHA_PROGRAMADA'],
                        'color' => $color,
                        'extendedProps' => [
                            'title' => $fila['PLACA'] . " - " . $fila['CATEGORIA'],
                            'descripcion' => $fila['DESCRIPCION'],
                            'estado' => $fila['ESTADO'],
                            'tipo' => $fila['TIPO']
                        ]
                    ];
                }
                return $eventos;
            }

            public function Mantenimientos_Mensual() {
                $c = conexionBD::conexionPDO();
                $sql = "SELECT COUNT(*) AS TOTAL_MANTENIMIENTOS
                        FROM MANTENIMIENTOS
                        WHERE 
                            MONTH(FECHA) = MONTH(GETDATE()) 
                            AND YEAR(FECHA) = YEAR(GETDATE())
                            AND ESTADO = 'ACTIVO';";
                $query = $c->prepare($sql);
                $query->execute();
                return json_encode($query->fetchAll(PDO::FETCH_ASSOC)); // Devuelve la cantidad total
            }
            
            
              
 }
?>