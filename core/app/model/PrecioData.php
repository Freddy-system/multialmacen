<?php
class PrecioData {
    public static $tablename = "precio";
        public $id;
        public $articulo;
        public $unidad;
        public $cantidad;
        public $tipo;
        public $precio;
        public $comision;
        public $moneda;
        public $estado;
        public $duplicidad;
        public $count;
        public $total;
        public $precioc;
        public $presentaciones;
        public $sucursales;
        public function registro(){
            $sql = "insert into ".self::$tablename." (articulo,cantidad,tipo,precio,comision,estado,duplicidad,unidad,precioc) ";
            $sql .= "value (\"$this->articulo\",\"$this->cantidad\",\"$this->tipo\",\"$this->precio\",\"$this->comision\",1,\"$this->duplicidad\",\"$this->unidad\",\"$this->precioc\")";
            return Executor::doit($sql);
        }
        public function compra(){
            $sql = "insert into ".self::$tablename." (producto,cantidad,duplicidad,estado,precioc,presentacion,moneda) ";
            $sql .= "value (\"$this->producto\",\"$this->cantidad\",\"$this->duplicidad\",1,\"$this->precioc\",\"$this->presentacion\",\"$this->moneda\")";
            return Executor::doit($sql);
        }
        public function actualizar(){
            $sql = "update ".self::$tablename." set cantidad=\"$this->cantidad\", tipo=\"$this->tipo\", comision=\"$this->comision\", estado=\"$this->estado\", precio=\"$this->precio\", unidad=\"$this->unidad\" where id=$this->id";
            Executor::doit($sql);
        }
        public static function verid($id){
            $sql = "select * from ".self::$tablename." where id=$id";
            $query = Executor::doit($sql);
            return Model::one($query[0],new PrecioData());
        }
        public function eliminar(){
            $sql = "delete from ".self::$tablename." where id=$this->id";
            Executor::doit($sql);
        }
        public static function vercontenido(){
            $sql = "select * from ".self::$tablename;
            $query = Executor::doit($sql);
            return Model::many($query[0],new PrecioData());
        }
        public static function vercontenidocompra($producto){
            $sql = "SELECT moneda FROM ".self::$tablename." WHERE producto = $producto ORDER BY id DESC LIMIT 1";
            $query = Executor::doit($sql);
            return Model::many($query[0],new PrecioData());
        }
        public static function vercontenidoporprodcuto($producto){
            $sql = "select p.*, p1.nombre as presentaciones from ".self::$tablename." p JOIN unidad p1 ON p1.id=p.unidad where p.articulo=$producto ";
            $query = Executor::doit($sql);
            return Model::many($query[0],new PrecioData());
        }
        public static function vercontenidoporproductoventa($producto){
            $sql = "select p.*, p1.nombre as presentaciones from ".self::$tablename." p JOIN presentacion p1 ON p1.id=p.presentacion where p.producto=$producto and p.estado=1 ORDER BY p.id DESC ";
            $query = Executor::doit($sql);
            return Model::many($query[0],new PrecioData());
        }
        public static function duplicidadd($duplicidad){
        $sql = "select * from ".self::$tablename." where duplicidad=\"$duplicidad\"";
        $query = Executor::doit($sql);
        $array = array();
        $cnt = 0;
        while($r = $query[0]->fetch_array()){
            $array[$cnt] = new PrecioData();
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
        public static function vercontenidoPaginado($start, $length, $articulo, $search = ''){
            $sql = "SELECT p.* FROM ".self::$tablename;
            $sql .= " p where p.articulo=$articulo";
            if ($search) {
                $sql .= " AND p.tipo LIKE '%$search%'";
            }
            $sql .= " LIMIT $start, $length";
            $query = Executor::doit($sql);
            return Model::many($query[0], new PrecioData());
        }

        public static function totalRegistro(){
            $sql = "select COUNT(*) as total from ".self::$tablename;
            $query = Executor::doit($sql);
            $result = Model::one($query[0], new PrecioData());
            return $result->total;
        }
        public static function totalRegistrosFiltrados($search){
            $sql = "select COUNT(*) as total from ".self::$tablename;
            if ($search) {
                $sql .= " WHERE tipo LIKE '%$search%'";
            }
            $query = Executor::doit($sql);
            $result = Model::one($query[0], new PrecioData());
            return $result->total;
        }
    }
?>