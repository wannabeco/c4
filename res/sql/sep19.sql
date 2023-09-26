ALTER TABLE `app_empresas` ADD `terminos` INT NOT NULL DEFAULT '1' AFTER `ultimoIngreso`;
ALTER TABLE `app_personas` ADD `terminos` INT NOT NULL DEFAULT '1' AFTER `ultimoIngreso`;

ALTER TABLE `app_sugiere_matriz` ADD `solicitud` INT NOT NULL AFTER `estaRespuesta`;
