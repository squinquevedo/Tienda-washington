<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <!-- <title>Tienda de Camisetas</title> -->
        <title>El Palacio de mis Angelitos</title>
        <link rel="stylesheet" href="<?=base_url?>assets/css/styles.css" />
    </head>
    <body>
        <div id="container">
            <!-- CABECERA -->
            <header id="header">
                <div id="logo">
                    <!-- <img src="<?=base_url?>assets/img/camiseta.png" alt="Camiseta Logo" /> -->
                    <img src="<?=base_url?>assets/img/angelitos.png" alt="Angelito Logo" />
                    <a href="<?=base_url?>">
                     <!-- <h1>Tienda de Camisetas</h1> -->
                        <h1>El Palacio de mis Angelitos</h1>
                    </a>
                </div>

            </header>

            <!-- MENU -->
            <?php $categorias = Utils::showCategorias(); ?>
            <nav id="menu">
                <ul>
                    <li>
                        <a href="<?=base_url?>">Inicio</a>
                    </li>
                    
                    <?php if(isset($_SESSION['identity'])):?>
                        <?php while ($cat = $categorias-> fetch_object()): ?>
                        <!-- 
                        fetch_object  Recorreme y sacame los objetos de todas 
                        las categorias de todo el resourcet que ha devuelto la bd
                        -->
                        <li>
                            <a href="<?=base_url?>categoria/ver&id=<?=$cat->id?>"><?= $cat?->nombre?></a>
                        </li>
                        <?php endwhile; ?>
                    <?php else:?>
                        <h1>Necesitas estar identificado</h1>
                        <p>Necesitas estar logeado en la web para ver categorias y productos.</p>
                    <?php endif; ?>

    
                </ul>
            </nav>

            <div id="content">