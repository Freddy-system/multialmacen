<?php
class ProcesoData {
    public static $tablename = "proceso";
        public $id;
        public $proveedor;
        public $numerofacfoli;
        public $almacen;
        public $unidad;
        public $tipocompra;
        public $articulo;
        public $cantidad;
        public $precio;
        public $adelanto;
        public $venta;
        public $compra;
        public $usuario;
        public $accion;
        public $estado;
        public $count;
        public $total;

        public $nombre;
        public $categoria;
        public $preciocompra;
        public $precio1;
        public $precio2;
        public $precio3;
        public $imagen;
        public $codigo;
        public $fecha;
        public $descripcion;


        public $categorias;
        public $cantidad_disponible;
        public $producto_id;
        public $id_almacen;
        public $nombre_almacen;
        public $total_almacen;
        public $articulos;
        public $unidades;
        public $resposable;
        public $proveedores;
        public $almacenes;
        public $cantidad_unidad;
        public function compra(){
            $sql = "insert into ".self::$tablename." (proveedor,numerofacfoli,almacen,unidad,tipocompra,articulo,cantidad,precio,adelanto,compra,usuario,estado,accion,fecha) ";
            $sql .= "value (\"$this->proveedor\",\"$this->numerofacfoli\",\"$this->almacen\",\"$this->unidad\",\"$this->tipocompra\",\"$this->articulo\",\"$this->cantidad\",\"$this->precio\",\"$this->adelanto\",\"$this->compra\",\"$this->usuario\",\"$this->estado\",1,NOW())";
            return Executor::doit($sql);
        }
        public function venta(){
            $sql = "insert into ".self::$tablename." (almacen,unidad,articulo,cantidad,precio,venta,usuario,estado,accion,fecha) ";
            $sql .= "value (\"$this->almacen\",\"$this->unidad\",\"$this->articulo\",\"$this->cantidad\",\"$this->precio\",\"$this->venta\",\"$this->usuario\",1,2,NOW())";
            return Executor::doit($sql);
        }
        public function actualizar(){
            $sql = "update ".self::$tablename." set nombre=\"$this->nombre\", contacto=\"$this->contacto\", direccion=\"$this->direccion\", telefono=\"$this->telefono\", email=\"$this->email\", cp=\"$this->cp\", estado=\"$this->estado\", rfc=\"$this->rfc\", limitecredito=\"$this->limitecredito\", observaciones=\"$this->observaciones\", diascredito=\"$this->diascredito\" where id=$this->id";
            Executor::doit($sql);
        }
        public function validandocomprasporpagar(){
            $sql = "update ".self::$tablename." set adelanto=\"$this->adelanto\", estado=\"$this->estado\" where id=$this->id";
            Executor::doit($sql);
        }
        public static function verid($id){
            $sql = "select c.*, CONCAT(u.nombre, ', ', u.apellido) as resposable, a.nombre as articulos, un.nombre as unidades, p.nombre as proveedores, al.nombre as almacenes from ".self::$tablename." c JOIN articulo a ON a.id=c.articulo JOIN usuario u ON u.id=c.usuario JOIN unidad un ON un.id=c.unidad JOIN persona p ON p.id=c.proveedor JOIN almacen al ON al.id=c.almacen where c.id=$id";
            $query = Executor::doit($sql);
            return Model::one($query[0],new ProcesoData());
        }
        public static function verventa($venta){
            $sql = "select * from proceso where venta=$venta";
            $query = Executor::doit($sql);
            return Model::many($query[0],new ProcesoData());
        }
        public function eliminar(){
            $sql = "delete from ".self::$tablename." where id=$this->id";
            Executor::doit($sql);
        }
        public static function vercontenido(){
            $sql = "select * from ".self::$tablename;
            $query = Executor::doit($sql);
            return Model::many($query[0],new ProcesoData());
        }
        public static function vercontenidoprecio($articulo){
            $sql = "select * from ".self::$tablename." where articulo=$articulo and accion=1 order by id desc ";
            $query = Executor::doit($sql);
            return Model::many($query[0],new ProcesoData());
        }
        public static function vercontenidos($compra){
            $sql = "select p.*, ca.nombre as categorias, a.nombre as articulos, u.nombre as unidades, pe.nombre as resposable, al.nombre as almacenes, pre.cantidad as cantidad_unidad from ".self::$tablename." p JOIN articulo a ON a.id=p.articulo JOIN categoria ca ON ca.id=a.categoria LEFT JOIN precio pre ON pre.id=p.unidad JOIN persona pe ON pe.id=p.proveedor JOIN almacen al ON al.id=p.almacen JOIN unidad u ON u.id=pre.unidad where p.compra=$compra ";
            $query = Executor::doit($sql);
            return Model::many($query[0],new ProcesoData());
        }
        public static function vercontenidos1($venta){
            $sql = "select p.*, ca.nombre as categorias, a.nombre as articulos, u.nombre as unidades, al.nombre as almacenes, pre.cantidad as cantidad_unidad from ".self::$tablename." p JOIN articulo a ON a.id=p.articulo JOIN categoria ca ON ca.id=a.categoria LEFT JOIN precio pre ON pre.id=p.unidad  JOIN almacen al ON al.id=p.almacen JOIN unidad u ON u.id=pre.unidad where p.venta=$venta ";
            $query = Executor::doit($sql);
            return Model::many($query[0],new ProcesoData());
        }

