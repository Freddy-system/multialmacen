<?php
    class ClubData {
        public static $tablename = "club";
        public $id;
        public $nombre;
        public $texto1;
        public $texto2;
        public $texto3;
        public $texto4;
        public $texto5;
        public $texto6;
        public $estado;
        public $fecha;
        public $count;
        public $total;
        public function registro(){
            $sql = "insert into ".self::$tablename." (nombre,texto1,texto2,texto3,texto4,texto5,texto6,estado,fecha) ";
            $sql .= "value (\"$this->nombre\",\"$this->texto1\",\"$this->texto2\",\"$this->texto3\",\"$this->texto4\",\"$this->texto5\",\"$this->texto6\",1,NOW())";
            return Executor::doit($sql);
        }
        public function actualizar(){
            $sql = "update ".self::$tablename." set sucursal=\"$this->sucursal\",nombre=\"$this->nombre\",descripcion=\"$this->descripcion\",duplicidad=\"$this->duplicidad\",estado=\"$this->estado\" where id=$this->id";
           return Executor::doit($sql);
        }
        public static function verid($id){
            $sql = "select * from ".self::$tablename." where id=$id";
            $query = Executor::doit($sql);
            return Model::one($query[0],new ClubData());
        }
        public function eliminar(){
            $sql = "delete from ".self::$tablename." where id=$this->id";
            Executor::doit($sql);
        }
        public static function duplicidad($nombre){
        $sql = "select * from ".self::$tablename." where nombre=\"$nombre\"";
        $query = Executor::doit($sql);
        $array = array();
        $cnt = 0;
        while($r = $query[0]->fetch_array()){
            $array[$cnt] = new ClubData();
            $array[$cnt]->nombre = $r['nombre'];
            $cnt++;
            }
            return $array;
        }
        public static function vercontenido(){
            $sql = "select * from ".self::$tablename;
            $query = Executor::doit($sql);
            return Model::many($query[0],new ClubData());
        }
        public static function vercontenidos($compra){
            $sql = "select * from ".self::$tablename;
            $query = Executor::doit($sql);
            return Model::many($query[0],new ClubData());
        }
        public static function vercontenidoPaginado($start, $length, $search = ''){
            $sql = "SELECT c.* FROM ".self::$tablename;
            $sql .= " c ";
            if ($search) {
                $sql .= " WHERE c.nombre LIKE '%$search%'";
            }
            $sql .= " LIMIT $start, $length";
            $query = Executor::doit($sql);
            return Model::many($query[0], new ClubData());
        }
        public static function totalRegistro(){
            $sql = "select COUNT(*) as total from ".self::$tablename;
            $query = Executor::doit($sql);
            $result = Model::one($query[0], new ClubData());
            return $result->total;
        }
        public static function totalRegistrosFiltrados($search){
            $sql = "select COUNT(*) as total from ".self::$tablename;
            if ($search) {
                $sql .= " WHERE nombre LIKE '%$search%'";
            }
            $query = Executor::doit($sql);
            $result = Model::one($query[0], new ClubData());
            return $result->total;
        }
    }
?>