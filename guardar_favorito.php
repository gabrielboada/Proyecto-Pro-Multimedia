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
        
        // Verificar si ya existe un registro con los mismos valores
        $stmt_check = $conn->prepare("SELECT COUNT(*) AS count FROM mymedia WHERE iditem = ? AND tabla = ? AND usuario = ?");
        $stmt_check->bind_param("sss", $item_id, $tabla, $email);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
        $row_check = $result_check->fetch_assoc();
        $existing_records = $row_check['count'];
        
        if ($existing_records == 0) {
            // Preparar la consulta SQL para insertar los datos en la tabla mymedia
            $stmt_insert = $conn->prepare("INSERT INTO mymedia (tabla, iditem, usuario) VALUES (?, ?, ?)");
            $stmt_insert->bind_param("sss", $tabla, $item_id, $email);
            
            // Ejecutar la consulta
            if ($stmt_insert->execute()) {
                echo "<script>
                    alert('Se a agregado a tus Favoritos.');
                    window.location.href = '".$tabla.".php';
                    </script>";
            } else {
                echo "Error al guardar los datos en la base de datos: " . $conn->error;
            }
            
            // Cerrar la conexión
            $stmt_insert->close();
        } else {
            echo "<script>
                    alert('Ya se encuentra entre tus favoritos');
                    window.location.href = '".$tabla.".php'; 
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
