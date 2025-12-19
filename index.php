<?php

//index.php
require_once "autoload.php";
session_start();
$gestor = new Gestor();
// OPERACIONES DEL CRUD
$accion = $_GET['accion'] ?? null;

if ($accion === 'crear') {
    //cogemos por POST los datos
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $formato = $_POST['formato'];
    $playlist = new Tracks($id, $nombre, $formato);
    $gestor->agregar($playlist);
    header("Location: index.php");
    exit;
}
if ($accion === 'editar') {
    //cogemos por POST los datos
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $formato = $_POST['formato'];
    $gestor->actualizar($id,$nombre,$formato);
    header("Location: index.php");
    exit;
}
if ($accion === 'eliminar') {
    //cogemos por POST los datos
    $id = $_GET['id'];
    $gestor->eliminar($id);
    header("Location: index.php");
    exit;
}
if ($accion === 'borrarTodo') {
    session_destroy();
    header("Location: index.php");
    exit;
}
//de forma análoga haremos editar, eliminar (le pasamos por GET el id) y borrar todos

$productos = $gestor->listar();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>CRUD V2</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h2 {
            color: #333;
        }
        form {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            width: 400px;
        }
        label {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            width: 100%;
            margin-bottom: 15px;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin: 0;
            margin-top: 5px;
            margin-bottom: 0;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<!-- ...-->
<!-- FORMULARIO CREAR -->
<h2>CRUD - Playlist</h2>

<form method="POST" action="index.php?accion=crear"> <!-- Aquí está la clave de recoger por GET la acción -->
    <label for="id">ID:
        <input type="text" name="id" id="id">
    </label>
    <label for="nombre">Nombre de la canción:
        <input type="text" name="nombre" id="nombre">
    </label>
    <label for="formato">Formato:
        <input type="text" name="formato" id="formato">
    </label>
    <input type="submit">
</form>


<!-- LISTADO DE PRODUCTOS-->
 <table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($productos as $p): ?>
    <tr>
        <td><?= $p->getId() ?></td>
        <td><?= $p->getNombre() ?></td>
        <td><?= $p->getFormato() ?></td>
        <td>
            <!-- Botón Editar -->
            <form method="POST" action="index.php?accion=editar" style="display:inline;"> <!-- Recogemos por GET la acción -->
                <!-- recogemos por POST los datos para modificar (podemos poner datos por defecto) -->
                 <label for="id"></label><input type="hidden"name="id" value="<?=$p->getId()?>">
                    <label for="nombre">Nombre:</label><input type="text" name ="nombre" value="<?=$p->getNombre()?>">
                    <label for="formato">Formato:</label><input type="text" name="formato" value="<?=$p->getFormato()?>">
                    <input type="submit">
            </form>

            <!-- Botón Eliminar -->
            <a href="index.php?accion=eliminar&id=<?= $p->getId() ?>">Eliminar</a> <!-- Recogemos por GET el id -->
        </td>
    </tr>
    <?php endforeach; ?>
    <?php if (empty($productos)): ?>
    <tr><td colspan="4" style="text-align:center;">No hay registros</td></tr>
    <?php endif; ?>
    </table>
    <a href="index.php?accion=borrarTodo">Borrar Todo</a> <!-- Recogemos por GET el id -->
</body>
</html>