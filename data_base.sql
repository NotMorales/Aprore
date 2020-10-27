-- -----------------------------------------------------
-- Schema aproreco_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `aproreco_db` DEFAULT CHARACTER SET utf8 ;
USE `aproreco_db` ;

-- -----------------------------------------------------
-- Table `personas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `personas` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NOT NULL,
  `apellido_paterno` VARCHAR(255) NOT NULL,
  `apellido_materno` VARCHAR(255) NOT NULL,
  `sexo` VARCHAR(255) NOT NULL,
  `telefono` VARCHAR(255) NOT NULL,
  `fecha_nacimiento` DATE NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `empresas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `empresas` (
  `id` BIGINT NOT NULL,
  `nombre` VARCHAR(255) NOT NULL,
  `direccion` VARCHAR(255) NOT NULL,
  `correo` VARCHAR(255) NOT NULL,
  `contacto` VARCHAR(250) NULL,
  `telefono` VARCHAR(255) NOT NULL,
  `rfc` VARCHAR(255) NULL,
  `data_base` VARCHAR(255) NULL,
  `logo_path` TEXT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `roles` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NOT NULL,
  `descripcion` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `persona_id` BIGINT NOT NULL,
  `role_id` BIGINT NOT NULL,
  `empresa_id` BIGINT NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `email_verified_at` TIMESTAMP NULL,
  `password` VARCHAR(255) NOT NULL,
  `two_factor_secret` TEXT NULL,
  `two_factor_recovery_codes` TEXT NULL,
  `remember_token` VARCHAR(100) NULL,
  `profile_photo_path` TEXT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_users_personas1_idx` (`persona_id` ASC),
  INDEX `fk_users_empresas1_idx` (`empresa_id` ASC),
  INDEX `fk_users_roles1_idx` (`role_id` ASC),
  CONSTRAINT `fk_users_personas1`
    FOREIGN KEY (`persona_id`)
    REFERENCES `personas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_empresas1`
    FOREIGN KEY (`empresa_id`)
    REFERENCES `empresas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_roles1`
    FOREIGN KEY (`role_id`)
    REFERENCES `roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `permisos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `permisos` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NOT NULL,
  `descripcion` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC));


-- -----------------------------------------------------
-- Table `permiso_role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `permiso_role` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `permiso_id` BIGINT NOT NULL,
  `role_id` BIGINT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_permiso_rol_permisos1_idx` (`permiso_id` ASC),
  INDEX `fk_permiso_rol_roles1_idx` (`role_id` ASC),
  CONSTRAINT `fk_permiso_rol_permisos1`
    FOREIGN KEY (`permiso_id`)
    REFERENCES `permisos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_permiso_rol_roles1`
    FOREIGN KEY (`role_id`)
    REFERENCES `roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `trabajadores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `trabajadores` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `user_id` BIGINT NOT NULL,
  `curp` VARCHAR(255) NULL,
  `rfc` VARCHAR(255) NULL,
  `nss` VARCHAR(255) NULL,
  `calle` VARCHAR(255) NULL,
  `colonia` VARCHAR(255) NULL,
  `ciudad` VARCHAR(255) NULL,
  `codigo_postal` VARCHAR(255) NULL,
  `clabe_bancaria` VARCHAR(255) NULL,
  `visto_bueno` TINYINT NULL,
  `descripcion` TEXT NULL,
  `expediente_path` TEXT NULL,
  `fecha_alta` DATE NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `user_idFK_idx` (`user_id` ASC),
  CONSTRAINT `user_idFK`
    FOREIGN KEY (`user_id`)
    REFERENCES `users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `aproreco_aprore`.`sucursales`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aproreco_aprore`.`sucursales` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NOT NULL,
  `razon_social` VARCHAR(255) NULL,
  `rfc` VARCHAR(15) NULL,
  `correo` VARCHAR(255) NULL,
  `telefono` VARCHAR(255) NULL,
  `direccion` VARCHAR(255) NULL,
  `descripcion` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `aproreco_aprore`.`areas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aproreco_aprore`.`areas` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `sucursal_id` BIGINT NOT NULL,
  `nombre` VARCHAR(255) NOT NULL,
  `descripcion` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_areas_sucursales1_idx` (`sucursal_id` ASC),
  CONSTRAINT `fk_areas_sucursales1`
    FOREIGN KEY (`sucursal_id`)
    REFERENCES `aproreco_aprore`.`sucursales` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `aproreco_aprore`.`secciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aproreco_aprore`.`secciones` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `area_id` BIGINT NOT NULL,
  `nombre` VARCHAR(255) NOT NULL,
  `descripcion` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_secciones_areas1_idx` (`area_id` ASC),
  CONSTRAINT `fk_secciones_areas1`
    FOREIGN KEY (`area_id`)
    REFERENCES `aproreco_aprore`.`areas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- -----------------------------------------------------
-- Table `modulos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `modulos` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NOT NULL,
  `descripcion` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `empresa_modulo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `empresa_modulo` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `empresa_id` BIGINT NOT NULL,
  `modulo_id` BIGINT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_modulo_user_modulos1_idx` (`modulo_id` ASC),
  INDEX `fk_modulo_user_empresas1_idx` (`empresa_id` ASC),
  CONSTRAINT `fk_modulo_user_modulos1`
    FOREIGN KEY (`modulo_id`)
    REFERENCES `modulos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_modulo_user_empresas1`
    FOREIGN KEY (`empresa_id`)
    REFERENCES `empresas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `staffs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `staffs` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `empresa_id` BIGINT NOT NULL,
  `user_id` BIGINT NOT NULL,
  `role_id` BIGINT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_staffs_empresas1_idx` (`empresa_id` ASC),
  INDEX `fk_staffs_users1_idx` (`user_id` ASC),
  INDEX `fk_staffs_roles1_idx` (`role_id` ASC),
  CONSTRAINT `fk_staffs_empresas1`
    FOREIGN KEY (`empresa_id`)
    REFERENCES `empresas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_staffs_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_staffs_roles1`
    FOREIGN KEY (`role_id`)
    REFERENCES `roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `utils`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `utils` (
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME NULL,
  `created_by` INT NULL,
  `updated_by` INT NULL,
  `deleted_by` INT NULL);


-- -----------------------------------------------------
-- Table `puestos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `puestos` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `area_id` BIGINT NOT NULL,
  `seccion_id` BIGINT NOT NULL,
  `nombre` VARCHAR(255) NOT NULL,
  `descripcion` TEXT NULL,
  `contratos_max` INT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_puesto_areas1_idx` (`area_id` ASC),
  INDEX `fk_puesto_secciones1_idx` (`seccion_id` ASC),
  CONSTRAINT `fk_puesto_areas1`
    FOREIGN KEY (`area_id`)
    REFERENCES `areas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_puesto_secciones1`
    FOREIGN KEY (`seccion_id`)
    REFERENCES `secciones` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `tabuladores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tabuladores` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `puesto` VARCHAR(255) NULL,
  `rango` VARCHAR(255) NULL,
  `nivel` VARCHAR(255) NULL,
  `salario_mensual` DOUBLE NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `contratos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `contratos` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `trabajador_id` BIGINT NOT NULL,
  `puesto_id` BIGINT NOT NULL,
  `tabulador_id` BIGINT NOT NULL,
  `num_contrato` VARCHAR(255) NOT NULL,
  `tipo_contrato` VARCHAR(255) NOT NULL,
  `fecha_contrato` DATE NOT NULL,
  `fecha_contrato_fin` DATE NULL,
  `contrato_path` TEXT NULL,
  `estado` TINYINT NULL,
  `visto_bueno` TINYINT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_contrato_puestos1_idx` (`puesto_id` ASC),
  INDEX `fk_contrato_trabajadores1_idx` (`trabajador_id` ASC),
  INDEX `fk_contrato_tabuladores1_idx` (`tabulador_id` ASC),
  CONSTRAINT `fk_contrato_puestos1`
    FOREIGN KEY (`puesto_id`)
    REFERENCES `puestos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contrato_trabajadores1`
    FOREIGN KEY (`trabajador_id`)
    REFERENCES `trabajadores` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contrato_tabuladores1`
    FOREIGN KEY (`tabulador_id`)
    REFERENCES `tabuladores` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `bajas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bajas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `contrato_id` BIGINT NOT NULL,
  `tipo_baja` VARCHAR(255) NULL,
  `fecha_baja` DATE NULL,
  `descripcion` VARCHAR(255) NULL,
  `doc_renuncia_patch` TEXT NULL,
  `visto_bueno` TINYINT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_bajas_contrato1_idx` (`contrato_id` ASC),
  CONSTRAINT `fk_bajas_contrato1`
    FOREIGN KEY (`contrato_id`)
    REFERENCES `contratos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `vacante`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `vacante` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `puesto_id` BIGINT NOT NULL,
  `tabulador_id` BIGINT NOT NULL,
  `descripcion` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_vacante_puesto1_idx` (`puesto_id` ASC),
  INDEX `fk_vacante_tabuladores1_idx` (`tabulador_id` ASC),
  CONSTRAINT `fk_vacante_puesto1`
    FOREIGN KEY (`puesto_id`)
    REFERENCES `puestos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vacante_tabuladores1`
    FOREIGN KEY (`tabulador_id`)
    REFERENCES `tabuladores` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `failed_jobs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `uuid` VARCHAR(255) NOT NULL,
  `connection` TEXT NOT NULL,
  `queue` TEXT NOT NULL,
  `payload` LONGTEXT NOT NULL,
  `exception` LONGTEXT NOT NULL,
  `failed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `uuid_UNIQUE` (`uuid` ASC));
