<?php
class AlmacenData {
    public static $tablename = "almacen";
        public $id;
        public $nombre;
        public $responsable;
        public $count;
        public $total;
        public $descripcion;
        public function registro(){
            $sql = "insert into ".self::$tablename." (nombre,descripcion) ";
            $sql .= "value (\"$this->nombre\",\"$this->descripcion\")";
            return Executor::doit($sql);
        }
        public function actualizar(){
            $sql = "update ".self::$tablename." set nombre=\"$this->nombre\", descripcion=\"$this->descripcion\" where id=$this->id";
            Executor::doit($sql);
        }
        public static function verid($id){
            $sql = "select * from ".self::$tablename." where id=$id";
            $query = Executor::doit($sql);
            return Model::one($query[0],new AlmacenData());
        }
        public function eliminar(){
            $sql = "delete from ".self::$tablename." where id=$this->id";
            Executor::doit($sql);
        }
        public static function vercontenido(){
            $sql = "select * from ".self::$tablename;
            $query = Executor::doit($sql);
            return Model::many($query[0],new AlmacenData());
        }
        public static function duplicidad($nombre){
        $sql = "select * from ".self::$tablename." where nombre=\"$nombre\"";
        $query = Executor::doit($sql);
        $array = array();
        $cnt = 0;
        while($r = $query[0]->fetch_array()){
            $array[$cnt] = new AlmacenData();
            $array[$cnt]->nombre = $r['nombre'];
            $cnt++;
            }
            return $array;
        }
        public static function evitarladuplicidad($nombre, $id){
            $sql = "select * from ".self::$tablename." where nombre=\"$nombre\" AND id!=\"$id\"";
            $query = Executor::doit($sql);
            $result = $query[0]->fetch_array();
            if($result){
                return true;
            }else{
                return false;
            }
        }
    }
?>