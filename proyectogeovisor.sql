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

CREATE TABLE estados (
  id_estado SERIAL PRIMARY KEY,
  nombre_estado VARCHAR(50) NOT NULL,
  tabla_pertenece VARCHAR(50)
);

INSERT INTO estados (nombre_estado, tabla_pertenece) 
VALUES 
('Habilitada', 'usuario'),
('Inhabilitada', 'usuario');

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


-- Modificar la tabla usuarios para incluir los nuevos campos requeridos
ALTER TABLE usuarios
ADD COLUMN usu_fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
ADD COLUMN usu_fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP;

-- Crear una tabla para los tokens de restablecimiento de contraseña
CREATE TABLE tokens_restablecimiento_contrasena (
  token_id SERIAL PRIMARY KEY,
  usu_id INTEGER NOT NULL,
  token VARCHAR(255) NOT NULL,
  fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  fecha_expiracion TIMESTAMP NOT NULL,
  FOREIGN KEY (usu_id) REFERENCES usuarios(usu_id)
);

-- Crear una tabla para las sesiones de usuario
CREATE TABLE sesiones_usuario (
  sesion_id SERIAL PRIMARY KEY,
  usu_id INTEGER NOT NULL,
  token_sesion VARCHAR(255) NOT NULL,
  fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  fecha_expiracion TIMESTAMP NOT NULL,
  FOREIGN KEY (usu_id) REFERENCES usuarios(usu_id)
);

-- Crear una tabla para los reportes de accidentes
CREATE TABLE reportes_accidentes (
  reporte_id SERIAL PRIMARY KEY,
  usu_id INTEGER NOT NULL,
  fecha_accidente TIMESTAMP NOT NULL,
  direccion TEXT NOT NULL,
  coordenadas POINT NOT NULL,
  tipo_choque INTEGER NOT NULL,
  subtipo_choque INTEGER NOT NULL,
  imagen VARCHAR(255),
  lesionados BOOLEAN NOT NULL,
  observacion TEXT,
  fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (usu_id) REFERENCES usuarios(usu_id),
  FOREIGN KEY (tipo_choque) REFERENCES tipo_choque(id_tipo_choque),
  FOREIGN KEY (subtipo_choque) REFERENCES subtipo_choque(id_subtipo_choque)
);

-- Crear una tabla de unión para los vehículos involucrados en accidentes
CREATE TABLE vehiculos_accidente (
  vehiculo_accidente_id SERIAL PRIMARY KEY,
  reporte_id INTEGER NOT NULL,
  clase_vehiculo INTEGER NOT NULL,
  FOREIGN KEY (reporte_id) REFERENCES reportes_accidentes(reporte_id),
  FOREIGN KEY (clase_vehiculo) REFERENCES clase_vehiculos(id_clase_vehiculo)
);

-- Crear una tabla para las categorías de señales de tránsito
CREATE TABLE categorias_senales_transito (
  categoria_id SERIAL PRIMARY KEY,
  nombre_categoria VARCHAR(50) NOT NULL
);

INSERT INTO categorias_senales_transito (nombre_categoria) 
VALUES 
('Reglamentaria'),
('Informativa'),
('Preventiva');

-- Crear una tabla para los tipos de señales de tránsito
CREATE TABLE tipos_senales_transito (
  tipo_id SERIAL PRIMARY KEY,
  nombre_tipo VARCHAR(50) NOT NULL,
  categoria_id INTEGER NOT NULL,
  FOREIGN KEY (categoria_id) REFERENCES categorias_senales_transito(categoria_id)
);

INSERT INTO tipos_senales_transito (nombre_tipo, categoria_id) 
VALUES 
('Alto', 1),
('Límite de velocidad', 1),
('Ceda el paso', 1),
('Prohibido girar a la izquierda', 1),
('Prohibido girar a la derecha', 1),
('Prohibido estacionar', 1),
('Prohibido el paso', 1),
('Hospital', 2),
('Zona escolar', 2),
('Paradero de autobús', 2),
('Dirección única', 2),
('Calle sin salida', 2),
('Curva peligrosa', 3),
('Reducción de carril', 3),
('Pendiente pronunciada', 3),
('Cruce de peatones', 3);