        public static function duplicidad($nombre){
        $sql = "select * from ".self::$tablename." where nombre=\"$nombre\"";
        $query = Executor::doit($sql);
        $array = array();
        $cnt = 0;
        while($r = $query[0]->fetch_array()){
            $array[$cnt] = new ProcesoData();
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
            $sql = "SELECT a.*, ca.nombre as categorias, ";
            $sql .= "(COALESCE((SELECT SUM(p.cantidad)  WHERE p.articulo = a.id), 0) - ";
            $sql .= "COALESCE((SELECT SUM(p.cantidad) WHERE p.articulo = a.id), 0)) as cantidad_disponible ";
            $sql .= "FROM ".self::$tablename." p ";
            $sql .= "LEFT JOIN articulo a ON a.id=p.articulo ";
            $sql .= "LEFT JOIN categoria ca ON ca.id=a.categoria ";
            if ($search) {
                $sql .= "WHERE a.nombre LIKE '%$search%' ";
            }
            $sql .= "GROUP BY p.id, a.nombre, ca.nombre ";
            $sql .= "LIMIT $start, $length";
            $query = Executor::doit($sql);
            return Model::many($query[0], new ProcesoData());
        }
        public static function totalRegistro(){
            $sql = "select COUNT(*) as total from ".self::$tablename;
            $query = Executor::doit($sql);
            $result = Model::one($query[0], new ProcesoData());
            return $result->total;
        }
        public static function totalRegistrosFiltrados($search){
            $sql = "select COUNT(*) as total from ".self::$tablename;
            if ($search) {
                $sql .= " WHERE nombre LIKE '%$search%'";
            }
            $query = Executor::doit($sql);
            $result = Model::one($query[0], new ProcesoData());
            return $result->total;
        }
        public static function cantidadporalmacen($id){
            $sql = "SELECT
                a.id AS id_almacen,
                a.nombre AS nombre_almacen,
                p.articulo AS producto_id,
                SUM(CASE WHEN p.accion = 1 THEN p.cantidad ELSE 0 END) -
                SUM(CASE WHEN p.accion = 2 THEN p.cantidad ELSE 0 END) AS total_almacen
            FROM
                proceso p
            JOIN
                almacen a ON p.almacen = a.id
            WHERE
                p.articulo = $id
            GROUP BY
                p.almacen, p.articulo ";
            $query = Executor::doit($sql);
            return Model::many($query[0], new ProcesoData());
        }
        public static function cantidadTotalProducto($id) {
            $sql = "SELECT
                        p.articulo AS producto_id,
                        SUM(CASE WHEN p.accion = 1 THEN p.cantidad ELSE 0 END) -
                        SUM(CASE WHEN p.accion = 2 THEN p.cantidad ELSE 0 END) AS total
                    FROM
                        proceso p
                    WHERE
                        p.articulo = $id";
            $query = Executor::doit($sql);
            return Model::one($query[0], new ProcesoData());
        }
        public static function vercontenidoPaginado1($start, $length, $search = ''){
            $sql = "SELECT c.*, CONCAT(u.nombre, ', ', u.apellido) as resposable, a.nombre as articulos, uni.nombre as unidades, p.nombre as proveedores, al.nombre as almacenes, pre.cantidad as cantidad_unidad  FROM ".self::$tablename;
            $sql .= " c JOIN articulo a ON a.id=c.articulo JOIN usuario u ON u.id=c.usuario JOIN precio pre ON pre.id=c.unidad JOIN persona p ON p.id=c.proveedor JOIN almacen al ON al.id=c.almacen JOIN unidad uni ON uni.id=pre.unidad WHERE c.accion=1 AND c.tipocompra='credito' ";
            if ($search) {
                $sql .= " AND a.nombre LIKE '%$search%'  OR  p.nombre LIKE '%$search%' ";
            }
            $sql .= " ORDER BY c.id DESC";
            $sql .= " LIMIT $start, $length";
            $query = Executor::doit($sql);
            return Model::many($query[0], new ProcesoData());
        }
        public static function totalRegistro1(){
            $sql = "select COUNT(*) as total from ".self::$tablename." c JOIN articulo a ON a.id=c.articulo JOIN usuario u ON u.id=c.usuario JOIN unidad un ON un.id=c.unidad JOIN persona p ON p.id=c.proveedor JOIN almacen al ON al.id=c.almacen WHERE c.accion=1 AND c.tipocompra='credito'";
            $query = Executor::doit($sql);
            $result = Model::one($query[0], new ProcesoData());
            return $result->total;
        }
        public static function totalRegistrosFiltrados1($search){
            $sql = "select COUNT(*) as total from ".self::$tablename." c JOIN articulo a ON a.id=c.articulo JOIN usuario u ON u.id=c.usuario JOIN unidad un ON un.id=c.unidad JOIN persona p ON p.id=c.proveedor JOIN almacen al ON al.id=c.almacen WHERE c.accion=1 AND c.tipocompra='credito'";
            if ($search) {
                $sql .= " AND a.nombre LIKE '%$search%'   OR  p.nombre LIKE '%$search%' ";
            }
            $query = Executor::doit($sql);
            $result = Model::one($query[0], new ProcesoData());
            return $result->total;
        }
    }
?>