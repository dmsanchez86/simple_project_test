create database if not exists lubricam;
use lubricam;

create table if not exists lubri_usuarios(
  id int primary key auto_increment,
  correo varchar(250) not null unique,
  fecha_nacimiento date,
  nick varchar(250) not null unique,
  nombre varchar(250) not null,
  detalles varchar(500) not null,
  descripcion varchar(500) not null,
  fecha_registro datetime,
  creditos int,
  localidad varchar(200),
  
  password varchar(255) not null,
  semilla varchar(255) not null,
  activo boolean,
  codigo_activacion varchar(255) not null,
  
  id_pais int,
  id_imagen_perfil int,

  foreign key(id_imagen_perfil) references lubri_imagenes(id),
  foreign key(id_pais) references lubri_paises(id)
);
create table if not exists lubri_usuarios_idiomas(
  id_usuario int,
  id_idioma int,
  primary key (id_usuario,id_idioma),

  foreign key(id_usuario) references lubri_usuarios(id),
  foreign key(id_idioma) references lubri_idiomas(id)
);
create table if not exists lubri_usuarios_paises_bloqueados(
  id_usuario int,
  id_pais int,
  primary key (id_usuario,id_pais),

  foreign key(id_usuario) references lubri_usuarios(id),
  foreign key(id_pais) references lubri_paises(id)
);

create table if not exists lubri_imagenes(
  id int primary key auto_increment,
  id_usuario_creador int,
  fecha_creacion datetime,
  precio_tokens int,
  titulo varchar(100),
  descripcion varchar(250),
  url varchar(250),

  foreign key(id_usuario_creador) references lubri_usuarios(id)
);
create table if not exists lubri_registro_creditos_usuarios(
  id_usuario int,
  cantidad int,
  fecha_compra datetime,

  foreign key(id_usuario) references lubri_usuarios(id)
);
create table if not exists lubri_favoritos_usuarios(
  id_usuario_espectador int,
  id_usuario_modelo int,

  foreign key(id_usuario_espectador) references lubri_usuarios(id),
  foreign key(id_usuario_modelo) references lubri_usuarios(id)
);



CREATE TABLE if not exists `lubri_paises` (
  id int primary key auto_increment,
  iso varchar(3) NOT NULL,
  pais_en varchar(150) NOT NULL,
  pais_es varchar(150) NOT NULL
);
create table if not exists lubri_idiomas(
  id int primary key auto_increment,
  codigo varchar(20),
  codigo2 varchar(20),
  descripcion varchar(50),
  original varchar(50)
);
# implementar para un futuro
# create table if not exists lubri_localidad(
# id int primary key auto_increment,
# nombre varchar(250),
# id_pais int,

 # foreign key(id_pais) references lubri_paises(id)
# );

#(SIN IMPLEMENTAR)fotos compradas por los usuarios
create table if not exists lubri_usuario_fotos_compradas(
 id_usuario int,
 id_foto int,
 primary key(id_usuario,id_foto),
 
 foreign key(id_usuario) references lubri_usuarios(id),
 foreign key(id_foto) references lubri_imagenes(id)
  
);