-- Crear una tabla para los tipos de daños en señales de tránsito
CREATE TABLE tipos_danos_senales (
  dano_id SERIAL PRIMARY KEY,
  nombre_dano VARCHAR(50) NOT NULL
);

INSERT INTO tipos_danos_senales (nombre_dano) 
VALUES 
('Despintada'),
('Deformada'),
('Vandalizada');

-- Crear una tabla para los estados de las solicitudes
CREATE TABLE estados_solicitudes (
  estado_id SERIAL PRIMARY KEY,
  nombre_estado VARCHAR(50) NOT NULL
);

INSERT INTO estados_solicitudes (nombre_estado) 
VALUES 
('Pendiente'),
('En revisión'),
('En proceso'),
('Rechazada'),
('Completada');

-- Crear una tabla para las solicitudes de señales de tránsito
CREATE TABLE solicitudes_senales_transito (
  solicitud_id SERIAL PRIMARY KEY,
  usu_id INTEGER NOT NULL,
  es_nueva_senal BOOLEAN NOT NULL,
  categoria_id INTEGER NOT NULL,
  tipo_id INTEGER NOT NULL,
  descripcion TEXT,
  dano_id INTEGER,
  direccion TEXT NOT NULL,
  imagen VARCHAR(255) NOT NULL,
  estado_id INTEGER NOT NULL,
  fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (usu_id) REFERENCES usuarios(usu_id),
  FOREIGN KEY (categoria_id) REFERENCES categorias_senales_transito(categoria_id),
  FOREIGN KEY (tipo_id) REFERENCES tipos_senales_transito(tipo_id),
  FOREIGN KEY (dano_id) REFERENCES tipos_danos_senales(dano_id),
  FOREIGN KEY (estado_id) REFERENCES estados_solicitudes(estado_id)
);

-- Crear una tabla para las categorías de reductores de velocidad
CREATE TABLE categorias_reductores_velocidad (
  categoria_id SERIAL PRIMARY KEY,
  nombre_categoria VARCHAR(50) NOT NULL
);

INSERT INTO categorias_reductores_velocidad (nombre_categoria) 
VALUES 
('Reductores estructurales'),
('Reductores modulares'),
('Reductores de señalización');

-- Crear una tabla para los tipos de reductores de velocidad
CREATE TABLE tipos_reductores_velocidad (
  tipo_id SERIAL PRIMARY KEY,
  nombre_tipo VARCHAR(50) NOT NULL,
  categoria_id INTEGER NOT NULL,
  FOREIGN KEY (categoria_id) REFERENCES categorias_reductores_velocidad(categoria_id)
);

-- Crear una tabla para las solicitudes de reductores de velocidad
CREATE TABLE solicitudes_reductores_velocidad (
  solicitud_id SERIAL PRIMARY KEY,
  usu_id INTEGER NOT NULL,
  es_nuevo_reductor BOOLEAN NOT NULL,
  categoria_id INTEGER NOT NULL,
  tipo_id INTEGER NOT NULL,
  descripcion TEXT,
  tipo_dano VARCHAR(100),
  direccion TEXT NOT NULL,
  imagen VARCHAR(255) NOT NULL,
  estado_id INTEGER NOT NULL,
  fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (usu_id) REFERENCES usuarios(usu_id),
  FOREIGN KEY (categoria_id) REFERENCES categorias_reductores_velocidad(categoria_id),
  FOREIGN KEY (tipo_id) REFERENCES tipos_reductores_velocidad(tipo_id),
  FOREIGN KEY (estado_id) REFERENCES estados_solicitudes(estado_id)
);

