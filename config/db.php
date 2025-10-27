<?php

class Database{
    public static function connect(){
        //local
        $db = new mysqli('localhost','root','','tienda');
        //remoto Washington-Tienda
        //$db = new mysqli('localhost','u762499790_root','e4O/!dJ=:','u762499790_tienda');
        //remoto Angelitos-Tienda
        //$db = new mysqli('localhost','u762499790_admin','Palacio2022*','u762499790_angelitos');
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
}