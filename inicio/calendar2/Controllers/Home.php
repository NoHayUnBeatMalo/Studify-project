<?php
session_start();
if (!isset($_SESSION['S_IDUSUARIO'])) {
    header('Location: ../login/index.php');
}


class Home extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->views->getView($this, 'index');
    }
    public function registrar()
    {
        if (empty($_POST['title']) || empty($_POST['start']) || empty($_POST['color'])) {
            $mensaje = array('msg' => 'Los campos evento, fecha de inicio y color son requeridos', 'estado' => false, 'tipo' => 'warning');
        } else {
            $evento = $_POST['title'];
            $descripcion = $_POST['description'];
            $fechaInicio = $_POST['start'];
            $fechaFin = $_POST['end'];
            $color = $_POST['color'];
            $idusuario = $_POST['idusuario'];
            echo $idusuario;
            $id = $_POST['id'];
            if ($id == '') {

                $insertar = array($evento, $descripcion, $fechaInicio, $fechaFin, $color, $idusuario);
                $respuesta = $this->model->registrar($insertar);
                if ($respuesta == 1) {
                    $msg = array('msg' => 'Evento registrado correctamente', 'estado' => true, 'tipo' => 'success');
                } else {
                    $msg = array('msg' => 'No se ha podido registrar el evento', 'estado' => false, 'tipo' => 'error');
                }
            } else {
                $insertar = array($evento, $descripcion, $fechaInicio, $fechaFin, $color, $id, $idusuario);
                $respuesta = $this->model->modificar($insertar);
                if ($respuesta == 1) {
                    $msg = array('msg' => 'Evento modificado correctamente', 'estado' => true, 'tipo' => 'success');
                } else {
                    $msg = array('msg' => 'No se ha podido modificar el evento', 'estado' => false, 'tipo' => 'error');
                }
            }
            echo json_encode($msg);
            die();
        }
    }
    public function listar()
    {
        $data = $this->model->listarEventos();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar($id)
    {
        $data = $this->model->eliminar($id);
        if ($data == 1) {
            $msg = array('msg' => 'Evento eliminado correctamente', 'estado' => true, 'tipo' => 'success');
        } else {
            $msg = array('msg' => 'No se ha podido eliminar el evento', 'estado' => false, 'tipo' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function drop()
    {
        $fecha = $_POST['fecha'];
        $id = $_POST['id'];
        $data = $this->model->drop($fecha, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Evento modificado correctamente', 'estado' => true, 'tipo' => 'success');
        } else {
            $msg = array('msg' => 'No se ha podido modificar el evento', 'estado' => false, 'tipo' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}