-- Crear una tabla para los tipos de daños en las vías
CREATE TABLE tipos_danos_vias (
  dano_id SERIAL PRIMARY KEY,
  nombre_dano VARCHAR(50) NOT NULL
);

INSERT INTO tipos_danos_vias (nombre_dano) 
VALUES 
('Baches o huecos'),
('Grietas'),
('Hundimientos'),
('Piel de cocodrilo');

-- Crear una tabla para los reportes de daños en las vías
CREATE TABLE reportes_danos_vias (
  reporte_id SERIAL PRIMARY KEY,
  usu_id INTEGER NOT NULL,
  descripcion TEXT,
  dano_id INTEGER NOT NULL,
  direccion TEXT NOT NULL,
  imagen VARCHAR(255) NOT NULL,
  estado_id INTEGER NOT NULL,
  fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (usu_id) REFERENCES usuarios(usu_id),
  FOREIGN KEY (dano_id) REFERENCES tipos_danos_vias(dano_id),
  FOREIGN KEY (estado_id) REFERENCES estados_solicitudes(estado_id)
);

-- Crear una tabla para los tipos de PQRS
CREATE TABLE tipos_pqrs (
  tipo_id SERIAL PRIMARY KEY,
  nombre_tipo VARCHAR(50) NOT NULL
);

INSERT INTO tipos_pqrs (nombre_tipo) 
VALUES 
('Petición'),
('Queja'),
('Reclamo'),
('Sugerencia');

-- Crear una tabla para PQRS
CREATE TABLE pqrs (
  pqrs_id SERIAL PRIMARY KEY,
  usu_id INTEGER NOT NULL,
  tipo_id INTEGER NOT NULL,
  mensaje TEXT NOT NULL,
  estado_id INTEGER NOT NULL,
  fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (usu_id) REFERENCES usuarios(usu_id),
  FOREIGN KEY (tipo_id) REFERENCES tipos_pqrs(tipo_id),
  FOREIGN KEY (estado_id) REFERENCES estados_solicitudes(estado_id)
);

-- Crear una tabla para las capas del geovisor
CREATE TABLE capas_geovisor (
  capa_id SERIAL PRIMARY KEY,
  nombre_capa VARCHAR(100) NOT NULL,
  tipo_capa VARCHAR(50) NOT NULL,
  url_capa TEXT NOT NULL,
  esta_activa BOOLEAN DEFAULT true
);

-- Crear una tabla para las coordenadas capturadas
CREATE TABLE coordenadas_capturadas (
  coordenada_id SERIAL PRIMARY KEY,
  usu_id INTEGER NOT NULL,
  latitud DECIMAL(10, 8) NOT NULL,
  longitud DECIMAL(11, 8) NOT NULL,
  fecha_captura TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (usu_id) REFERENCES usuarios(usu_id)
);

-- Tabla de auditoría para usuarios
CREATE TABLE auditoria_usuarios (
    auditoria_id SERIAL PRIMARY KEY,
    usu_id INTEGER NOT NULL,
    accion VARCHAR(10) NOT NULL,
    fecha_accion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    usuario_accion INTEGER,
    datos_antiguos JSONB,
    datos_nuevos JSONB,
    FOREIGN KEY (usu_id) REFERENCES usuarios(usu_id),
    FOREIGN KEY (usuario_accion) REFERENCES usuarios(usu_id)
);

-- Tabla de auditoría para reportes de accidentes
CREATE TABLE auditoria_reportes_accidentes (
    auditoria_id SERIAL PRIMARY KEY,
    reporte_id INTEGER NOT NULL,
    accion VARCHAR(10) NOT NULL,
    fecha_accion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    usuario_accion INTEGER,
    datos_antiguos JSONB,
    datos_nuevos JSONB,
    FOREIGN KEY (reporte_id) REFERENCES reportes_accidentes(reporte_id),
    FOREIGN KEY (usuario_accion) REFERENCES usuarios(usu_id)
);

