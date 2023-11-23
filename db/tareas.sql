-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-10-2023 a las 03:08:15
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tareas`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_agregar_tarea` (IN `p_titulo` VARCHAR(255), IN `p_descripcion` TEXT, IN `p_fecha_compromiso` DATE, IN `p_editada` VARCHAR(3), IN `p_responsable` VARCHAR(255), IN `p_tipo_tarea` VARCHAR(255), IN `p_estado` VARCHAR(255))   BEGIN
    INSERT INTO tareas (titulo, descripcion, fecha_compromiso, editada, responsable, tipo_tarea, estado)
    VALUES (p_titulo, p_descripcion, p_fecha_compromiso, p_editada, p_responsable, p_tipo_tarea, p_estado);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_buscar_tareas` (IN `termino` VARCHAR(255))   BEGIN
    SELECT * FROM tareas 
    WHERE titulo LIKE CONCAT('%', termino, '%') 
    OR descripcion LIKE CONCAT('%', termino, '%') 
    OR fecha_compromiso LIKE CONCAT('%', termino, '%') 
    OR editada LIKE CONCAT('%', termino, '%') 
    OR responsable LIKE CONCAT('%', termino, '%') 
    OR tipo_tarea LIKE CONCAT('%', termino, '%') 
    OR estado LIKE CONCAT('%', termino, '%');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_editar` (IN `p_id` INT, IN `p_titulo` VARCHAR(255), IN `p_descripcion` TEXT, IN `p_fecha_compromiso` DATE, IN `p_editada` DATETIME, IN `p_responsable` VARCHAR(255), IN `p_tipo_tarea` VARCHAR(255), IN `p_estado` VARCHAR(255))   BEGIN
    UPDATE tareas 
    SET 
        titulo = p_titulo,
        descripcion = p_descripcion,
        fecha_compromiso = p_fecha_compromiso,
        editada = p_editada,
        responsable = p_responsable,
        tipo_tarea = p_tipo_tarea,
        estado = p_estado
    WHERE id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_eliminar_tarea` (IN `tarea_id` INT)   BEGIN
    DELETE FROM tareas WHERE id = tarea_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_todos` ()   BEGIN
    SELECT * FROM tareas;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_compromiso` date DEFAULT NULL,
  `editada` enum('si','no') DEFAULT 'no',
  `responsable` varchar(255) DEFAULT NULL,
  `tipo_tarea` enum('hogar','trabajo','escuela') NOT NULL,
  `estado` enum('pendiente','en_proceso','completa') NOT NULL DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
