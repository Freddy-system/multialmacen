<?php
class VentaData {
    public static $tablename = "venta";

        public $id;
        public $subtotal;
        public $descuento;
        public $igv;
        public $adelanto;
        public $comprobante;
        public $factura;
        public $descripcion;
        public $cliente;
        public $numerofacfoli;
        public $almacen;
        public $cantidad;
        public $unidad;
        public $precio;
        public $importe;
        public $venta;
        public $total;
        public $fecha;
        public $estado;
        public $pendiente;
        public $usuario;
        public $accion;
        public $tipoventa;
        public $count;
        public $sucursales;
        public $clientes;
        public $usuarios;
        public function registro(){
            $sql = "insert into ".self::$tablename." (subtotal,descuento,igv,total,tipoventa,adelanto,comprobante,accion,factura,cliente,descripcion,usuario,estado,fecha) ";
            $sql .= "value (\"$this->subtotal\",\"$this->descuento\",\"$this->igv\",\"$this->total\",\"$this->tipoventa\",\"$this->adelanto\",\"$this->comprobante\",\"$this->accion\",\"$this->factura\",\"$this->cliente\",\"$this->descripcion\",\"$this->usuario\",\"$this->estado\",NOW())";
            return Executor::doit($sql);
        }
        public function actualizar(){
            $sql = "update ".self::$tablename." set nombre=\"$this->nombre\", contacto=\"$this->contacto\", direccion=\"$this->direccion\", telefono=\"$this->telefono\", email=\"$this->email\", cp=\"$this->cp\", estado=\"$this->estado\", rfc=\"$this->rfc\", limitecredito=\"$this->limitecredito\", observaciones=\"$this->observaciones\", diascredito=\"$this->diascredito\" where id=$this->id";
            Executor::doit($sql);
        }
        public function validarventaporcobrar(){
            $sql = "update ".self::$tablename." set adelanto=\"$this->adelanto\", estado=\"$this->estado\" where id=$this->id";
            Executor::doit($sql);
        }
        public function cotizacion_venta(){
            $sql = "update ".self::$tablename." set accion=\"$this->accion\" where id=$this->id";
            Executor::doit($sql);
        }
        public static function verid($id){
            $sql = "select c.*, cl.nombre as clientes, CONCAT(u.nombre, ', ', u.apellido) as usuarios from ".self::$tablename." c LEFT JOIN persona cl ON cl.id=c.cliente JOIN usuario u ON u.id=c.usuario where c.id=$id";
            $query = Executor::doit($sql);
            return Model::one($query[0],new VentaData());
        }
        public function eliminar(){
            $sql = "delete from ".self::$tablename." where id=$this->id";
            Executor::doit($sql);
        } 
        public function eliminarDetalleVenta() {
            $sql = "DELETE FROM ".self::$tablename." WHERE id=$this->id";
            Executor::doit($sql);
        }
        public static function vercontenido(){
            $sql = "select * from ".self::$tablename;
            $query = Executor::doit($sql);
            return Model::many($query[0],new VentaData());
        }
        public static function duplicidad($nombre){
        $sql = "select * from ".self::$tablename." where nombre=\"$nombre\"";
        $query = Executor::doit($sql);
        $array = array();
        $cnt = 0;
        while($r = $query[0]->fetch_array()){
            $array[$cnt] = new VentaData();
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
        public static function vercontenidoPaginado($start, $length, $search = '') {
            $sql = "SELECT c.*, cl.nombre as clientes, CONCAT(u.nombre, ', ', u.apellido) as usuarios FROM " . self::$tablename;
            $sql .= " c LEFT JOIN persona cl ON cl.id=c.cliente JOIN usuario u ON u.id=c.usuario WHERE c.accion=1";
            if ($search) {
                $sql .= " AND cl.nombre LIKE '%$search%'";
            }
            $sql .= " ORDER BY c.id DESC";
            $sql .= " LIMIT $start, $length";
            $query = Executor::doit($sql);
            return Model::many($query[0], new VentaData());
        }
        public static function totalRegistro(){
            $sql = "select COUNT(*) as total from ".self::$tablename." WHERE accion=1 ";
            $query = Executor::doit($sql);
            $result = Model::one($query[0], new VentaData());
            return $result->total;
        }
        public static function totalRegistrosFiltrados($search){
            $sql = "select COUNT(*) as total from ".self::$tablename." WHERE accion=1 ";
            if ($search) {
                $sql .= " WHERE cliente LIKE '%$search%'";
            }
            $query = Executor::doit($sql);
            $result = Model::one($query[0], new VentaData());
            return $result->total;
        }
        public static function vercontenidoPaginado1($start, $length, $search = '') {
            $sql = "SELECT c.*, cl.nombre as clientes, CONCAT(u.nombre, ', ', u.apellido) as usuarios FROM " . self::$tablename;
            $sql .= " c LEFT JOIN persona cl ON cl.id=c.cliente JOIN usuario u ON u.id=c.usuario WHERE c.accion=2";
            if ($search) {
                $sql .= " WHERE cl.nombre LIKE '%$search%'";
            }
            $sql .= " ORDER BY c.id DESC";
            $sql .= " LIMIT $start, $length";
            $query = Executor::doit($sql);
            return Model::many($query[0], new VentaData());
        }
        public static function totalRegistro1(){
            $sql = "select COUNT(*) as total from ".self::$tablename." WHERE accion=2 ";
            $query = Executor::doit($sql);
            $result = Model::one($query[0], new VentaData());
            return $result->total;
        }
        public static function totalRegistrosFiltrados1($search){
            $sql = "select COUNT(*) as total from ".self::$tablename." WHERE accion=2 ";
            if ($search) {
                $sql .= " WHERE cliente LIKE '%$search%'";
            }
            $query = Executor::doit($sql);
            $result = Model::one($query[0], new VentaData());
            return $result->total;
        }
        public static function vercontenidoPaginado2($start, $length, $search = '') {
            $sql = "SELECT c.*, cl.nombre as clientes, CONCAT(u.nombre, ', ', u.apellido) as usuarios FROM " . self::$tablename;
            $sql .= " c LEFT JOIN persona cl ON cl.id=c.cliente JOIN usuario u ON u.id=c.usuario WHERE c.accion=1 and c.estado=1";
            if ($search) {
                $sql .= " AND cl.nombre LIKE '%$search%'";
            }
            $sql .= " ORDER BY c.id DESC";
            $sql .= " LIMIT $start, $length";
            $query = Executor::doit($sql);
            return Model::many($query[0], new VentaData());
        }
        public static function totalRegistro2(){
            $sql = "select COUNT(*) as total from ".self::$tablename." WHERE accion=1 and estado=1 ";
            $query = Executor::doit($sql);
            $result = Model::one($query[0], new VentaData());
            return $result->total;
        }
        public static function totalRegistrosFiltrados2($search){
            $sql = "select COUNT(*) as total from ".self::$tablename." WHERE accion=1 and estado=1 ";
            if ($search) {
                $sql .= " AND cliente LIKE '%$search%'";
            }
            $query = Executor::doit($sql);
            $result = Model::one($query[0], new VentaData());
            return $result->total;
        }
    }
?>