-- Tabla de auditoría para solicitudes de señales de tránsito
CREATE TABLE auditoria_solicitudes_senales_transito (
    auditoria_id SERIAL PRIMARY KEY,
    solicitud_id INTEGER NOT NULL,
    accion VARCHAR(10) NOT NULL,
    fecha_accion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    usuario_accion INTEGER,
    datos_antiguos JSONB,
    datos_nuevos JSONB,
    FOREIGN KEY (solicitud_id) REFERENCES solicitudes_senales_transito(solicitud_id),
    FOREIGN KEY (usuario_accion) REFERENCES usuarios(usu_id)
);

-- Tabla de auditoría para solicitudes de reductores de velocidad
CREATE TABLE auditoria_solicitudes_reductores_velocidad (
    auditoria_id SERIAL PRIMARY KEY,
    solicitud_id INTEGER NOT NULL,
    accion VARCHAR(10) NOT NULL,
    fecha_accion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    usuario_accion INTEGER,
    datos_antiguos JSONB,
    datos_nuevos JSONB,
    FOREIGN KEY (solicitud_id) REFERENCES solicitudes_reductores_velocidad(solicitud_id),
    FOREIGN KEY (usuario_accion) REFERENCES usuarios(usu_id)
);

-- Tabla de auditoría para reportes de daños en vías
CREATE TABLE auditoria_reportes_danos_vias (
    auditoria_id SERIAL PRIMARY KEY,
    reporte_id INTEGER NOT NULL,
    accion VARCHAR(10) NOT NULL,
    fecha_accion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    usuario_accion INTEGER,
    datos_antiguos JSONB,
    datos_nuevos JSONB,
    FOREIGN KEY (reporte_id) REFERENCES reportes_danos_vias(reporte_id),
    FOREIGN KEY (usuario_accion) REFERENCES usuarios(usu_id)
);

-- Tabla de auditoría para PQRS
CREATE TABLE auditoria_pqrs (
    auditoria_id SERIAL PRIMARY KEY,
    pqrs_id INTEGER NOT NULL,
    accion VARCHAR(10) NOT NULL,
    fecha_accion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    usuario_accion INTEGER,
    datos_antiguos JSONB,
    datos_nuevos JSONB,
    FOREIGN KEY (pqrs_id) REFERENCES pqrs(pqrs_id),
    FOREIGN KEY (usuario_accion) REFERENCES usuarios(usu_id)
);

-- Tabla de auditoría para capas del geovisor
CREATE TABLE auditoria_capas_geovisor (
    auditoria_id SERIAL PRIMARY KEY,
    capa_id INTEGER NOT NULL,
    accion VARCHAR(10) NOT NULL,
    fecha_accion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    usuario_accion INTEGER,
    datos_antiguos JSONB,
    datos_nuevos JSONB,
    FOREIGN KEY (capa_id) REFERENCES capas_geovisor(capa_id),
    FOREIGN KEY (usuario_accion) REFERENCES usuarios(usu_id)
);

CREATE OR REPLACE FUNCTION audit_usuarios() RETURNS TRIGGER AS $$
BEGIN
    IF (TG_OP = 'DELETE') THEN
        INSERT INTO auditoria_usuarios (usu_id, accion, usuario_accion)
        VALUES (OLD.usu_id, 'DELETE', 1);
    ELSIF (TG_OP = 'UPDATE') THEN
        INSERT INTO auditoria_usuarios (usu_id, accion, usuario_accion)
        VALUES (NEW.usu_id, 'UPDATE', 1);
    ELSIF (TG_OP = 'INSERT') THEN
        INSERT INTO auditoria_usuarios (usu_id, accion, usuario_accion)
        VALUES (NEW.usu_id, 'INSERT', 1);
    END IF;
    RETURN NULL;
END;
$$ LANGUAGE plpgsql;

CREATE  OR REPLACE TRIGGER trigger_audit_usuarios
AFTER INSERT OR UPDATE OR DELETE ON usuarios
FOR EACH ROW EXECUTE FUNCTION audit_usuarios();

