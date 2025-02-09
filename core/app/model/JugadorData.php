<?php
    class JugadorData {
        public static $tablename = "jugador";
        public $id;
        public $apellido1;
        public $apellido2;
        public $nombre;
        public $nacimiento;
        public $numlicencia;
        public $club;
        public $telefono;
        public $estado;
        public $fecha;
        public $duplicidad;
        public $count;
        public $total;
        public function registro(){
            $sql = "insert into ".self::$tablename." (apellido1,apellido2,nombre,nacimiento,numlicencia,telefono,estado,fecha,duplicidad) ";
            $sql .= "value (\"$this->apellido1\",\"$this->apellido2\",\"$this->nombre\",\"$this->nacimiento\",\"$this->numlicencia\",\"$this->telefono\",1,NOW(),\"$this->duplicidad\")";
            return Executor::doit($sql);
        }
        public function actualizar(){
            $sql = "update ".self::$tablename." set apellido1=\"$this->apellido1\",apellido2=\"$this->apellido2\",nombre=\"$this->nombre\",nacimiento=\"$this->nacimiento\",numlicencia=\"$this->numlicencia\",telefono=\"$this->telefono\",estado=\"$this->estado\",duplicidad=\"$this->duplicidad\" where id=$this->id";
           return Executor::doit($sql);
        }
        public static function verid($id){
            $sql = "select * from ".self::$tablename." where id=$id";
            $query = Executor::doit($sql);
            return Model::one($query[0],new JugadorData());
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
            $array[$cnt] = new JugadorData();
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
            return Model::many($query[0],new JugadorData());
        }
        public static function vercontenidos($compra){
            $sql = "select * from ".self::$tablename;
            $query = Executor::doit($sql);
            return Model::many($query[0],new JugadorData());
        }
        public static function vercontenidoPaginado($start, $length, $search = ''){
            $sql = "SELECT c.* FROM ".self::$tablename;
            $sql .= " c ";
            if ($search) {
                $sql .= " WHERE c.nombre LIKE '%$search%'";
            }
            $sql .= " LIMIT $start, $length";
            $query = Executor::doit($sql);
            return Model::many($query[0], new JugadorData());
        }
        public static function totalRegistro(){
            $sql = "select COUNT(*) as total from ".self::$tablename;
            $query = Executor::doit($sql);
            $result = Model::one($query[0], new JugadorData());
            return $result->total;
        }
        public static function totalRegistrosFiltrados($search){
            $sql = "select COUNT(*) as total from ".self::$tablename;
            if ($search) {
                $sql .= " WHERE nombre LIKE '%$search%'";
            }
            $query = Executor::doit($sql);
            $result = Model::one($query[0], new JugadorData());
            return $result->total;
        }
    }
?>