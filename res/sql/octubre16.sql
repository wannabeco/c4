ALTER TABLE `app_nueva_matriz` ADD `idEmpresa` INT NOT NULL AFTER `gratis`;
ALTER TABLE `app_nueva_matriz` CHANGE `idEmpresa` `idEmpresa` INT(11) NOT NULL DEFAULT '0';