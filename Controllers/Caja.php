<?php
class Caja extends Controller{
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
        $data = $this->model->getCaja();
        for ($i=0; $i < count($data); $i++) { 
            if($data[$i]['estado'] == 1){
                $data[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
                $data[$i]['acciones'] = '<div>
                                        <button class="btn btn-primary" onclick="btnEditarCaja('.$data[$i]['id'].');" type="button"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger" onclick="btnEliminarCaja('.$data[$i]['id'].');" type="button"><i class="fas fa-trash-alt"></i></button>
                                        </div>';
            }else{
                $data[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                
                <button class="btn btn-success" onclick="btnReingresarCaja('.$data[$i]['id'].');" type="button">Reingresar</button>
                </div>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
     
  
    public function registrar(){
        $caja = $_POST['caja'];
        $estado = $_POST['estado'];
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        // encriptar 
        if(empty($caja) || empty($estado)){
            $msg = "Todos los campos son obligatorios";
        }else{
            if($id == "" || $id == null){
                 
                $data = $this->model->registrarCaja($caja, $estado);
                
                if ($data == "ok") {
                    $msg = "si";
                }else if($data == "existe"){
                    $msg = "La Caja ya existe";
                }else{
                    $msg = "Error al registrar caja";
                }
            }else{
                $data = $this->model->modificarCaja($caja, $estado,$id);
                if ($data == "modificado") {
                    $msg = "modificado";
                }else{
                    $msg = "Error al modificar caja";
                }
            }

        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar(int $id){
        $data = $this->model->editarCaja($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar(int $id){
        $data = $this->model->accionCaja(0,$id);
        if ($data == 1) {
            $msg = "ok";
        }else{
            $msg = "Error al eliminar cliente";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
 
    }
    public function reingresar(int $id){
        $data = $this->model->accionCaja(1,$id);
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