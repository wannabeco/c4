<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-06-22 08:54:50 --> Query error: Expression #7 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'c4.r.idMatrizRecurrente' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT *
FROM `app_nueva_matriz` `m`
INNER JOIN `app_matriz_recurrente` `r` ON `r`.`idNuevaMatriz` = `m`.`idNuevaMatriz`
INNER JOIN `app_asignaciones` `a` ON `a`.`idMatriz` = `m`.`idNuevaMatriz`
WHERE `r`.`idResponsable` = '9'
AND `a`.`idTipoEmpresa` = '4'
GROUP BY `m`.`idNuevaMatriz`
ERROR - 2023-06-22 08:55:44 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 08:55:51 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 08:56:48 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 09:15:16 --> Query error: Unknown column 'r.idPersona' in 'where clause' - Invalid query: SELECT *
FROM `app_matriz_recurrente` `r`
INNER JOIN `app_entidades` `e` ON `e`.`idEntidad`=`r`.`idEntidad`
INNER JOIN `app_cuando_aplique` `c` ON `c`.`idCuandoAplique`=`r`.`idcuandoAplique`
INNER JOIN `app_perfiles` `p` ON `p`.`idPerfil`=`r`.`idResponsable`
INNER JOIN `app_ccsm` `x` ON `x`.`idccsm`=`r`.`idccsm`
INNER JOIN `app_metodo_control` `M` ON `M`.`idMetodoControl`=`r`.`idMetodoControl`
INNER JOIN `app_periodicidad` `l` ON `l`.`idperiodicidad`=`r`.`idperiodicidad`
INNER JOIN `app_estados` `k` ON `k`.`idEstado`=`r`.`estado`
INNER JOIN `app_respuesta_comentarios` `g` ON `g`.`idPerfil`=`p`.`idPerfil`
WHERE `r`.`idNuevaMatriz` = '25'
AND `r`.`idResponsable` = '9'
AND `r`.`eliminado` = 0
AND `r`.`idPersona` = '10'
ERROR - 2023-06-22 09:18:34 --> Severity: Warning --> Array to string conversion /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 17
ERROR - 2023-06-22 09:18:48 --> Severity: Warning --> Array to string conversion /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 17
ERROR - 2023-06-22 09:18:50 --> Severity: Warning --> Array to string conversion /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 17
ERROR - 2023-06-22 10:07:28 --> Severity: Warning --> Array to string conversion /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 17
ERROR - 2023-06-22 10:07:40 --> Severity: Warning --> Array to string conversion /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 17
ERROR - 2023-06-22 10:08:35 --> Severity: Warning --> Undefined array key 0 /Applications/MAMP/htdocs/c4/application/controllers/MisMatrices.php 149
ERROR - 2023-06-22 10:09:23 --> Severity: Warning --> Undefined array key 0 /Applications/MAMP/htdocs/c4/application/controllers/MisMatrices.php 150
ERROR - 2023-06-22 10:09:47 --> Severity: Warning --> Undefined array key 0 /Applications/MAMP/htdocs/c4/application/controllers/MisMatrices.php 149
ERROR - 2023-06-22 10:09:48 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 17
ERROR - 2023-06-22 10:10:07 --> Severity: Warning --> Undefined array key 0 /Applications/MAMP/htdocs/c4/application/controllers/MisMatrices.php 150
ERROR - 2023-06-22 10:17:27 --> Severity: Warning --> Undefined array key 0 /Applications/MAMP/htdocs/c4/application/controllers/MisMatrices.php 150
ERROR - 2023-06-22 10:17:27 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/controllers/MisMatrices.php 150
ERROR - 2023-06-22 10:17:27 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 17
ERROR - 2023-06-22 10:19:55 --> Severity: Warning --> Undefined array key 0 /Applications/MAMP/htdocs/c4/application/controllers/MisMatrices.php 140
ERROR - 2023-06-22 10:19:55 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/controllers/MisMatrices.php 140
ERROR - 2023-06-22 10:19:55 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 17
ERROR - 2023-06-22 10:20:25 --> Severity: Warning --> Undefined array key 0 /Applications/MAMP/htdocs/c4/application/controllers/MisMatrices.php 140
ERROR - 2023-06-22 10:20:25 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/controllers/MisMatrices.php 140
ERROR - 2023-06-22 10:20:44 --> Severity: Warning --> Undefined array key 0 /Applications/MAMP/htdocs/c4/application/controllers/MisMatrices.php 140
ERROR - 2023-06-22 10:20:44 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/controllers/MisMatrices.php 140
ERROR - 2023-06-22 10:20:44 --> Severity: Warning --> Undefined array key 0 /Applications/MAMP/htdocs/c4/application/controllers/MisMatrices.php 141
ERROR - 2023-06-22 10:20:44 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/controllers/MisMatrices.php 141
ERROR - 2023-06-22 10:21:18 --> Severity: Warning --> Undefined array key 0 /Applications/MAMP/htdocs/c4/application/controllers/MisMatrices.php 140
ERROR - 2023-06-22 10:21:18 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/controllers/MisMatrices.php 140
ERROR - 2023-06-22 10:21:18 --> Severity: Warning --> Undefined array key 0 /Applications/MAMP/htdocs/c4/application/controllers/MisMatrices.php 141
ERROR - 2023-06-22 10:21:18 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/controllers/MisMatrices.php 141
ERROR - 2023-06-22 10:21:29 --> Severity: Warning --> Undefined array key 0 /Applications/MAMP/htdocs/c4/application/controllers/MisMatrices.php 140
ERROR - 2023-06-22 10:22:32 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 17
ERROR - 2023-06-22 10:22:44 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 17
ERROR - 2023-06-22 10:32:02 --> Severity: error --> Exception: syntax error, unexpected double-quoted string "", expecting variable or "{" or "$" /Applications/MAMP/htdocs/c4/application/models/crearMatriz/LogicaMatriz.php 483
ERROR - 2023-06-22 10:32:09 --> Severity: error --> Exception: syntax error, unexpected double-quoted string "", expecting variable or "{" or "$" /Applications/MAMP/htdocs/c4/application/models/crearMatriz/LogicaMatriz.php 483
ERROR - 2023-06-22 10:35:26 --> Severity: Warning --> Undefined array key 0 /Applications/MAMP/htdocs/c4/application/controllers/MisMatrices.php 154
ERROR - 2023-06-22 10:35:32 --> Severity: Warning --> Undefined array key 0 /Applications/MAMP/htdocs/c4/application/controllers/MisMatrices.php 154
ERROR - 2023-06-22 10:35:35 --> Severity: Warning --> Undefined array key 0 /Applications/MAMP/htdocs/c4/application/controllers/MisMatrices.php 142
ERROR - 2023-06-22 10:35:35 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/controllers/MisMatrices.php 142
ERROR - 2023-06-22 10:35:35 --> Severity: Warning --> Undefined array key 0 /Applications/MAMP/htdocs/c4/application/controllers/MisMatrices.php 154
ERROR - 2023-06-22 10:56:33 --> Severity: Warning --> Undefined array key "datos" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 10:57:24 --> Severity: Warning --> Undefined array key 0 /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 10:58:03 --> Severity: Warning --> Undefined array key 0 /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 10:58:57 --> Severity: Warning --> Undefined array key 0 /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 10:59:46 --> Severity: Warning --> Undefined array key 0 /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:01:47 --> Severity: Warning --> Undefined array key 0 /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:01:58 --> Severity: Warning --> Undefined array key 0 /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:03:08 --> Severity: Warning --> Undefined array key "idMatrizRecurrente" /Applications/MAMP/htdocs/c4/application/models/crearMatriz/LogicaMatriz.php 475
ERROR - 2023-06-22 11:03:08 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 17
ERROR - 2023-06-22 11:03:08 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:03:08 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:03:08 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:03:22 --> Severity: Warning --> Undefined array key "idMatrizRecurrente" /Applications/MAMP/htdocs/c4/application/models/crearMatriz/LogicaMatriz.php 475
ERROR - 2023-06-22 11:03:22 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 17
ERROR - 2023-06-22 11:03:22 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:03:22 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:03:22 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:03:59 --> Severity: Warning --> Undefined array key "idMatrizRecurrente" /Applications/MAMP/htdocs/c4/application/models/crearMatriz/LogicaMatriz.php 475
ERROR - 2023-06-22 11:03:59 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 17
ERROR - 2023-06-22 11:03:59 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:03:59 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:03:59 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:04:57 --> Severity: Warning --> Undefined array key 0 /Applications/MAMP/htdocs/c4/application/models/crearMatriz/LogicaMatriz.php 476
ERROR - 2023-06-22 11:04:57 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/models/crearMatriz/LogicaMatriz.php 476
ERROR - 2023-06-22 11:04:57 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 17
ERROR - 2023-06-22 11:04:57 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:04:57 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:04:57 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:05:37 --> Severity: Warning --> Undefined array key 0 /Applications/MAMP/htdocs/c4/application/models/crearMatriz/LogicaMatriz.php 476
ERROR - 2023-06-22 11:05:37 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/models/crearMatriz/LogicaMatriz.php 476
ERROR - 2023-06-22 11:05:37 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 17
ERROR - 2023-06-22 11:05:37 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:05:37 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:05:37 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:05:59 --> Severity: error --> Exception: Too few arguments to function MisMatrices::informacion(), 0 passed in /Applications/MAMP/htdocs/c4/system/core/CodeIgniter.php on line 532 and exactly 2 expected /Applications/MAMP/htdocs/c4/application/controllers/MisMatrices.php 99
ERROR - 2023-06-22 11:06:01 --> Severity: Warning --> Undefined array key 0 /Applications/MAMP/htdocs/c4/application/models/crearMatriz/LogicaMatriz.php 476
ERROR - 2023-06-22 11:06:01 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/models/crearMatriz/LogicaMatriz.php 476
ERROR - 2023-06-22 11:06:01 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 17
ERROR - 2023-06-22 11:06:01 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:06:01 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:06:01 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:06:10 --> Severity: Warning --> Undefined array key 0 /Applications/MAMP/htdocs/c4/application/models/crearMatriz/LogicaMatriz.php 476
ERROR - 2023-06-22 11:06:10 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/models/crearMatriz/LogicaMatriz.php 476
ERROR - 2023-06-22 11:06:10 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 17
ERROR - 2023-06-22 11:06:10 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:06:10 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:06:10 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:07:41 --> Severity: Warning --> Undefined variable $id /Applications/MAMP/htdocs/c4/application/models/crearMatriz/LogicaMatriz.php 479
ERROR - 2023-06-22 11:07:41 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 17
ERROR - 2023-06-22 11:07:41 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:07:41 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:07:41 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:07:56 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 17
ERROR - 2023-06-22 11:07:56 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:07:56 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:07:56 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:08:46 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 17
ERROR - 2023-06-22 11:08:46 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:08:46 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:08:46 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:09:20 --> Severity: error --> Exception: Cannot access offset of type string on string /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:10:45 --> Severity: Warning --> Trying to access array offset on value of type int /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:10:45 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:13:20 --> Severity: Warning --> Trying to access array offset on value of type int /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:13:40 --> Severity: Warning --> Trying to access array offset on value of type int /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:14:22 --> Severity: Warning --> Trying to access array offset on value of type int /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:14:22 --> Severity: Warning --> Trying to access array offset on value of type int /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 96
ERROR - 2023-06-22 11:43:47 --> 404 Page Not Found: Img/undraw_posting_photo.svg
ERROR - 2023-06-22 11:43:55 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 11:43:55 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 11:43:55 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 11:43:55 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 11:43:58 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:43:58 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:43:58 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:43:58 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:43:58 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:43:58 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:43:58 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:43:58 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:43:58 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:43:58 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:43:58 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:43:58 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:47:54 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:47:54 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:47:54 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:47:54 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:47:54 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:47:54 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:47:54 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:47:54 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:47:54 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:47:54 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:47:54 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:47:54 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:49:48 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:49:48 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:49:48 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:49:48 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:49:48 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:49:48 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:49:48 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:49:48 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:49:48 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:49:48 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:49:48 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:49:48 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:49:52 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:49:52 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:49:52 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:49:52 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:49:52 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:49:52 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:49:52 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:49:52 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:49:52 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:49:52 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:49:52 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:49:52 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:49:53 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:49:53 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:49:53 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:49:53 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:49:53 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:49:53 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:49:53 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:49:53 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:49:53 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:49:53 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:49:53 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:49:53 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:50:35 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:50:35 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:50:35 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:50:35 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:50:35 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:50:35 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:50:35 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:50:35 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:50:35 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:50:35 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:50:35 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:50:35 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:50:35 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:50:35 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:50:35 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:50:35 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:50:35 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:50:35 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:50:35 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:50:35 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:50:35 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:50:35 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:50:35 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:50:35 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:51:55 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:51:55 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:51:55 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:51:55 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:51:55 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:51:55 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:51:55 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:51:55 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:51:55 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:51:55 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:51:55 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:51:55 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:52:09 --> 404 Page Not Found: Img/undraw_posting_photo.svg
ERROR - 2023-06-22 11:52:14 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 11:52:14 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 11:52:14 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 11:52:14 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 11:52:16 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:52:16 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:52:16 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:52:16 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:52:33 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 11:52:33 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 11:52:33 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 11:52:33 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 11:52:36 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:52:36 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:52:36 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:52:36 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:52:42 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 11:52:42 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 11:52:42 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 11:52:42 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 11:52:46 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:52:46 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:52:46 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:52:46 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:54:08 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:54:08 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:54:08 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:54:08 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:54:08 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:54:08 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:54:08 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:54:08 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:54:11 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 11:54:16 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:54:16 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:54:16 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:54:16 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:54:17 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 11:57:43 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:57:43 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:57:43 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:57:43 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:57:44 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 11:58:32 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 11:58:36 --> 404 Page Not Found: Img/undraw_posting_photo.svg
ERROR - 2023-06-22 11:58:37 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 11:59:31 --> 404 Page Not Found: Img/undraw_posting_photo.svg
ERROR - 2023-06-22 11:59:35 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 11:59:35 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 11:59:35 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 11:59:35 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 11:59:36 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:59:36 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:59:36 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:59:36 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:59:36 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:59:36 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:59:36 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:59:36 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:59:36 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:59:36 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 11:59:36 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 11:59:36 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 12:00:22 --> Severity: Warning --> Undefined array key 0 /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 36
ERROR - 2023-06-22 12:00:22 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 36
ERROR - 2023-06-22 12:00:44 --> Severity: Warning --> Undefined array key 0 /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 36
ERROR - 2023-06-22 12:00:44 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 36
ERROR - 2023-06-22 12:00:48 --> Severity: Warning --> Undefined array key 0 /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 36
ERROR - 2023-06-22 12:00:48 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 36
ERROR - 2023-06-22 12:01:00 --> 404 Page Not Found: Img/undraw_posting_photo.svg
ERROR - 2023-06-22 12:01:02 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 12:01:02 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 12:01:02 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 12:01:02 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 12:01:04 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 12:01:04 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 12:01:04 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 12:01:04 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 12:01:10 --> Severity: Warning --> Undefined array key 0 /Applications/MAMP/htdocs/c4/application/controllers/CrearMatriz.php 1090
ERROR - 2023-06-22 12:01:10 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/formCheck.php 186
ERROR - 2023-06-22 12:01:10 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/formCheck.php 188
ERROR - 2023-06-22 12:01:10 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/formCheck.php 189
ERROR - 2023-06-22 14:51:57 --> 404 Page Not Found: Img/undraw_posting_photo.svg
ERROR - 2023-06-22 14:52:00 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 14:52:00 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 14:52:00 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 14:52:00 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 14:52:02 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 14:52:02 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 14:52:02 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 14:52:02 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 14:52:02 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 14:52:02 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 14:52:02 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 14:52:02 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 14:52:02 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 14:52:02 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 14:52:02 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 14:52:02 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 14:54:03 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 14:54:03 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 14:54:03 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 14:54:03 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 14:54:03 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 14:54:03 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 14:54:03 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 14:54:03 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 14:54:03 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 14:54:03 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 14:54:03 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 14:54:03 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 14:55:08 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 14:55:08 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 14:55:08 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 14:55:08 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 14:55:08 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 14:55:08 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 14:55:08 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 14:55:08 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 14:55:08 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 14:55:08 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 14:55:08 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 14:55:08 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 14:55:25 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 14:55:25 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 14:55:25 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 14:55:25 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 14:55:25 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 14:55:25 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 14:55:25 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 14:55:25 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 14:55:25 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 14:55:25 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 14:55:25 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 14:55:25 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 14:55:50 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 14:55:50 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 14:55:50 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 14:55:50 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 14:55:50 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 14:55:50 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 14:55:50 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 14:55:50 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 14:55:50 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 14:55:50 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 14:55:50 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 14:55:50 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 14:56:20 --> Severity: Warning --> Undefined array key 0 /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 36
ERROR - 2023-06-22 14:56:20 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 36
ERROR - 2023-06-22 14:56:25 --> Severity: Warning --> Undefined array key 0 /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 36
ERROR - 2023-06-22 14:56:25 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 36
ERROR - 2023-06-22 14:56:42 --> 404 Page Not Found: Img/undraw_posting_photo.svg
ERROR - 2023-06-22 14:56:45 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 14:56:45 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 14:56:45 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 14:56:45 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 14:56:47 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 14:56:47 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 14:56:47 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 14:56:47 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 14:56:56 --> Query error: Expression #7 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'c4.r.idMatrizRecurrente' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT *
FROM `app_nueva_matriz` `m`
INNER JOIN `app_matriz_recurrente` `r` ON `r`.`idNuevaMatriz` = `m`.`idNuevaMatriz`
INNER JOIN `app_asignaciones` `a` ON `a`.`idMatriz` = `m`.`idNuevaMatriz`
WHERE `r`.`idResponsable` = '9'
AND `a`.`idTipoEmpresa` = '4'
GROUP BY `m`.`idNuevaMatriz`
ERROR - 2023-06-22 14:58:27 --> 404 Page Not Found: Img/undraw_posting_photo.svg
ERROR - 2023-06-22 14:58:37 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 14:58:37 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 14:58:37 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 14:58:37 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 14:58:38 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 14:58:38 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 14:58:38 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 14:58:38 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 14:59:17 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 14:59:17 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 14:59:17 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 14:59:17 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 14:59:21 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 14:59:21 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 14:59:21 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 14:59:21 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 14:59:47 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 14:59:47 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 14:59:47 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 14:59:47 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 14:59:50 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 14:59:59 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 14:59:59 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 14:59:59 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 14:59:59 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:00:00 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:01:14 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:01:14 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:01:14 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:01:14 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:01:15 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:01:29 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:01:29 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:01:29 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:01:29 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:01:30 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:01:51 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:01:51 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:01:51 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:01:51 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:01:51 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:01:52 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:02:08 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:02:08 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:02:08 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:02:08 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:02:08 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:03:24 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:03:24 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:03:24 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:03:24 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:03:25 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:03:27 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:03:27 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:03:27 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:03:27 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:03:28 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:03:30 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:03:30 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:03:30 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:03:30 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:03:30 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:03:30 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:03:30 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:03:30 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:03:31 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:03:33 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:03:33 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:03:33 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:03:33 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:03:34 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:07:39 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:08:28 --> 404 Page Not Found: Img/undraw_posting_photo.svg
ERROR - 2023-06-22 15:08:29 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:08:31 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:08:31 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:08:31 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:08:31 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:08:32 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:08:33 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:08:33 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:08:33 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:08:33 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:08:34 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:10:16 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:10:16 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:10:16 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:10:16 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:10:17 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:10:20 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:10:20 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:10:20 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:10:20 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:10:21 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:10:24 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:10:33 --> 404 Page Not Found: Img/undraw_posting_photo.svg
ERROR - 2023-06-22 15:10:33 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:10:37 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:11:30 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:11:32 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:11:32 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:11:32 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:11:32 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:11:33 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:11:34 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:11:34 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:11:34 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:11:34 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:11:35 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:12:13 --> 404 Page Not Found: Img/undraw_posting_photo.svg
ERROR - 2023-06-22 15:12:21 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:12:21 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:12:21 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:12:21 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:12:22 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:12:22 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:12:22 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:12:22 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:14:14 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:14:14 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:14:14 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:14:14 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:14:16 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:14:19 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:14:25 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:14:26 --> Severity: Warning --> Undefined array key 0 /Applications/MAMP/htdocs/c4/application/controllers/MisMatrices.php 153
ERROR - 2023-06-22 15:14:29 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:14:30 --> Severity: Warning --> Undefined array key 0 /Applications/MAMP/htdocs/c4/application/controllers/MisMatrices.php 153
ERROR - 2023-06-22 15:14:40 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:14:43 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:14:45 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:14:46 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:14:48 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:17:49 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:17:52 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:18:24 --> 404 Page Not Found: Img/undraw_posting_photo.svg
ERROR - 2023-06-22 15:18:25 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:18:26 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:18:26 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:18:26 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:18:26 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:18:27 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:18:29 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:18:29 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:18:29 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:18:29 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:18:30 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:19:26 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:19:26 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:19:26 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:19:26 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:19:27 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:19:30 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:19:36 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:19:38 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:19:42 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:19:45 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:19:46 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:20:17 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:20:50 --> 404 Page Not Found: Img/undraw_posting_photo.svg
ERROR - 2023-06-22 15:20:51 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:20:54 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:20:54 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:20:54 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:20:54 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:20:55 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:20:56 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:20:56 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:20:56 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:20:56 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:20:57 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:21:13 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:21:13 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:21:13 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:21:13 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:21:13 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:21:35 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:21:35 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:21:35 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:21:35 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:21:36 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:21:43 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:21:43 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:21:43 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:21:44 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:21:44 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:21:46 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:21:46 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:21:46 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:21:46 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:21:46 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:21:46 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:21:46 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:21:46 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:21:46 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:23:17 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 17
ERROR - 2023-06-22 15:23:17 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 15:23:17 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 15:23:17 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 15:23:17 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 15:23:17 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 15:23:17 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 15:23:17 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 15:23:17 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 15:23:18 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:24:31 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 17
ERROR - 2023-06-22 15:24:31 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 15:24:31 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 15:24:31 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 15:24:31 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 15:24:31 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 15:24:31 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 15:24:31 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 15:24:31 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 15:24:31 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:25:13 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 17
ERROR - 2023-06-22 15:25:13 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 15:25:13 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 15:25:13 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 15:25:13 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 15:25:13 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 15:25:13 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 92
ERROR - 2023-06-22 15:25:13 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 15:25:13 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 94
ERROR - 2023-06-22 15:25:14 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:25:33 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:25:33 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:25:33 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:25:33 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:25:33 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:25:33 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:25:33 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:25:33 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:25:34 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:25:34 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:25:34 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:25:34 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:25:34 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:25:34 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:25:34 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:25:34 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:25:34 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:25:34 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:25:34 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:25:34 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:25:34 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:25:34 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:25:34 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:25:34 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:25:34 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:25:35 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:25:35 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:25:35 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:25:35 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:25:35 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:25:35 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:25:35 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:25:35 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:25:35 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:26:36 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:26:36 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:26:36 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:26:36 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:26:36 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:26:36 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:26:36 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:26:36 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:26:37 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:27:06 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:27:06 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:27:06 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:27:06 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:27:06 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:27:06 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:27:06 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:27:06 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:27:07 --> 404 Page Not Found: Res/js
ERROR - 2023-06-22 15:29:37 --> 404 Page Not Found: Img/undraw_posting_photo.svg
ERROR - 2023-06-22 15:29:39 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:29:39 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:29:39 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:29:39 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:29:40 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:29:40 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:29:40 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:29:40 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:29:59 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:29:59 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:29:59 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:29:59 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:30:22 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:30:22 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:30:22 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:30:22 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:30:25 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:30:25 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:30:25 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:30:25 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:30:25 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:30:25 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:30:25 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:30:25 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:30:25 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:30:25 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:30:25 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:30:25 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:30:25 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:30:25 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:30:25 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:30:25 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:30:25 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:30:25 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:30:25 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:30:25 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:30:25 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:30:25 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:30:25 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:30:25 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:30:25 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:30:25 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:30:25 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:30:25 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:30:25 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:30:25 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:30:25 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:30:25 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:30:26 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:30:26 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:30:26 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:30:26 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:30:26 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:30:26 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:30:26 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:30:26 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:30:26 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:30:26 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:30:26 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:30:26 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:30:26 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:30:26 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:30:26 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:30:26 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:30:26 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:30:26 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:30:26 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:30:26 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:30:26 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:30:26 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:30:26 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:30:26 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:30:26 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:30:26 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:30:26 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:30:26 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:30:26 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:30:26 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:30:26 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:30:26 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:30:27 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:30:27 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:30:27 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:30:27 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:32:33 --> 404 Page Not Found: Img/undraw_posting_photo.svg
ERROR - 2023-06-22 15:32:35 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:32:35 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:32:35 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:32:35 --> Severity: Warning --> Undefined array key "TipoEmpresa" /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/home.php 52
ERROR - 2023-06-22 15:32:42 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:32:42 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:32:42 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:32:42 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:32:42 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:32:42 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 91
ERROR - 2023-06-22 15:32:42 --> Severity: Warning --> Undefined variable $infoComentarios /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
ERROR - 2023-06-22 15:32:42 --> Severity: Warning --> Trying to access array offset on value of type null /Applications/MAMP/htdocs/c4/application/views/MatricesCreadas/infoMatriz.php 93
