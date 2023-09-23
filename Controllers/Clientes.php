<?php
class Clientes extends Controller{
    public function __construct() {
        session_start();
        if(empty($_SESSION['activo'])){
            header('location: '.base_url);
        }
        parent::__construct();
    }
    public function index()
    { 
        $this->views->getViews($this,"index");
    }
    public function listar(){
        $data = $this->model->getClientes();
        for ($i=0; $i < count($data); $i++) { 
            if($data[$i]['estado'] == 1){
                $data[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
                $data[$i]['acciones'] = '<div>
                                        <button class="btn btn-primary" onclick="btnEditarCli('.$data[$i]['id'].');" type="button"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger" onclick="btnEliminarCli('.$data[$i]['id'].');" type="button"><i class="fas fa-trash-alt"></i></button>
                                        </div>';
            }else{
                $data[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                
                <button class="btn btn-success" onclick="btnReingresarCli('.$data[$i]['id'].');" type="button">Reingresar</button>
                </div>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
     
  
    public function registrar(){
        $rut = $_POST['rut'];
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $id = $_POST['id'];
        // encriptar 
        if(empty($rut) || empty($nombre) || empty($telefono) || empty($direccion)){
            $msg = "Todos los campos son obligatorios";
        }else{
            if($id == ""){
                 
                $data = $this->model->registrarCliente($rut, $nombre, $telefono, $direccion);
                
                if ($data == "ok") {
                    $msg = "si";
                }else if($data == "existe"){
                    $msg = "El rut ya existe";
                }else{
                    $msg = "Error al registrar el cliente";
                }
            }else{
                $data = $this->model->modificarCliente($rut, $nombre, $telefono, $direccion, $id);
                if ($data == "modificado") {
                    $msg = "modificado";
                }else{
                    $msg = "Error al modificar el cliente";
                }
            }

        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar(int $id){
        $data = $this->model->editarCli($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar(int $id){
        $data = $this->model->accionCli(0,$id);
        if ($data == 1) {
            $msg = "ok";
        }else{
            $msg = "Error al eliminar cliente";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
 
    }
    public function reingresar(int $id){
        $data = $this->model->accionCli(1,$id);
        if ($data == 1) {
            $msg = "ok";
        }else{
            $msg = "Error al eliminar cliente";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
        // $data = $this->model->eliminarUser($id);
        // echo json_encode($data, JSON_UNESCAPED_UNICODE);
        // die();
    }
     
}
?>
