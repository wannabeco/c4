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