CREATE TABLE Personas (
	id_persona varchar(12) PRIMARY KEY,
	nombres varchar(50) NOT NULL,
	apellidos varchar(50) NOT NULL,
	foto varchar(100) NOT NULL,
	sexo char(1) NOT NULL,
	fechaNacimiento date NOT NULL,
	estado boolean NOT NULL
);

CREATE TABLE Empresas (
	id_empresa varchar(12) PRIMARY KEY,
	nombre varchar(50) NOT NULL,
	responsable varchar(12) REFERENCES personas(id_persona) NOT NULL,
	estado boolean NOT NULL
);

CREATE TABLE TiposContactos (
	id_tipocontacto varchar(12) PRIMARY KEY,
	nombre varchar(20) UNIQUE NOT NULL
);

CREATE TABLE Contactos (
	id_contacto varchar(12) PRIMARY KEY,
	tipo varchar(12) REFERENCES TiposContactos(id_tipocontacto) NOT NULL,
	contacto varchar(50) NOT NULL
);

CREATE TABLE ContactosPersonas (
	persona varchar(12) REFERENCES Personas(id_persona) NOT NULL
) INHERITS (Contactos);

CREATE TABLE ContactosEmpresas (
	empresa varchar(12) REFERENCES Empresas(id_empresa) NOT NULL
) INHERITS (Contactos);

CREATE TABLE NivelesUsuarios (
	id_nivel varchar(12) PRIMARY KEY,
	tipoNivel varchar(20) NOT NULL,
	numeroNivel NUMERIC NOT NULL UNIQUE,
	estado BOOLEAN
);

CREATE TABLE Usuarios (
	id_usuario varchar(12) PRIMARY KEY,
	nombre varchar(20) NOT NULL,
	contrasenia varchar(50),
	persona varchar(12) REFERENCES Personas(id_persona) NOT NULL,
	nivel NUMERIC REFERENCES NivelesUsuarios(numeroNivel) NOT NULL,
	estado boolean NOT NULL
);

CREATE TABLE Proyectos (
	id_proyecto varchar(12) PRIMARY KEY,
	nombre varchar(20) NOT NULL,
	empresa varchar(12) REFERENCES Empresas(id_empresa) NOT NULL,
	creador varchar(12) REFERENCES Usuarios(id_usuario) NOT NULL,
	fechaAsignacion DATE NOT NULL,
	fechaCompromiso DATE NOT NULL ,
	estado boolean NOT NUll
);

CREATE TABLE Condciones (
	id_condicion varchar(12) PRIMARY KEY,
	nombre varchar(20) NOT NULL
);

CREATE TABLE Tareas (
	id_tarea varchar(12) PRIMARY KEY,
	proyecto varchar(12) REFERENCES Proyectos(id_proyecto)  NOT NULL,
	cantidadHoras NUMERIC NOT NULL,
	creador varchar(12) REFERENCES Usuarios(id_usuario) NOT NULL,
	responsable varchar(12) REFERENCES Usuarios(id_usuario) NOT NULL,
	fechaAsignacion DATE NOT NULL,
	fechaCompromiso DATE NOT NULL,
	condicion varchar(12) REFERENCES Condciones(id_condicion) NOT NULL,
	nota varchar(50) NOT NULL,
	estado boolean NOT NULL
);

CREATE TABLE Referencias(
	modulo VARCHAR(30) NOT NULL,
	referencia VARCHAR(5) UNIQUE NOT NULL,
	serie INTEGER NOT NULL DEFAULT 0,
	tiempo TIMESTAMP WITHOUT TIME ZONE NOT NULL DEFAULT now()
);

-- Funciones:
CREATE OR REPLACE FUNCTION cargarRegistro(tabla_modulo VARCHAR)
RETURNS VARCHAR AS $$
DECLARE codigo VARCHAR;
	BEGIN
		UPDATE Referencias SET serie = serie + 1, tiempo = now() WHERE modulo = tabla_modulo;
		 SELECT (referencia || trim(TO_CHAR(serie, '00000000'))) INTO codigo FROM Referencias WHERE modulo = tabla_modulo;
		 RETURN codigo;
	END
$$
LANGUAGE plpgsql;

-- Pendiente: crear vista tareas vencidas
-- Pendiente: crear vista tareas termiandas
-- Pendiente: crear vista tareas en curso

-- Código: T 140406 0001
-- SELECT 'T14' || trim(TO_CHAR(1, '00000000'));
