<?php
class Productos extends Controller{
    public function __construct() {
        session_start();

        parent::__construct();
    }
    public function index(){
        if(empty($_SESSION['activo'])){
            header('location: '.base_url);
        }
        $data['cajas'] = $this->model->getCajas();
        $this->views->getViews($this,"index",$data);
    }
    public function listar(){
        $data = $this->model->getProductos();
        for ($i=0; $i < count($data); $i++) { 
            if($data[$i]['estado'] == 1){
                $data[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" onclick="btnEditarUser('.$data[$i]['id'].');" type="button"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" onclick="btnEliminarUser('.$data[$i]['id'].');" type="button"><i class="fas fa-trash-alt"></i></button>
                
                </div>';
            }else{
                $data[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" onclick="btnReingresarUser('.$data[$i]['id'].');" type="button">Reingresar</button>
                </div>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function validar(){
        if(empty($_POST['Producto']) || empty($_POST['clave'])){
            $msg = "Campos vacios";
        }else{
            $Producto = $_POST['Producto'];
            $clave = $_POST['clave'];
            $hash = hash("SHA256", $clave);
            $data = $this->model->getProducto($Producto, $hash);
            if($data){
                $_SESSION['id_Producto'] = $data['id'];
                $_SESSION['Producto'] = $data['Producto'];
                $_SESSION['nombre'] = $data['nombre'];
                $_SESSION['activo'] = true;
                $msg = "ok";
            }else{
                $msg = "Producto o contraseña incorrecta";
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

  
    public function registrar(){
        $Producto = $_POST['Producto'];
        $nombre = $_POST['nombre'];
        $clave = $_POST['clave'];
        $confirmar = $_POST['confirmar'];
        $caja = $_POST['caja'];
        $id = $_POST['id'];
        // encriptar
        $hash = hash("SHA256", $clave);
        if(empty($Producto) || empty($nombre) || empty($caja)){
            $msg = "Todos los campos son obligatorios";
        }else{
            if($id == ""){
                if($clave != $confirmar){
                    $msg = "Las contraseñas no coinciden";
                }else{
                    $data = $this->model->registrarProducto($Producto, $nombre, $hash, $caja);
                    if ($data == "ok") {
                        $msg = "si";
                    }else if($data == "existe"){
                        $msg = "El Producto ya existe";
                    }else{
                        $msg = "Error al registrar el Producto";
                    }
                }
            }else{
                $data = $this->model->modificarProducto($Producto, $nombre, $caja, $id);
                if ($data == "modificado") {
                    $msg = "modificado";
                }else{
                    $msg = "Error al modificar el Producto";
                }
            }

        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar(int $id){
        $data = $this->model->editarUser($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar(int $id){
        $data = $this->model->accionUser(0,$id);
        if ($data == 1) {
            $msg = "ok";
        }else{
            $msg = "Error al eliminar Producto";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
        // $data = $this->model->eliminarUser($id);
        // echo json_encode($data, JSON_UNESCAPED_UNICODE);
        // die();
    }
    public function reingresar(int $id){
        $data = $this->model->accionUser(1,$id);
        if ($data == 1) {
            $msg = "ok";
        }else{
            $msg = "Error al eliminar Producto";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
        // $data = $this->model->eliminarUser($id);
        // echo json_encode($data, JSON_UNESCAPED_UNICODE);
        // die();
    }
    public function salir(){
        session_destroy();
        header('location: '.base_url);
    }
}
?>
