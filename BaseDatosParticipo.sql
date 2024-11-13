-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para db_participo
CREATE DATABASE IF NOT EXISTS `db_participo` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_participo`;

-- Volcando estructura para tabla db_participo.alumnos
CREATE TABLE IF NOT EXISTS `alumnos` (
  `idAlumno` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `apellido` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `dni` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`idAlumno`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_participo.alumnos: ~24 rows (aproximadamente)
INSERT INTO `alumnos` (`idAlumno`, `nombre`, `apellido`, `email`, `fechaNacimiento`, `dni`) VALUES
	(1, 'Valentino ', 'Andrade', 'valentino.andrade@example.com', '2006-08-18', '12345678'),
	(2, 'Lucas', 'Cedres', 'lucas.cedres@example.com', '2003-11-12', '23456789'),
	(3, 'Facundo', 'Figun', 'facundo.figun@example.com', '2015-11-12', '34567890'),
	(4, 'Luca', 'Giordano', 'luca.giordano@example.com', '2003-12-11', '45678901'),
	(5, 'Bruno', 'Godoy', 'bruno.godoy@example.com', '2007-11-15', '567890'),
	(6, 'Agustin', 'Gomez', 'agustin.gomez@example.com', '2004-11-19', '67890123'),
	(7, 'Brian', 'Gonzalez', 'brian.gonzalez@example.com', '2003-05-20', '78901234'),
	(8, 'Federico', 'Guigou Scottini', 'federico.guigou@example.com', '2003-11-13', '89012345'),
	(9, 'Luna', 'Marrano', 'luna.marrano@example.com', '2003-02-20', '90123456'),
	(10, 'Giuliana', 'Mercado Aviles', 'giuliana.mercado@example.com', '2003-04-20', '01234567'),
	(11, 'Lucila', 'Mercado Ruiz', 'lucila.mercado@example.com', '2012-11-14', '12345679'),
	(12, 'Angel ', 'Murillo', 'angel.murillo@example.com', '2006-09-18', '23456789'),
	(13, 'Juan', 'Nissero', 'juan.nissero@example.com', '2007-05-16', '34567891'),
	(14, 'Fausto', 'Parada', 'fausto.parada@example.com', '2000-11-15', '45678902'),
	(15, 'Fausto', 'Parada', 'fausto.parada@example.com', '2006-10-18', '45678902'),
	(16, 'Ignacio', 'Piter', 'ignacio.piter@example.com', '2009-07-14', '56789013'),
	(17, 'Tomas', 'Planchon', 'tomas.planchon@example.com', '2007-11-16', '67890124'),
	(18, 'Elisa', 'Ronconi', 'elisa.ronconi@example.com', '2004-03-19', '78901235'),
	(19, 'Exequiel', 'Sanchez', 'exequiel.sanchez@example.com', '2006-08-17', '89012346'),
	(20, 'Melina', 'Schimpf Baldo', 'melina.schimpf@example.com', '2004-02-19', '90123457'),
	(21, 'Diego', 'Segovia', 'diego.segovia@example.com', '2003-07-20', '01234568'),
	(22, 'Camila', 'Sittner', 'camila.sittner@example.com', '2006-11-18', '12345680'),
	(23, 'Yamil', 'Villa', 'yamil.villa@example.com', '2007-01-16', '23456781'),
	(24, 'Daniel', 'Zabala', 'daniel.zabala@example.com', '2000-11-16', '23489781');

-- Volcando estructura para tabla db_participo.alumno_materia
CREATE TABLE IF NOT EXISTS `alumno_materia` (
  `idAlumno` int NOT NULL,
  `numeroMateria` int NOT NULL,
  PRIMARY KEY (`idAlumno`,`numeroMateria`),
  KEY `fk_materia` (`numeroMateria`),
  CONSTRAINT `fk_alumno` FOREIGN KEY (`idAlumno`) REFERENCES `alumnos` (`idAlumno`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_materia` FOREIGN KEY (`numeroMateria`) REFERENCES `materias` (`numeroMateria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_participo.alumno_materia: ~30 rows (aproximadamente)
INSERT INTO `alumno_materia` (`idAlumno`, `numeroMateria`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(7, 1),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(12, 1),
	(13, 1),
	(14, 1),
	(16, 1),
	(17, 1),
	(18, 1),
	(19, 1),
	(20, 1),
	(21, 1),
	(22, 1),
	(23, 1),
	(24, 1),
	(1, 2),
	(2, 2),
	(3, 2),
	(4, 2),
	(5, 2),
	(6, 4),
	(12, 4);

-- Volcando estructura para tabla db_participo.asistencias
CREATE TABLE IF NOT EXISTS `asistencias` (
  `idAsistencia` int NOT NULL AUTO_INCREMENT,
  `idAlumno` int NOT NULL,
  `idMateria` int NOT NULL,
  `fecha` date NOT NULL,
  `presente` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idAsistencia`),
  UNIQUE KEY `idAlumno` (`idAlumno`,`idMateria`,`fecha`),
  KEY `idMateria` (`idMateria`),
  CONSTRAINT `asistencias_ibfk_1` FOREIGN KEY (`idAlumno`) REFERENCES `alumnos` (`idAlumno`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `asistencias_ibfk_2` FOREIGN KEY (`idMateria`) REFERENCES `materias` (`numeroMateria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=639 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_participo.asistencias: ~33 rows (aproximadamente)
INSERT INTO `asistencias` (`idAsistencia`, `idAlumno`, `idMateria`, `fecha`, `presente`) VALUES
	(601, 1, 1, '2024-11-12', 1),
	(602, 2, 1, '2024-11-12', 1),
	(603, 3, 1, '2024-11-12', 1),
	(604, 4, 1, '2024-11-12', 1),
	(605, 5, 1, '2024-11-12', 1),
	(606, 6, 1, '2024-11-12', 1),
	(607, 7, 1, '2024-11-12', 1),
	(608, 8, 1, '2024-11-12', 1),
	(609, 9, 1, '2024-11-12', 1),
	(610, 10, 1, '2024-11-12', 1),
	(611, 11, 1, '2024-11-12', 1),
	(612, 12, 1, '2024-11-12', 1),
	(613, 13, 1, '2024-11-12', 1),
	(614, 14, 1, '2024-11-12', 1),
	(615, 16, 1, '2024-11-12', 1),
	(616, 17, 1, '2024-11-12', 1),
	(617, 18, 1, '2024-11-12', 1),
	(618, 19, 1, '2024-11-12', 1),
	(619, 20, 1, '2024-11-12', 1),
	(620, 21, 1, '2024-11-12', 1),
	(621, 22, 1, '2024-11-12', 1),
	(622, 23, 1, '2024-11-12', 1),
	(623, 24, 1, '2024-11-12', 1),
	(624, 1, 2, '2024-11-12', 1),
	(625, 2, 2, '2024-11-12', 1),
	(626, 3, 2, '2024-11-12', 1),
	(627, 4, 2, '2024-11-12', 1),
	(628, 5, 2, '2024-11-12', 1),
	(634, 1, 2, '2024-11-13', 1),
	(635, 2, 2, '2024-11-13', 1),
	(636, 3, 2, '2024-11-13', 1),
	(637, 4, 2, '2024-11-13', 1),
	(638, 5, 2, '2024-11-13', 1);

-- Volcando estructura para tabla db_participo.clases
CREATE TABLE IF NOT EXISTS `clases` (
  `numeroClase` int NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`numeroClase`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_participo.clases: ~1 rows (aproximadamente)
INSERT INTO `clases` (`numeroClase`, `fecha`) VALUES
	(1, '2024-10-01');

-- Volcando estructura para tabla db_participo.institutos
CREATE TABLE IF NOT EXISTS `institutos` (
  `idInstituto` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`idInstituto`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_participo.institutos: ~5 rows (aproximadamente)
INSERT INTO `institutos` (`idInstituto`, `nombre`, `direccion`) VALUES
	(1, 'Sedes Sapientiae', 'Sta. Fe 74, E3269 Gualeguaychú, Entre Ríos'),
	(2, 'Facultad de Bromatología - UNER Centro', 'Sede Centro: 25 de Mayo 709'),
	(3, 'Facultad de Bromatología - UNER Polo Educativo', 'Sede Polo Educativo: Pte. Perón 1154'),
	(4, 'UCU ', '25 de Mayo 1312, E3269 Gualeguaychú, Entre Ríos'),
	(5, 'UTN FRCU', 'BTD Concepción del Uruguay Entre Ríos AR, Ing. Pereyra 676, E3264');

-- Volcando estructura para tabla db_participo.materias
CREATE TABLE IF NOT EXISTS `materias` (
  `numeroMateria` int NOT NULL AUTO_INCREMENT,
  `materia` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`numeroMateria`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_participo.materias: ~4 rows (aproximadamente)
INSERT INTO `materias` (`numeroMateria`, `materia`) VALUES
	(1, 'Programacion I'),
	(2, 'Programacion II'),
	(3, 'Matemática'),
	(4, 'Biologia');

-- Volcando estructura para tabla db_participo.materia_instituto
CREATE TABLE IF NOT EXISTS `materia_instituto` (
  `numeroMateria` int DEFAULT NULL,
  `idInstituto` int DEFAULT NULL,
  KEY `FK_materia_instituto_materias` (`numeroMateria`),
  KEY `FK_materia_instituto_institutos` (`idInstituto`),
  CONSTRAINT `FK_materia_instituto_institutos` FOREIGN KEY (`idInstituto`) REFERENCES `institutos` (`idInstituto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_materia_instituto_materias` FOREIGN KEY (`numeroMateria`) REFERENCES `materias` (`numeroMateria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_participo.materia_instituto: ~4 rows (aproximadamente)
INSERT INTO `materia_instituto` (`numeroMateria`, `idInstituto`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 2);

-- Volcando estructura para tabla db_participo.materia_profesor
CREATE TABLE IF NOT EXISTS `materia_profesor` (
  `idMateria` int DEFAULT NULL,
  `idProfesor` int DEFAULT NULL,
  KEY `FK__materias` (`idMateria`),
  KEY `FK__profesores` (`idProfesor`),
  CONSTRAINT `FK__materias` FOREIGN KEY (`idMateria`) REFERENCES `materias` (`numeroMateria`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__profesores` FOREIGN KEY (`idProfesor`) REFERENCES `profesores` (`idProfesor`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_participo.materia_profesor: ~4 rows (aproximadamente)
INSERT INTO `materia_profesor` (`idMateria`, `idProfesor`) VALUES
	(4, 2),
	(1, 1),
	(2, 1),
	(3, 2);

-- Volcando estructura para tabla db_participo.notas
CREATE TABLE IF NOT EXISTS `notas` (
  `nota1` decimal(4,2) DEFAULT NULL,
  `nota2` decimal(4,2) DEFAULT NULL,
  `nota3` decimal(4,2) DEFAULT NULL,
  `idAlumno` int DEFAULT NULL,
  `idNotas` int NOT NULL AUTO_INCREMENT,
  `idMateria` int DEFAULT NULL,
  PRIMARY KEY (`idNotas`),
  KEY `fk_notas_alumnos` (`idAlumno`),
  KEY `FK_notas_materias` (`idMateria`),
  CONSTRAINT `fk_notas_alumnos` FOREIGN KEY (`idAlumno`) REFERENCES `alumnos` (`idAlumno`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_notas_materias` FOREIGN KEY (`idMateria`) REFERENCES `materias` (`numeroMateria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_participo.notas: ~30 rows (aproximadamente)
INSERT INTO `notas` (`nota1`, `nota2`, `nota3`, `idAlumno`, `idNotas`, `idMateria`) VALUES
	(9.00, 8.50, 9.00, 1, 82, 2),
	(5.50, 5.50, 8.00, 2, 83, 2),
	(7.00, 7.00, 7.00, 3, 84, 2),
	(8.00, 8.00, 8.00, 4, 85, 2),
	(7.00, 7.00, 7.00, 5, 86, 2),
	(5.00, 5.50, 5.00, 1, 87, 1),
	(0.00, 0.00, 0.00, 2, 88, 1),
	(0.00, 0.00, 0.00, 3, 89, 1),
	(0.00, 0.00, 0.00, 4, 90, 1),
	(0.00, 0.00, 0.00, 5, 91, 1),
	(0.00, 0.00, 0.00, 6, 92, 1),
	(0.00, 0.00, 0.00, 7, 93, 1),
	(0.00, 0.00, 0.00, 8, 94, 1),
	(0.00, 0.00, 0.00, 9, 95, 1),
	(0.00, 0.00, 0.00, 10, 96, 1),
	(0.00, 0.00, 0.00, 11, 97, 1),
	(0.00, 0.00, 0.00, 12, 98, 1),
	(0.00, 0.00, 0.00, 13, 99, 1),
	(0.00, 0.00, 0.00, 14, 100, 1),
	(0.00, 0.00, 0.00, 16, 101, 1),
	(0.00, 0.00, 0.00, 17, 102, 1),
	(0.00, 0.00, 0.00, 18, 103, 1),
	(0.00, 0.00, 0.00, 19, 104, 1),
	(0.00, 0.00, 0.00, 20, 105, 1),
	(0.00, 0.00, 0.00, 21, 106, 1),
	(0.00, 0.00, 0.00, 22, 107, 1),
	(0.00, 0.00, 0.00, 23, 108, 1),
	(0.00, 0.00, 0.00, 24, 109, 1),
	(5.00, 0.00, 0.00, 6, 110, 4),
	(8.00, 0.00, 0.00, 12, 111, 4);

-- Volcando estructura para tabla db_participo.parametros
CREATE TABLE IF NOT EXISTS `parametros` (
  `nLibre` int DEFAULT NULL,
  `nRegular` int DEFAULT NULL,
  `nPromocion` int DEFAULT NULL,
  `aLibre` int DEFAULT NULL,
  `aRegular` int DEFAULT NULL,
  `aPromocion` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_participo.parametros: ~1 rows (aproximadamente)
INSERT INTO `parametros` (`nLibre`, `nRegular`, `nPromocion`, `aLibre`, `aRegular`, `aPromocion`) VALUES
	(5, 7, 8, 60, 70, 80);

-- Volcando estructura para tabla db_participo.profesores
CREATE TABLE IF NOT EXISTS `profesores` (
  `idProfesor` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `dni` varchar(20) DEFAULT NULL,
  `legajo` varchar(8) DEFAULT NULL,
  `idUsuario` int DEFAULT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`idProfesor`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_participo.profesores: ~2 rows (aproximadamente)
INSERT INTO `profesores` (`idProfesor`, `nombre`, `apellido`, `dni`, `legajo`, `idUsuario`, `email`) VALUES
	(1, 'Javier', 'Parra', '1234', '111', 5, NULL),
	(2, 'Elisa', 'Ronconi', '3456', '121', 1, NULL);

-- Volcando estructura para tabla db_participo.profesor_instituto
CREATE TABLE IF NOT EXISTS `profesor_instituto` (
  `idProfesor` int DEFAULT NULL,
  `idInstituto` int DEFAULT NULL,
  KEY `profesor_instituto` (`idProfesor`),
  KEY `instituo_profesor` (`idInstituto`),
  CONSTRAINT `instituo_profesor` FOREIGN KEY (`idInstituto`) REFERENCES `institutos` (`idInstituto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `profesor_instituto` FOREIGN KEY (`idProfesor`) REFERENCES `profesores` (`idProfesor`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_participo.profesor_instituto: ~3 rows (aproximadamente)
INSERT INTO `profesor_instituto` (`idProfesor`, `idInstituto`) VALUES
	(1, 1),
	(1, 2),
	(2, 2);

-- Volcando estructura para tabla db_participo.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuario` int NOT NULL AUTO_INCREMENT,
  `idAlumno` int DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `contraseña` varchar(25) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `idProfesor` int DEFAULT NULL,
  PRIMARY KEY (`idUsuario`) USING BTREE,
  UNIQUE KEY `usuario` (`usuario`),
  KEY `idAlumno` (`idAlumno`),
  KEY `FK_usuarios_profesores` (`idProfesor`),
  CONSTRAINT `FK_usuarios_profesores` FOREIGN KEY (`idProfesor`) REFERENCES `profesores` (`idProfesor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idAlumno`) REFERENCES `alumnos` (`idAlumno`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_participo.usuarios: ~2 rows (aproximadamente)
INSERT INTO `usuarios` (`idUsuario`, `idAlumno`, `usuario`, `contraseña`, `email`, `idProfesor`) VALUES
	(5, NULL, 'JavierParra', '1234', NULL, 1),
	(6, NULL, 'ElisaRonconi', '1234', NULL, 2);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
