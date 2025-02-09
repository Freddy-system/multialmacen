<?php
    class EquipoData {
        public static $tablename = "equipo";
        public $id;
        public $club;
        public $nombre;
        public $categoria;
        public $capitan;
        public $nacimiento1;
        public $subcapitan;
        public $nacimiento2;
        public $descripcion;
        public $duplicidad;
        public $estado;
        public $fecha;
        public $capitanes;
        public $subcapitanes;
        public $clubes;
        public $count;
        public $total;
        public function registro(){
            $sql = "insert into ".self::$tablename." (club,nombre,categoria,capitan,subcapitan,descripcion,estado,fecha,duplicidad) ";
            $sql .= "value (\"$this->club\",\"$this->nombre\",\"$this->categoria\",\"$this->capitan\",\"$this->subcapitan\",\"$this->descripcion\",1,NOW(),\"$this->duplicidad\")";
            return Executor::doit($sql);
        }
        // public function actualizar(){
        //     $sql = "update ".self::$tablename." set club=\"$this->club\",estado=\"$this->estado\",nombre=\"$this->nombre\",categoria=\"$this->categoria\",capitan=\"$this->capitan\",subcapitan=\"$this->subcapitan\",descripcion=\"$this->descripcion\" where id=$this->id";
        //    return Executor::doit($sql);
        // }
        public function actualizar() {
            $subcapitanValue = ($this->subcapitan === "" || $this->subcapitan === "0") ? "NULL" : "\"$this->subcapitan\"";
            $sql = "update ".self::$tablename." set club=\"$this->club\",estado=\"$this->estado\",nombre=\"$this->nombre\",categoria=\"$this->categoria\",capitan=\"$this->capitan\",subcapitan=$subcapitanValue,descripcion=\"$this->descripcion\" where id=$this->id";
            return Executor::doit($sql);
        }
        public static function verid($id){
            $sql = "select * from ".self::$tablename." where id=$id";
            $query = Executor::doit($sql);
            return Model::one($query[0],new EquipoData());
        }
        public function eliminar(){
            $sql = "delete from ".self::$tablename." where id=$this->id";
            Executor::doit($sql);
        }
        public static function duplicidad($duplicidad){
        $sql = "select * from ".self::$tablename." where duplicidad=\"$duplicidad\"";
        $query = Executor::doit($sql);
        $array = array();
        $cnt = 0;
        while($r = $query[0]->fetch_array()){
            $array[$cnt] = new EquipoData();
            $array[$cnt]->duplicidad = $r['duplicidad'];
            $cnt++;
            }
            return $array;
        }
        public static function evitarladuplicidad($duplicidad, $id){
            $sql = "select * from ".self::$tablename." where duplicidad=\"$duplicidad\" AND id!=\"$id\"";
            $query = Executor::doit($sql);
            $result = $query[0]->fetch_array();
            if($result){
                return true;
            }else{
                return false;
            }
        }
        public static function vercontenido(){
            $sql = "select * from ".self::$tablename;
            $query = Executor::doit($sql);
            return Model::many($query[0],new EquipoData());
        }
        public static function vercontenidos($compra){
            $sql = "select * from ".self::$tablename;
            $query = Executor::doit($sql);
            return Model::many($query[0],new EquipoData());
        }
        public static function vercontenidoPaginado($start, $length, $search = ''){
            $sql = "SELECT c.*, CONCAT(u.nombre, ', ', u.apellido) as capitanes, CONCAT(us.nombre, ', ', us.apellido) as subcapitanes, cl.nombre as clubes FROM ".self::$tablename;
            $sql .= " c JOIN usuario u ON u.id=c.capitan LEFT JOIN usuario us ON us.id=c.subcapitan JOIN club cl ON cl.id=c.club ";
            if ($search) {
                $sql .= " WHERE c.nombre LIKE '%$search%'";
            }
            $sql .= " LIMIT $start, $length";
            $query = Executor::doit($sql);
            return Model::many($query[0], new EquipoData());
        }
        public static function totalRegistro(){
            $sql = "select COUNT(*) as total from ".self::$tablename;
            $query = Executor::doit($sql);
            $result = Model::one($query[0], new EquipoData());
            return $result->total;
        }
        public static function totalRegistrosFiltrados($search){
            $sql = "select COUNT(*) as total from ".self::$tablename;
            if ($search) {
                $sql .= " WHERE nombre LIKE '%$search%'";
            }
            $query = Executor::doit($sql);
            $result = Model::one($query[0], new EquipoData());
            return $result->total;
        }
    }
?>