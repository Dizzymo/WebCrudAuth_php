<?php

class ClientesModel extends Query{
    private $rut, $nombre, $telefono, $direccion, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }

    public function getClientes(){
        $sql = "SELECT * FROM clientes;";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarCliente(string $rut, string $nombre, string $telefono, string $direccion){
        $this->rut = $rut;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $verificar = "SELECT * FROM clientes WHERE rut = '$this->rut' ";
        $existe = $this->select($verificar);
        if(empty($existe)){
            $sql = "INSERT INTO clientes(rut, nombre, telefono, direccion) VALUES (?,?,?,?);";
            $datos = array($this->rut,$this->nombre,$this->telefono,$this->direccion);
            $data = $this->save($sql, $datos);
            if ($data == 1) {
                $res = "ok";
            }else{
                $res = "error";
            }
        }else{
            $res = "existe";
        }
        return $res;
    }

    public function modificarCliente(string $rut, string $nombre, string $telefono,string $direccion, int $id)
    {
        $this->rut = $rut;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->id = $id;

         
        $sql = "UPDATE clientes SET rut = ?, nombre = ?, telefono = ? , direccion = ? WHERE id = ?;";
        $datos = array($this->rut,$this->nombre,$this->telefono,$this->direccion,$this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        }else{
            $res = "error";
        }
 
        return $res;
    }

    public function editarCli(int $id){
        $sql = "SELECT * FROM clientes WHERE id = $id;";
        $data = $this->select($sql);
        return $data;
    }
    public function accionCli(int $estado,int $id)
    {
        $this->estado = $estado;
        $this->id = $id;
        $sql = "UPDATE clientes SET estado = ? WHERE id = ?;";
        $datos = array($this->estado,$this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }
}

?>