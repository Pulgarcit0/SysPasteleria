<?php
session_start();

require "../conexion.php";

// Verificar si el usuario ya ha visto el mensaje de bienvenida
if (!isset($_SESSION['bienvenida_mostrada']) && !empty($_SESSION['active'])) {
    echo '<div id="bienvenidaAlert" class="container mt-3 fixed-top" style="z-index: 1000;">
        <div class="alert alert-success" role="alert">
            ¡Bienvenido, ' . $_SESSION['nombre'] . '!
        </div>
    </div>';

    // Establecer la variable de sesión para indicar que el mensaje ya se ha mostrado
    $_SESSION['bienvenida_mostrada'] = true;
}

// Incluye el script de funciones.js al final del archivo
echo '<script src="../assets/js/funciones.js"></script>';
echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Llamar a la función mostrarBienvenida después de que se haya cargado el contenido
        mostrarBienvenida();
    });
</script>';
echo '</body></html>';

// Resto de tu código
$usuarios = mysqli_query($conexion, "SELECT * FROM usuario");
$total['usuarios'] = mysqli_num_rows($usuarios);
$clientes = mysqli_query($conexion, "SELECT * FROM cliente");
$total['clientes'] = mysqli_num_rows($clientes);
$productos = mysqli_query($conexion, "SELECT * FROM producto");
$total['productos'] = mysqli_num_rows($productos);
$ventas = mysqli_query($conexion, "SELECT * FROM ventas WHERE fecha > CURDATE()");
$total['ventas'] = mysqli_num_rows($ventas);

// Incluye el header después del resto del código
include_once "includes/header.php";
?>

<!-- Content Row -->
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                    <i class="fas fa-user fa-2x"></i>
                </div>
                <a href="usuarios.php" class="card-category text-warning font-weight-bold">
                    Usuarios
                </a>
                <h3 class="card-title"><?php echo $total['usuarios']; ?></h3>
            </div>
            <div class="card-footer bg-warning text-white">
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
                <div class="card-icon">
                    <i class="fas fa-users fa-2x"></i>
                </div>
                <a href="clientes.php" class="card-category text-success font-weight-bold">
                    Clientes
                </a>
                <h3 class="card-title"><?php echo $total['clientes']; ?></h3>
            </div>
            <div class="card-footer bg-secondary text-white">
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
                <div class="card-icon">
                    <i class="fab fa-product-hunt fa-2x"></i>
                </div>
                <a href="productos.php" class="card-category text-danger font-weight-bold">
                    Productos
                </a>
                <h3 class="card-title"><?php echo $total['productos']; ?></h3>
            </div>
            <div class="card-footer bg-primary">
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
                <div class="card-icon">
                    <i class="fas fa-cash-register fa-2x"></i>
                </div>
                <a href="ventas.php" class="card-category text-info font-weight-bold">
                    Ventas
                </a>
                <h3 class="card-title"><?php echo $total['ventas']; ?></h3>
            </div>
            <div class="card-footer bg-danger text-white">
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8 mb-4">
            <div class="card" style="background-color: #e1bee7;"> <!-- Cambiar el color de fondo de la tarjeta -->
                <div class="card-header card-header-primary" style="background-color: rgba(73,166,158,0.57);"> <!-- Cambiar el color de fondo de la cabecera -->
                    <h3 class="title-2 m-b-40" style="color: #2ba7c4;">Productos con stock mínimo</h3> <!-- Cambiar el color del texto -->
                </div>
                <div class="card-body">
                    <canvas id="stockMinimo"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-8 mb-4">
            <div class="card" style="background-color: #80deea;"> <!-- Cambiar el color de fondo de la tarjeta -->
                <div class="card-header card-header-primary" style="background-color: #00838f;"> <!-- Cambiar el color de fondo de la cabecera -->
                    <h3 class="title-2 m-b-40" style="color: #ffffff;">Productos más vendidos</h3> <!-- Cambiar el color del texto -->
                </div>
                <div class="card-body">
                    <canvas id="ProductosVendidos"></canvas>
                </div>
            </div>
        </div>
    </div>


    <?php include_once "includes/footer.php"; ?>

