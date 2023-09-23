<?php 
    require_once "Config/Config.php";
    $ruta = !empty($_GET['url']) ? $_GET['url'] : "Home/index";
    $arr = explode("/", $ruta);
    $controller = $arr[0];
    $metodo = "index";
    $parametro = "";
    if (!empty($arr[1])){
        if(!empty($arr[1] != "")){
            $metodo = $arr[1];
        }
    }
    if(!empty($arr[2])){
        if(!empty($arr[2] != "")){
            for ($i=2; $i < count($arr); $i++){
                $parametro .= $arr[$i]. ",";
            }
            $parametro = trim($parametro, ",");
        }
    }
    require_once "Config/App/autoload.php";
    $dirControllers = "Controllers/".$controller.".php";
    if(file_exists($dirControllers)){
        require_once $dirControllers;
        $controller = new $controller();
        if(method_exists($controller, $metodo)){
            $controller->$metodo($parametro);
        }else{
            echo "No existe el metodo";
        }
    }else{
        echo "No existe el controlador";
    }
?>