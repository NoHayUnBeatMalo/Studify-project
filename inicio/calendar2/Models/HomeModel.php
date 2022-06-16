<?php
class HomeModel extends Query{
    public function __construct()
    {
        parent::__construct();
    }
    public function registrar($title, $inicio, $color, $idusuario)
    {
        $sql = "INSERT INTO calendario (title, start, color, idusuario) VALUES (?,?,?,?)";
        $array = array($title, $inicio, $color, $idusuario);
        $data = $this->save($sql, $array);
        if ($data == 1) {
            $res = 'ok';
        }else{
            $res = 'error';
        }
        return $res;
    }
    public function getEventos($idusuario)
    {
        $sql = "SELECT * FROM calendario WHERE idusuario=?";
        return $this->selectAll($sql);
    }
    public function modificar($title, $inicio, $color, $id, $idusuario)
    {
        $sql = "UPDATE calendario SET title=?, start=?, color=? WHERE idevento=? AND idusuario=?";
        $array = array($title, $inicio, $color, $id, $idusuario);
        $data = $this->save($sql, $array);
        if ($data == 1) {
            $res = 'ok';
        } else {
            $res = 'error';
        }
        return $res;
    }
    public function eliminar($id)
    {
        $sql = "DELETE FROM calendario WHERE idevento=?";
        $array = array($id);
        $data = $this->save($sql, $array);
        if ($data == 1) {
            $res = 'ok';
        } else {
            $res = 'error';
        }
        return $res;
    }
    public function dragOver($start, $id)
    {
        $sql = "UPDATE calendario SET start=? WHERE idevento=?";
        $array = array($start, $id);
        $data = $this->save($sql, $array);
        if ($data == 1) {
            $res = 'ok';
        } else {
            $res = 'error';
        }
        return $res;
    }
}
 
?>