<?php
class CompraData {
    public static $tablename = "compra";
        public $id;
        public $subtotal;
        public $descuento;
        public $igv;
        public $tipocompra;
        public $adelanto;
        public $pendiente;
        public $usuario;
        public $estado;
        public $fecha;
        public $count;
        public $total;
        public $sucursales;
        public $responsable;
        public function registro(){
            $sql = "insert into ".self::$tablename." (subtotal,descuento,igv,total,usuario,estado,fecha) ";
            $sql .= "value (\"$this->subtotal\",\"$this->descuento\",\"$this->igv\",\"$this->total\",\"$this->usuario\",1,NOW())";
            return Executor::doit($sql);
        }
        public function actualizar(){
            $sql = "update ".self::$tablename." set nombre=\"$this->nombre\", contacto=\"$this->contacto\", direccion=\"$this->direccion\", telefono=\"$this->telefono\", email=\"$this->email\", cp=\"$this->cp\", estado=\"$this->estado\", rfc=\"$this->rfc\", limitecredito=\"$this->limitecredito\", observaciones=\"$this->observaciones\", diascredito=\"$this->diascredito\" where id=$this->id";
            Executor::doit($sql);
        }
        public static function verid($id){
            $sql = "select c.*, CONCAT(u.nombre, ', ', u.apellido) as responsable from ".self::$tablename." c JOIN usuario u ON u.id=c.usuario where c.id=$id";
            $query = Executor::doit($sql);
            return Model::one($query[0],new CompraData());
        }
        public function eliminar(){
            $sql = "delete from ".self::$tablename." where id=$this->id";
            Executor::doit($sql);
        }
        public static function vercontenido(){
            $sql = "select * from ".self::$tablename;
            $query = Executor::doit($sql);
            return Model::many($query[0],new CompraData());
        }
        public static function duplicidad($nombre){
        $sql = "select * from ".self::$tablename." where nombre=\"$nombre\"";
        $query = Executor::doit($sql);
        $array = array();
        $cnt = 0;
        while($r = $query[0]->fetch_array()){
            $array[$cnt] = new CompraData();
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
        public static function vercontenidoPaginado($start, $length, $search = ''){
            $sql = "SELECT c.*, CONCAT(u.nombre, ', ', u.apellido) as responsable  FROM ".self::$tablename;
            $sql .= " c JOIN usuario u ON u.id=c.usuario ";
            if ($search) {
                $sql .= " WHERE c.descuento LIKE '%$search%'";
            }
            $sql .= " ORDER BY c.id DESC";
            $sql .= " LIMIT $start, $length";
            $query = Executor::doit($sql);
            return Model::many($query[0], new CompraData());
        }
        public static function totalRegistro(){
            $sql = "select COUNT(*) as total from ".self::$tablename;
            $query = Executor::doit($sql);
            $result = Model::one($query[0], new CompraData());
            return $result->total;
        }
        public static function totalRegistrosFiltrados($search){
            $sql = "select COUNT(*) as total from ".self::$tablename;
            if ($search) {
                $sql .= " WHERE descuento LIKE '%$search%'";
            }
            $query = Executor::doit($sql);
            $result = Model::one($query[0], new CompraData());
            return $result->total;
        }
    }
?>