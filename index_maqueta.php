<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tienda de Camisetas</title>
        <link rel="stylesheet" href="assets/css/styles.css">
    </head>
    <body>
        <div id="container">
            <!-- CABECERA -->
            <header id="header">
                <div id="logo">
                    <img src="assets/img/camiseta.png" alt="Camiseta Logo" />
                    <a href="index.php">
                        <h1>Tienda de Camisetas</h1>
                    </a>
                </div>

            </header>

            <!-- MENU -->
            <nav id="menu">
                <ul>
                    <li>
                        <a href="#">Inicio</a>
                    </li>
                    <li>
                        <a href="#">Categoria1</a>
                    </li>
                    <li>
                        <a href="#">Categoria2</a>
                    </li>
                    <li>
                        <a href="#">Categoria3</a>
                    </li>
                    <li>
                        <a href="#">Categoria4</a>
                    </li>
                </ul>
            </nav>

            <div id="content">
                <!-- BARRA LATERAL -->
                <aside id="lateral">
                    <div id="login" class="block_aside">
                        <h3>Entrar a la web</h3>
                        <form action="#" method="post">
                            <label for="email">Email</label>
                            <input type="email" name="email" />
                            <label for="password">Contrasena</label>
                            <input type="password" name="password" />
                            <input type="submit" value="Enviar" />

                        </form>
                        <ul>
                            <li><a href="#">Mis Pedidos</a></li>
                            <li><a href="#">Gestionar Pedidos</a></li>
                            <li><a href="#">Gestionar Categorias</a></li>

                        </ul>

                    </div>
                </aside>

                <!-- CONTENIDO CENTRAL -->
                <div id="central">
                    <h1>Productos destacados</h1>
                    <div class="product">
                        <img src="assets/img/camiseta.png" />
                        <h2>Camiseta Azul Talla m</h2>
                        <p> 130 Euros </p>
                        <a href="" class="button">Comprar</a>
                    </div>

                    <div class="product">
                        <img src="assets/img/camiseta.png" />
                        <h2>Pantalon Azul Talla m</h2>
                        <p> 40 Euros </p>
                        <a href="" class="button">Comprar</a>
                    </div>

                    <div class="product">
                        <img src="assets/img/camiseta.png" />
                        <h2>Blusa roja</h2>
                        <p> 25 Euros </p>
                        <a href="" class="button">Comprar</a>
                    </div>
                </div>
            </div>
            <!-- PIE DE PAGINA -->
            <footer id="footer">
                <p>Desarrollado por Washington Nieto &copy:<?= date("Y") ?></p>
            </footer>
        </div>
    </body>
</html>

