create database inventario;
	use inventario;
	set sql_mode='';

	create table cargo(
		id int primary key auto_increment not null,
		nombre varchar(500));
	insert into cargo (nombre) values ("Administrador"),("Subadministrador"),("Encargado");
	
	create table usuario(
		id int primary key auto_increment not null,
		nombre varchar(200),
		apellido varchar(200),
		tipodocumento varchar(100),
		documento varchar(20),
		direccion text,
		telefono varchar(15),
		email varchar(255),
		cargo int,
		usuario varchar(255),
		password varchar(255),
		estado boolean default 0,
		imagen text,
		sexo varchar(20),
		permiso int,
		fecha datetime,
		foreign key (cargo) references cargo(id));
	insert into usuario(nombre,apellido,usuario,password,estado,cargo) value("admin","admin","admin","$2y$10$8asrZfSaluo8qKPoMaGdcuEeDucF9ue21hcD820LPLW36q/6gtYMm","1","1");

	create table persona( /* tabla de proveedores y clientes*/
		id int primary key auto_increment not null,
		nombre text,
		contacto text,
		direccion text,
		telefono varchar(15),
		email varchar(200),
		cp varchar(50),
		estado int,
		rfc varchar(200),
		diascredito varchar(200),
		limitecredito varchar(200),
		observaciones text,
		fecha datetime
		);

	create table almacen(
		id int primary key auto_increment not null,
		nombre text,
		responsable int,
		descripcion text,
		foreign key (responsable) references usuario (id)
		);

	create table categoria(
		id int primary key auto_increment not null,
		nombre text,
		descripcion text
		);

	create table unidad(
		id int primary key not null auto_increment,
		nombre text,
		descripcion text);

	create table articulo(
		id int primary key auto_increment not null,
		nombre text,
		categoria int,
		marca text,
		serie text,
		modelo text,
		estado text,
		color text,
		descripcion text,
		vencimiento datetime,
		par float,
		talla float,
		imagen text,
		codigo varchar(200),
		fecha datetime,
		foreign key (categoria) references categoria (id)
		);
	create table precio(
		id int primary key not null auto_increment,
		articulo int,
		unidad int,
		cantidad float,
		tipo varchar(50),
		precio float,
		precioc float,
		comision float,
		moneda text,
		estado int,
		duplicidad text,
		foreign key (articulo) references articulo(id),
		foreign key (unidad) references unidad(id));
	create table compra(
		id int primary key auto_increment not null,
		subtotal float,
		descuento float,
		igv float,
		total float,
		tipocompra float,
		adelanto float,
		pendiente float,
		usuario int,
		estado int default 0,
		fecha datetime
		);
	-- create table compra(
	-- 	id int primary key auto_increment not null,
	-- 	cantidad float,
	-- 	unidad text,
	-- 	precio float,
	-- 	fecha datetime,
	-- 	pendiente float,
	-- 	usuario int,
	-- 	subtotal float,
	-- 	descuento float,
	-- 	igv float,
	-- 	total float,
	-- 	estado int default 0, /* 1 al contado, credito, mixto*/
	-- 	foreign key (proveedor) references persona (id),
	-- 	foreign key (almacen) references almacen (id)
	-- 	);

	create table venta(
		id int primary key auto_increment not null,
		cliente int,
		numerofacfoli varchar(200),
		almacen int,
		cantidad float,
		unidad text,
		precio float,
		importe float,
		venta text,
		total float,
		subtotal float,
		descuento float,
		igv float,
		adelanto float,
		comprobante varchar(200),
		factura varchar(200),
		descripcion text,
		fecha datetime,
		pendiente float,
		usuario int,
		estado int default 0,
		accion int, /* 1 venta normal, 2 cotización */
		tipoventa int, /* 1 al contado, credito, mixto*/
		foreign key (cliente) references persona (id),
		foreign key (almacen) references almacen (id)
		);

	create table abono(
		id int primary key auto_increment not null,
		venta int,
		compra int,
		metodopago varchar(200),
		referencia text,
		importe float,
		abono float,
		saldo float,
		fecha datetime,
		usuario int
		);

	create table proceso(
		id int primary key auto_increment not null,
		proveedor int,
		numerofacfoli varchar(200),
		almacen int,
		unidad int,
		tipocompra text,
		articulo int,
		cantidad float,
		precio float,
		adelanto float,
		total float,
		venta int,
		compra int,
		usuario int,
		accion int, /* 1= ingreso, 2=salida, 3 transferencia*/
		estado int default 0, /*0 pendiente, 1 finalizado con exito, 3 cancelado*/
		fecha datetime,
		foreign key (articulo) references articulo (id)
		);