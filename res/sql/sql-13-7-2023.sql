ALTER TABLE `app_sugiere_matriz` ADD `nombredeMatriz` VARCHAR(250) NOT NULL AFTER `idEmpresa`;

ALTER TABLE `app_empresas` ADD 
`fechaIngreso` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER 
`eliminado`, ADD `paquete` VARCHAR(50) NOT NULL AFTER 
`fechaIngreso`, ADD `estadoFunciona` VARCHAR(50) NOT NULL AFTER 
`paquete`, ADD `fechaInicioPlan` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER 
`estadoFunciona`, ADD `fechaCaducidad` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER 
`fechaInicioPlan`, ADD `caduca` INT NOT NULL DEFAULT '0' AFTER `fechaCaducidad`;

CREATE TABLE `app_planes` (
    `idPlan` INT NOT NULL AUTO_INCREMENT , 
    `nombrePlan` VARCHAR(250) NOT NULL , 
    `tituloPlan` VARCHAR(250) NOT NULL , 
    `descripcion` VARCHAR(250) NOT NULL , 
    `precio` INT(20) NOT NULL , 
    `dirigido` INT NOT NULL , 
    `promocion` INT NOT NULL DEFAULT '0' , 
    `fechaInicio` DATETIME NOT NULL , 
    `fechaFinaliza` DATETIME NOT NULL , 
    `estado` INT NOT NULL DEFAULT '1' , 
    `elimina` INT NOT NULL DEFAULT '0' , 
    PRIMARY KEY (`idPlan`)) ENGINE = InnoDB;
    
    ALTER TABLE `app_pago_matrices` ADD `email` VARCHAR(250) NOT NULL AFTER `idEmpresa`;
    ALTER TABLE `app_pago_empresas` ADD `email` VARCHAR(250) NOT NULL AFTER `idPersona`;
    ALTER TABLE `app_rel_cumplimiento_empresa` CHANGE `idPerfil` `idPago` INT(11) NOT NULL;
    ALTER TABLE `app_rel_cumplimiento_empresa` CHANGE `idPago` `idPagoEmpresa` INT(11) NOT NULL;
    ALTER TABLE `app_perfiles` ADD `precio` INT(10) NOT NULL AFTER `nombrePerfil`;
    ALTER TABLE `app_perfiles` CHANGE `precio` `precioPerfil` INT(10) NOT NULL;
    ALTER TABLE `app_empresas` CHANGE `nroDocumento` `nroDocumento` INT(11) NULL;

    CREATE TABLE `app_pago_mensualidad_empresa` (
        `idPagoMesEmpresas` INT NOT NULL AUTO_INCREMENT , 
        `idPersona` INT(11) NOT NULL , 
        `email` VARCHAR(250) NOT NULL , 
        `proveedor` VARCHAR(50) NOT NULL , 
        `ip` VARCHAR(50) NOT NULL , 
        `estadoPago` INT(11) NOT NULL , 
        `formaPago` VARCHAR(250) NOT NULL , 
        `transactionId` VARCHAR(250) NOT NULL , 
        `referencia_pol` VARCHAR(250) NOT NULL , 
        `valor` INT(20) NOT NULL , 
        `moneda` VARCHAR(50) NOT NULL , 
        `entidad` VARCHAR(50) NOT NULL , 
        `codigoPago` VARCHAR(50) NOT NULL , 
        `fechaPago` DATETIME NOT NULL , 
        PRIMARY KEY (`idPagoMesEmpresas`)) ENGINE = InnoDB;
ALTER TABLE `app_pago_mensualidad_empresa` ADD `idEmpresa` INT(11) NOT NULL AFTER `idPagoMesEmpresas`;

CREATE TABLE `app_pago_mensualidad_oficial` (
        `idPagoMesOficial` INT NOT NULL AUTO_INCREMENT , 
        `idPersona` INT(11) NOT NULL , 
        `email` VARCHAR(250) NOT NULL , 
        `proveedor` VARCHAR(50) NOT NULL , 
        `ip` VARCHAR(50) NOT NULL , 
        `estadoPago` INT(11) NOT NULL , 
        `formaPago` VARCHAR(250) NOT NULL , 
        `transactionId` VARCHAR(250) NOT NULL , 
        `referencia_pol` VARCHAR(250) NOT NULL , 
        `valor` INT(20) NOT NULL , 
        `moneda` VARCHAR(50) NOT NULL , 
        `entidad` VARCHAR(50) NOT NULL , 
        `codigoPago` VARCHAR(50) NOT NULL , 
        `fechaPago` DATETIME NOT NULL , 
        PRIMARY KEY (`idPagoMesOficial`)) ENGINE = InnoDB;

CREATE TABLE `app_membresia_oficial` (
    `idMembresiaOficial` INT NOT NULL AUTO_INCREMENT , 
    `idPersona` INT(11) NOT NULL , 
    `email` VARCHAR(250) NOT NULL , 
    `idPagoMesOficial` INT(11) NOT NULL , 
    `fechaIngreso` DATETIME NOT NULL , 
    `paquete` VARCHAR(50) NOT NULL , 
    `estadoFunciona` VARCHAR(50) NOT NULL , 
    `fechaInicioMes` DATETIME NOT NULL , 
    `fechaCaducidad` DATETIME NOT NULL , 
    `caduca` INT NOT NULL , 
    PRIMARY KEY (`idMembresiaOficial`)) ENGINE = InnoDB;

    ALTER TABLE `app_rel_cumplimiento_empresa` ADD `precioEmpresa` INT(11) NOT NULL AFTER `idEmpresa`;
    ALTER TABLE `app_membresia_oficial` CHANGE `idPagoMesOficial` `codigoPago` VARCHAR(50) NOT NULL;
    ALTER TABLE `app_respuestas_check` ADD `nombreArchivo` VARCHAR(250) NOT NULL AFTER `valor`;
    
    CREATE TABLE `app_archivos_temporales` (
    `idArchivo` INT NOT NULL , 
    `nombreArchivo` VARCHAR(250) NOT NULL , 
    `ruta` VARCHAR(250) NOT NULL ) ENGINE = InnoDB;
    
ALTER TABLE `app_archivos_temporales` CHANGE `idArchivo` `idArchivo` INT(11) NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`idArchivo`);
ALTER TABLE `app_respuestas_check` ADD `resOficial` VARCHAR(50) NOT NULL AFTER `valor`;