-- Trigger para reportes_accidentes
CREATE OR REPLACE FUNCTION audit_reportes_accidentes() RETURNS TRIGGER AS $$
BEGIN
    IF (TG_OP = 'DELETE') THEN
        INSERT INTO auditoria_reportes_accidentes (reporte_id, accion, usuario_accion)
        VALUES (OLD.reporte_id, 'DELETE', 1);
    ELSIF (TG_OP = 'UPDATE') THEN
        INSERT INTO auditoria_reportes_accidentes (reporte_id, accion, usuario_accion, datos_antiguos)
        VALUES (NEW.reporte_id, 'UPDATE', 1);
    ELSIF (TG_OP = 'INSERT') THEN
        INSERT INTO auditoria_reportes_accidentes (reporte_id, accion, usuario_accion)
        VALUES (NEW.reporte_id, 'INSERT', 1);
    END IF;
    RETURN NULL;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_audit_reportes_accidentes
AFTER INSERT OR UPDATE OR DELETE ON reportes_accidentes
FOR EACH ROW EXECUTE FUNCTION audit_reportes_accidentes();

-- Trigger para solicitudes_senales_transito
CREATE OR REPLACE FUNCTION audit_solicitudes_senales_transito() RETURNS TRIGGER AS $$
BEGIN
    IF (TG_OP = 'DELETE') THEN
        INSERT INTO auditoria_solicitudes_senales_transito (solicitud_id, accion, usuario_accion, datos_antiguos)
        VALUES (OLD.solicitud_id, 'DELETE', current_setting('app.current_user')::integer, row_to_json(OLD));
    ELSIF (TG_OP = 'UPDATE') THEN
        INSERT INTO auditoria_solicitudes_senales_transito (solicitud_id, accion, usuario_accion, datos_antiguos, datos_nuevos)
        VALUES (NEW.solicitud_id, 'UPDATE', current_setting('app.current_user')::integer, row_to_json(OLD), row_to_json(NEW));
    ELSIF (TG_OP = 'INSERT') THEN
        INSERT INTO auditoria_solicitudes_senales_transito (solicitud_id, accion, usuario_accion, datos_nuevos)
        VALUES (NEW.solicitud_id, 'INSERT', current_setting('app.current_user')::integer, row_to_json(NEW));
    END IF;
    RETURN NULL;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_audit_solicitudes_senales_transito
AFTER INSERT OR UPDATE OR DELETE ON solicitudes_senales_transito
FOR EACH ROW EXECUTE FUNCTION audit_solicitudes_senales_transito();

-- Trigger para solicitudes_reductores_velocidad
CREATE OR REPLACE FUNCTION audit_solicitudes_reductores_velocidad() RETURNS TRIGGER AS $$
BEGIN
    IF (TG_OP = 'DELETE') THEN
        INSERT INTO auditoria_solicitudes_reductores_velocidad (solicitud_id, accion, usuario_accion, datos_antiguos)
        VALUES (OLD.solicitud_id, 'DELETE', current_setting('app.current_user')::integer, row_to_json(OLD));
    ELSIF (TG_OP = 'UPDATE') THEN
        INSERT INTO auditoria_solicitudes_reductores_velocidad (solicitud_id, accion, usuario_accion, datos_antiguos, datos_nuevos)
        VALUES (NEW.solicitud_id, 'UPDATE', current_setting('app.current_user')::integer, row_to_json(OLD), row_to_json(NEW));
    ELSIF (TG_OP = 'INSERT') THEN
        INSERT INTO auditoria_solicitudes_reductores_velocidad (solicitud_id, accion, usuario_accion, datos_nuevos)
        VALUES (NEW.solicitud_id, 'INSERT', current_setting('app.current_user')::integer, row_to_json(NEW));
    END IF;
    RETURN NULL;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_audit_solicitudes_reductores_velocidad
