<?php

require_once 'models/categoria.php';
require_once 'models/producto.php';

class CategoriaController{
    public function index(){
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        
        require_once 'views/categoria/index.php';
    }
    public function ver(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            
            //Conseguir categoria
            $categoria = new Categoria();
            $categoria->setId($id);
            $categoria = $categoria->getOne();
            
            //Conseguir producto
            $producto = new Producto();
            $producto->setCategoria_id($id);
            $productos = $producto->getAllCategory();
            //var_dump($_GET['id']);
        }
        require_once 'views/categoria/ver.php';
    }
    
    public function crear(){
        Utils::isAdmin();
        require_once 'views/categoria/crear.php';
    }
    
    public function save(){
        Utils::isAdmin();
        if(isset($_POST) && isset($_POST['nombre'])){
            //Guardar la categoria
            $categoria = new Categoria();
            $categoria->setNombre($_POST['nombre']);

            //si llega un metodo $_GET es edicion..
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $categoria->setId($id);
                $save = $categoria->edit();
                //sino es insercion-producto nuevo
            } else {
                $save = $categoria->save();
            }
            if ($save) {
                $_SESSION[''] = "complete";
            } else {
                $_SESSION['categoria'] = "failed";
            }
         
        } else {
            $_SESSION['categoria'] = "failed";
        }
        if(!headers_sent()){
            header("Location:".base_url."categoria/index");
        }        
    }
    
        public function editar() {
        //averiguemos primero que trae $_GET
        //var_dump($_GET);
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $edit = true;

            $categoria = new Categoria();
            $categoria->setId($id);
            $cat = $categoria->getOne();

            require_once 'views/categoria/crear.php';
        } else {
            if (!headers_sent()) {
                header('Location:' . base_url . 'categoria/index');
            }
        }
    }
    
        public function eliminar() {
        Utils::isAdmin();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $categoria = new Categoria();
            $categoria->setId($id);
            $delete = $categoria->delete();
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
