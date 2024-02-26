<?php
// Verificar si se enviaron datos mediante POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $item_id = $_POST["item_id"];
    $tabla = $_POST["tabla"];
    
    // Verificar si hay una sesión activa
    session_start();
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        
        // Conectar a la base de datos
        include("cnx.php");
        
        // Verificar si existe el registro en la tabla mymedia
        $stmt_check = $conn->prepare("SELECT COUNT(*) AS count FROM mymedia WHERE iditem = ? AND tabla = ? AND usuario = ?");
        $stmt_check->bind_param("sss", $item_id, $tabla, $email);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
        $row_check = $result_check->fetch_assoc();
        $existing_records = $row_check['count'];
        
        if ($existing_records > 0) {
            // Preparar la consulta SQL para eliminar el registro de la tabla mymedia
            $stmt_delete = $conn->prepare("DELETE FROM mymedia WHERE iditem = ? AND tabla = ? AND usuario = ?");
            $stmt_delete->bind_param("sss", $item_id, $tabla, $email);
            
            // Ejecutar la consulta
            if ($stmt_delete->execute()) {
                echo "<script>
                    alert('Se ha eliminado de tus Favoritos.');
                    window.location.href = 'mymedia.php';
                    </script>";
            } else {
                echo "Error al eliminar los datos de la base de datos: " . $conn->error;
            }
            
            // Cerrar la conexión
            $stmt_delete->close();
        } else {
            echo "<script>
                    alert('No se encuentra en tus favoritos');
                    window.location.href = 'mymedia.php'; 
                </script>";
        }
        
        // Cerrar la conexión
        $stmt_check->close();
        $conn->close();
    } else {
        echo "No se encontró una sesión activa.";
    }
} else {
    echo "No se recibieron datos.";
}
?>
