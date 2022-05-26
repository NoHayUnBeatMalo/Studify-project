<?php
class HomeModel extends Query{
    public function __construct()
    {
        parent::__construct();
    }
    public function registrar($evento, $descripcion, $fechainicio, $fechafin, $color, $idusuario){
        $sql = "INSERT INTO calendario (title, descripcion, start, end, color) VALUES (?, ?, ?, ?, ?) WHERE calendario.idusuario=?";
        $array = array($evento, $descripcion, $fechainicio, $fechafin, $color, $idusuario);
        $data = $this->save($sql, $array);
        if($data == 1){
            $msg = 1;
        }else{
            $msg = 0;
        }
        return $msg;

    }
    public function listarEventos($idusuario){
        $sql = "SELECT * FROM calendario WHERE idusuario=?";
        $array = array($idusuario);
        return $this->save($sql, $array);
        

    }
    public function eliminar($id, $idusuario){
        $sql = "DELETE FROM calendario WHERE `calendario`.`idevento` =? AND `calendario`.`idusuario` =?";
        $array = array($id, $idusuario);
        $data = $this->save($sql, $array);
        if($data == 1){
            $msg = 1;
        }else{
            $msg = 0;
        }
        return $msg;
        

    }
    public function modificar($evento, $descripcion, $fechainicio, $fechafin, $color, $id, $idusuario){
        $sql = "UPDATE calendario SET title=?, descripcion=?, start=?, end=?, color=? WHERE idevento=? AND calendario.idusuario INNER JOIN usuarios.idusuario=?";
        $array = array($evento, $descripcion, $fechainicio, $fechafin, $color, $id, $idusuario);
        $data = $this->save($sql, $array);
        if($data == 1){
            $msg = 1;
        }else{
            $msg = 0;
        }
        return $msg;

    }
    public function drop($fechainicio, $fechafin, $id, $idusuario){
        $sql = "UPDATE calendario SET start=?, end=? WHERE idevento=? AND idusuario=?";
        $array = array($fechainicio, $fechafin, $id, $idusuario);
        $data = $this->save($sql, $array);
        if($data == 1){
            $msg = 1;
        }else{
            $msg = 0;
        }
        return $msg;

    }
}

?>