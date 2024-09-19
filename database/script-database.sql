
-- -----------------------------------------------------
-- Schema savi_3
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `cat_tipo_reporte`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cat_tipo_reporte` (
  `id_tipo_reporte` INT NOT NULL AUTO_INCREMENT,
  `concepto` VARCHAR(45) NULL,
  `abreviacion` VARCHAR(5) NULL,
  `activo` TINYINT NULL,
  PRIMARY KEY (`id_tipo_reporte`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sap_oitm`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sap_oitm` (
  `id_oitm` INT NOT NULL AUTO_INCREMENT,
  `codigo_sap_articulo` TEXT NULL,
  `nombre_articulo` TEXT NULL,
  `clave_articulo` TEXT NULL,
  `numero_tela` INT NULL,
  `familia_articulo` INT NULL,
  `en_stock_sap` FLOAT NULL,
  `proveedor_linea` TEXT NULL,
  `cantidad_compra_costo` FLOAT NULL,
  `es_pt` TEXT NULL,
  `tipo_material1` TEXT NULL,
  `tipo_material2` TEXT NULL,
  `cliente` TEXT NULL,
  `unidad_costo` TEXT NULL,
  `unidad_compra` TEXT NULL,
  `ultimo_precio_compra` FLOAT NULL,
  `f_sincronizacion` DATETIME NULL,
  PRIMARY KEY (`id_oitm`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cat_endpoints`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cat_endpoints` (
  `id_endpoints` INT NOT NULL AUTO_INCREMENT,
  `endpoint` TEXT NULL,
  `user_name` VARCHAR(45) NULL,
  `password` VARCHAR(155) NULL,
  `company_db` VARCHAR(155) NULL,
  `activo` TINYINT NULL,
  `flujo` INT NULL,
  PRIMARY KEY (`id_endpoints`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cat_metodo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cat_metodo` (
  `id_metodo` INT NOT NULL AUTO_INCREMENT,
  `metodo` VARCHAR(45) NULL,
  `flujo` INT NULL,
  `activo` TINYINT NULL,
  PRIMARY KEY (`id_metodo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rom_endpoints_has_metodo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rom_endpoints_has_metodo` (
  `id_rom_endpoint_metodo` INT NOT NULL,
  `id_endpoints` INT NULL,
  `id_metodo` INT NULL,
  INDEX `fk_cat_endpoints_has_cat_metodo_cat_metodo1_idx` (`id_metodo` ASC) ,
  INDEX `fk_cat_endpoints_has_cat_metodo_cat_endpoints_idx` (`id_endpoints` ASC) ,
  PRIMARY KEY (`id_rom_endpoint_metodo`),
  CONSTRAINT `fk_cat_endpoints_has_cat_metodo_cat_endpoints`
    FOREIGN KEY (`id_endpoints`)
    REFERENCES `cat_endpoints` (`id_endpoints`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cat_endpoints_has_cat_metodo_cat_metodo1`
    FOREIGN KEY (`id_metodo`)
    REFERENCES `cat_metodo` (`id_metodo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sap_session`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sap_session` (
  `id_session` INT NOT NULL AUTO_INCREMENT,
  `session_id` TEXT NULL,
  `session_timeout` INT NULL,
  `activo` TINYINT NULL,
  `f_sincronizacion` DATETIME NULL,
  PRIMARY KEY (`id_session`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sap_itm1`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sap_itm1` (
  `id_itm1` INT NOT NULL AUTO_INCREMENT,
  `codigo_sap_articulo` TEXT NULL,
  `lista_precio` INT NULL,
  `precio_costo` FLOAT NULL,
  `f_sincronizacion` DATETIME NULL,
  PRIMARY KEY (`id_itm1`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sap_oitb`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sap_oitb` (
  `id_oitb` INT NOT NULL AUTO_INCREMENT,
  `familia_articulo` INT NULL,
  `familia_descripcion` TEXT NULL,
  `f_sincronizacion` DATETIME NULL,
  PRIMARY KEY (`id_oitb`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sap_ittm1`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sap_ittm1` (
  `id_ittm1` INT NOT NULL AUTO_INCREMENT,
  `fhater` TEXT NULL,
  `code` VARCHAR(155) NULL,
  `quantity` FLOAT NULL,
  `f_sincronizacion` DATETIME NULL,
  PRIMARY KEY (`id_ittm1`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cat_plantas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cat_plantas` (
  `id_plantas` INT NOT NULL AUTO_INCREMENT,
  `concepto` VARCHAR(45) NULL,
  `activo` TINYINT NULL,
  PRIMARY KEY (`id_plantas`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cat_almacen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cat_almacen` (
  `id_almacen` INT NOT NULL AUTO_INCREMENT,
  `concepto` VARCHAR(45) NULL,
  `codigo` VARCHAR(5) NULL,
  `activo` TINYINT NULL,
  `id_plantas` INT NULL,
  PRIMARY KEY (`id_almacen`),
  INDEX `fk_cat_almacen_cat_plantas1_idx` (`id_plantas` ASC) ,
  CONSTRAINT `fk_cat_almacen_cat_plantas1`
    FOREIGN KEY (`id_plantas`)
    REFERENCES `cat_plantas` (`id_plantas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sap_warehouse`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sap_warehouse` (
  `id_warehouse` INT NOT NULL AUTO_INCREMENT,
  `item_code` TEXT NULL,
  `warehouse_code` VARCHAR(10) NULL,
  `in_stock` FLOAT NULL,
  `f_sincronizacion` DATETIME NULL,
  PRIMARY KEY (`id_warehouse`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rom_warehouse_has_almacen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rom_warehouse_has_almacen` (
  `id_warehouse` INT NULL,
  `id_almacen` INT NULL,
  INDEX `fk_sap_warehouse_has_cat_almacen_cat_almacen1_idx` (`id_almacen` ASC) ,
  INDEX `fk_sap_warehouse_has_cat_almacen_sap_warehouse1_idx` (`id_warehouse` ASC) ,
  CONSTRAINT `fk_sap_warehouse_has_cat_almacen_sap_warehouse1`
    FOREIGN KEY (`id_warehouse`)
    REFERENCES `sap_warehouse` (`id_warehouse`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sap_warehouse_has_cat_almacen_cat_almacen1`
    FOREIGN KEY (`id_almacen`)
    REFERENCES `cat_almacen` (`id_almacen`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rom_almacen_has_tipo_reporte`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rom_almacen_has_tipo_reporte` (
  `id_almacen` INT NULL,
  `id_tipo_reporte` INT NULL,
  INDEX `fk_cat_almacen_has_cat_tipo_reporte_cat_tipo_reporte1_idx` (`id_tipo_reporte` ASC) ,
  INDEX `fk_cat_almacen_has_cat_tipo_reporte_cat_almacen1_idx` (`id_almacen` ASC) ,
  CONSTRAINT `fk_cat_almacen_has_cat_tipo_reporte_cat_almacen1`
    FOREIGN KEY (`id_almacen`)
    REFERENCES `cat_almacen` (`id_almacen`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cat_almacen_has_cat_tipo_reporte_cat_tipo_reporte1`
    FOREIGN KEY (`id_tipo_reporte`)
    REFERENCES `cat_tipo_reporte` (`id_tipo_reporte`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cat_roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cat_roles` (
  `id_roles` INT NOT NULL AUTO_INCREMENT,
  `concepto` VARCHAR(45) NULL,
  `activo` TINYINT NULL,
  PRIMARY KEY (`id_roles`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cat_departamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cat_departamento` (
  `id_departamento` INT NOT NULL AUTO_INCREMENT,
  `concepto` TEXT NULL,
  `activo` TINYINT NULL,
  PRIMARY KEY (`id_departamento`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ent_usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ent_usuario` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `nombre` TEXT NULL,
  `apellidos` TEXT NULL,
  `correo_electronico` TEXT NULL,
  `usuario` VARCHAR(45) NULL,
  `contrasenia` LONGTEXT NULL,
  `id_roles` INT NULL,
  `id_departamento` INT NULL,
  `id_plantas` INT NULL,
  `activo` TINYINT NULL,
  PRIMARY KEY (`id_usuario`),
  INDEX `fk_ent_usuario_cat_roles1_idx` (`id_roles` ASC) ,
  INDEX `fk_ent_usuario_cat_departamento1_idx` (`id_departamento` ASC) ,
  INDEX `fk_ent_usuario_cat_plantas1_idx` (`id_plantas` ASC) ,
  CONSTRAINT `fk_ent_usuario_cat_roles1`
    FOREIGN KEY (`id_roles`)
    REFERENCES `cat_roles` (`id_roles`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ent_usuario_cat_departamento1`
    FOREIGN KEY (`id_departamento`)
    REFERENCES `cat_departamento` (`id_departamento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ent_usuario_cat_plantas1`
    FOREIGN KEY (`id_plantas`)
    REFERENCES `cat_plantas` (`id_plantas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sap_business_partnes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sap_business_partnes` (
  `id_business_partnes` INT NOT NULL AUTO_INCREMENT,
  `card_code` TEXT NULL,
  `card_name` TEXT NULL,
  `card_foreign_name` TEXT NULL,
  `contact_employee` LONGTEXT NULL,
  `f_sincronizacion` DATETIME NULL,
  PRIMARY KEY (`id_business_partnes`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cat_condicion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cat_condicion` (
  `id_condicion` INT NOT NULL AUTO_INCREMENT,
  `concepto` VARCHAR(45) NULL,
  `descripcion` TEXT NULL,
  `activo` TINYINT NULL,
  PRIMARY KEY (`id_condicion`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cat_aplicacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cat_aplicacion` (
  `id_aplicacion` INT NOT NULL AUTO_INCREMENT,
  `concepto` VARCHAR(45) NULL,
  `activo` TINYINT NULL,
  PRIMARY KEY (`id_aplicacion`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cat_condiciones_comerciales`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cat_condiciones_comerciales` (
  `id_condiciones_comerciales` INT NOT NULL AUTO_INCREMENT,
  `id_business_partnes` INT NOT NULL,
  `id_condicion` INT NOT NULL,
  `codigo_descuento` VARCHAR(15) NULL,
  `porcentaje` FLOAT NULL,
  `id_aplicacion` INT NOT NULL,
  `activo` TINYINT NULL,
  PRIMARY KEY (`id_condiciones_comerciales`),
  INDEX `fk_cat_condiciones_comerciales_sap_business_partnes1_idx` (`id_business_partnes` ASC) ,
  INDEX `fk_cat_condiciones_comerciales_cat_condicion1_idx` (`id_condicion` ASC) ,
  INDEX `fk_cat_condiciones_comerciales_cat_aplicacion1_idx` (`id_aplicacion` ASC) ,
  CONSTRAINT `fk_cat_condiciones_comerciales_sap_business_partnes1`
    FOREIGN KEY (`id_business_partnes`)
    REFERENCES `sap_business_partnes` (`id_business_partnes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cat_condiciones_comerciales_cat_condicion1`
    FOREIGN KEY (`id_condicion`)
    REFERENCES `cat_condicion` (`id_condicion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cat_condiciones_comerciales_cat_aplicacion1`
    FOREIGN KEY (`id_aplicacion`)
    REFERENCES `cat_aplicacion` (`id_aplicacion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cat_tipo_cotizacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cat_tipo_cotizacion` (
  `id_tipo_cotizacion` INT NOT NULL AUTO_INCREMENT,
  `concepto` VARCHAR(45) NULL,
  `activo` TINYINT NULL,
  PRIMARY KEY (`id_tipo_cotizacion`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cat_estatus`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cat_estatus` (
  `id_estatus` INT NOT NULL AUTO_INCREMENT,
  `concepto` VARCHAR(45) NULL,
  `activo` TINYINT NULL,
  PRIMARY KEY (`id_estatus`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ent_cotizacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ent_cotizacion` (
  `id_cotizacion` INT NOT NULL AUTO_INCREMENT,
  `folio_consecutivo` INT NULL,
  `id_tipo_cotizacion` INT NOT NULL,
  `id_estatus` INT NOT NULL,
  `id_business_partnes` INT NOT NULL,
  `u_registro` INT NULL,
  `f_registro` DATETIME NULL,
  `auto_ventas` TINYINT NULL,
  `auto_direccion` TINYINT NULL,
  `auto_disenio` TINYINT NULL,
  `auto_contabilidad` TINYINT NULL,
  PRIMARY KEY (`id_cotizacion`),
  INDEX `fk_ent_cotizacion_cat_tipo_cotizacion1_idx` (`id_tipo_cotizacion` ASC) ,
  INDEX `fk_ent_cotizacion_cat_estatus1_idx` (`id_estatus` ASC) ,
  INDEX `fk_ent_cotizacion_sap_business_partnes1_idx` (`id_business_partnes` ASC) ,
  CONSTRAINT `fk_ent_cotizacion_cat_tipo_cotizacion1`
    FOREIGN KEY (`id_tipo_cotizacion`)
    REFERENCES `cat_tipo_cotizacion` (`id_tipo_cotizacion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ent_cotizacion_cat_estatus1`
    FOREIGN KEY (`id_estatus`)
    REFERENCES `cat_estatus` (`id_estatus`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ent_cotizacion_sap_business_partnes1`
    FOREIGN KEY (`id_business_partnes`)
    REFERENCES `sap_business_partnes` (`id_business_partnes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cat_claves`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cat_claves` (
  `id_claves` INT NOT NULL AUTO_INCREMENT,
  `concepto` VARCHAR(45) NULL,
  `mts_1` FLOAT NULL,
  `mts_2` FLOAT NULL,
  `mts_3` FLOAT NULL,
  `mts_4` FLOAT NULL,
  `pata_1` INT NULL,
  `pata_2` INT NULL,
  `herraje_1` INT NULL,
  `herraje_2` INT NULL,
  `ebanisteria_1` INT NULL,
  `ebanisteria_2` INT NULL,
  `ebanisteria_3` INT NULL,
  `maquinas` INT NULL,
  `pegado_hule` INT NULL,
  `armado` INT NULL,
  `blanco` INT NULL,
  `costura` INT NULL,
  `tapiceria` INT NULL,
  `total` INT NULL,
  `mano_de_obra` FLOAT NULL,
  `porcentaje` FLOAT NULL,
  `imagen` TEXT NULL,
  `u_registro` INT NULL,
  `u_nom_usuario` VARCHAR(45) NULL,
  PRIMARY KEY (`id_claves`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rom_cotizacion_has_claves`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rom_cotizacion_has_claves` (
  `id_cotizaciones_claves` INT NOT NULL AUTO_INCREMENT,
  `id_cotizacion` INT NULL,
  `id_claves` INT NULL,
  `id_padre` INT NULL,
  `variante` TINYINT NULL,
  INDEX `fk_ent_cotizacion_has_cat_claves_cat_claves1_idx` (`id_claves` ASC) ,
  INDEX `fk_ent_cotizacion_has_cat_claves_ent_cotizacion1_idx` (`id_cotizacion` ASC) ,
  PRIMARY KEY (`id_cotizaciones_claves`),
  CONSTRAINT `fk_ent_cotizacion_has_cat_claves_ent_cotizacion1`
    FOREIGN KEY (`id_cotizacion`)
    REFERENCES `ent_cotizacion` (`id_cotizacion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ent_cotizacion_has_cat_claves_cat_claves1`
    FOREIGN KEY (`id_claves`)
    REFERENCES `cat_claves` (`id_claves`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `temp_cotizacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `temp_cotizacion` (
  `id_temp_cotizacion` INT NOT NULL AUTO_INCREMENT,
  `id_cotizaciones_claves` INT NULL,
  `id_cotizacion` INT NULL,
  `codigo_sap_articulo` TEXT NULL,
  `mano_obra` FLOAT NULL,
  `id_tela_uno` INT NULL,
  `clave_tela_uno` VARCHAR(45) NULL,
  `nombre_tela_uno` VARCHAR(45) NULL,
  `mts_uno` FLOAT NULL,
  `precio_costo_uno` FLOAT NULL,
  `importe_uno` FLOAT NULL,
  `id_tela_dos` INT NULL,
  `clave_tela_dos` VARCHAR(45) NULL,
  `nombre_tela_dos` VARCHAR(45) NULL,
  `mts_dos` FLOAT NULL,
  `precio_costo_dos` FLOAT NULL,
  `importe_dos` FLOAT NULL,
  `id_tela_tres` INT NULL,
  `clave_tela_tres` VARCHAR(45) NULL,
  `nombre_tela_tres` VARCHAR(45) NULL,
  `mts_tres` FLOAT NULL,
  `precio_costo_tres` FLOAT NULL,
  `importe_tres` FLOAT NULL,
  `id_tela_cuatro` INT NULL,
  `clave_tela_cuatro` VARCHAR(45) NULL,
  `nombre_tela_cuatro` VARCHAR(45) NULL,
  `mts_cuatro` FLOAT NULL,
  `precio_costo_cuatro` FLOAT NULL,
  `importe_cuatro` FLOAT NULL,
  `id_pata_uno` INT NULL,
  `clave_pata_uno` VARCHAR(45) NULL,
  `nombre_pata_uno` VARCHAR(45) NULL,
  `pz_pata_uno` INT NULL,
  `precio_costo_pata_uno` FLOAT NULL,
  `importe_pata_uno` FLOAT NULL,
  `id_pata_dos` INT NULL,
  `clave_pata_dos` VARCHAR(45) NULL,
  `nombre_pata_dos` VARCHAR(45) NULL,
  `pz_pata_dos` INT NULL,
  `precio_costo_pata_dos` FLOAT NULL,
  `importe_pata_dos` FLOAT NULL,
  `id_herraje_uno` INT NULL,
  `clave_herraje_uno` VARCHAR(45) NULL,
  `nombre_herraje_uno` VARCHAR(45) NULL,
  `pz_herraje_uno` INT NULL,
  `precio_costo_herraje_uno` FLOAT NULL,
  `importe_herraje_uno` FLOAT NULL,
  `id_herraje_dos` INT NULL,
  `clave_herraje_dos` VARCHAR(45) NULL,
  `nombre_herraje_dos` VARCHAR(45) NULL,
  `pz_herraje_dos` INT NULL,
  `precio_costo_herraje_dos` FLOAT NULL,
  `importe_herraje_dos` FLOAT NULL,
  `id_ebanesteria_uno` INT NULL,
  `clave_ebanesteria_uno` VARCHAR(45) NULL,
  `nombre_ebanesteria_uno` VARCHAR(45) NULL,
  `pz_ebanesteria_uno` INT NULL,
  `precio_costo_ebanesteria_uno` FLOAT NULL,
  `importe_ebanesteria_uno` FLOAT NULL,
  `id_ebanesteria_dos` INT NULL,
  `clave_ebanesteria_dos` VARCHAR(45) NULL,
  `nombre_ebanesteria_dos` VARCHAR(45) NULL,
  `pz_ebanesteria_dos` INT NULL,
  `precio_costo_ebanesteria_dos` FLOAT NULL,
  `importe_ebanesteria_dos` FLOAT NULL,
  `id_ebanesteria_tres` INT NULL,
  `clave_ebanesteria_tres` VARCHAR(45) NULL,
  `nombre_ebanesteria_tres` VARCHAR(45) NULL,
  `pz_ebanesteria_tres` INT NULL,
  `precio_costo_ebanesteria_tres` FLOAT NULL,
  `importe_ebanesteria_tres` FLOAT NULL,
  `id_padre` INT NULL,
  `total_g_telas` FLOAT NULL,
  `total_g_patas` FLOAT NULL,
  `total_g_herrajes_importados` FLOAT NULL,
  `total_g_ebanesteria` FLOAT NULL,
  `costo_materia_prima` FLOAT NULL,
  `total_herraje_nacional` FLOAT NULL,
  `precio_sugerido` FLOAT NULL,
  `gastos_uni` FLOAT NULL,
  `nom_uni` FLOAT NULL,
  `desc_uni` FLOAT NULL,
  `gast_fin_uni` FLOAT NULL,
  `flete_uni` FLOAT NULL,
  `comision` FLOAT NULL,
  `costo_total` FLOAT NULL,
  `concepto` VARCHAR(45) NULL,
  `total_kit_hab` FLOAT NULL,
  `total_kit_hul` FLOAT NULL,
  `total_kit_mp` FLOAT NULL,
  `total_mp` FLOAT NULL,
  `imagen` TEXT NULL,
  `id_cliente` INT NULL,
  `cliente` TEXT NULL,
  `descripcion_general` LONGTEXT NULL,
  `margen` FLOAT NULL,
  PRIMARY KEY (`id_temp_cotizacion`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `conf_fijos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `conf_fijos` (
  `id_fijos` INT NOT NULL AUTO_INCREMENT,
  `concepto` VARCHAR(45) NULL,
  `valor` FLOAT NULL,
  `activo` TINYINT NULL,
  PRIMARY KEY (`id_fijos`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `temp_kits_hb`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `temp_kits_hb` (
  `id_kits_hb` INT NOT NULL AUTO_INCREMENT,
  `id_ittm1` INT NULL,
  `fhater` VARCHAR(45) NULL,
  `code` VARCHAR(45) NULL,
  `quantity` FLOAT NULL,
  `id_itm1` VARCHAR(45) NULL,
  `precio_costo` FLOAT NULL,
  `kit` VARCHAR(45) NULL,
  `id_cotizaciones_claves` INT NULL,
  `id_cotizacion` INT NULL,
  `descripcion` LONGTEXT NULL,
  `familia_articulo` INT NULL,
  PRIMARY KEY (`id_kits_hb`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cat_detalle_cotizacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cat_detalle_cotizacion` (
  `id_detalle_cotizacion` INT NOT NULL AUTO_INCREMENT,
  `codigo_sap_articulo` TEXT NULL,
  `mano_obra` FLOAT NULL,
  `id_tela_uno` INT NULL,
  `clave_tela_uno` VARCHAR(45) NULL,
  `nombre_tela_uno` TEXT NULL,
  `mts_uno` FLOAT NULL,
  `precio_costo_uno` FLOAT NULL,
  `importe_uno` FLOAT NULL,
  `id_tela_dos` INT NULL,
  `clave_tela_dos` VARCHAR(45) NULL,
  `nombre_tela_dos` TEXT NULL,
  `mts_dos` FLOAT NULL,
  `precio_costo_dos` FLOAT NULL,
  `importe_dos` FLOAT NULL,
  `id_tela_tres` INT NULL,
  `clave_tela_tres` VARCHAR(45) NULL,
  `nombre_tela_tres` TEXT NULL,
  `mts_tres` FLOAT NULL,
  `precio_costo_tres` FLOAT NULL,
  `importe_tres` FLOAT NULL,
  `id_tela_cuatro` INT NULL,
  `clave_tela_cuatro` VARCHAR(45) NULL,
  `nombre_tela_cuatro` TEXT NULL,
  `mts_cuatro` FLOAT NULL,
  `precio_costo_cuatro` FLOAT NULL,
  `importe_cuatro` FLOAT NULL,
  `id_pata_uno` INT NULL,
  `clave_pata_uno` VARCHAR(45) NULL,
  `nombre_pata_uno` TEXT NULL,
  `pz_pata_uno` INT NULL,
  `precio_costo_pata_uno` FLOAT NULL,
  `importe_pata_uno` FLOAT NULL,
  `id_pata_dos` INT NULL,
  `clave_pata_dos` VARCHAR(45) NULL,
  `nombre_pata_dos` TEXT NULL,
  `pz_pata_dos` INT NULL,
  `precio_costo_pata_dos` FLOAT NULL,
  `importe_pata_dos` FLOAT NULL,
  `id_herraje_uno` INT NULL,
  `clave_herraje_uno` VARCHAR(45) NULL,
  `nombre_herraje_uno` TEXT NULL,
  `pz_herraje_uno` INT NULL,
  `precio_costo_herraje_uno` FLOAT NULL,
  `importe_herraje_uno` FLOAT NULL,
  `id_herraje_dos` INT NULL,
  `clave_herraje_dos` VARCHAR(45) NULL,
  `nombre_herraje_dos` TEXT NULL,
  `pz_herraje_dos` INT NULL,
  `precio_costo_herraje_dos` FLOAT NULL,
  `importe_herraje_dos` FLOAT NULL,
  `id_ebanesteria_uno` INT NULL,
  `clave_ebanesteria_uno` VARCHAR(45) NULL,
  `nombre_ebanesteria_uno` TEXT NULL,
  `pz_ebanesteria_uno` INT NULL,
  `precio_costo_ebanesteria_uno` FLOAT NULL,
  `importe_ebanesteria_uno` FLOAT NULL,
  `id_ebanesteria_dos` INT NULL,
  `nombre_ebanesteria_dos` TEXT NULL,
  `clave_ebanesteria_dos` VARCHAR(45) NULL,
  `pz_ebanesteria_dos` INT NULL,
  `precio_costo_ebanesteria_dos` FLOAT NULL,
  `importe_ebanesteria_dos` FLOAT NULL,
  `id_ebanesteria_tres` INT NULL,
  `clave_ebanesteria_tres` VARCHAR(45) NULL,
  `nombre_ebanesteria_tres` TEXT NULL,
  `pz_ebanesteria_tres` INT NULL,
  `precio_costo_ebanesteria_tres` FLOAT NULL,
  `importe_ebanesteria_tres` FLOAT NULL,
  `total_g_telas` FLOAT NULL,
  `total_g_patas` FLOAT NULL,
  `total_g_herrajes_importados` FLOAT NULL,
  `total_g_ebanesteria` FLOAT NULL,
  `costo_materia_prima` FLOAT NULL,
  `total_herraje_nacional` FLOAT NULL,
  `precio_sugerido` FLOAT NULL,
  `gastos_uni` FLOAT NULL,
  `nom_uni` FLOAT NULL,
  `desc_uni` FLOAT NULL,
  `gast_fin_uni` FLOAT NULL,
  `flete_uni` FLOAT NULL,
  `comision` FLOAT NULL,
  `costo_total` FLOAT NULL,
  `concepto` VARCHAR(45) NULL,
  `descripcion_general` TEXT NULL,
  `total_kit_hab` FLOAT NULL,
  `total_kit_hul` FLOAT NULL,
  `total_kit_mp` FLOAT NULL,
  `total_mp` FLOAT NULL,
  `margen` FLOAT NULL,
  `observaciones` LONGTEXT NULL,
  `estatus` INT NULL,
  PRIMARY KEY (`id_detalle_cotizacion`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rom_detalle_cotizacion_has_cotizacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rom_detalle_cotizacion_has_cotizacion` (
  `id_detalle_cotizacion` INT NULL,
  `id_cotizacion` INT NULL,
  INDEX `fk_cat_detalle_cotizacion_has_ent_cotizacion_ent_cotizacion_idx` (`id_cotizacion` ASC) ,
  INDEX `fk_cat_detalle_cotizacion_has_ent_cotizacion_cat_detalle_co_idx` (`id_detalle_cotizacion` ASC) ,
  CONSTRAINT `fk_cat_detalle_cotizacion_has_ent_cotizacion_cat_detalle_coti1`
    FOREIGN KEY (`id_detalle_cotizacion`)
    REFERENCES `cat_detalle_cotizacion` (`id_detalle_cotizacion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cat_detalle_cotizacion_has_ent_cotizacion_ent_cotizacion1`
    FOREIGN KEY (`id_cotizacion`)
    REFERENCES `ent_cotizacion` (`id_cotizacion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Product_trees`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Product_trees` (
  `product_trees` INT NOT NULL AUTO_INCREMENT,
  `fhater` TEXT NULL,
  `itemCode` VARCHAR(155) NULL,
  `quantity` FLOAT NULL,
  PRIMARY KEY (`product_trees`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `conf_margen_global`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `conf_margen_global` (
  `id_margen_global` INT NOT NULL AUTO_INCREMENT,
  `concepto` VARCHAR(45) NULL,
  `valor` FLOAT NULL,
  PRIMARY KEY (`id_margen_global`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- View `vis_endpoint_metodo`
-- -----------------------------------------------------
CREATE  OR REPLACE VIEW `vis_endpoint_metodo` AS
select 
rehm.id_rom_endpoint_metodo,
ce.id_endpoints,
ce.endpoint,
ce.user_name,
ce.password,
ce.company_db,
ce.activo as endpoint_activo,
ce.flujo,
cm.id_metodo,
cm.metodo,
cm.flujo as flujo_metodo,
cm.activo as metodo_activo
from rom_endpoints_has_metodo rehm
inner join cat_endpoints ce on ce.id_endpoints = rehm.id_endpoints
inner join cat_metodo cm on cm.id_metodo = rehm.id_metodo;

-- -----------------------------------------------------
-- View `vis_sap`
-- -----------------------------------------------------
CREATE  OR REPLACE VIEW `vis_sap` AS
select
so.id_oitm,
so.codigo_sap_articulo,
so.nombre_articulo,
so.clave_articulo,
so.numero_tela,
so.familia_articulo,
soi.familia_descripcion,
so.en_stock_sap,
so.proveedor_linea,
so.cantidad_compra_costo,
so.es_pt,
so.tipo_material1,
so.tipo_material2,
so.cliente,
so.unidad_costo,
so.unidad_compra,
si.lista_precio,
si.precio_costo
from sap_oitm so
inner join sap_itm1 si on si.codigo_sap_articulo = so.codigo_sap_articulo
inner join sap_oitb soi on soi.familia_articulo = so.familia_articulo;

-- -----------------------------------------------------
-- View `vis_reporte_almacen_mp_116`
-- -----------------------------------------------------
CREATE  OR REPLACE VIEW `vis_reporte_almacen_mp_116` AS 
select
vs.codigo_sap_articulo,
vs.nombre_articulo as material,
vs.familia_articulo as familia,
vs.familia_descripcion,
vs.unidad_costo as unidad,
vs.precio_costo as precio,
sw.in_stock as stock,
vs.precio_costo * sw.in_stock as importe,
sw.warehouse_code,
sw.in_stock,
ca.id_almacen,
ca.concepto as almacen,
ca.codigo as codigo_almacen,
cp.id_plantas,
cp.concepto as planta
from rom_warehouse_has_almacen rwha
inner join sap_warehouse sw on sw.id_warehouse = rwha.id_warehouse
inner join cat_almacen ca on ca.id_almacen = rwha.id_almacen
inner join cat_plantas cp on cp.id_plantas = ca.id_plantas
inner join vis_sap vs on vs.codigo_sap_articulo = sw.item_code
where sw.item_code like "A0%" and sw.in_stock > 0;

-- -----------------------------------------------------
-- View `vis_almacen_tipo_reporte`
-- -----------------------------------------------------
CREATE  OR REPLACE VIEW `vis_almacen_tipo_reporte` AS
select
ca.id_almacen,
ca.concepto as almacen,
ca.codigo as almacen_codigo,
ca.activo as almacen_actibvo,
cp.id_plantas,
cp.concepto as planta,
cp.activo as activo_planta,
ctr.id_tipo_reporte,
ctr.concepto as tipo_reporte,
ctr.abreviacion as abreviacion_tipo_reporte,
ctr.activo as activo_tipo_reporte
from rom_almacen_has_tipo_reporte rahtr
inner join cat_almacen ca on ca.id_almacen = rahtr.id_almacen
inner join cat_plantas cp on cp.id_plantas = ca.id_plantas
inner join cat_tipo_reporte ctr on ctr.id_tipo_reporte = rahtr.id_tipo_reporte;

-- -----------------------------------------------------
-- View `vis_usuarios`
-- -----------------------------------------------------
CREATE  OR REPLACE VIEW `vis_usuarios` AS
select 
eu.id_usuario,
eu.nombre,
eu.apellidos,
eu.correo_electronico,
eu.usuario,
eu.contrasenia,
cr.id_roles,
cr.concepto as rol,
cd.id_departamento,
cd.concepto as departamento,
cp.id_plantas,
cp.concepto as planta,
eu.activo as usuario_activo
from ent_usuario eu
inner join cat_roles cr on cr.id_roles = eu.id_roles
inner join cat_departamento cd on cd.id_departamento = eu.id_departamento
inner join cat_plantas cp on cp.id_plantas = eu.id_plantas;

-- -----------------------------------------------------
-- View `vis_condiciones_comerciales`
-- -----------------------------------------------------
CREATE  OR REPLACE VIEW `vis_condiciones_comerciales` AS
select
ccc.id_condiciones_comerciales,
sbp.id_business_partnes,
sbp.card_code,
sbp.card_name,
sbp.card_foreign_name,
sbp.contact_employee,
cc.id_condicion,
ccc.codigo_descuento,
ccc.porcentaje,
cc.concepto as condicion,
cc.descripcion as descripcion_condicion,
ca.id_aplicacion,
ca.concepto as aplicacion,
ccc.activo as cc_activo
from cat_condiciones_comerciales ccc
inner join sap_business_partnes sbp on sbp.id_business_partnes = ccc.id_business_partnes
inner join cat_condicion cc on cc.id_condicion = ccc.id_condicion
inner join cat_aplicacion ca on ca.id_aplicacion = ccc.id_aplicacion;

-- -----------------------------------------------------
-- View `vis_cotizacion_consecutivo`
-- -----------------------------------------------------
CREATE  OR REPLACE VIEW `vis_cotizacion_consecutivo` AS
select
ec.id_cotizacion,
ec.folio_consecutivo,
ce.id_estatus,
ce.concepto as estatus
from ent_cotizacion ec
inner join cat_estatus ce on ce.id_estatus = ec.id_estatus;

-- -----------------------------------------------------
-- View `vis_detalle_cot_cliente`
-- -----------------------------------------------------
CREATE  OR REPLACE VIEW `vis_detalle_cot_cliente` AS
select
ec.folio_consecutivo,
ctc.id_tipo_cotizacion,
ctc.concepto as tipo_cotizacion,
ce.id_estatus,
ce.concepto as estatus,
sbp.id_business_partnes,
sbp.card_code,
sbp.card_foreign_name
from ent_cotizacion ec
inner join cat_tipo_cotizacion ctc on ctc.id_tipo_cotizacion = ec.id_tipo_cotizacion
inner join cat_estatus ce on ce.id_estatus = ec.id_estatus
inner join sap_business_partnes sbp on sbp.id_business_partnes = ec.id_business_partnes;

-- -----------------------------------------------------
-- View `vis_cotizacion_claves`
-- -----------------------------------------------------
CREATE  OR REPLACE VIEW `vis_cotizacion_claves` AS
select
rcgc.id_cotizaciones_claves,
ec.id_cotizacion,
ec.folio_consecutivo,
ctc.id_tipo_cotizacion,
ctc.concepto as tipo_cotizacion,
ce.id_estatus,
ce.concepto as estatus,
sbp.id_business_partnes,
sbp.card_code,
sbp.card_name,
sbp.card_foreign_name,
sbp.contact_employee,
ec.u_registro,
ec.f_registro,
cc.id_claves,
cc.concepto,
cc.mts_1,
cc.mts_2,
cc.mts_3,
cc.mts_4,
cc.pata_1,
cc.pata_2,
cc.herraje_1,
cc.herraje_2,
cc.ebanisteria_1,
cc.ebanisteria_2,
cc.ebanisteria_3,
cc.maquinas,
cc.pegado_hule,
cc.armado,
cc.blanco,
cc.costura,
cc.tapiceria,
cc.total,
cc.mano_de_obra,
cc.porcentaje,
cc.imagen,
rcgc.variante,
rcgc.id_padre
from rom_cotizacion_has_claves rcgc
inner join ent_cotizacion ec on ec.id_cotizacion = rcgc.id_cotizacion
inner join cat_claves cc on cc.id_claves = rcgc.id_claves
inner join cat_tipo_cotizacion ctc on ctc.id_tipo_cotizacion = ec.id_tipo_cotizacion
inner join cat_estatus ce on ce.id_estatus = ec.id_estatus
inner join sap_business_partnes sbp on sbp.id_business_partnes = ec.id_business_partnes;

-- -----------------------------------------------------
-- View `vis_telas`
-- -----------------------------------------------------
CREATE  OR REPLACE VIEW `vis_telas` AS
SELECT * FROM sap_oitm where numero_tela > 0;

-- -----------------------------------------------------
-- View `vis_patas`
-- -----------------------------------------------------
CREATE  OR REPLACE VIEW `vis_patas` AS
SELECT id_oitm,nombre_articulo,clave_articulo,familia_articulo,familia_descripcion,precio_costo FROM vis_sap where familia_articulo = 135 order by nombre_articulo ASC;

-- -----------------------------------------------------
-- View `vis_herraje_importado`
-- -----------------------------------------------------
CREATE  OR REPLACE VIEW `vis_herraje_importado` AS
SELECT id_oitm,nombre_articulo,clave_articulo,familia_articulo,familia_descripcion,precio_costo FROM vis_sap where familia_articulo = 147 order by nombre_articulo ASC;

-- -----------------------------------------------------
-- View `vis_ebanesteria`
-- -----------------------------------------------------
CREATE  OR REPLACE VIEW `vis_ebanesteria` AS
SELECT id_oitm,nombre_articulo,clave_articulo,familia_articulo,familia_descripcion,precio_costo FROM vis_sap where familia_articulo = 132 order by nombre_articulo ASC;

-- -----------------------------------------------------
-- View `vis_precios_telas`
-- -----------------------------------------------------
CREATE  OR REPLACE VIEW `vis_precios_telas` AS
select 
vt.id_oitm,
vt.codigo_sap_articulo,
vt.nombre_articulo,
vt.numero_tela,
si.precio_costo
from vis_telas vt
inner join sap_itm1 si on si.codigo_sap_articulo = vt.codigo_sap_articulo;

-- -----------------------------------------------------
-- View `vis_precios_items`
-- -----------------------------------------------------
CREATE  OR REPLACE VIEW `vis_precios_items` AS
select
si.id_itm1,
si.codigo_sap_articulo,
so.nombre_articulo,
si.lista_precio,
si.precio_costo,
sit.id_ittm1,
sit.fhater,
sit.code,
sit.quantity,
so.familia_articulo
from sap_itm1 si
inner join sap_ittm1 sit on sit.code = si.codigo_sap_articulo
inner join sap_oitm so on so.codigo_sap_articulo =si.codigo_sap_articulo;

-- -----------------------------------------------------
-- View `vis_previo_cotizacion`
-- -----------------------------------------------------
CREATE  OR REPLACE VIEW `vis_previo_cotizacion` AS
SELECT
tc.id_temp_cotizacion,
tc.id_cotizaciones_claves,
ec.id_cotizacion,
ec.folio_consecutivo,
tc.codigo_sap_articulo,
tc.descripcion_general,
tc.imagen,
tc.id_padre,
sbp.id_business_partnes,
sbp.card_foreign_name,
tc.total_kit_hab,
tc.total_kit_hul,
tc.total_kit_mp,
tc.total_g_telas,
tc.total_g_patas,
tc.total_g_herrajes_importados,
tc.total_g_ebanesteria,
tc.costo_materia_prima,
tc.total_herraje_nacional,
tc.precio_sugerido,
tc.total_mp,
tc.mano_obra
FROM temp_cotizacion tc
inner join ent_cotizacion ec on ec.id_cotizacion = tc.id_cotizacion
inner join sap_business_partnes sbp on sbp.id_business_partnes = ec.id_business_partnes
inner join rom_cotizacion_has_claves rchc on rchc.id_cotizacion = ec.id_cotizacion
inner join cat_claves cv on cv.id_claves = rchc.id_claves
group by tc.id_temp_cotizacion;

-- -----------------------------------------------------
-- View `vis_articulo_nombre_precio`
-- -----------------------------------------------------
CREATE  OR REPLACE VIEW `vis_articulo_nombre_precio` AS
select
vpt.id_itm1,
vpt.codigo_sap_articulo,
vpt.nombre_articulo,
vpt.lista_precio,
vpt.precio_costo,
vpt.id_ittm1,
vpt.fhater,
vpt.code,
vpt.quantity,
vpt.familia_articulo
from vis_precios_items vpt
inner join sap_oitm so on so.codigo_sap_articulo = vpt.codigo_sap_articulo;

-- -----------------------------------------------------
-- View `vis_cotizaciones_pendientes`
-- -----------------------------------------------------
CREATE  OR REPLACE VIEW `vis_cotizaciones_pendientes` AS
select 
ec.id_cotizacion,
ec.folio_consecutivo,
sbp.id_business_partnes,
sbp.card_foreign_name,
ctc.id_tipo_cotizacion,
ctc.concepto as tipo_cotizacion,
ce.id_estatus,
ce.concepto as estatus,
ec.u_registro,
ec.f_registro
from ent_cotizacion ec
inner join sap_business_partnes sbp on sbp.id_business_partnes = ec.id_business_partnes
inner join cat_tipo_cotizacion ctc on ctc.id_tipo_cotizacion = ec.id_tipo_cotizacion
inner join cat_estatus ce on ce.id_estatus = ec.id_estatus
where ec.id_estatus = 3;

-- -----------------------------------------------------
-- View `vis_detalle_cotizacion_cotizacion`
-- -----------------------------------------------------
CREATE  OR REPLACE VIEW `vis_detalle_cotizacion_cotizacion` AS
select
rdcc.id_cotizacion,
ec.folio_consecutivo,
ec.f_registro,
rdcc.id_detalle_cotizacion,
cdc.codigo_sap_articulo,
cdc.mano_obra,
cdc.id_tela_uno,
cdc.clave_tela_uno,
cdc.nombre_tela_uno,
cdc.mts_uno,
cdc.precio_costo_uno,
cdc.importe_uno,
cdc.id_tela_dos,
cdc.clave_tela_dos,
cdc.nombre_tela_dos,
cdc.mts_dos,
cdc.precio_costo_dos,
cdc.importe_dos,
cdc.id_tela_tres,
cdc.clave_tela_tres,
cdc.nombre_tela_tres,
cdc.mts_tres,
cdc.precio_costo_tres,
cdc.importe_tres,
cdc.id_tela_cuatro,
cdc.clave_tela_cuatro,
cdc.nombre_tela_cuatro,
cdc.mts_cuatro,
cdc.precio_costo_cuatro,
cdc.importe_cuatro,
cdc.id_pata_uno,
cdc.clave_pata_uno,
cdc.nombre_pata_uno,
cdc.pz_pata_uno,
cdc.precio_costo_pata_uno,
cdc.importe_pata_uno,
cdc.id_pata_dos,
cdc.clave_pata_dos,
cdc.nombre_pata_dos,
cdc.pz_pata_dos,
cdc.precio_costo_pata_dos,
cdc.importe_pata_dos,
cdc.id_herraje_uno,
cdc.clave_herraje_uno,
cdc.nombre_herraje_uno,
cdc.pz_herraje_uno,
cdc.precio_costo_herraje_uno,
cdc.importe_herraje_uno,
cdc.id_herraje_dos,
cdc.clave_herraje_dos,
cdc.nombre_herraje_dos,
cdc.pz_herraje_dos,
cdc.precio_costo_herraje_dos,
cdc.importe_herraje_dos,
cdc.id_ebanesteria_uno,
cdc.clave_ebanesteria_uno,
cdc.nombre_ebanesteria_uno,
cdc.pz_ebanesteria_uno,
cdc.precio_costo_ebanesteria_uno,
cdc.importe_ebanesteria_uno,
cdc.id_ebanesteria_dos,
cdc.clave_ebanesteria_dos,
cdc.nombre_ebanesteria_dos,
cdc.pz_ebanesteria_dos,
cdc.precio_costo_ebanesteria_dos,
cdc.importe_ebanesteria_dos,
cdc.id_ebanesteria_tres,
cdc.clave_ebanesteria_tres,
cdc.nombre_ebanesteria_tres,
cdc.pz_ebanesteria_tres,
cdc.precio_costo_ebanesteria_tres,
cdc.importe_ebanesteria_tres,
cdc.total_g_telas,
cdc.total_g_patas,
cdc.total_g_herrajes_importados,
cdc.total_g_ebanesteria,
cdc.costo_materia_prima,
cdc.total_herraje_nacional,
cdc.precio_sugerido,
cdc.gastos_uni,
cdc.nom_uni,
cdc.desc_uni,
cdc.gast_fin_uni,
cdc.flete_uni,
cdc.comision,
cdc.costo_total,
cdc.concepto,
cdc.descripcion_general,
cdc.total_kit_hab,
cdc.total_kit_hul,
cdc.total_kit_mp,
cdc.total_mp,
cdc.margen,
cdc.observaciones,
ec.id_business_partnes,
cdc.estatus,
ec.id_estatus as id_estatus_orden,
cet.concepto as estatus_orden,
ec.auto_ventas,
ec.auto_direccion,
ec.auto_disenio,
ec.auto_contabilidad
from rom_detalle_cotizacion_has_cotizacion rdcc
inner join ent_cotizacion ec on ec.id_cotizacion = rdcc.id_cotizacion
inner join cat_detalle_cotizacion cdc on cdc.id_detalle_cotizacion = rdcc.id_detalle_cotizacion
inner join cat_estatus cet on cet.id_estatus = ec.id_estatus;

-- -----------------------------------------------------
-- View `vis_temp_cotizacion`
-- -----------------------------------------------------
CREATE  OR REPLACE VIEW `vis_temp_cotizacion` AS
SELECT
tc.id_temp_cotizacion,
tc.id_cotizaciones_claves,
tc.id_cotizacion,
tc.codigo_sap_articulo,
tc.mano_obra,
tc.id_tela_uno,
tc.mts_uno,
tc.precio_costo_uno,
tc.importe_uno,
tc.id_tela_dos,
tc.mts_dos,
tc.precio_costo_dos,
tc.importe_dos,
tc.id_tela_tres,
tc.mts_tres,
tc.precio_costo_tres,
tc.importe_tres,
tc.id_tela_cuatro,
tc.mts_cuatro,
tc.precio_costo_cuatro,
tc.importe_cuatro,
tc.id_pata_uno,
tc.pz_pata_uno,
tc.precio_costo_pata_uno,
tc.importe_pata_uno,
tc.id_pata_dos,
tc.pz_pata_dos,
tc.precio_costo_pata_dos,
tc.importe_pata_dos,
tc.id_herraje_uno,
tc.pz_herraje_uno,
tc.precio_costo_herraje_uno,
tc.importe_herraje_uno,
tc.id_herraje_dos,
tc.pz_herraje_dos,
tc.precio_costo_herraje_dos,
tc.importe_herraje_dos,
tc.id_ebanesteria_uno,
tc.pz_ebanesteria_uno,
tc.precio_costo_ebanesteria_uno,
tc.importe_ebanesteria_uno,
tc.id_ebanesteria_dos,
tc.pz_ebanesteria_dos,
tc.precio_costo_ebanesteria_dos,
tc.importe_ebanesteria_dos,
tc.id_ebanesteria_tres,
tc.pz_ebanesteria_tres,
tc.precio_costo_ebanesteria_tres,
tc.importe_ebanesteria_tres,
tc.id_padre,
tc.total_g_telas,
tc.total_g_patas,
tc.total_g_herrajes_importados,
tc.total_g_ebanesteria,
tc.total_herraje_nacional,
tc.costo_materia_prima,
tc.precio_sugerido,
tc.gastos_uni,
tc.nom_uni,
tc.desc_uni,
tc.gast_fin_uni,
tc.flete_uni,
tc.comision,
tc.costo_total,
tc.concepto,
tc.total_kit_hab,
tc.total_kit_hul,
tc.total_kit_mp,
tc.total_mp,
tc.imagen,
tc.id_cliente,
tc.cliente,
tc.descripcion_general,
ec.folio_consecutivo,
sbp.id_business_partnes,
sbp.card_foreign_name
FROM temp_cotizacion tc
inner join ent_cotizacion ec on ec.id_cotizacion = tc.id_cotizacion
inner join sap_business_partnes sbp on sbp.id_business_partnes = ec.id_business_partnes
inner join rom_cotizacion_has_claves rchc on rchc.id_cotizacion = ec.id_cotizacion
inner join cat_claves cv on cv.id_claves = rchc.id_claves
group BY tc.codigo_sap_articulo;

-- -----------------------------------------------------
-- View `vis_cotizaciones_aprobadas`
-- -----------------------------------------------------
CREATE  OR REPLACE VIEW `vis_cotizaciones_aprobadas` AS
select 
ec.id_cotizacion,
ec.folio_consecutivo,
sbp.id_business_partnes,
sbp.card_foreign_name,
ctc.id_tipo_cotizacion,
ctc.concepto as tipo_cotizacion,
ce.id_estatus,
ce.concepto as estatus,
ec.u_registro,
ec.f_registro
from ent_cotizacion ec
inner join sap_business_partnes sbp on sbp.id_business_partnes = ec.id_business_partnes
inner join cat_tipo_cotizacion ctc on ctc.id_tipo_cotizacion = ec.id_tipo_cotizacion
inner join cat_estatus ce on ce.id_estatus = ec.id_estatus
where ec.id_estatus = 4;