AFTER INSERT OR UPDATE OR DELETE ON solicitudes_reductores_velocidad
FOR EACH ROW EXECUTE FUNCTION audit_solicitudes_reductores_velocidad();

-- Trigger para reportes_danos_vias
CREATE OR REPLACE FUNCTION audit_reportes_danos_vias() RETURNS TRIGGER AS $$
BEGIN
    IF (TG_OP = 'DELETE') THEN
        INSERT INTO auditoria_reportes_danos_vias (reporte_id, accion, usuario_accion, datos_antiguos)
        VALUES (OLD.reporte_id, 'DELETE', current_setting('app.current_user')::integer, row_to_json(OLD));
    ELSIF (TG_OP = 'UPDATE') THEN
        INSERT INTO auditoria_reportes_danos_vias (reporte_id, accion, usuario_accion, datos_antiguos, datos_nuevos)
        VALUES (NEW.reporte_id, 'UPDATE', current_setting('app.current_user')::integer, row_to_json(OLD), row_to_json(NEW));
    ELSIF (TG_OP = 'INSERT') THEN
        INSERT INTO auditoria_reportes_danos_vias (reporte_id, accion, usuario_accion, datos_nuevos)
        VALUES (NEW.reporte_id, 'INSERT', current_setting('app.current_user')::integer, row_to_json(NEW));
    END IF;
    RETURN NULL;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_audit_reportes_danos_vias
AFTER INSERT OR UPDATE OR DELETE ON reportes_danos_vias
FOR EACH ROW EXECUTE FUNCTION audit_reportes_danos_vias();

-- Trigger para pqrs
CREATE OR REPLACE FUNCTION audit_pqrs() RETURNS TRIGGER AS $$
BEGIN
    IF (TG_OP = 'DELETE') THEN
        INSERT INTO auditoria_pqrs (pqrs_id, accion, usuario_accion, datos_antiguos)
        VALUES (OLD.pqrs_id, 'DELETE', current_setting('app.current_user')::integer, row_to_json(OLD));
    ELSIF (TG_OP = 'UPDATE') THEN
        INSERT INTO auditoria_pqrs (pqrs_id, accion, usuario_accion, datos_antiguos, datos_nuevos)
        VALUES (NEW.pqrs_id, 'UPDATE', current_setting('app.current_user')::integer, row_to_json(OLD), row_to_json(NEW));
    ELSIF (TG_OP = 'INSERT') THEN
        INSERT INTO auditoria_pqrs (pqrs_id, accion, usuario_accion, datos_nuevos)
        VALUES (NEW.pqrs_id, 'INSERT', current_setting('app.current_user')::integer, row_to_json(NEW));
    END IF;
    RETURN NULL;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_audit_pqrs
AFTER INSERT OR UPDATE OR DELETE ON pqrs
FOR EACH ROW EXECUTE FUNCTION audit_pqrs();


SELECT tablename FROM pg_catalog.pg_tables WHERE schemaname != 'pg_catalog' AND schemaname != 'information_schema';

-- barrios
-- tipodedocumento
-- roles
-- tipo_via
-- usuarios
-- auditoria_reportes_accidentes
-- auditoria_solicitudes_senales_transito
-- auditoria_solicitudes_reductores_velocidad
-- auditoria_reportes_danos_vias
-- estado
-- tipo_choque
-- subtipo_choque
-- auditoria_pqrs
-- tokens_restablecimiento_contrasena
-- sesiones_usuario
-- reportes_accidentes
-- categorias_senales_transito
-- tipos_senales_transito
-- solicitudes_senales_transito
-- tipos_danos_senales
-- estados_solicitudes
-- categorias_reductores_velocidad
-- tipos_reductores_velocidad
-- solicitudes_reductores_velocidad
-- reportes_danos_vias
-- tipos_danos_vias
-- pqrs
-- tipos_pqrs
-- coordenadas_capturadas
-- auditoria_usuarios
-- capas_geovisor
-- auditoria_capas_geovisor