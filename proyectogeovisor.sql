-- Active: 1729519566808@@127.0.0.1@5432@proyectogeovisor
CREATE DATABASE proyectogeovisor;



CREATE TABLE roles (
  rol_id SERIAL PRIMARY KEY,
  rol_nombre VARCHAR(50) NOT NULL
);

INSERT INTO roles ( rol_nombre) 
VALUES 
( 'Administrador'),
( 'Funcionario'),
( 'Ciudadano');

CREATE TABLE tipoDeDocumento (
  td_id SERIAL PRIMARY KEY,
  td_nombre VARCHAR(50) NOT NULL
);

INSERT INTO tipoDeDocumento (td_nombre) 
VALUES 
('Cédula de Ciudadanía'),
('Tarjeta de Identidad'),
('Registro Civil'),
('Pasaporte'),
('Cédula de Extranjería');

CREATE TABLE tipo_via (
  tv_id SERIAL PRIMARY KEY,
  tv_nombre VARCHAR(50) NOT NULL
);

INSERT INTO tipo_via (tv_nombre) 
VALUES 
('Calle'),
('Carrera'),
('Avenida'),
('Diagonal'),
('Transversal'),
('Circular'),
('Paseo'),
('Bulevar'),
('Autopista'),
('Carretera'),
('Camino'),
('Sendero'),
('Pasaje'),
('Callejón'),
('Plaza');

CREATE TABLE barrios (
  id_barrio SERIAL PRIMARY KEY,
  nombre_barrio VARCHAR(100) NOT NULL,
  comuna INTEGER NOT NULL
);

INSERT INTO barrios (nombre_barrio, comuna) 
VALUES 
('Ulpiano Lloreda', 13),
('Charco Azul', 13),
('Ciudad Córdoba', 13),
('Lleras Restrepo I', 13),
('Lleras Restrepo II', 13),
('Ricardo Bálcázar', 13),
('José Manuel', 13),
('Marroquín III', 13),
('Omar Torrijos', 13),
('Rodrigo Lara Bonilla', 13),
('Los Comuneros II', 13),
('Los Lagos', 13),
('Los Robles', 13),
('Calipso', 13),
('San Carlos', 13),
('Yira Castro', 13),
('El Pondaje', 13),
('Villa Blanca', 13),
('El Lago', 13),
('Villa del Lago', 13),
('Nuevo Horizonte', 13),
('La Paz', 13),
('Los Lagos II', 13),
('El Diamante', 13);


CREATE TABLE usuarios (
  usu_id SERIAL PRIMARY KEY,
  usu_td INTEGER NOT NULL,
  usu_numeroDocumento VARCHAR(20) UNIQUE NOT NULL,
  usu_nombre VARCHAR(50) NOT NULL,
  usu_apellido VARCHAR(50) NOT NULL,
  usu_password VARCHAR(255) NOT NULL,
  usu_correo VARCHAR(100) UNIQUE NOT NULL,
  usu_telefono VARCHAR(20) NOT NULL,
  usu_tipo_via INTEGER,              -- Ejemplo: Calle, Carrera, Avenida
  usu_numero_via INT NOT NULL,                   -- Número de la vía principal
  usu_tipo_via_interseccion INTEGER,          -- Ejemplo: Carrera, Diagonal (opcional)
  usu_numero_interseccion INT,                    -- Número de la vía secundaria (opcional)
  usu_numero_adicional VARCHAR(10),               -- Número adicional (opcional)
  usu_barrio INTEGER,                  -- Barrio o sector (opcional)
  usu_complemento VARCHAR(100),
  usu_rol INTEGER NOT NULL,
  Foreign Key (usu_tipo_via) REFERENCES tipo_via(tv_id),
  Foreign Key (usu_tipo_via_interseccion) REFERENCES tipo_via(tv_id),
  Foreign Key (usu_barrio) REFERENCES barrios(id_barrio),
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

CREATE TABLE estados (
  id_estado SERIAL PRIMARY KEY,
  nombre_estado VARCHAR(50) NOT NULL,
  tabla_pertenece VARCHAR(50)
);

INSERT INTO estados (nombre_estado, tabla_pertenece) 
VALUES 
('Habilitada', 'usuario'),
('Inhabilitada', 'usuario');

-- Fecha del accidente
-- ✓ Dirección – coordenadas Accidente.
-- ✓ Clase vehículos involucrados:Automóvil, bus, buseta, camión,
-- camioneta, campero, microbús, tractocamión, volqueta,
-- motocicleta, bicicleta, motocarro, cuatrimoto.
-- ✓ Tipo de choque:
-- ▪ Colisión entre vehículos (carro con carro, carro con moto,
-- bus con bicicleta, etc.).
-- ▪ Colisión con objeto fijo (poste, señal de tránsito, árbol,
-- etc.).
-- ▪ Atropello (peatón, animal).
-- ▪ volcamiento.
-- ▪ Otro (con espacio para especificar).
-- ✓ Imagen. (Formato JPG, JPEG, PNG).
-- ✓ Lesionados.(Abarca cualquier persona que haya sido afectada
-- físicamente en un accidente, ya sea un peatón, conductor,
-- pasajero u ocupante de un vehículo).
-- ✓ Observación. (Espacio para colocar información relevante del
-- accidente reportado).

CREATE TABLE tipo_choque (
  id_tipo_choque SERIAL PRIMARY KEY,
  nombre_tipo_choque VARCHAR(50) NOT NULL
);

INSERT INTO tipo_choque (nombre_tipo_choque) 
VALUES 
('Colisión entre vehículos'),
('Colisión con objeto fijo'),
('Atropello'),
('Volcamiento'),
('Otro');

CREATE TABLE subtipo_choque (
  id_subtipo_choque SERIAL PRIMARY KEY,
  id_tipo_choque INTEGER NOT NULL,
  nombre_subtipo_choque VARCHAR(100) NOT NULL,
  FOREIGN KEY (id_tipo_choque) REFERENCES tipo_choque(id_tipo_choque)
);

INSERT INTO subtipo_choque (id_tipo_choque, nombre_subtipo_choque) 
VALUES 
(1, 'Carro con carro'),
(1, 'Carro con moto'),
(1, 'Moto con moto'),
(1, 'Bus con bicicleta'),
(2, 'Poste'),
(2, 'Señal de tránsito'),
(2, 'Árbol'),
(3, 'Peatón'),
(3, 'Animal'),
(4, 'Volcamiento'),
(5, 'Otro');

CREATE TABLE clase_vehiculos (
  id_clase_vehiculo SERIAL PRIMARY KEY,
  nombre_clase_vehiculo VARCHAR(50) NOT NULL
);

INSERT INTO clase_vehiculos (nombre_clase_vehiculo) 
VALUES 
('Automóvil'),
('Bus'),
('Buseta'),
('Camión'),
('Camioneta'),
('Campero'),
('Microbús'),
('Tractocamión'),
('Volqueta'),
('Motocicleta'),
('Bicicleta'),
('Motocarro'),
('Cuatrimoto');