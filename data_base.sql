-- -----------------------------------------------------
-- Table `aproreco_aprore`.`personas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aproreco_aprore`.`personas` (
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
-- Table `aproreco_aprore`.`empresas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aproreco_aprore`.`empresas` (
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
-- Table `aproreco_aprore`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aproreco_aprore`.`roles` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NOT NULL,
  `descripcion` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `aproreco_aprore`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aproreco_aprore`.`users` (
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
    REFERENCES `aproreco_aprore`.`personas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_empresas1`
    FOREIGN KEY (`empresa_id`)
    REFERENCES `aproreco_aprore`.`empresas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_roles1`
    FOREIGN KEY (`role_id`)
    REFERENCES `aproreco_aprore`.`roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `aproreco_aprore`.`permisos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aproreco_aprore`.`permisos` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NOT NULL,
  `descripcion` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC));


-- -----------------------------------------------------
-- Table `aproreco_aprore`.`permiso_role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aproreco_aprore`.`permiso_role` (
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
    REFERENCES `aproreco_aprore`.`permisos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_permiso_rol_roles1`
    FOREIGN KEY (`role_id`)
    REFERENCES `aproreco_aprore`.`roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `aproreco_aprore`.`trabajadores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aproreco_aprore`.`trabajadores` (
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
  `estado` TINYINT NULL DEFAULT 0,
  `fecha_alta` DATE NULL,
  `expediente_path` TEXT NULL,
  `visto_bueno` TINYINT NULL,
  `descripcion` TEXT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `user_idFK_idx` (`user_id` ASC),
  CONSTRAINT `user_idFK`
    FOREIGN KEY (`user_id`)
    REFERENCES `aproreco_aprore`.`users` (`id`)
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
-- Table `aproreco_aprore`.`modulos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aproreco_aprore`.`modulos` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NOT NULL,
  `descripcion` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `aproreco_aprore`.`empresa_modulo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aproreco_aprore`.`empresa_modulo` (
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
    REFERENCES `aproreco_aprore`.`modulos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_modulo_user_empresas1`
    FOREIGN KEY (`empresa_id`)
    REFERENCES `aproreco_aprore`.`empresas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `aproreco_aprore`.`staffs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aproreco_aprore`.`staffs` (
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
    REFERENCES `aproreco_aprore`.`empresas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_staffs_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `aproreco_aprore`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_staffs_roles1`
    FOREIGN KEY (`role_id`)
    REFERENCES `aproreco_aprore`.`roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `aproreco_aprore`.`utils`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aproreco_aprore`.`utils` (
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME NULL,
  `created_by` INT NULL,
  `updated_by` INT NULL,
  `deleted_by` INT NULL);


-- -----------------------------------------------------
-- Table `aproreco_aprore`.`bajas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aproreco_aprore`.`bajas` (
  `id` BIGINT NOT NULL,
  `trabajador_id` BIGINT NOT NULL,
  `tipo_baja` VARCHAR(255) NULL,
  `fecha_baja` DATE NULL,
  `descripcion` VARCHAR(255) NULL,
  `doc_renuncia_patch` TEXT NULL,
  `estado` TINYINT NULL,
  `visto_bueno` TINYINT NULL,
  `descripcion` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_bajas_trabajadores1_idx` (`trabajador_id` ASC),
  CONSTRAINT `fk_bajas_trabajadores1`
    FOREIGN KEY (`trabajador_id`)
    REFERENCES `aproreco_aprore`.`trabajadores` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `aproreco_aprore`.`tabuladores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aproreco_aprore`.`tabuladores` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `rango` VARCHAR(255) NULL,
  `nivel` VARCHAR(255) NULL,
  `salario_mensual` DOUBLE NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `aproreco_aprore`.`puestos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aproreco_aprore`.`puestos` (
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
    REFERENCES `aproreco_aprore`.`areas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_puesto_secciones1`
    FOREIGN KEY (`seccion_id`)
    REFERENCES `aproreco_aprore`.`secciones` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `aproreco_aprore`.`vacante`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aproreco_aprore`.`vacante` (
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
    REFERENCES `aproreco_aprore`.`puestos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vacante_tabuladores1`
    FOREIGN KEY (`tabulador_id`)
    REFERENCES `aproreco_aprore`.`tabuladores` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `aproreco_aprore`.`contratos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aproreco_aprore`.`contratos` (
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
    REFERENCES `aproreco_aprore`.`puestos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contrato_trabajadores1`
    FOREIGN KEY (`trabajador_id`)
    REFERENCES `aproreco_aprore`.`trabajadores` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contrato_tabuladores1`
    FOREIGN KEY (`tabulador_id`)
    REFERENCES `aproreco_aprore`.`tabuladores` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `aproreco_aprore`.`failed_jobs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aproreco_aprore`.`failed_jobs` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `uuid` VARCHAR(255) NOT NULL,
  `connection` TEXT NOT NULL,
  `queue` TEXT NOT NULL,
  `payload` LONGTEXT NOT NULL,
  `exception` LONGTEXT NOT NULL,
  `failed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `uuid_UNIQUE` (`uuid` ASC));
