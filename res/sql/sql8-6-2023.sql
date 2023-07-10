/* -- tabla de check --*/
CREATE TABLE `app_form_checkeo` (
    `idCheckeo` INT NOT NULL AUTO_INCREMENT , 
    `idEmpresa` INT(10) NOT NULL , 
    `idPerfil` INT(10) NOT NULL , 
    `idMatriz` INT(10) NOT NULL , 
    `nombreResponsable` VARCHAR(250) NOT NULL , 
    `fechaDiligenciamiento` DATE NOT NULL , 
    `observaciones` VARCHAR(250) NOT NULL , 
    `fechaRevision` DATE NOT NULL , 
    `IdOficial` INT(10) NOT NULL , 
    `estado` INT NOT NULL DEFAULT '1' , 
    `eliminado` INT NOT NULL DEFAULT '0' , 
    PRIMARY KEY (`idCheckeo`)) ENGINE = InnoDB;

CREATE TABLE `app_rel_cumplimiento_empresa` (
    `idRel` INT NOT NULL , 
    `idPersona` INT NOT NULL , 
    `idPerfil` INT NOT NULL , 
    `idEmpresa` INT NOT NULL , 
    `fecha` DATETIME NOT NULL , 
    `estado` INT NOT NULL DEFAULT '1' , 
    `eliminado` INT NOT NULL DEFAULT '0' ) ENGINE = InnoDB;
    
ALTER TABLE `app_rel_cumplimiento_empresa` CHANGE `idRel` `idRel` INT(11) NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`idRel`);
ALTER TABLE `app_nueva_matriz` ADD `precio` INT(20) NOT NULL AFTER `tipoEmpresa`, ADD `descripcion` VARCHAR(250) NOT NULL AFTER `precio`, ADD `gratis` INT NOT NULL AFTER `descripcion`;

CREATE TABLE `app_matriz_comprada` (
    `idComprada` INT NOT NULL AUTO_INCREMENT , 
    `idMatriz` INT NOT NULL , 
    `idEmpresa` INT NOT NULL , 
    `idPersona` INT NOT NULL , 
    `pago` INT NOT NULL , 
    `fechaPago` DATETIME NOT NULL , 
    `estado` INT NOT NULL DEFAULT '1' , 
    `eliminado` INT NOT NULL DEFAULT '0' , 
    PRIMARY KEY (`idComprada`)) ENGINE = InnoDB;

CREATE TABLE `app_pago_matrices` (
    `idPago` INT NOT NULL AUTO_INCREMENT , 
    `idEmpresa` INT NOT NULL , 
    `nombrepersona` VARCHAR(250) NOT NULL , 
    `ip` VARCHAR(20) NOT NULL , 
    `estadoPago` INT NOT NULL , 
    `formaPago` VARCHAR(50) NOT NULL , 
    `transactionId` VARCHAR(250) NOT NULL , 
    `referencia_pol` VARCHAR(250) NOT NULL , 
    `valor` INT(20) NOT NULL , 
    `moneda` VARCHAR(50) NOT NULL , 
    `entidad` VARCHAR(20) NOT NULL , 
    `codigoPago` VARCHAR(250) NOT NULL , 
    `fechaPago` DATETIME NOT NULL , 
    PRIMARY KEY (`idPago`)) ENGINE = InnoDB;
    ALTER TABLE `app_pago_matrices` ADD `proveedor` VARCHAR(250) NOT NULL AFTER `nombrepersona`;

CREATE TABLE `app_cMatrices_temporal` (
    `idCompraTemporal` INT NOT NULL AUTO_INCREMENT , 
    `idPago` INT NOT NULL , 
    `idEmpresa` INT NOT NULL , 
    `idMatriz` INT NOT NULL , 
    `idPersona` INT NOT NULL , 
    `nombreMatriz` VARCHAR(250) NOT NULL , 
    `valor` INT NOT NULL , 
    PRIMARY KEY (`idCompraTemporal`)) ENGINE = InnoDB;
    ALTER TABLE `app_cMatrices_temporal` CHANGE `valor` `precioMatriz` INT(11) NOT NULL;

CREATE TABLE `app_pago_empresas` (
    `idPagoEmpresa` INT NOT NULL AUTO_INCREMENT , 
    `idPersona` INT NOT NULL , 
    `ip` VARCHAR(20) NOT NULL , 
    `estadoPago` INT NOT NULL , 
    `formaPago` VARCHAR(250) NOT NULL , 
    `transactionId` VARCHAR(250) NOT NULL , 
    `referencia_pol` VARCHAR(250) NOT NULL , 
    `valor` INT(20) NOT NULL , 
    `moneda` VARCHAR(50) NOT NULL , 
    `entidad` VARCHAR(50) NOT NULL , 
    `codigoPago` VARCHAR(250) NOT NULL , 
    `fechaPago` DATETIME NOT NULL , 
    PRIMARY KEY (`idPagoEmpresa`)) ENGINE = InnoDB;
    ALTER TABLE `app_pago_empresas` ADD `proveedor` VARCHAR(50) NOT NULL AFTER `idPersona`;
    
CREATE TABLE `app_cEmpresas_temporal` (
    `idcEmpresaTemporal` INT NOT NULL AUTO_INCREMENT , 
    `idPago` INT NOT NULL , 
    `idEmpresa` INT NOT NULL , 
    `idPersona` INT NOT NULL , 
    `nombreEmpresa` VARCHAR(250) NOT NULL , 
    `precioEmpresa` INT(20) NOT NULL , 
    PRIMARY KEY (`idcEmpresaTemporal`)) ENGINE = InnoDB;

CREATE TABLE `app_sugiere_matriz` (
    `idSugiere` INT NOT NULL AUTO_INCREMENT , 
    `idUsuario` INT NOT NULL , 
    `emailUsuario` VARCHAR(250) NOT NULL , 
    `descripcion` VARCHAR(250) NOT NULL , 
    `fechaSugerencia` DATETIME NOT NULL , 
    `respuesta` VARCHAR(250) NOT NULL , 
    `fechaRespuesta` DATETIME NOT NULL , 
    `emailRespuesta` VARCHAR(250) NOT NULL , 
    `estaRespuesta` INT NOT NULL DEFAULT '0' , 
    `estado` INT NOT NULL DEFAULT '1' , 
    `eliminado` INT NOT NULL DEFAULT '0', 
    PRIMARY KEY (`idSugiere`)) ENGINE = InnoDB;