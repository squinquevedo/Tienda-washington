<?php

require_once 'models/usuario.php';


class UsuarioController{
    public function index(){
        echo "Controlador Usuario, Accion index";
    }
    
    public function registro(){
        require_once 'views/usuario/registro.php';
    }
    public function save(){
        if(isset($_POST)){
            //comprobar si los datos existen
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;
            
            //var_dump($nombre);
            
            if($nombre && $apellidos && $email && $password){
                $usuario = new Usuario();
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setPassword($password);

                $save = $usuario->save();
                if($save){
                    $_SESSION['register'] = "complete";
                }else{
                    $_SESSION['register'] = "failed";
                }
            }else{
                $_SESSION['register'] = "failed";
            }
        }else{
            $_SESSION['register'] = "failed";
        }
        if(!headers_sent()){
           header("Location:".base_url.'usuario/registro');
        }        
    }
    
    public function login(){
        if(isset($_POST)){
            //Identificar usuario
            //hacer una consulta 
            $usuario = new Usuario();
            $usuario->setEmail($_POST['email']);
            $usuario->setPassword($_POST['password']);
            
            $identity=$usuario ->login();
            
            if($identity && is_object($identity)){
                $_SESSION['identity'] = $identity;
                
                if($identity->rol == 'admin'){
                    $_SESSION['admin'] = true;
                }
            }else{
                $_SESSION['error_login'] = 'Identificacion fallida !';
            }
            
            //var_dump($identity);
            //die();
            //Crear una session
        }

        if(!headers_sent()){
            header("Location:".base_url);
        }        
    }
    
    public function logout(){
        
        if(isset($_SESSION['identity'])){
            unset($_SESSION['identity']);
        }
        if(isset($_SESSION['admin'])){
            unset($_SESSION['admin']);
        }
        
        if(!headers_sent()){
            header("Location:".base_url);
        } else {
            echo
            '<script>
                window.location.href="http://localhost/Tienda/";
                //window.location.href="https://washingtonnieto.com/Tienda/";
                //window.location.href="https://elpalaciodemisangelitos.com/Tienda/";
             </script>';
            
        }        
        
//        if (!headers_sent($filename, $linenum)) {
//            header("Location:".base_url);
//            exit;
//
//        // Lo más probable es generar un error aquí.
//        } else {
//
//            echo "Headers already sent in $filename on line $linenum\n" .
//                  "Cannot redirect, for now please click this <a " .
//                  "href=\"http://localhost/Tienda\">link</a> instead\n";
//        exit;
//        }

        
        
        

    }
}
