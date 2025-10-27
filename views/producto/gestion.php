<h1>Gestion de productos</h1>

<a href="<?=base_url?>producto/crear" class="button button-small">
    Crear Producto
</a>

<?php if(isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete'): ?>
    <strong class="alert_green"> El producto ha sido creado exitosamente</strong>
<?php elseif(isset($_SESSION['producto']) && $_SESSION['producto'] != 'complete'): ?>
    <strong class="alert_red"> El producto NO ha sido creado exitosamente</strong>
<?php endif;?>

<?php Utils::deleteSession('producto');?>
    
<?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete'): ?>
    <strong class="alert_green"> El producto ha sido borrado exitosamente</strong>
<?php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] != 'complete'): ?>
    <strong class="alert_red"> El producto NO ha sido borrado correctamente</strong>
<?php endif;?>

<?php Utils::deleteSession('delete');?>
    
<table border="1">
    <tr>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>PRECIO</th>
        <th>STOCK</th>
        <th>ACCIONES</th>
    </tr> 
   <?php while($pro = $productos->fetch_object()): ?>

    <tr>
        <td><?=$pro->id; ?></td>
        <td><?=$pro->nombre; ?></td>
        <td><?=$pro->precio; ?></td>
        <td><?=$pro->stock; ?></td>
        <td>
            <!-- 
                <a href="<?=base_url?>producto/editar?id=<?=$pro->id?>" class="button button-gestion">Editar</a>
                al usar ? trae el siguiente parametro no el primero como queremos
                para que traiga el primer parametro se usa &
            -->

            <a href="<?=base_url?>producto/editar&id=<?=$pro->id?>" class="button button-gestion">Editar</a>
            <a href="<?=base_url?>producto/eliminar&id=<?=$pro->id?>" class="button button-gestion button-red">Eliminar</a>
        </td>
    </tr>
        
    <?php endwhile; ?>
</table>