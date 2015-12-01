SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema simapro
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `simapro` ;
CREATE SCHEMA IF NOT EXISTS `simapro` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `simapro` ;

-- -----------------------------------------------------
-- Table `simapro`.`personal`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simapro`.`personal` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NULL,
  `correo` VARCHAR(100) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simapro`.`ciclos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simapro`.`ciclos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fecha_inicio` DATE NULL,
  `fecha_fin` DATE NULL,
  `nombre` VARCHAR(100) NULL,
  `paridad` ENUM('I', 'II') NULL,
  `activo` TINYINT(1) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simapro`.`facultades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simapro`.`facultades` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simapro`.`escuelas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simapro`.`escuelas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NULL,
  `director` INT NULL,
  `secretario` INT NULL,
  `facultad` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_escuelas_1_idx` (`director` ASC),
  INDEX `fk_escuelas_2_idx` (`secretario` ASC),
  INDEX `fk_escuelas_3_idx` (`facultad` ASC),
  CONSTRAINT `fk_escuelas_1`
    FOREIGN KEY (`director`)
    REFERENCES `simapro`.`personal` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_escuelas_2`
    FOREIGN KEY (`secretario`)
    REFERENCES `simapro`.`personal` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_escuelas_3`
    FOREIGN KEY (`facultad`)
    REFERENCES `simapro`.`facultades` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `simapro`.`carreras`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simapro`.`carreras` (
  `codigo` VARCHAR(10) NOT NULL,
  `nombre` VARCHAR(100) NULL,
  `escuela` INT NULL,
  INDEX `fk_carreras_1_idx` (`escuela` ASC),
  PRIMARY KEY (`codigo`),
  CONSTRAINT `fk_carreras_1`
    FOREIGN KEY (`escuela`)
    REFERENCES `simapro`.`escuelas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simapro`.`areas_administrativas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simapro`.`areas_administrativas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NULL,
  `jefe` INT NULL,
  `escuela` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_areas_administrativas_2_idx` (`jefe` ASC),
  INDEX `fk_areas_administrativas_1_idx` (`escuela` ASC),
  CONSTRAINT `fk_areas_administrativas_1`
    FOREIGN KEY (`escuela`)
    REFERENCES `simapro`.`escuelas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_areas_administrativas_2`
    FOREIGN KEY (`jefe`)
    REFERENCES `simapro`.`personal` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simapro`.`asignaturas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simapro`.`asignaturas` (
  `codigo` VARCHAR(10) NOT NULL,
  `area_administrativa` INT NULL,
  `nombre` VARCHAR(100) NULL,
  INDEX `fk_asignaturas_1_idx` (`area_administrativa` ASC),
  PRIMARY KEY (`codigo`),
  CONSTRAINT `fk_asignaturas_1`
    FOREIGN KEY (`area_administrativa`)
    REFERENCES `simapro`.`areas_administrativas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `simapro`.`asignatura_ciclo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simapro`.`asignatura_ciclo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `ciclo` INT NULL,
  `asignatura` VARCHAR(10) NULL,
  `coordinador_de_teorico` INT NULL,
  `coordinador_de_laboratorio` INT NULL,
  `coordinador_total` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_asignatura_ciclo_1_idx` (`ciclo` ASC),
  INDEX `fk_asignatura_ciclo_3_idx` (`coordinador_de_teorico` ASC),
  INDEX `fk_asignatura_ciclo_4_idx` (`coordinador_de_laboratorio` ASC),
  INDEX `fk_asignatura_ciclo_5_idx` (`coordinador_total` ASC),
  INDEX `fk_asignatura_ciclo_2_idx` (`asignatura` ASC),
  CONSTRAINT `fk_asignatura_ciclo_1`
    FOREIGN KEY (`ciclo`)
    REFERENCES `simapro`.`ciclos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_asignatura_ciclo_3`
    FOREIGN KEY (`coordinador_de_teorico`)
    REFERENCES `simapro`.`personal` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_asignatura_ciclo_4`
    FOREIGN KEY (`coordinador_de_laboratorio`)
    REFERENCES `simapro`.`personal` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_asignatura_ciclo_5`
    FOREIGN KEY (`coordinador_total`)
    REFERENCES `simapro`.`personal` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_asignatura_ciclo_2`
    FOREIGN KEY (`asignatura`)
    REFERENCES `simapro`.`asignaturas` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simapro`.`horarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simapro`.`horarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `hora_inicio` TIME NULL,
  `hora_fin` TIME NULL,
  `minutos` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simapro`.`grupos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simapro`.`grupos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `numero` VARCHAR(50) NULL,
  `tipo` VARCHAR(45) NULL,
  `asignatura_ciclo` INT NULL,
  `encargado` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_grupo_1_idx` (`asignatura_ciclo` ASC),
  INDEX `fk_grupo_2_idx` (`encargado` ASC),
  CONSTRAINT `fk_grupo_1`
    FOREIGN KEY (`asignatura_ciclo`)
    REFERENCES `simapro`.`asignatura_ciclo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_grupo_2`
    FOREIGN KEY (`encargado`)
    REFERENCES `simapro`.`personal` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `simapro`.`aulas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simapro`.`aulas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `codigo` VARCHAR(10) NULL,
  `nombre` VARCHAR(100) NULL,
  `capacidad` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simapro`.`grupo_horario_aula`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simapro`.`grupo_horario_aula` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `horario` INT NULL,
  `aula` INT NULL,
  `grupo` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_grupo_horario_aula_1_idx` (`aula` ASC),
  INDEX `fk_grupo_horario_aula_2_idx` (`horario` ASC),
  INDEX `fk_grupo_horario_aula_3_idx` (`grupo` ASC),
  CONSTRAINT `fk_grupo_horario_aula_1`
    FOREIGN KEY (`aula`)
    REFERENCES `simapro`.`aulas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_grupo_horario_aula_2`
    FOREIGN KEY (`horario`)
    REFERENCES `simapro`.`horarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_grupo_horario_aula_3`
    FOREIGN KEY (`grupo`)
    REFERENCES `simapro`.`grupos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simapro`.`carrera_recibe_asignatura`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simapro`.`carrera_recibe_asignatura` (
  `carrera` VARCHAR(10) NOT NULL,
  `asignatura` VARCHAR(10) NOT NULL,
  INDEX `fk_carrera_recibe_asignatura_2_idx` (`asignatura` ASC),
  INDEX `fk_carrera_recibe_asignatura_1_idx` (`carrera` ASC),
  PRIMARY KEY (`carrera`, `asignatura`),
  CONSTRAINT `fk_carrera_recibe_asignatura_2`
    FOREIGN KEY (`asignatura`)
    REFERENCES `simapro`.`asignaturas` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_carrera_recibe_asignatura_1`
    FOREIGN KEY (`carrera`)
    REFERENCES `simapro`.`carreras` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simapro`.`alumnos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simapro`.`alumnos` (
  `carnet` VARCHAR(10) NOT NULL,
  `apellidos` VARCHAR(100) NULL,
  `nombres` VARCHAR(100) NULL,
  `password` VARCHAR(45) NULL,
  PRIMARY KEY (`carnet`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simapro`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simapro`.`usuarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usuario` VARCHAR(10) NULL,
  `password` VARCHAR(45) NULL,
  `personal` INT NULL,
  `carnet` VARCHAR(10) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_usuarios_1_idx` (`personal` ASC),
  INDEX `fk_usuarios_2_idx` (`carnet` ASC),
  CONSTRAINT `fk_usuarios_1`
    FOREIGN KEY (`personal`)
    REFERENCES `simapro`.`personal` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_2`
    FOREIGN KEY (`carnet`)
    REFERENCES `simapro`.`alumnos` (`carnet`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `simapro`.`alumnos_grupo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simapro`.`alumnos_grupo` (
  `carnet` VARCHAR(10) NOT NULL,
  `grupo` INT NOT NULL,
  PRIMARY KEY (`carnet`, `grupo`),
  INDEX `fk_alumnos_grupo_2_idx` (`grupo` ASC),
  CONSTRAINT `fk_alumnos_grupo_1`
    FOREIGN KEY (`carnet`)
    REFERENCES `simapro`.`alumnos` (`carnet`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_alumnos_grupo_2`
    FOREIGN KEY (`grupo`)
    REFERENCES `simapro`.`grupos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `simapro` ;

-- -----------------------------------------------------
-- Placeholder table for view `simapro`.`v_escuelas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simapro`.`v_escuelas` (`id` INT, `nombre` INT, `director` INT, `secretario` INT, `facultad` INT);

-- -----------------------------------------------------
-- Placeholder table for view `simapro`.`v_carreras`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simapro`.`v_carreras` (`codigo` INT, `nombre` INT, `escuela` INT, `facultad` INT);

-- -----------------------------------------------------
-- Placeholder table for view `simapro`.`v_asignaturas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simapro`.`v_asignaturas` (`codigo` INT, `nombre` INT, `nombre_area_administrativa` INT, `escuela` INT, `facultad` INT);

-- -----------------------------------------------------
-- Placeholder table for view `simapro`.`v_asignaturas_del_ciclo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simapro`.`v_asignaturas_del_ciclo` (`id` INT, `codigo` INT, `nombre` INT, `ciclo` INT, `paridad` INT, `activo` INT);

-- -----------------------------------------------------
-- Placeholder table for view `simapro`.`v_areas_administrativas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simapro`.`v_areas_administrativas` (`id` INT, `nombre` INT, `jefe` INT, `escuela` INT);

-- -----------------------------------------------------
-- Placeholder table for view `simapro`.`v_grupo_horarios_aula`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `simapro`.`v_grupo_horarios_aula` (`id` INT, `grupo_id` INT, `horario_id` INT, `aula_id` INT, `asignatura_ciclo` INT, `tipo` INT, `numero` INT, `encargado` INT, `codigo` INT, `nombre` INT);

-- -----------------------------------------------------
-- View `simapro`.`v_escuelas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `simapro`.`v_escuelas`;
USE `simapro`;
CREATE  OR REPLACE VIEW `v_escuelas` AS SELECT e.id, e.nombre, p.nombre as director, e.secretario, f.nombre as facultad FROM escuelas e 
INNER JOIN facultades f ON e.facultad = f.id
INNER JOIN personal p ON e.director = p.id;


-- -----------------------------------------------------
-- View `simapro`.`v_carreras`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `simapro`.`v_carreras`;
USE `simapro`;
CREATE  OR REPLACE VIEW `v_carreras` AS SELECT c.codigo, c.nombre, e.nombre as escuela, f.nombre as facultad 
FROM carreras c INNER JOIN escuelas e ON c.escuela=e.id INNER JOIN facultades f ON e.facultad = f.id;


-- -----------------------------------------------------
-- View `simapro`.`v_asignaturas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `simapro`.`v_asignaturas`;
USE `simapro`;
CREATE  OR REPLACE VIEW `v_asignaturas` AS SELECT a.codigo, a.nombre, aa.nombre as nombre_area_administrativa, e.nombre as escuela, f.nombre as facultad FROM asignaturas a 
INNER JOIN areas_administrativas aa ON a.area_administrativa = aa.id 
INNER JOIN escuelas e ON aa.escuela=e.id 
INNER JOIN facultades f ON e.facultad = f.id;


-- -----------------------------------------------------
-- View `simapro`.`v_asignaturas_del_ciclo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `simapro`.`v_asignaturas_del_ciclo`;
USE `simapro`;
CREATE  OR REPLACE VIEW `v_asignaturas_del_ciclo` AS SELECT 
	ac.id,
	a.codigo, 
	a.nombre, 
	c.nombre as ciclo,
	c.paridad,
	case when c.activo is not true
		then 'No Activo'
		else 'Activo'
	end activo
FROM asignaturas a 
INNER JOIN asignatura_ciclo ac ON a.codigo = ac.asignatura
INNER JOIN ciclos c ON c.id = ac.ciclo
WHERE c.activo=true;



-- -----------------------------------------------------
-- View `simapro`.`v_areas_administrativas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `simapro`.`v_areas_administrativas`;
USE `simapro`;
CREATE  OR REPLACE VIEW `v_areas_administrativas` AS SELECT aa.id, aa.nombre, p.nombre as jefe, e.nombre as escuela FROM areas_administrativas aa
INNER JOIN escuelas e ON aa.escuela = e.id
INNER JOIN personal p ON aa.jefe = p.id;


-- -----------------------------------------------------
-- View `simapro`.`v_grupo_horarios_aula`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `simapro`.`v_grupo_horarios_aula`;
USE `simapro`;
CREATE  OR REPLACE VIEW `v_grupo_horarios_aula` AS SELECT 
	gha.id, 
	g.id as grupo_id,
	h.id as horario_id, 
	au.id as aula_id,
	ac.id as asignatura_ciclo,
	g.tipo,	
	g.numero,
	g.encargado,
	a.codigo,
	a.nombre
FROM grupo_horario_aula gha
INNER JOIN horarios h ON gha.horario = h.id
INNER JOIN aulas au ON gha.aula = au.id
INNER JOIN grupos g ON gha.grupo = g.id
INNER JOIN asignatura_ciclo ac ON g.asignatura_ciclo = ac.id
INNER JOIN asignaturas a ON ac.asignatura = a.codigo;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
