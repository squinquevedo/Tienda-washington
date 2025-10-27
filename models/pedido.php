<?php

class Pedido{
    private $id;
    private $usuario_id;
    private $departamento;
    private $ciudad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;
    private $db;
    
    
    public function __construct(){
        $this->db = Database::connect();
    }


    public function getId() {
        return $this->id;
    }

    public function getUsuario_id() {
        return $this->usuario_id;
    }

    public function getDepartamento() {
        return $this->departamento;
    }

    public function getCiudad() {
        return $this->ciudad;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getCoste() {
        return $this->coste;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getHora() {
        return $this->hora;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setUsuario_id($usuario_id): void {
        $this->usuario_id = $usuario_id;
    }

    public function setDepartamento($departamento): void {
        $this->departamento = $this->db->real_escape_string($departamento);
    }

    public function setCiudad($ciudad): void {
        $this->ciudad = $this->db->real_escape_string($ciudad);
    }

    public function setDireccion($direccion): void {
        $this->direccion = $this->db->real_escape_string($direccion);
    }

    public function setCoste($coste): void {
        $this->coste = $coste;
    }

    public function setEstado($estado): void {
        $this->estado = $estado;
    }

    public function setFecha($fecha): void {
        $this->fecha = $fecha;
    }

    public function setHora($hora): void {
        $this->hora = $hora;
    }

        
    public function getAll(){
        $pedidos = $this->db->query("SELECT * FROM pedidos ORDER BY id DESC");
        return $pedidos;
    }

      public function getOne(){
        $pedidos = $this->db->query("SELECT * FROM pedidos WHERE id = {$this->getId()}");
        return $pedidos->fetch_object(); //lo devuelvo con un fetch para que sea un objeto usable
    }
    
    public function getOneByUser(){
        $sql = "SELECT id, coste FROM pedidos "
                . "WHERE usuario_id = {$this->getUsuario_id()} ORDER BY id DESC LIMIT 1";
                
        $pedido = $this->db->query($sql);               
                //echo $sql;
                //echo $this->db->error;
                //die();
        return $pedido->fetch_object(); //lo devuelvo con un fetch para que sea un objeto usable
    }

    public function getAllByUser(){
            $sql = "SELECT p.* FROM pedidos p "
                            . "WHERE p.usuario_id = {$this->getUsuario_id()} ORDER BY id DESC";

            $pedido = $this->db->query($sql);

            return $pedido;
    }    
    
	public function getProductosByPedido($id){
//		$sql = "SELECT * FROM productos WHERE id IN "
//				. "(SELECT producto_id FROM lineas_pedidos WHERE pedido_id={$id})";
	
		$sql = "SELECT pr.*, lp.unidades FROM productos pr "
				. "INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id "
				. "WHERE lp.pedido_id={$id}";
				
		$productos = $this->db->query($sql);
			
		return $productos;
	}
    
    public function save(){
        $sql = "INSERT INTO pedidos VALUES(NULL, '{$this->getUsuario_id()}','{$this->getDepartamento()}','{$this->getCiudad()}','{$this->getDireccion()}',{$this->getCoste()}, 'confirm', CURDATE(),CURTIME()); ";
        $save = $this->db->query($sql);

        //echo $this->db->error;
        //var_dump($sql);
        //die();
        
        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }
    
    
    public function save_linea(){
        $sql = "SELECT LAST_INSERT_ID() as 'pedido';";
        $query = $this->db->query($sql);
        $pedido_id = $query->fetch_object()->pedido;
 
        //var_dump($pedido_id);
        
        foreach($_SESSION['carrito'] as $elemento){ 
            $producto = $elemento['producto'];
            
            $insert = "INSERT INTO lineas_pedidos VALUE(NULL, {$pedido_id},{$producto->id},{$elemento['unidades']})";
            $save = $this->db->query($insert);
            

//            //para ver porque no inserta linea pedidos
//            var_dump($producto);
//            var_dump($insert);
//            echo $this->db->error;
//            die();
        }
        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }
}