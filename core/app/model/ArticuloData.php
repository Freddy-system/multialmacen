<?php
class ArticuloData {
    public static $tablename = "articulo";
        public $id;
        public $nombre;
        public $categoria;
        public $marca;
        public $serie;
        public $modelo;
        public $estado;
        public $color;
        public $descripcion;
        public $vencimiento;
        public $par;
        public $talla;
        public $imagen;
        public $codigo;
        public $fecha;
        public $count;
        public $total;
        public $categorias;
        public $cantidad_disponible;
        public $producto_id;
        public function registro(){
            $sql = "insert into ".self::$tablename." (nombre,categoria,marca,serie,modelo,color,estado,vencimiento,talla,par,imagen,codigo,descripcion,fecha) ";
            $sql .= "value (\"$this->nombre\",\"$this->categoria\",\"$this->marca\",\"$this->serie\",\"$this->modelo\",\"$this->color\",\"$this->estado\",\"$this->vencimiento\",\"$this->talla\",\"$this->par\",\"$this->imagen\",\"$this->codigo\",\"$this->descripcion\",NOW())";
            return Executor::doit($sql);
        }
        public function actualizar(){
            $sql = "update ".self::$tablename." set nombre=\"$this->nombre\", categoria=\"$this->categoria\", marca=\"$this->marca\", serie=\"$this->serie\", modelo=\"$this->modelo\", color=\"$this->color\", estado=\"$this->estado\", vencimiento=\"$this->vencimiento\", talla=\"$this->talla\", par=\"$this->par\", descripcion=\"$this->descripcion\", imagen=\"$this->imagen\", codigo=\"$this->codigo\" where id=$this->id";
            Executor::doit($sql);
        }
        public static function verid($id){
            $sql = "select * from ".self::$tablename." where id=$id";
            $query = Executor::doit($sql);
            return Model::one($query[0],new ArticuloData());
        }
        public function eliminar(){
            $sql = "delete from ".self::$tablename." where id=$this->id";
            Executor::doit($sql);
        }
        public static function vercontenido(){
            $sql = "select a.*, c.nombre as categorias from ".self::$tablename." a JOIN categoria c ON c.id=a.categoria";
            $query = Executor::doit($sql);
            return Model::many($query[0],new ArticuloData());
        }
        public static function duplicidad($codigo){
        $sql = "select * from ".self::$tablename." where codigo=\"$codigo\"";
        $query = Executor::doit($sql);
        $array = array();
        $cnt = 0;
        while($r = $query[0]->fetch_array()){
            $array[$cnt] = new ArticuloData();
            $array[$cnt]->codigo = $r['codigo'];
            $cnt++;
            }
            return $array;
        }
        public static function evitarladuplicidad($codigo, $id){
            $sql = "select * from ".self::$tablename." where codigo=\"$codigo\" AND id!=\"$id\"";
            $query = Executor::doit($sql);
            $result = $query[0]->fetch_array();
            if($result){
                return true;
            }else{
                return false;
            }
        }
        public static function vercontenidoPaginado($start, $length, $search = ''){
            $sql = "SELECT a.*, c.nombre as categorias  FROM ".self::$tablename;
            $sql .= " a JOIN categoria c ON c.id=a.categoria  ";
            if ($search) {
                $sql .= " WHERE a.nombre LIKE '%$search%' OR a.precio1 LIKE '%$search%'";
            }
            $sql .= " LIMIT $start, $length";
            $query = Executor::doit($sql);
            return Model::many($query[0], new ArticuloData());
        }
        public static function totalRegistro(){
            $sql = "select COUNT(*) as total from ".self::$tablename;
            $query = Executor::doit($sql);
            $result = Model::one($query[0], new ArticuloData());
            return $result->total;
        }
        public static function totalRegistrosFiltrados($search){
            $sql = "select COUNT(*) as total from ".self::$tablename;
            if ($search) {
                $sql .= " WHERE nombre LIKE '%$search%' OR precio1 LIKE '%$search%'";
            }
            $query = Executor::doit($sql);
            $result = Model::one($query[0], new ArticuloData());
            return $result->total;
        }
        // **************+
        public static function vercontenidoPaginado1($start, $length, $search = '') {
            $sql = "SELECT a.*, ca.nombre as categorias, ";
            $sql .= "(COALESCE((SELECT SUM(p1.cantidad) FROM proceso p1 WHERE p1.articulo = a.id AND p1.accion = 1), 0) - ";
            $sql .= "COALESCE((SELECT SUM(p2.cantidad) FROM proceso p2 WHERE p2.articulo = a.id AND p2.accion = 2), 0)) as cantidad_disponible ";
            $sql .= "FROM articulo a ";
            $sql .= "LEFT JOIN categoria ca ON ca.id = a.categoria ";
            if (!empty($search)) {
                $sql .= "WHERE a.nombre LIKE '%$search%' ";
            }
            $sql .= "GROUP BY a.id "; // Corregido aquí: usar 'a.id' en lugar de 'p.id'
            $sql .= "LIMIT $start, $length";
            $query = Executor::doit($sql);
            return Model::many($query[0], new ArticuloData());
        }
        public static function totalRegistro1(){
            $sql = "select COUNT(*) as total from ".self::$tablename;
            $query = Executor::doit($sql);
            $result = Model::one($query[0], new ArticuloData());
            return $result->total;
        }
        public static function totalRegistrosFiltrados1($search){
            $sql = "select COUNT(*) as total from ".self::$tablename;
            if ($search) {
                $sql .= " WHERE nombre LIKE '%$search%'";
            }
            $query = Executor::doit($sql);
            $result = Model::one($query[0], new ArticuloData());
            return $result->total;
        }
        public static function reporte1($desde, $hasta){
            $desde = date('Y-m-d', strtotime($desde));
            $hasta = date('Y-m-d', strtotime($hasta));

            if($desde == $hasta){
                $sql = " select a.*, c.nombre as categorias from  ".self::$tablename." a JOIN categoria c ON c.id=a.categoria   
                        WHERE date(a.fecha) = '$desde' 
                        ORDER BY a.fecha DESC";
            } else {
                $sql = " select a.*, c.nombre as categorias from  ".self::$tablename."  a JOIN categoria c ON c.id=a.categoria  
                        WHERE date(a.fecha) >= '$desde' AND date(a.fecha) <= '$hasta' 
                        ORDER BY a.fecha DESC";
            }

            $query = Executor::doit($sql);
            return Model::many($query[0],new ArticuloData());
        }
    }
?>