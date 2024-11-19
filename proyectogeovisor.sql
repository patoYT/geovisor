CREATE DATABASE proyectogeovisor;

CREATE TABLE usuarios (
  id SERIAL PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL,
  apellido VARCHAR(50) NOT NULL,
  cedula VARCHAR(20) UNIQUE NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  telefono VARCHAR(20) NOT NULL,
  password VARCHAR(255) NOT NULL,
  creado_en TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE roles (
  id SERIAL PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL
);

CREATE TABLE usuarios_roles (
  usuario_id INTEGER NOT NULL,
  rol_id INTEGER NOT NULL,
  PRIMARY KEY (usuario_id, rol_id),
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
  FOREIGN KEY (rol_id) REFERENCES roles(id)
);

CREATE TABLE usuarios (
  id_usuario SERIAL PRIMARY KEY,
  tipo_documento VARCHAR(50) NOT NULL,
  numero_identificacion VARCHAR(20) UNIQUE NOT NULL,
  nombres VARCHAR(50) NOT NULL,
  apellidos VARCHAR(50) NOT NULL,
  contrasena VARCHAR(255) NOT NULL,
  correo_electronico VARCHAR(100) UNIQUE NOT NULL,
  telefono VARCHAR(20) NOT NULL,
  direccion VARCHAR(255) NOT NULL,
  rol INTEGER NOT NULL,
  FOREIGN KEY (rol) REFERENCES roles(id_rol)
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