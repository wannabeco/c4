ALTER TABLE `app_planes` ADD `canMatrices` INT(10) NOT NULL AFTER `fechaFinaliza`, ADD `canUsuarios` INT(10) NOT NULL AFTER `canMatrices`;
CREATE TABLE `app_rel_empresa_plan` (
    `idRelacion` INT NOT NULL AUTO_INCREMENT , 
    `idEmpresa` INT NOT NULL , 
    `idPlan` INT NOT NULL , 
    `canUsuarios` INT NOT NULL , 
    `canChecks` INT NOT NULL , 
    `estado` INT NOT NULL DEFAULT '1' , 
    `eliminado` INT NOT NULL DEFAULT '0' , 
    PRIMARY KEY (`idRelacion`)
    ) ENGINE = InnoDB;
ALTER TABLE `app_planes` ADD `mesCobraYear` INT(11) NOT NULL AFTER `canUsuarios`;

-- agosto 25

CREATE TABLE `app_rel_periocidad` (
    `idRelPeriocidad` INT NOT NULL AUTO_INCREMENT , 
    `idEmpresa` INT(20) NOT NULL , 
    `nombreRel` VARCHAR(250) NOT NULL , 
    `doliente` INT(20) NOT NULL , 
    `fecha` DATETIME NOT NULL , 
    `estado` INT NOT NULL DEFAULT '1' , 
    `eliminado` INT NOT NULL DEFAULT '0' , 
    PRIMARY KEY (`idRelPeriocidad`)) ENGINE = InnoDB;
    ALTER TABLE `app_rel_periocidad` CHANGE `doliente` `idPersona` INT(20) NOT NULL;
    ALTER TABLE `app_rel_periocidad` ADD `idPeriodicidad` INT NOT NULL AFTER `idEmpresa`;
    ALTER TABLE `app_respuestas_check` ADD `idRelPeriocidad` INT(10) NOT NULL AFTER `idMatrizRecurrente`;
    ALTER TABLE `app_respuesta_comentarios` ADD `idRelPeriocidad` INT(10) NOT NULL AFTER `idMatrizRecurrente`;
