<?php

function controllers_autoload($classname){
    $env = getenv("ENVIRONMENT");
    
    $controller = substr($classname, -10);
    $clase=substr($classname,0, -10);
    
    $classname = ucfirst($clase).ucfirst($controller);
    
    //var_dump(ucfirst($classname));
    //die();
    
    if($env == "produccion"){
        //cargar controladores en produccion
        require_once 'controllers/'.$classname.'.php';
   
    }else{
        //cargar controladores en local

        include 'controllers/'.$classname.'.php';
    }
}

spl_autoload_register('controllers_autoload');