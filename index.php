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
<!-- ...-->
<!-- FORMULARIO CREAR -->
<h2>Crear Producto</h2>

<form method="POST" action="index.php?accion=crear"> <!-- Aquí está la clave de recoger por GET la acción -->
    <label for="ID"><input type="text" name= "id"></label>
    <label for="nombre">nombre:<input type="text" name= "nombre"></label>
    <label for="formato">formato:<input type="text" name= "formato"></label>
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
    <a href="index.php?accion=borrarTodo">Borrar Todo</a> <!-- Recogemos por GET el id -->