<?php

require_once 'models/producto.php';

class ProductoController {

   
    public function index() {
        //renderizar vista de producto
        $producto = new Producto();
        $productos = $producto->getRandom(6);

        //require_once 'views/producto/destacados.php';
    }

    public function ver() {

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $producto = new Producto();
            $producto->setId($id);
            $product = $producto->getOne();
        }
        require_once 'views/producto/ver.php';

    }

    public function gestion() {
        Utils::isAdmin();

        //creamos una variable producto
        //que es una instancia de la clase Producto
        //creo el objeto para poder acceder al select de los productos
        //el resultado se guarda en $productos
        //los cuales se le pasan a la vista gestion.php
        $producto = new Producto();
        $productos = $producto->getAll();

        require_once 'views/producto/gestion.php';
    }

    public function crear() {
        Utils::isAdmin();
        require_once 'views/producto/crear.php';
    }

    public function save() {
        Utils::isAdmin();
        if (isset($_POST) && isset($_POST['nombre'])) {
            //var_dump($_POST);
            //die();
            //Guardar la producto
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;

            if ($nombre && $descripcion && $precio && $stock && $categoria) {
                $producto = new Producto();
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoria_id($categoria);

                //Guardar la imagen
                if (isset($_FILES['imagen'])) {
                    $file = $_FILES['imagen'];
                    $filename = $file['name'];
                    $mimetype = $file['type'];

                    //var_dump($file);
                    //die();

                    if ($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/git") {
                        if (!is_dir('uploads/images')) {
                            mkdir('uploads/images', 0777, true);
                        }
                        move_uploaded_file($file['tmp_name'], 'uploads/images/' . $filename);
                        $producto->setImagen($filename);
                    }
                }

                //si llega un metodo $_GET es edicion..
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $producto->setId($id);
                    $save = $producto->edit();
                    //sino es insercion-producto nuevo
                } else {
                    $save = $producto->save();
                }
                if ($save) {
                    $_SESSION['producto'] = "complete";
                } else {
                    $_SESSION['producto'] = "failed";
                }
            } else {
                $_SESSION['producto'] = "failed";
            }
        } else {
            $_SESSION['producto'] = "failed";
        }
        if (!headers_sent()) {
            header('Location:' . base_url . 'producto/gestion');
        }
    }

    public function editar() {
        //averiguemos primero que trae $_GET
        //var_dump($_GET);
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $edit = true;

            $producto = new Producto();
            $producto->setId($id);
            $pro = $producto->getOne();

            require_once 'views/producto/crear.php';
        } else {
            if (!headers_sent()) {
                header('Location:' . base_url . 'producto/gestion');
            }
        }
    }

    public function eliminar() {
        Utils::isAdmin();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $producto = new producto();
            $producto->setId($id);
            $delete = $producto->delete();
            if ($delete) {
                $_SESSION['delete'] = 'complete';
            } else {
                $_SESSION['delete'] = 'failed';
            }
        } else {
            $_SESSION['delete'] = 'failed';
        }
        if (!headers_sent()) {
            header('Location:' . base_url . 'producto/gestion');
        }
    }

}
