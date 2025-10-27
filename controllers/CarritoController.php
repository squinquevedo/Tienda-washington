<?php

require_once 'models/producto.php';

class CarritoController {

    public function index() {
        if (isset($_SESSION['identity'])) {
            $carrito = $_SESSION['carrito'];
        }
        require_once 'views/carrito/index.php';
    }

    public function add() {
        if (isset($_GET['id'])) {
            $producto_id = $_GET['id'];
        } else {
            if (!headers_sent()) {
                header("Location:" . base_url . "categoria/index");
            }
        }
        if (isset($_SESSION['carrito'])) {
            $counter = 0;
            foreach ($_SESSION['carrito'] as $indice => $elemento) {
                if ($elemento['id_producto'] == $producto_id) {
                    $_SESSION['carrito'][$indice]['unidades']++;
                    $counter++;
                }
            }
        }

        if (!isset($counter) || $counter == 0) {

            //conseguir producto
            $producto = new Producto();
            $producto->setId($producto_id);
            $producto = $producto->getOne();

            if (is_object($producto)) {
                $_SESSION['carrito'][] = array(
                    "id_producto" => $producto->id,
                    "precio" => $producto->precio,
                    "unidades" => 1,
                    "producto" => $producto
                );
            }
        }
        //if (!headers_sent()) {
        //    header("Location:" . base_url . "carrito/index");
        //}
        echo '<script>window.location="' . base_url . 'carrito/index"</script>';
    }

    public function delete() {
        if (isset($_GET['index'])) {
            $index = $_GET['index'];
            unset($_SESSION['carrito'][$index]);
        }
        echo '<script>window.location="' . base_url . 'carrito/index"</script>';
        //header("Location:" . base_url . "carrito/index");
    }

    public function up() {
        if (isset($_GET['index'])) {
            $index = $_GET['index'];
            $_SESSION['carrito'][$index]['unidades']++;
        }
        //header("Location:" . base_url . "carrito/index");
        echo '<script>window.location="' . base_url . 'carrito/index"</script>';
    }

    public function down() {
        if (isset($_GET['index'])) {
            $index = $_GET['index'];
            $_SESSION['carrito'][$index]['unidades']--;

            if ($_SESSION['carrito'][$index]['unidades'] == 0) {
                unset($_SESSION['carrito'][$index]);
            }
        }
        //header("Location:" . base_url . "carrito/index");
        echo '<script>window.location="' . base_url . 'carrito/index"</script>';
    }

    public function delete_all() {
        unset($_SESSION['carrito']);
        //if (!headers_sent()) {
        //    header("Location:" . base_url . "carrito/index");
        //}
        echo '<script>window.location="' . base_url . 'carrito/index"</script>';
    }

}
