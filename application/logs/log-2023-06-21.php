<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-06-21 08:15:14 --> Query error: Expression #7 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'c4.r.idMatrizRecurrente' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT *
FROM `app_nueva_matriz` `m`
INNER JOIN `app_matriz_recurrente` `r` ON `r`.`idNuevaMatriz` = `m`.`idNuevaMatriz`
INNER JOIN `app_asignaciones` `a` ON `a`.`idMatriz` = `m`.`idNuevaMatriz`
WHERE `r`.`idResponsable` = '9'
AND `a`.`idTipoEmpresa` = '4'
GROUP BY `m`.`idNuevaMatriz`
ERROR - 2023-06-21 08:15:23 --> Severity: error --> Exception: Too few arguments to function MisMatrices::matrices(), 0 passed in /Applications/MAMP/htdocs/c4/system/core/CodeIgniter.php on line 532 and exactly 1 expected /Applications/MAMP/htdocs/c4/application/controllers/MisMatrices.php 36
ERROR - 2023-06-21 08:15:30 --> Query error: Expression #7 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'c4.r.idMatrizRecurrente' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT *
FROM `app_nueva_matriz` `m`
INNER JOIN `app_matriz_recurrente` `r` ON `r`.`idNuevaMatriz` = `m`.`idNuevaMatriz`
INNER JOIN `app_asignaciones` `a` ON `a`.`idMatriz` = `m`.`idNuevaMatriz`
WHERE `r`.`idResponsable` = '9'
AND `a`.`idTipoEmpresa` = '4'
GROUP BY `m`.`idNuevaMatriz`
ERROR - 2023-06-21 10:41:58 --> Query error: Expression #7 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'c4.r.idMatrizRecurrente' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT *
FROM `app_nueva_matriz` `m`
INNER JOIN `app_matriz_recurrente` `r` ON `r`.`idNuevaMatriz` = `m`.`idNuevaMatriz`
INNER JOIN `app_asignaciones` `a` ON `a`.`idMatriz` = `m`.`idNuevaMatriz`
WHERE `r`.`idResponsable` = '9'
AND `a`.`idTipoEmpresa` = '4'
GROUP BY `m`.`idNuevaMatriz`
ERROR - 2023-06-21 10:42:44 --> 404 Page Not Found: Img/undraw_posting_photo.svg
