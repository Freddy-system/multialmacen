<?php
class UserData {
    public static $tablename = "usuario";
    public $id;
    public $nombre;
    public $apellido;
    public $tipodocumento;
    public $documento;
    public $direccion;
    public $telefono;
    public $email;
    public $cargo;
    public $usuario;
    public $password;
    public $estado;
    public $imagen;
    public $sexo;
    public $permiso;
    public $fecha;

    public $count;
    public $total;
    public $cargos;

        public function registro(){
                $sql = "insert into ".self::$tablename." (cargo, nombre, apellido, documento, telefono, email, imagen, tipodocumento, fecha, estado, usuario, password, direccion) ";
                $sql .= "value (\"$this->cargo\",\"$this->nombre\",\"$this->apellido\",\"$this->documento\",\"$this->telefono\",\"$this->email\",\"$this->imagen\",\"$this->tipodocumento\",NOW(),1,\"$this->usuario\",\"$this->password\",\"$this->direccion\")";
                return Executor::doit($sql);
            }
        public function actualizar(){
            $sql = "update ".self::$tablename." set nombre=\"$this->nombre\",apellido=\"$this->apellido\",documento=\"$this->documento\",telefono=\"$this->telefono\",email=\"$this->email\",tipodocumento=\"$this->tipodocumento\",cargo=\"$this->cargo\",direccion=\"$this->direccion\",imagen=\"$this->imagen\",estado=\"$this->estado\"  where id=$this->id";
           return Executor::doit($sql);
        }
        public function actualizarusuario(){
            $sql = "update ".self::$tablename." set usuario=\"$this->usuario\"  where id=$this->id";
           return Executor::doit($sql);
        }
        public function actualizarpassword(){
            $sql = "update ".self::$tablename." set password=\"$this->password\"  where id=$this->id";
           return Executor::doit($sql);
        }
        public static function verid($id){
                $sql = "select * from ".self::$tablename." where id=$id";
                $query = Executor::doit($sql);
                return Model::one($query[0],new UserData());
            }
        public function eliminar(){
            $sql = "delete from ".self::$tablename." where id=$this->id";
            Executor::doit($sql);
        }
        public static function duplicidad($documento){
            $sql = "select * from ".self::$tablename." where documento=\"$documento\"";
            $query = Executor::doit($sql);
            $array = array();
            $cnt = 0;
            while($r = $query[0]->fetch_array()){
                $array[$cnt] = new UserData();
                $array[$cnt]->documento = $r['documento'];
                $cnt++;
                }
                return $array;
        }
        public static function getDNI($rut, $excludeId = null) {
            $sql = "SELECT * FROM ".self::$tablename." WHERE rut = ?";  
            $params = [$rut];
            if ($excludeId !== null) {
                $sql .= " AND id != ?"; 
                $params[] = $excludeId;
            }
            $query = Executor::doit($sql, $params);
            $numRows = $query->num_rows;
            return $numRows > 0;
        }
        public static function vercontenido(){
            $sql = "select u.*, c.nombre as cargos from ".self::$tablename." u  LEFT JOIN cargo c ON c.id=u.cargo ";
            $query = Executor::doit($sql);
            return Model::many($query[0],new UserData());
        }
        public static function evitarladuplicidad($documento, $id){
            $sql = "select * from ".self::$tablename." where documento=\"$documento\" AND id!=\"$id\"";
            $query = Executor::doit($sql);
            $result = $query[0]->fetch_array();
            if($result){
                return true;
            }else{
                return false;
            }
        }
        public static function vercontenidoPaginado($start, $length, $search = ''){
            $sql = "SELECT u.*, c.nombre as cargos, cl.nombre as clubs FROM ".self::$tablename;
            $sql .= " u LEFT JOIN cargo c ON c.id=u.cargo LEFT JOIN club cl ON cl.id=u.club ";
            if ($search) {
                $sql .= " WHERE u.nombre LIKE '%$search%' OR u.documento LIKE '%$search%'";
            }
            $sql .= " LIMIT $start, $length";
            $query = Executor::doit($sql);
            return Model::many($query[0], new UserData());
        }
        public static function totalRegistro(){
            $sql = "select COUNT(*) as total from ".self::$tablename;
            $query = Executor::doit($sql);
            $result = Model::one($query[0], new UserData());
            return $result->total;
        }
        public static function totalRegistrosFiltrados($search){
            $sql = "select COUNT(*) as total from ".self::$tablename;
            if ($search) {
                $sql .= " WHERE nombre LIKE '%$search%' OR documento LIKE '%$search%'";
            }
            $query = Executor::doit($sql);
            $result = Model::one($query[0], new UserData());
            return $result->total;
        }
    }
?>