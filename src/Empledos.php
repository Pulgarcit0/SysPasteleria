<?php
session_start();
$permiso = 'usuarios';
$id_user = $_SESSION['idUser'];
include "../conexion.php";

$sql = mysqli_query($conexion, "SELECT p.*, d.* FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_user AND p.nombre = '$permiso'");
$existe = mysqli_fetch_all($sql);

if (empty($existe) && $id_user != 1) {
    header('Location: permisos.php');
}

include "includes/header.php";

$alert = "";

if (!empty($_POST)) {
    $id = $_POST['id'];
    $rfc = $_POST['rfc'];
    $nombre = $_POST['nombre'];
    $email = $_POST['correo'];
    $user = $_POST['usuario'];

    $Apaterno = isset($_POST['Apaterno']) ? $_POST['Apaterno'] : '';
    $Am = isset($_POST['aMaterno']) ? $_POST['aMaterno'] : '';
    $fechaN = isset($_POST['fechaN']) ? date('Y-m-d', strtotime($_POST['fechaN'])) : '0000-00-00';
    $sexo = isset($_POST['sexo']) ? $_POST['sexo'] : '';
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
    $sueldo = isset($_POST['sueldo']) ? $_POST['sueldo'] : '';
    $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';

    $alert = "";

    if (empty($nombre) || empty($email) || empty($user)) {
        $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Todos los campos son obligatorios
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
    } else {
        if (empty($id)) {
            $clave = $_POST['clave'];
            if (empty($clave)) {
                $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    La contraseña es requerida
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            } else {
                $clave = md5($_POST['clave']);
                $query = mysqli_query($conexion, "SELECT * FROM usuario where correo = '$email'");
                $result = mysqli_fetch_array($query);
                if ($result > 0) {
                    $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    El correo ya existe
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                } else {
                    $query_insert = mysqli_query($conexion, "INSERT INTO usuario(rfc, nombre, Apaterno, aMaterno, fecha_nacimiento, sexo, telefono, correo, sueldo, direccion, usuario, clave, idrol, fecha_contratacion) VALUES ('$rfc', '$nombre', '$Apaterno', '$Am', '$fechaN', '$sexo', '$telefono', '$email', '$sueldo', '$direccion', '$user', '$clave', 2, CURRENT_TIMESTAMP)");
                    if ($query_insert) {
                        $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Usuario Registrado
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                    } else {
                        $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al registrar
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                    }
                }
            }
        } else {
            // Actualiza el usuario
            $sql_update = mysqli_query($conexion, "UPDATE usuario SET nombre = '$nombre', Apaterno = '$Apaterno', aMaterno = '$Am', fecha_nacimiento = '$fechaN', sexo = '$sexo', telefono = '$telefono', correo = '$email', sueldo = '$sueldo', direccion = '$direccion', usuario = '$user', idrol = 1 WHERE idusuario = $id");

            if ($sql_update) {
                $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Usuario Modificado
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
            } else {
                $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Error al modificar
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
            }
        }
    }
}
?>

<!-- Resto de código HTML -->


<div class="card">
    <div class="card-body">
        <form action="" method="post" autocomplete="off" id="formulario">
            <?php echo isset($alert) ? $alert : ''; ?>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="rfc">RFC</label>
                        <input type="text" class="form-control" placeholder="Ingrese RFC" name="rfc" id="rfc">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" placeholder="Ingrese Nombre" name="nombre" id="nombre">
                        <input type="hidden" id="id" name="id">
                    </div>

                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="nombre">ApellidoP</label>
                        <input type="text" class="form-control" placeholder="Apellido Paterno" name="Apaterno" id="Apaterno">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="aMaterno">ApellidoM</label>
                        <input type="text" class="form-control" placeholder="Apellido Materno" name="aMaterno" id="aMaterno">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="fechaN">Fecha Nacimiento</label>
                        <input type="text" class="form-control" placeholder="1970-01-01" name="fechaN" id="fechaN">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="sexo">Sexo</label>
                        <input type="text" class="form-control" placeholder="Ingrese sexo" name="sexo" id="sexo">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="telefono">Telefono</label>
                        <input type="text" class="form-control" placeholder="9512435219" name="telefono" id="telefono">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="sueldo">Sueldo</label>
                        <input type="sueldo" class="form-control" placeholder="Ingrese sueldo" name="sueldo" id="sueldo">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="correo">Correo</label>
                        <input type="email" class="form-control" placeholder="Ingrese Correo Electrónico" name="correo" id="correo">
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="form-group">
                        <label for="direccion">direccion</label>
                        <input type="text" class="form-control" placeholder="Ingrese su direccion xxxxxx xxxx xxxx xxxx" name="direccion" id="direccion">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input type="text" class="form-control" placeholder="Ingrese Usuario" name="usuario" id="usuario">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="clave">Contraseña</label>
                        <input type="password" class="form-control" placeholder="Ingrese Contraseña" name="clave" id="clave">
                    </div>
                </div>
            </div>
            <input type="submit" value="Registrar" class="btn btn-primary" id="btnAccion">
            <input type="button" value="Nuevo" class="btn btn-success" id="btnNuevo" onclick="limpiar()">
        </form>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-hover table-striped table-bordered mt-3" id="tbl">
        <thead class="thead-dark">
        <tr>
            <th>#</th>\
            <th>RFC</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Usuario</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $query = mysqli_query($conexion, "SELECT * FROM usuario where idrol=2");
        $result = mysqli_num_rows($query);
        if ($result > 0) {
            $contador = 1; // Inicializa el contador
            while ($data = mysqli_fetch_assoc($query)) { ?>
                <tr>
                    <td><?php echo $contador; ?></td>
                    <td><?php echo $data['rfc'];?></td>
                    <td><?php echo $data['nombre']; ?></td>
                    <td><?php echo $data['correo']; ?></td>
                    <td><?php echo $data['usuario']; ?></td>
                    <td>

                        <a href="#" onclick="editarUsuario(<?php echo $data['idusuario']; ?>)" class="btn btn-success"><i class='fas fa-edit'></i></a>
                        <form action="eliminar_usuario.php?id=<?php echo $data['idusuario']; ?>" method="post" class="confirmar d-inline">
                            <button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> </button>
                        </form>
                    </td>
                </tr>
                <?php
                $contador++; // Incrementa el contador en cada iteración
            }
        } ?>
        </tbody>
    </table>
</div>
<?php include_once "includes/footer.php"; ?>
