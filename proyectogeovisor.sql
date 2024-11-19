-- Active: 1730128443239@@127.0.0.1@5432@proyectogeovisor
CREATE DATABASE proyectogeovisor;



CREATE TABLE roles (
  rol_id SERIAL PRIMARY KEY,
  rol_nombre VARCHAR(50) NOT NULL
);

CREATE TABLE tipoDeDocumento (
  td_id SERIAL PRIMARY KEY,
  td_nombre VARCHAR(50) NOT NULL
);

CREATE TABLE usuarios (
  usu_id SERIAL PRIMARY KEY,
  usu_td INTEGER NOT NULL,
  usu_numeroDocumento VARCHAR(20) UNIQUE NOT NULL,
  usu_nombre VARCHAR(50) NOT NULL,
  usu_apellido VARCHAR(50) NOT NULL,
  usu_password VARCHAR(255) NOT NULL,
  usu_correo VARCHAR(100) UNIQUE NOT NULL,
  usu_telefono VARCHAR(20) NOT NULL,
  usu_direccion VARCHAR(255) NOT NULL,
  usu_rol INTEGER NOT NULL,
  Foreign Key (usu_td) REFERENCES tipoDeDocumento(td_id),
  FOREIGN KEY (usu_rol) REFERENCES roles(rol_id)
);

CREATE TABLE solicitudes (
  id_solicitud SERIAL PRIMARY KEY,
  tipo_solicitud VARCHAR(50) NOT NULL,
  descripcion TEXT NOT NULL,
  estado INTEGER NOT NULL,
  id_usuario INTEGER NOT NULL,
  fecha_creacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  fecha_actualizacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  coordenadas VARCHAR(100),
  imagen VARCHAR(255),
  FOREIGN KEY (estado) REFERENCES estados_solicitud(id_estado),
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

CREATE TABLE accidentes (
  id_accidente SERIAL PRIMARY KEY,
  gravedad VARCHAR(50) NOT NULL,
  lugar VARCHAR(255) NOT NULL,
  fecha DATE NOT NULL,
  hora TIME NOT NULL,
  clase VARCHAR(50),
  descripcion TEXT,
  id_solicitud INTEGER NOT NULL,
  FOREIGN KEY (id_solicitud) REFERENCES solicitudes(id_solicitud)
);

CREATE TABLE senalizaciones (
  id_senal SERIAL PRIMARY KEY,
  tipo VARCHAR(50) NOT NULL,
  categoria VARCHAR(50),
  estado VARCHAR(50) NOT NULL,
  direccion VARCHAR(255) NOT NULL,
  descripcion TEXT,
  imagen VARCHAR(255),
  id_solicitud INTEGER NOT NULL,
  FOREIGN KEY (id_solicitud) REFERENCES solicitudes(id_solicitud)
);

CREATE TABLE reductores_velocidad (
  id_reductor SERIAL PRIMARY KEY,
  categoria VARCHAR(50),
  tipo VARCHAR(50) NOT NULL,
  estado VARCHAR(50) NOT NULL,
  descripcion TEXT,
  direccion VARCHAR(255) NOT NULL,
  imagen VARCHAR(255),
  id_solicitud INTEGER NOT NULL,
  FOREIGN KEY (id_solicitud) REFERENCES solicitudes(id_solicitud)
);

CREATE TABLE vias_publicas (
  id_via SERIAL PRIMARY KEY,
  tipo_danio VARCHAR(50),
  descripcion TEXT,
  direccion VARCHAR(255) NOT NULL,
  imagen VARCHAR(255),
  id_solicitud INTEGER NOT NULL,
  FOREIGN KEY (id_solicitud) REFERENCES solicitudes(id_solicitud)
);

CREATE TABLE reportes (
  id_reporte SERIAL PRIMARY KEY,
  tipo_reporte VARCHAR(50) NOT NULL,
  id_solicitud INTEGER NOT NULL,
  fecha_generacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  archivo VARCHAR(255),
  FOREIGN KEY (id_solicitud) REFERENCES solicitudes(id_solicitud)
);

CREATE TABLE roles (
  id_rol SERIAL PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL
);

CREATE TABLE estados_solicitud (
  id_estado SERIAL PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL
);

CREATE TABLE clima (
  id_clima SERIAL PRIMARY KEY,
  descripcion TEXT,
  temperatura DECIMAL(5, 2),
  fecha_hora TIMESTAMP NOT NULL,
  coordenadas VARCHAR(100)
);

CREATE TABLE tipo_accidente (
  id_tipo SERIAL PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL
);

CREATE TABLE vehiculos (
  id_vehiculo SERIAL PRIMARY KEY,
  tipo VARCHAR(50) NOT NULL,
  marca VARCHAR(50) NOT NULL,
  modelo VARCHAR(50) NOT NULL,
  placa VARCHAR(20) UNIQUE NOT NULL,
  id_accidente INTEGER NOT NULL,
  FOREIGN KEY (id_accidente) REFERENCES accidentes(id_accidente)
);

CREATE TABLE victimas (
  id_victima SERIAL PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL,
  edad INTEGER NOT NULL,
  condicion VARCHAR(50),
  id_accidente INTEGER NOT NULL,
  FOREIGN KEY (id_accidente) REFERENCES accidentes(id_accidente)
);

CREATE TABLE pqrs (
  id_pqrs SERIAL PRIMARY KEY,
  tipo VARCHAR(50) NOT NULL,
  mensaje TEXT NOT NULL,
  fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  id_usuario INTEGER NOT NULL,
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

CREATE TABLE geovisor (
  id_capa SERIAL PRIMARY KEY,
  nombre_capa VARCHAR(100) NOT NULL,
  descripcion TEXT,
  archivo VARCHAR(255),
  fecha_carga TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);