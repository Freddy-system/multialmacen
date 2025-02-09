<?php
class ClienteData {
    public static $tablename = "persona";
        public $id;
        public $nombre;
        public $contacto;
        public $direccion;
        public $telefono;
        public $email;
        public $cp;
        public $estado;
        public $rfc;
        public $diascredito;
        public $limitecredito;
        public $observaciones;
        public $fecha;
        public $count;
        public $total;
        public $sucursales;
        public function registro(){
            $sql = "insert into ".self::$tablename." (nombre,contacto,direccion,telefono,email,cp,estado,rfc,limitecredito,observaciones,diascredito,fecha) ";
            $sql .= "value (\"$this->nombre\",\"$this->contacto\",\"$this->direccion\",\"$this->telefono\",\"$this->email\",\"$this->cp\",1,\"$this->rfc\",\"$this->limitecredito\",\"$this->observaciones\",\"$this->diascredito\",NOW())";
            return Executor::doit($sql);
        }
        public function actualizar(){
            $sql = "update ".self::$tablename." set nombre=\"$this->nombre\", contacto=\"$this->contacto\", direccion=\"$this->direccion\", telefono=\"$this->telefono\", email=\"$this->email\", cp=\"$this->cp\", estado=\"$this->estado\", rfc=\"$this->rfc\", limitecredito=\"$this->limitecredito\", observaciones=\"$this->observaciones\", diascredito=\"$this->diascredito\" where id=$this->id";
            Executor::doit($sql);
        }
        public static function verid($id){
            $sql = "select * from ".self::$tablename." where id=$id";
            $query = Executor::doit($sql);
            return Model::one($query[0],new ClienteData());
        }
        public function eliminar(){
            $sql = "delete from ".self::$tablename." where id=$this->id";
            Executor::doit($sql);
        }
        public static function vercontenido(){
            $sql = "select * from ".self::$tablename;
            $query = Executor::doit($sql);
            return Model::many($query[0],new ClienteData());
        }
        public static function duplicidad($nombre){
        $sql = "select * from ".self::$tablename." where nombre=\"$nombre\"";
        $query = Executor::doit($sql);
        $array = array();
        $cnt = 0;
        while($r = $query[0]->fetch_array()){
            $array[$cnt] = new ClienteData();
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
        public static function reporte1($desde, $hasta){
            $desde = date('Y-m-d', strtotime($desde));
            $hasta = date('Y-m-d', strtotime($hasta));

            if($desde == $hasta){
                $sql = " select a.* from ".self::$tablename." a   
                        WHERE date(a.fecha) = '$desde' 
                        ORDER BY a.fecha DESC";
            } else {
                $sql = " select a.* from  ".self::$tablename."  a  
                        WHERE date(a.fecha) >= '$desde' AND date(a.fecha) <= '$hasta' 
                        ORDER BY a.fecha DESC";
            }

            $query = Executor::doit($sql);
            return Model::many($query[0],new ClienteData());
        }
    }
?>