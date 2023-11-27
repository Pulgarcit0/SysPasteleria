<?php
session_start();
$permiso = 'usuarios';
$id_user = $_SESSION['idUser'];
include "../conexion.php";

// Función para obtener la información del usuario por RFC
function obtenerUsuarioPorRFC($conexion, $rfc)
{
    $query = mysqli_query($conexion, "SELECT rfc, nombre, Apaterno, aMaterno, fecha_nacimiento, sexo, telefono, correo, sueldo, direccion, usuario, fecha_contratacion, TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) AS edad FROM usuario WHERE rfc = '$rfc'");
    return mysqli_fetch_assoc($query);
}

// Verificar si se realizó una búsqueda
if (!empty($_POST['buscar_rfc'])) {
    $rfc_buscado = $_POST['buscar_rfc'];
    $usuario_encontrado = obtenerUsuarioPorRFC($conexion, $rfc_buscado);
}
include "includes/header.php";
?>

<!-- Añadir formulario de búsqueda con estilos -->
<link rel="stylesheet" href="../assets/css/x.css">
<div class="card mb-4 form-containerv2">
    <div class="card-body">
        <form action="" method="post" autocomplete="off">
            <div class="grupo">
                <input type="text" class="barra" placeholder=" " name="buscar_rfc" id="buscar_rfc" required>
                <label for="buscar_rfc">Buscar por RFC:</label>
            </div>
            <button type="submit">Buscar</button>
        </form>
    </div>
</div>

<!-- Mostrar información del usuario si se encontró con estilos -->
<?php if (!empty($usuario_encontrado)) { ?>
    <div class="alert alert-info user-info-container" role="alert">
        <strong>Información del Usuario:</strong><br>
        <span class="campo">RFC:</span> <?php echo $usuario_encontrado['rfc']; ?><br>
        <span class="campo">Nombre:</span> <?php echo $usuario_encontrado['nombre']; ?><br>
        <span class="campo">Apellido Paterno:</span> <?php echo $usuario_encontrado['Apaterno']; ?><br>
        <span class="campo">Apellido Materno:</span> <?php echo $usuario_encontrado['aMaterno']; ?><br>
        <span class="campo">Fecha de Nacimiento:</span> <?php echo $usuario_encontrado['fecha_nacimiento']; ?><br>
        <span class="campo">Sexo:</span> <?php echo $usuario_encontrado['sexo']; ?><br>
        <span class="campo">Teléfono:</span> <?php echo $usuario_encontrado['telefono']; ?><br>
        <span class="campo">Correo:</span> <?php echo $usuario_encontrado['correo']; ?><br>
        <span class="campo">Sueldo:</span> <?php echo $usuario_encontrado['sueldo']; ?><br>
        <span class="campo">Dirección:</span> <?php echo $usuario_encontrado['direccion']; ?><br>
        <span class="campo">Usuario:</span> <?php echo $usuario_encontrado['usuario']; ?><br>
        <span class="campo">Fecha de Contratación:</span> <?php echo $usuario_encontrado['fecha_contratacion']; ?><br>
        <span class="campo">Edad:</span> <?php echo $usuario_encontrado['edad']; ?> años
    </div>
<?php } ?>

<?php include_once "includes/footer.php"; ?>

