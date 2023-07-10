/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 10.6.4-MariaDB : Database - gestorbase
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `app_areas` */

DROP TABLE IF EXISTS `app_areas`;

CREATE TABLE `app_areas` (
  `idArea` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombreArea` text DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  PRIMARY KEY (`idArea`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `app_areas` */

insert  into `app_areas`(`idArea`,`nombreArea`,`estado`) values (1,'Sistemas',1);

/*Table structure for table `app_auditoria_general` */

DROP TABLE IF EXISTS `app_auditoria_general`;

CREATE TABLE `app_auditoria_general` (
  `idAuditoria` bigint(20) NOT NULL AUTO_INCREMENT,
  `tipoAuditoria` text DEFAULT NULL,
  `textAuditoria` text DEFAULT NULL,
  `idUsuario` bigint(20) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `ip` text DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  PRIMARY KEY (`idAuditoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `app_auditoria_general` */

/*Table structure for table `app_cargos` */

DROP TABLE IF EXISTS `app_cargos`;

CREATE TABLE `app_cargos` (
  `idCargo` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombreCargo` text DEFAULT NULL,
  `especialista` int(11) DEFAULT 0,
  `estado` int(11) DEFAULT 1,
  PRIMARY KEY (`idCargo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `app_cargos` */

insert  into `app_cargos`(`idCargo`,`nombreCargo`,`especialista`,`estado`) values (1,'T?®cnico en sistemas',0,1);

/*Table structure for table `app_cesantias` */

DROP TABLE IF EXISTS `app_cesantias`;

CREATE TABLE `app_cesantias` (
  `id_app_cesantias` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombrefondocesantias` text DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  PRIMARY KEY (`id_app_cesantias`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `app_cesantias` */

insert  into `app_cesantias`(`id_app_cesantias`,`nombrefondocesantias`,`estado`) values (1,'Porvenir',1),(2,'Proteccion',1),(3,'Bbva horizonte',1),(4,'Colfondos',1),(5,'Prestaciones sociales del Magisterio',1),(6,'Fondo Nacional del ahorro',1),(7,'Santander',1),(8,'Skandia',1);

/*Table structure for table `app_citas` */

DROP TABLE IF EXISTS `app_citas`;

CREATE TABLE `app_citas` (
  `idCita` bigint(20) NOT NULL AUTO_INCREMENT,
  `idServicio` bigint(20) DEFAULT NULL,
  `idEspecialista` bigint(20) DEFAULT NULL,
  `idPaciente` bigint(20) DEFAULT NULL,
  `fechaCita` date DEFAULT NULL,
  `horaCita` time DEFAULT NULL,
  `fechaFinCita` date DEFAULT NULL,
  `horaFinCita` time DEFAULT NULL,
  `usuarioCrea` bigint(20) DEFAULT NULL,
  `fechaCrea` datetime DEFAULT NULL,
  `ip` text DEFAULT NULL,
  `tomada` int(11) DEFAULT 1,
  `observaciones` text DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  `eliminado` int(11) DEFAULT 0,
  PRIMARY KEY (`idCita`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

/*Data for the table `app_citas` */

insert  into `app_citas`(`idCita`,`idServicio`,`idEspecialista`,`idPaciente`,`fechaCita`,`horaCita`,`fechaFinCita`,`horaFinCita`,`usuarioCrea`,`fechaCrea`,`ip`,`tomada`,`observaciones`,`estado`,`eliminado`) values (1,10,122,3,'2016-12-13','10:20:00',NULL,NULL,NULL,NULL,NULL,4,'sdfdsfsdfdsfsdf',1,0),(2,10,122,3,'2016-11-29','08:00:00',NULL,NULL,NULL,NULL,NULL,1,NULL,1,0),(3,10,122,3,'2016-12-01','11:40:00',NULL,NULL,NULL,NULL,NULL,1,NULL,1,0),(4,10,122,3,'2016-11-29','13:20:00',NULL,NULL,NULL,NULL,NULL,1,NULL,1,0),(5,10,122,3,'2016-11-30','12:00:00',NULL,NULL,NULL,NULL,NULL,1,NULL,1,0),(6,10,122,3,'2016-11-29','13:00:00',NULL,NULL,NULL,NULL,NULL,1,NULL,1,0),(7,2,19,3,'2016-11-29','06:40:00',NULL,NULL,NULL,NULL,NULL,1,NULL,1,0),(8,10,122,145,'2016-12-06','10:00:00',NULL,'11:00:00',NULL,NULL,NULL,1,NULL,1,0),(9,10,122,145,'2016-12-07','07:00:00',NULL,'08:30:00',NULL,NULL,NULL,1,NULL,1,0),(10,10,122,145,'2016-12-07','09:00:00',NULL,'10:30:00',NULL,NULL,NULL,1,NULL,1,0),(11,10,122,145,'2016-12-07','11:30:00',NULL,'12:00:00',NULL,NULL,NULL,1,NULL,1,0),(12,10,122,145,'2016-12-08','09:00:00',NULL,'09:30:00',NULL,NULL,NULL,1,NULL,1,0),(13,10,122,145,'2016-12-15','08:00:00',NULL,'09:30:00',NULL,NULL,NULL,4,'Se cancela porque qued?? mal guardada.',1,0),(14,10,122,145,'2016-12-14','08:00:00',NULL,'10:30:00',NULL,NULL,NULL,4,'gdfgdfgfg',1,0),(15,10,122,4,'2016-12-09','07:00:00',NULL,'08:00:00',NULL,NULL,NULL,1,NULL,1,0),(16,10,122,4,'2016-12-09','09:00:00',NULL,'10:00:00',NULL,NULL,NULL,1,NULL,1,0),(17,10,122,4,'2016-12-09','11:00:00',NULL,'12:00:00',NULL,NULL,NULL,1,NULL,1,0),(18,10,122,6,'2016-12-09','10:00:00',NULL,'10:30:00',NULL,NULL,NULL,1,NULL,1,0),(19,10,122,52,'2016-12-09','10:30:00',NULL,'11:00:00',NULL,NULL,NULL,1,NULL,1,0),(20,10,122,52,'2016-12-09','08:00:00',NULL,'08:30:00',NULL,NULL,NULL,1,NULL,1,0),(21,10,122,52,'2016-12-09','08:30:00',NULL,'09:00:00',NULL,NULL,NULL,1,NULL,1,0),(22,10,122,51,'2016-12-09','12:00:00',NULL,'13:00:00',NULL,NULL,NULL,1,NULL,1,0),(23,10,122,51,'2016-12-20','08:00:00',NULL,'09:00:00',NULL,NULL,NULL,4,'vbcbgcdfgdfg',1,0),(24,10,122,51,'2016-12-08','09:30:00',NULL,'10:00:00',NULL,NULL,NULL,1,NULL,1,0),(25,10,122,157,'2016-12-16','07:00:00',NULL,'08:00:00',NULL,NULL,NULL,4,'Esta cita qued?? mal creada.',1,0),(26,10,122,157,'2016-12-16','08:00:00',NULL,'09:00:00',NULL,NULL,NULL,4,'Otra cita mala',1,0),(27,10,122,157,'2016-12-16','09:00:00',NULL,'10:00:00',NULL,NULL,NULL,4,'hgfjhgfjhgf',1,0),(28,10,122,157,'2016-12-21','13:00:00',NULL,'14:00:00',NULL,NULL,NULL,2,'',1,0),(29,10,122,158,'2016-12-15','11:00:00',NULL,'12:30:00',NULL,NULL,NULL,2,'El usuario llego sobre el tiempo y est?í peleando.',1,0),(30,10,122,157,'2016-12-16','07:00:00',NULL,'08:00:00',NULL,NULL,NULL,1,NULL,1,0),(32,10,122,157,'2016-12-16','08:30:00',NULL,'09:30:00',NULL,NULL,NULL,4,'Ya tengo otra cita mas antes.',1,0),(33,10,122,158,'2016-12-16','10:00:00',NULL,'11:00:00',NULL,NULL,NULL,3,'Tudo bem.',1,0),(34,10,13,157,'2016-12-20','07:30:00',NULL,'08:30:00',NULL,NULL,NULL,4,'fghfghfghgfh',1,0),(35,10,13,157,'2016-12-19','11:00:00',NULL,'12:00:00',NULL,NULL,NULL,4,'por que no alcanzo a llegar ',1,0),(36,10,13,158,'2016-12-19','16:00:00',NULL,'16:30:00',NULL,NULL,NULL,2,'',1,0),(37,10,13,157,'2016-12-20','08:30:00',NULL,'09:30:00',NULL,NULL,NULL,4,'Esta es una prueba',1,0),(38,10,13,157,'2016-12-20','12:00:00',NULL,'12:30:00',NULL,NULL,NULL,1,NULL,1,0),(39,10,13,158,'2016-12-20','12:30:00',NULL,'13:30:00',NULL,NULL,NULL,1,NULL,1,0),(40,10,13,157,'2016-12-20','11:30:00',NULL,'12:00:00',NULL,NULL,NULL,2,'El personaje llega tarde.',1,0),(41,10,13,32,'2016-12-21','11:30:00',NULL,'12:00:00',NULL,NULL,NULL,2,'',1,0),(42,10,13,43,'2016-12-22','10:30:00',NULL,'11:00:00',NULL,NULL,NULL,2,'El usuario ha legado con anterioridad',1,0),(43,10,13,57,'2016-12-22','12:00:00',NULL,'12:30:00',NULL,NULL,NULL,1,NULL,1,0),(44,10,13,48,'2016-12-23','08:30:00',NULL,'09:00:00',NULL,NULL,NULL,2,'',1,0),(45,10,13,52,'2016-12-23','10:30:00',NULL,'11:00:00',NULL,NULL,NULL,2,'',1,0),(46,12,528,157,'2016-12-22','13:00:00',NULL,'13:30:00',NULL,NULL,NULL,1,NULL,1,0),(47,10,13,157,'2016-12-21','16:30:00',NULL,'17:00:00',NULL,NULL,NULL,2,'',1,0),(48,10,13,157,'2017-01-20','15:00:00',NULL,'15:30:00',NULL,NULL,NULL,2,'',1,0),(49,10,13,157,'2017-01-25','07:30:00',NULL,'08:00:00',NULL,NULL,NULL,1,NULL,1,0),(50,10,13,157,'2017-02-01','14:00:00',NULL,'14:30:00',NULL,NULL,NULL,2,'ya llego',1,0);

/*Table structure for table `app_ciudades` */

DROP TABLE IF EXISTS `app_ciudades`;

CREATE TABLE `app_ciudades` (
  `ID_PAIS` varchar(10) NOT NULL,
  `ID_DPTO` varchar(10) NOT NULL,
  `ID_CIUDAD` varchar(10) NOT NULL,
  `NOMBRE` varchar(255) NOT NULL,
  `estado` int(11) DEFAULT 1,
  PRIMARY KEY (`ID_PAIS`,`ID_DPTO`,`ID_CIUDAD`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `app_ciudades` */

insert  into `app_ciudades`(`ID_PAIS`,`ID_DPTO`,`ID_CIUDAD`,`NOMBRE`,`estado`) values ('057','05','001','MEDELLIN ',1),('057','05','002','ABEJORRAL ',1),('057','05','004','ABRIAQUI ',1),('057','05','021','ALEJANDRIA ',1),('057','05','030','AMAGA ',1),('057','05','031','AMALFI ',1),('057','05','034','ANDES ',1),('057','05','036','ANGELOPOLIS ',1),('057','05','038','ANGOSTURA ',1),('057','05','040','ANORI ',1),('057','05','042','SANTAFE DE ANTIOQUIA ',1),('057','05','044','ANZA ',1),('057','05','045','APARTADO ',1),('057','05','051','ARBOLETES ',1),('057','05','059','ARMENIA ',1),('057','05','079','BARBOSA ',1),('057','05','086','BELMIRA ',1),('057','05','088','BELLO ',1),('057','05','091','BETANIA ',1),('057','05','093','BETULIA ',1),('057','05','101','CIUDAD BOLIVAR ',1),('057','05','107','BRICE?æO',1),('057','05','113','BURITICA ',1),('057','05','120','CACERES ',1),('057','05','125','CAICEDO ',1),('057','05','129','CALDAS ',1),('057','05','134','CAMPAMENTO ',1),('057','05','138','CA?æASGORDAS ',1),('057','05','142','CARACOLI ',1),('057','05','145','CARAMANTA ',1),('057','05','147','CAREPA ',1),('057','05','148','EL CARMEN DE VIBORAL ',1),('057','05','150','CAROLINA ',1),('057','05','154','CAUCASIA ',1),('057','05','172','CHIGORODO ',1),('057','05','190','CISNEROS ',1),('057','05','197','COCORNA ',1),('057','05','206','CONCEPCION ',1),('057','05','209','CONCORDIA ',1),('057','05','212','COPACABANA ',1),('057','05','234','DABEIBA ',1),('057','05','237','DON MATIAS ',1),('057','05','240','EBEJICO ',1),('057','05','250','EL BAGRE ',1),('057','05','264','ENTRERRIOS ',1),('057','05','266','ENVIGADO ',1),('057','05','282','FREDONIA ',1),('057','05','284','FRONTINO ',1),('057','05','306','GIRALDO ',1),('057','05','308','GIRARDOTA ',1),('057','05','309','PUERTO LEGUIZAMO',1),('057','05','310','GOMEZ PLATA ',1),('057','05','318','GUARNE ',1),('057','05','321','GUATAPE ',1),('057','05','347','HELICONIA ',1),('057','05','353','HISPANIA ',1),('057','05','360','ITAGUI',1),('057','05','361','ITUANGO ',1),('057','05','364','JARDIN ',1),('057','05','368','JERICO ',1),('057','05','376','LA CEJA ',1),('057','05','380','LA ESTRELLA ',1),('057','05','390','LA PINTADA ',1),('057','05','411','LIBORINA ',1),('057','05','425','MACEO ',1),('057','05','440','MARINILLA ',1),('057','05','467','MONTEBELLO ',1),('057','05','475','MURINDO ',1),('057','05','480','MUTATA ',1),('057','05','490','NECOCLI ',1),('057','05','495','NECHI ',1),('057','05','501','OLAYA ',1),('057','05','541','PE?æOL',1),('057','05','543','PEQUE ',1),('057','05','576','PUEBLORRICO ',1),('057','05','579','PUERTO BERRIO ',1),('057','05','585','PUERTO NARE ',1),('057','05','591','PUERTO TRIUNFO ',1),('057','05','604','REMEDIOS ',1),('057','05','607','RETIRO ',1),('057','05','615','RIONEGRO ',1),('057','05','631','SABANETA ',1),('057','05','642','SALGAR ',1),('057','05','647','SAN ANDRES ',1),('057','05','649','SAN CARLOS ',1),('057','05','656','SAN JERONIMO ',1),('057','05','658','SAN JOSE DE LA MONTA?æA ',1),('057','05','659','SAN JUAN DE URABA ',1),('057','05','665','SAN PEDRO DE URABA ',1),('057','05','667','SAN RAFAEL ',1),('057','05','670','SAN ROQUE ',1),('057','05','674','SAN VICENTE ',1),('057','05','686','SANTA ROSA DE OSOS ',1),('057','05','690','SANTO DOMINGO ',1),('057','05','697','EL SANTUARIO ',1),('057','05','736','SEGOVIA ',1),('057','05','756','SONSON ',1),('057','05','761','SOPETRAN ',1),('057','05','789','TAMESIS ',1),('057','05','790','TARAZA ',1),('057','05','792','TARSO ',1),('057','05','809','TITIRIBI ',1),('057','05','837','TURBO ',1),('057','05','842','URAMITA ',1),('057','05','847','URRAO ',1),('057','05','854','VALDIVIA ',1),('057','05','856','VALPARAISO ',1),('057','05','858','VEGACHI ',1),('057','05','861','VENECIA ',1),('057','05','873','VIGIA DEL FUERTE ',1),('057','05','885','YALI ',1),('057','05','887','YARUMAL ',1),('057','05','890','YOLOMBO ',1),('057','05','893','YONDO ',1),('057','05','895','ZARAGOZA ',1),('057','08','001','BARRANQUILLA ',1),('057','08','078','BARANOA ',1),('057','08','137','CAMPO DE LA CRUZ ',1),('057','08','141','CANDELARIA ',1),('057','08','296','GALAPA ',1),('057','08','372','JUAN DE ACOSTA ',1),('057','08','421','LURUACO ',1),('057','08','433','MALAMBO ',1),('057','08','436','MANATI ',1),('057','08','520','PALMAR DE VARELA ',1),('057','08','549','PIOJO ',1),('057','08','558','POLONUEVO ',1),('057','08','560','PONEDERA ',1),('057','08','606','REPELON ',1),('057','08','634','SABANAGRANDE ',1),('057','08','675','SANTA LUCIA ',1),('057','08','685','SANTO TOMAS ',1),('057','08','758','SOLEDAD ',1),('057','08','770','SUAN ',1),('057','08','832','TUBARA ',1),('057','08','849','USIACURI ',1),('057','11','001','BOGOTA',1),('057','13','001','CARTAGENA ',1),('057','13','006','ACHI ',1),('057','13','030','ALTOS DEL ROSARIO ',1),('057','13','042','ARENAL ',1),('057','13','052','ARJONA ',1),('057','13','062','ARROYOHONDO ',1),('057','13','074','BARRANCO DE LOBA ',1),('057','13','140','CALAMAR ',1),('057','13','160','CANTAGALLO ',1),('057','13','188','CICUCO ',1),('057','13','212','CORDOBA ',1),('057','13','222','CLEMENCIA ',1),('057','13','244','EL CARMEN DE BOLIVAR ',1),('057','13','248','EL GUAMO ',1),('057','13','300','HATILLO DE LOBA ',1),('057','13','430','MAGANGUE ',1),('057','13','433','MAHATES ',1),('057','13','440','MARGARITA ',1),('057','13','442','MARIA LA BAJA ',1),('057','13','458','MONTECRISTO ',1),('057','13','468','MOMPOS ',1),('057','13','549','PINILLOS ',1),('057','13','580','REGIDOR ',1),('057','13','600','RIO VIEJO ',1),('057','13','620','SAN CRISTOBAL ',1),('057','13','647','SAN ESTANISLAO ',1),('057','13','650','SAN FERNANDO ',1),('057','13','654','SAN JACINTO ',1),('057','13','655','SAN JACINTO DEL CAUCA ',1),('057','13','657','SAN JUAN NEPOMUCENO ',1),('057','13','667','SAN MARTIN DE LOBA ',1),('057','13','670','SAN PABLO ',1),('057','13','673','SANTA CATALINA ',1),('057','13','683','SANTA ROSA ',1),('057','13','688','SANTA ROSA DEL SUR ',1),('057','13','744','SIMITI ',1),('057','13','760','SOPLAVIENTO ',1),('057','13','780','TALAIGUA NUEVO ',1),('057','13','810','TIQUISIO ',1),('057','13','836','TURBACO ',1),('057','13','838','TURBANA ',1),('057','13','894','ZAMBRANO ',1),('057','15','001','TUNJA ',1),('057','15','022','ALMEIDA ',1),('057','15','047','AQUITANIA ',1),('057','15','051','ARCABUCO ',1),('057','15','087','BELEN ',1),('057','15','090','BERBEO ',1),('057','15','092','BETEITIVA ',1),('057','15','097','BOAVITA ',1),('057','15','104','BOYACA ',1),('057','15','114','BUSBANZA ',1),('057','15','131','CALDAS ',1),('057','15','135','CAMPOHERMOSO ',1),('057','15','162','CERINZA ',1),('057','15','172','CHINAVITA ',1),('057','15','176','CHIQUINQUIRA ',1),('057','15','180','CHISCAS ',1),('057','15','183','CHITA ',1),('057','15','185','CHITARAQUE ',1),('057','15','187','CHIVATA ',1),('057','15','189','CIENEGA ',1),('057','15','204','COMBITA ',1),('057','15','212','COPER ',1),('057','15','215','CORRALES ',1),('057','15','218','COVARACHIA ',1),('057','15','223','CUBARA ',1),('057','15','224','CUCAITA ',1),('057','15','226','CUITIVA ',1),('057','15','232','CHIQUIZA ',1),('057','15','236','CHIVOR ',1),('057','15','238','DUITAMA ',1),('057','15','244','EL COCUY ',1),('057','15','248','EL ESPINO ',1),('057','15','272','FIRAVITOBA ',1),('057','15','276','FLORESTA ',1),('057','15','293','GACHANTIVA ',1),('057','15','296','GAMEZA ',1),('057','15','299','GARAGOA ',1),('057','15','317','GUACAMAYAS ',1),('057','15','322','GUATEQUE ',1),('057','15','325','GUAYATA ',1),('057','15','332','GA?æICAN ',1),('057','15','362','IZA ',1),('057','15','367','JENESANO ',1),('057','15','377','LABRANZAGRANDE ',1),('057','15','380','LA CAPILLA ',1),('057','15','403','LA UVITA ',1),('057','15','407','VILLA DE LEYVA ',1),('057','15','425','MACANAL ',1),('057','15','442','MARIPI ',1),('057','15','455','MIRAFLORES ',1),('057','15','464','MONGUA ',1),('057','15','466','MONGUI ',1),('057','15','469','MONIQUIRA ',1),('057','15','476','MOTAVITA ',1),('057','15','480','MUZO ',1),('057','15','491','NOBSA ',1),('057','15','494','NUEVO COLON ',1),('057','15','500','OICATA ',1),('057','15','507','OTANCHE ',1),('057','15','511','PACHAVITA ',1),('057','15','514','PAEZ ',1),('057','15','516','PAIPA ',1),('057','15','518','PAJARITO ',1),('057','15','522','PANQUEBA ',1),('057','15','531','PAUNA ',1),('057','15','533','PAYA ',1),('057','15','537','PAZ DE RIO ',1),('057','15','542','PESCA ',1),('057','15','550','PISBA ',1),('057','15','572','PUERTO BOYACA ',1),('057','15','580','QUIPAMA ',1),('057','15','599','RAMIRIQUI ',1),('057','15','600','RAQUIRA ',1),('057','15','621','RONDON ',1),('057','15','632','SABOYA ',1),('057','15','638','SACHICA ',1),('057','15','646','SAMACA ',1),('057','15','660','SAN EDUARDO ',1),('057','15','664','SAN JOSE DE PARE ',1),('057','15','667','SAN LUIS DE GACENO ',1),('057','15','673','SAN MATEO ',1),('057','15','676','SAN MIGUEL DE SEMA ',1),('057','15','681','SAN PABLO DE BORBUR ',1),('057','15','686','SANTANA ',1),('057','15','693','SANTA ROSA DE VITERBO ',1),('057','15','696','SANTA SOFIA ',1),('057','15','720','SATIVANORTE ',1),('057','15','723','SATIVASUR ',1),('057','15','740','SIACHOQUE ',1),('057','15','753','SOATA ',1),('057','15','755','SOCOTA ',1),('057','15','757','SOCHA ',1),('057','15','759','SOGAMOSO ',1),('057','15','761','SOMONDOCO ',1),('057','15','762','SORA ',1),('057','15','763','SOTAQUIRA ',1),('057','15','764','SORACA ',1),('057','15','774','SUSACON ',1),('057','15','776','SUTAMARCHAN ',1),('057','15','778','SUTATENZA ',1),('057','15','790','TASCO ',1),('057','15','798','TENZA ',1),('057','15','804','TIBANA ',1),('057','15','806','TIBASOSA ',1),('057','15','808','TINJACA ',1),('057','15','810','TIPACOQUE ',1),('057','15','814','TOCA ',1),('057','15','816','TOGA?æI ',1),('057','15','820','TOPAGA ',1),('057','15','822','TOTA ',1),('057','15','832','TUNUNGUA ',1),('057','15','835','TURMEQUE ',1),('057','15','837','TUTA ',1),('057','15','839','TUTAZA ',1),('057','15','842','UMBITA ',1),('057','15','861','VENTAQUEMADA ',1),('057','15','879','VIRACACHA ',1),('057','15','897','ZETAQUIRA ',1),('057','17','001','MANIZALES ',1),('057','17','013','AGUADAS ',1),('057','17','042','ANSERMA ',1),('057','17','050','ARANZAZU ',1),('057','17','088','BELALCAZAR ',1),('057','17','174','CHINCHINA ',1),('057','17','272','FILADELFIA ',1),('057','17','380','LA DORADA ',1),('057','17','388','LA MERCED ',1),('057','17','433','MANZANARES ',1),('057','17','442','MARMATO ',1),('057','17','444','MARQUETALIA ',1),('057','17','446','MARULANDA ',1),('057','17','486','NEIRA ',1),('057','17','495','NORCASIA ',1),('057','17','513','PACORA ',1),('057','17','524','PALESTINA ',1),('057','17','541','PENSILVANIA ',1),('057','17','616','RISARALDA ',1),('057','17','653','SALAMINA ',1),('057','17','662','SAMANA ',1),('057','17','665','SAN JOSE ',1),('057','17','777','SUPIA ',1),('057','17','867','VICTORIA ',1),('057','17','873','VILLAMARIA ',1),('057','17','877','VITERBO ',1),('057','18','029','ALBANIA ',1),('057','18','094','BELEN DE LOS ANDAQUIES ',1),('057','18','150','CARTAGENA DEL CHAIRA ',1),('057','18','205','CURILLO ',1),('057','18','247','EL DONCELLO ',1),('057','18','256','EL PAUJIL ',1),('057','18','410','LA MONTA?æITA ',1),('057','18','460','MILAN ',1),('057','18','479','MORELIA ',1),('057','18','592','PUERTO RICO ',1),('057','18','610','SAN JOSE DE LA FRAGUA ',1),('057','18','753','SAN VICENTE DEL CAGUAN ',1),('057','18','756','SOLANO ',1),('057','18','785','SOLITA ',1),('057','19','001','POPAYAN ',1),('057','19','022','ALMAGUER ',1),('057','19','050','ARGELIA ',1),('057','19','075','BALBOA ',1),('057','19','100','BOLIVAR ',1),('057','19','110','BUENOS AIRES ',1),('057','19','130','CAJIBIO ',1),('057','19','137','CALDONO ',1),('057','19','142','CALOTO ',1),('057','19','212','CORINTO ',1),('057','19','290','FLORENCIA ',1),('057','19','318','GUAPI ',1),('057','19','355','INZA ',1),('057','19','364','JAMBALO ',1),('057','19','392','LA SIERRA ',1),('057','19','397','LA VEGA ',1),('057','19','418','LOPEZ ',1),('057','19','450','MERCADERES ',1),('057','19','455','MIRANDA ',1),('057','19','473','MORALES ',1),('057','19','513','PADILLA ',1),('057','19','517','PAEZ ',1),('057','19','532','PATIA ',1),('057','19','533','PIAMONTE ',1),('057','19','548','PIENDAMO ',1),('057','19','573','PUERTO TEJADA ',1),('057','19','585','PURACE ',1),('057','19','622','ROSAS ',1),('057','19','693','SAN SEBASTIAN ',1),('057','19','698','SANTANDER DE QUILICHAO ',1),('057','19','743','SILVIA ',1),('057','19','760','SOTARA ',1),('057','19','780','SUAREZ ',1),('057','19','807','TIMBIO ',1),('057','19','809','TIMBIQUI ',1),('057','19','821','TORIBIO ',1),('057','19','824','TOTORO ',1),('057','19','845','VILLA RICA ',1),('057','20','001','VALLEDUPAR ',1),('057','20','011','AGUACHICA ',1),('057','20','013','AGUSTIN CODAZZI ',1),('057','20','032','ASTREA ',1),('057','20','045','BECERRIL ',1),('057','20','060','BOSCONIA ',1),('057','20','175','CHIMICHAGUA ',1),('057','20','178','CHIRIGUANA ',1),('057','20','228','CURUMANI ',1),('057','20','238','EL COPEY ',1),('057','20','250','EL PASO ',1),('057','20','295','GAMARRA ',1),('057','20','310','GONZALEZ ',1),('057','20','383','LA GLORIA ',1),('057','20','400','LA JAGUA DE IBIRICO ',1),('057','20','443','MANAURE ',1),('057','20','517','PAILITAS ',1),('057','20','550','PELAYA ',1),('057','20','570','PUEBLO BELLO ',1),('057','20','614','RIO DE ORO ',1),('057','20','710','SAN ALBERTO ',1),('057','20','750','SAN DIEGO ',1),('057','20','787','TAMALAMEQUE ',1),('057','23','001','MONTERIA ',1),('057','23','068','AYAPEL ',1),('057','23','090','CANALETE ',1),('057','23','162','CERETE ',1),('057','23','168','CHIMA ',1),('057','23','182','CHINU ',1),('057','23','189','CIENAGA DE ORO ',1),('057','23','300','COTORRA ',1),('057','23','350','LA APARTADA ',1),('057','23','417','LORICA ',1),('057','23','419','LOS CORDOBAS ',1),('057','23','464','MOMIL ',1),('057','23','466','MONTELIBANO ',1),('057','23','500','MO?æITOS ',1),('057','23','555','PLANETA RICA ',1),('057','23','570','PUEBLO NUEVO ',1),('057','23','574','PUERTO ESCONDIDO ',1),('057','23','580','PUERTO LIBERTADOR ',1),('057','23','586','PURISIMA ',1),('057','23','660','SAHAGUN ',1),('057','23','670','SAN ANDRES DE SOTAVENTO ',1),('057','23','672','SAN ANTERO ',1),('057','23','675','SAN BERNARDO DEL VIENTO ',1),('057','23','686','SAN PELAYO ',1),('057','23','807','TIERRALTA ',1),('057','23','855','VALENCIA ',1),('057','25','001','AGUA DE DIOS ',1),('057','25','019','ALBAN ',1),('057','25','035','ANAPOIMA ',1),('057','25','040','ANOLAIMA ',1),('057','25','053','ARBELAEZ ',1),('057','25','086','BELTRAN ',1),('057','25','095','BITUIMA ',1),('057','25','099','BOJACA ',1),('057','25','120','CABRERA ',1),('057','25','123','CACHIPAY ',1),('057','25','126','CAJICA ',1),('057','25','148','CAPARRAPI ',1),('057','25','151','CAQUEZA ',1),('057','25','154','CARMEN DE CARUPA ',1),('057','25','168','CHAGUANI ',1),('057','25','175','CHIA ',1),('057','25','178','CHIPAQUE ',1),('057','25','181','CHOACHI ',1),('057','25','183','CHOCONTA ',1),('057','25','200','COGUA ',1),('057','25','214','COTA ',1),('057','25','224','CUCUNUBA ',1),('057','25','245','EL COLEGIO ',1),('057','25','260','EL ROSAL ',1),('057','25','269','FACATATIVA ',1),('057','25','279','FOMEQUE ',1),('057','25','281','FOSCA ',1),('057','25','286','FUNZA ',1),('057','25','288','FUQUENE ',1),('057','25','290','FUSAGASUGA ',1),('057','25','293','GACHALA ',1),('057','25','295','GACHANCIPA ',1),('057','25','297','GACHETA ',1),('057','25','299','GAMA ',1),('057','25','307','GIRARDOT ',1),('057','25','317','GUACHETA ',1),('057','25','320','GUADUAS ',1),('057','25','322','GUASCA ',1),('057','25','324','GUATAQUI ',1),('057','25','326','GUATAVITA ',1),('057','25','328','GUAYABAL DE SIQUIMA ',1),('057','25','335','GUAYABETAL ',1),('057','25','339','GUTIERREZ ',1),('057','25','368','JERUSALEN ',1),('057','25','372','JUNIN ',1),('057','25','377','LA CALERA ',1),('057','25','386','LA MESA ',1),('057','25','394','LA PALMA ',1),('057','25','398','LA PE?æA ',1),('057','25','402','LA VEGA ',1),('057','25','407','LENGUAZAQUE ',1),('057','25','426','MACHETA ',1),('057','25','430','MADRID ',1),('057','25','436','MANTA ',1),('057','25','438','MEDINA ',1),('057','25','486','NEMOCON ',1),('057','25','488','NILO ',1),('057','25','489','NIMAIMA ',1),('057','25','491','NOCAIMA ',1),('057','25','513','PACHO ',1),('057','25','518','PAIME ',1),('057','25','524','PANDI ',1),('057','25','530','PARATEBUENO ',1),('057','25','535','PASCA ',1),('057','25','572','PUERTO SALGAR ',1),('057','25','580','PULI ',1),('057','25','592','QUEBRADANEGRA ',1),('057','25','594','QUETAME ',1),('057','25','596','QUIPILE ',1),('057','25','599','APULO ',1),('057','25','612','RICAURTE ',1),('057','25','645','SAN ANTONIO DEL TEQUENDAMA ',1),('057','25','653','SAN CAYETANO ',1),('057','25','662','SAN JUAN DE RIO SECO ',1),('057','25','718','SASAIMA ',1),('057','25','736','SESQUILE ',1),('057','25','740','SIBATE ',1),('057','25','743','SILVANIA ',1),('057','25','745','SIMIJACA ',1),('057','25','754','SOACHA ',1),('057','25','758','SOPO ',1),('057','25','769','SUBACHOQUE ',1),('057','25','772','SUESCA ',1),('057','25','777','SUPATA ',1),('057','25','779','SUSA ',1),('057','25','781','SUTATAUSA ',1),('057','25','785','TABIO ',1),('057','25','793','TAUSA ',1),('057','25','797','TENA ',1),('057','25','799','TENJO ',1),('057','25','805','TIBACUY ',1),('057','25','807','TIBIRITA ',1),('057','25','815','TOCAIMA ',1),('057','25','817','TOCANCIPA ',1),('057','25','823','TOPAIPI ',1),('057','25','839','UBALA ',1),('057','25','841','UBAQUE ',1),('057','25','843','VILLA DE SAN DIEGO DE UBATE ',1),('057','25','845','UNE ',1),('057','25','851','UTICA ',1),('057','25','862','VERGARA ',1),('057','25','867','VIANI ',1),('057','25','871','VILLAGOMEZ ',1),('057','25','873','VILLAPINZON ',1),('057','25','875','VILLETA ',1),('057','25','878','VIOTA ',1),('057','25','885','YACOPI ',1),('057','25','898','ZIPACON ',1),('057','25','899','ZIPAQUIRA ',1),('057','27','001','QUIBDO ',1),('057','27','006','ACANDI ',1),('057','27','025','ALTO BAUDO ',1),('057','27','050','ATRATO ',1),('057','27','073','BAGADO ',1),('057','27','075','BAHIA SOLANO ',1),('057','27','077','BAJO BAUDO ',1),('057','27','086','BELEN DE BAJIRA ',1),('057','27','135','EL CANTON DEL SAN PABLO ',1),('057','27','150','CARMEN DEL DARIEN ',1),('057','27','160','CERTEGUI ',1),('057','27','205','CONDOTO ',1),('057','27','245','EL CARMEN DE ATRATO ',1),('057','27','250','EL LITORAL DEL SAN JUAN ',1),('057','27','361','ISTMINA ',1),('057','27','372','JURADO ',1),('057','27','413','LLORO ',1),('057','27','425','MEDIO ATRATO ',1),('057','27','430','MEDIO BAUDO ',1),('057','27','450','MEDIO SAN JUAN ',1),('057','27','491','NOVITA ',1),('057','27','495','NUQUI ',1),('057','27','580','RIO IRO ',1),('057','27','600','RIO QUITO ',1),('057','27','615','RIOSUCIO ',1),('057','27','660','SAN JOSE DEL PALMAR ',1),('057','27','745','SIPI ',1),('057','27','787','TADO ',1),('057','27','800','UNGUIA ',1),('057','27','810','UNION PANAMERICANA ',1),('057','41','001','NEIVA ',1),('057','41','006','ACEVEDO ',1),('057','41','013','AGRADO ',1),('057','41','016','AIPE ',1),('057','41','020','ALGECIRAS ',1),('057','41','026','ALTAMIRA ',1),('057','41','078','BARAYA ',1),('057','41','132','CAMPOALEGRE ',1),('057','41','206','COLOMBIA ',1),('057','41','244','ELIAS ',1),('057','41','298','GARZON ',1),('057','41','306','GIGANTE ',1),('057','41','349','HOBO ',1),('057','41','357','IQUIRA ',1),('057','41','359','ISNOS ',1),('057','41','378','LA ARGENTINA ',1),('057','41','396','LA PLATA ',1),('057','41','483','NATAGA ',1),('057','41','503','OPORAPA ',1),('057','41','518','PAICOL ',1),('057','41','524','PALERMO ',1),('057','41','548','PITAL ',1),('057','41','551','PITALITO ',1),('057','41','615','RIVERA ',1),('057','41','660','SALADOBLANCO ',1),('057','41','668','SAN AGUSTIN ',1),('057','41','676','SANTA MARIA ',1),('057','41','770','SUAZA ',1),('057','41','791','TARQUI ',1),('057','41','797','TESALIA ',1),('057','41','799','TELLO ',1),('057','41','801','TERUEL ',1),('057','41','807','TIMANA ',1),('057','41','872','VILLAVIEJA ',1),('057','41','885','YAGUARA ',1),('057','44','001','RIOHACHA ',1),('057','44','078','BARRANCAS ',1),('057','44','090','DIBULLA ',1),('057','44','098','DISTRACCION ',1),('057','44','110','EL MOLINO ',1),('057','44','279','FONSECA ',1),('057','44','378','HATONUEVO ',1),('057','44','420','LA JAGUA DEL PILAR ',1),('057','44','430','MAICAO ',1),('057','44','650','SAN JUAN DEL CESAR ',1),('057','44','847','URIBIA ',1),('057','44','855','URUMITA ',1),('057','47','001','SANTA MARTA ',1),('057','47','030','ALGARROBO ',1),('057','47','053','ARACATACA ',1),('057','47','058','ARIGUANI ',1),('057','47','161','CERRO SAN ANTONIO ',1),('057','47','170','CHIVOLO ',1),('057','47','189','CIENAGA ',1),('057','47','245','EL BANCO ',1),('057','47','268','EL RETEN ',1),('057','47','288','FUNDACION ',1),('057','47','460','NUEVA GRANADA ',1),('057','47','541','PEDRAZA ',1),('057','47','545','PIJAO DEL CARMEN ',1),('057','47','551','PIVIJAY ',1),('057','47','555','PLATO ',1),('057','47','570','PUEBLOVIEJO ',1),('057','47','605','REMOLINO ',1),('057','47','660','SABANAS DE SAN ANGEL ',1),('057','47','692','SAN SEBASTIAN DE BUENAVISTA ',1),('057','47','703','SAN ZENON ',1),('057','47','707','SANTA ANA ',1),('057','47','720','SANTA BARBARA DE PINTO ',1),('057','47','745','SITIONUEVO ',1),('057','47','798','TENERIFE ',1),('057','47','960','ZAPAYAN ',1),('057','47','980','ZONA BANANERA ',1),('057','50','001','VILLAVICENCIO ',1),('057','50','006','ACACIAS ',1),('057','50','110','BARRANCA DE UPIA ',1),('057','50','124','CABUYARO ',1),('057','50','150','CASTILLA LA NUEVA ',1),('057','50','223','CUBARRAL ',1),('057','50','226','CUMARAL ',1),('057','50','245','EL CALVARIO ',1),('057','50','251','EL CASTILLO ',1),('057','50','270','EL DORADO ',1),('057','50','287','FUENTE DE ORO ',1),('057','50','318','GUAMAL ',1),('057','50','325','MAPIRIPAN ',1),('057','50','330','MESETAS ',1),('057','50','350','LA MACARENA ',1),('057','50','370','URIBE ',1),('057','50','400','LEJANIAS ',1),('057','50','450','PUERTO CONCORDIA ',1),('057','50','568','PUERTO GAITAN ',1),('057','50','573','PUERTO LOPEZ ',1),('057','50','577','PUERTO LLERAS ',1),('057','50','606','RESTREPO ',1),('057','50','680','SAN CARLOS DE GUAROA ',1),('057','50','683','SAN JUAN DE ARAMA ',1),('057','50','686','SAN JUANITO ',1),('057','50','689','SAN MARTIN ',1),('057','50','711','VISTA HERMOSA ',1),('057','52','001','PASTO ',1),('057','52','022','ALDANA ',1),('057','52','036','ANCUYA ',1),('057','52','051','ARBOLEDA ',1),('057','52','079','BARBACOAS ',1),('057','52','110','BUESACO ',1),('057','52','203','COLON ',1),('057','52','207','CONSACA ',1),('057','52','210','CONTADERO ',1),('057','52','224','CUASPUD ',1),('057','52','227','CUMBAL ',1),('057','52','233','CUMBITARA ',1),('057','52','240','CHACHAGA',1),('057','52','250','EL CHARCO ',1),('057','52','254','EL PE?æOL ',1),('057','52','256','EL ROSARIO ',1),('057','52','258','EL TABLON DE GOMEZ ',1),('057','52','260','EL TAMBO ',1),('057','52','287','FUNES ',1),('057','52','317','GUACHUCAL ',1),('057','52','320','GUAITARILLA ',1),('057','52','323','GUALMATAN ',1),('057','52','352','ILES ',1),('057','52','354','IMUES ',1),('057','52','356','IPIALES ',1),('057','52','378','LA CRUZ ',1),('057','52','381','LA FLORIDA ',1),('057','52','385','LA LLANADA ',1),('057','52','390','LA TOLA ',1),('057','52','405','LEIVA ',1),('057','52','411','LINARES ',1),('057','52','418','LOS ANDES ',1),('057','52','427','MAGUI ',1),('057','52','435','MALLAMA ',1),('057','52','473','MOSQUERA ',1),('057','52','480','NARI?æO ',1),('057','52','490','OLAYA HERRERA ',1),('057','52','506','OSPINA ',1),('057','52','520','FRANCISCO PIZARRO ',1),('057','52','540','POLICARPA ',1),('057','52','560','POTOSI ',1),('057','52','565','PROVIDENCIA ',1),('057','52','573','PUERRES ',1),('057','52','585','PUPIALES ',1),('057','52','621','ROBERTO PAYAN ',1),('057','52','678','SAMANIEGO ',1),('057','52','683','SANDONA ',1),('057','52','685','SAN BERNARDO ',1),('057','52','687','SAN LORENZO ',1),('057','52','694','SAN PEDRO DE CARTAGO ',1),('057','52','699','SANTACRUZ ',1),('057','52','720','SAPUYES ',1),('057','52','786','TAMINANGO ',1),('057','52','788','TANGUA ',1),('057','52','835','TUMACO ',1),('057','52','838','TUQUERRES ',1),('057','52','885','YACUANQUER ',1),('057','54','001','CUCUTA ',1),('057','54','003','ABREGO ',1),('057','54','051','ARBOLEDAS ',1),('057','54','099','BOCHALEMA ',1),('057','54','109','BUCARASICA ',1),('057','54','125','CACOTA ',1),('057','54','128','CACHIRA ',1),('057','54','172','CHINACOTA ',1),('057','54','174','CHITAGA ',1),('057','54','206','CONVENCION ',1),('057','54','223','CUCUTILLA ',1),('057','54','239','DURANIA ',1),('057','54','245','EL CARMEN ',1),('057','54','250','EL TARRA ',1),('057','54','261','EL ZULIA ',1),('057','54','313','GRAMALOTE ',1),('057','54','344','HACARI ',1),('057','54','347','HERRAN ',1),('057','54','377','LABATECA ',1),('057','54','385','LA ESPERANZA ',1),('057','54','398','LA PLAYA ',1),('057','54','405','LOS PATIOS ',1),('057','54','418','LOURDES ',1),('057','54','480','MUTISCUA ',1),('057','54','498','OCA?æA ',1),('057','54','518','PAMPLONA ',1),('057','54','520','PAMPLONITA ',1),('057','54','553','PUERTO SANTANDER ',1),('057','54','599','RAGONVALIA ',1),('057','54','660','SALAZAR ',1),('057','54','670','SAN CALIXTO ',1),('057','54','680','SANTIAGO ',1),('057','54','720','SARDINATA ',1),('057','54','743','SILOS ',1),('057','54','800','TEORAMA ',1),('057','54','810','TIBU ',1),('057','54','820','TOLEDO ',1),('057','54','871','VILLA CARO ',1),('057','54','874','VILLA DEL ROSARIO ',1),('057','63','190','CIRCASIA ',1),('057','63','272','FILANDIA ',1),('057','63','302','GENOVA ',1),('057','63','401','LA TEBAIDA ',1),('057','63','470','MONTENEGRO ',1),('057','63','548','PIJAO ',1),('057','63','594','QUIMBAYA ',1),('057','63','690','SALENTO ',1),('057','66','001','PEREIRA ',1),('057','66','045','APIA ',1),('057','66','088','BELEN DE UMBRIA ',1),('057','66','170','DOSQUEBRADAS ',1),('057','66','318','GUATICA ',1),('057','66','383','LA CELIA ',1),('057','66','400','LA VIRGINIA ',1),('057','66','440','MARSELLA ',1),('057','66','456','MISTRATO ',1),('057','66','572','PUEBLO RICO ',1),('057','66','594','QUINCHIA ',1),('057','66','682','SANTA ROSA DE CABAL ',1),('057','66','687','SANTUARIO ',1),('057','68','001','BUCARAMANGA ',1),('057','68','013','AGUADA ',1),('057','68','051','ARATOCA ',1),('057','68','079','BARICHARA ',1),('057','68','081','BARRANCABERMEJA ',1),('057','68','132','CALIFORNIA ',1),('057','68','147','CAPITANEJO ',1),('057','68','152','CARCASI ',1),('057','68','160','CEPITA ',1),('057','68','162','CERRITO ',1),('057','68','167','CHARALA ',1),('057','68','169','CHARTA ',1),('057','68','179','CHIPATA ',1),('057','68','190','CIMITARRA ',1),('057','68','209','CONFINES ',1),('057','68','211','CONTRATACION ',1),('057','68','217','COROMORO ',1),('057','68','229','CURITI ',1),('057','68','235','EL CARMEN DE CHUCURI ',1),('057','68','245','EL GUACAMAYO ',1),('057','68','255','EL PLAYON ',1),('057','68','264','ENCINO ',1),('057','68','266','ENCISO ',1),('057','68','276','FLORIDABLANCA ',1),('057','68','296','GALAN ',1),('057','68','298','GAMBITA ',1),('057','68','307','GIRON ',1),('057','68','318','GUACA ',1),('057','68','320','GUADALUPE ',1),('057','68','322','GUAPOTA ',1),('057','68','324','GUAVATA ',1),('057','68','327','GA?æEPSA ',1),('057','68','344','HATO ',1),('057','68','368','JESUS MARIA ',1),('057','68','370','JORDAN ',1),('057','68','377','LA BELLEZA ',1),('057','68','385','LANDAZURI ',1),('057','68','397','LA PAZ ',1),('057','68','406','LEBRIJA ',1),('057','68','418','LOS SANTOS ',1),('057','68','425','MACARAVITA ',1),('057','68','432','MALAGA ',1),('057','68','444','MATANZA ',1),('057','68','464','MOGOTES ',1),('057','68','468','MOLAGAVITA ',1),('057','68','498','OCAMONTE ',1),('057','68','500','OIBA ',1),('057','68','502','ONZAGA ',1),('057','68','522','PALMAR ',1),('057','68','524','PALMAS DEL SOCORRO ',1),('057','68','533','PARAMO ',1),('057','68','547','PIEDECUESTA ',1),('057','68','549','PINCHOTE ',1),('057','68','572','PUENTE NACIONAL ',1),('057','68','573','PUERTO PARRA ',1),('057','68','575','PUERTO WILCHES ',1),('057','68','655','SABANA DE TORRES ',1),('057','68','673','SAN BENITO ',1),('057','68','679','SAN GIL ',1),('057','68','682','SAN JOAQUIN ',1),('057','68','684','SAN JOSE DE MIRANDA ',1),('057','68','686','SAN MIGUEL ',1),('057','68','689','SAN VICENTE DE CHUCURI ',1),('057','68','705','SANTA BARBARA ',1),('057','68','720','SANTA HELENA DEL OPON ',1),('057','68','745','SIMACOTA ',1),('057','68','755','SOCORRO ',1),('057','68','770','SUAITA ',1),('057','68','780','SURATA ',1),('057','68','820','TONA ',1),('057','68','855','VALLE DE SAN JOSE ',1),('057','68','861','VELEZ ',1),('057','68','867','VETAS ',1),('057','68','895','ZAPATOCA ',1),('057','70','001','SINCELEJO ',1),('057','70','110','BUENAVISTA ',1),('057','70','124','CAIMITO ',1),('057','70','204','COLOSO ',1),('057','70','215','COROZAL ',1),('057','70','230','CHALAN ',1),('057','70','233','EL ROBLE ',1),('057','70','235','GALERAS ',1),('057','70','265','GUARANDA ',1),('057','70','418','LOS PALMITOS ',1),('057','70','429','MAJAGUAL ',1),('057','70','473','MORROA ',1),('057','70','508','OVEJAS ',1),('057','70','523','PALMITO ',1),('057','70','670','SAMPUES ',1),('057','70','678','SAN BENITO ABAD ',1),('057','70','702','SAN JUAN DE BETULIA ',1),('057','70','708','SAN MARCOS ',1),('057','70','713','SAN ONOFRE ',1),('057','70','742','SINCE ',1),('057','70','771','SUCRE ',1),('057','70','820','SANTIAGO DE TOLU ',1),('057','70','823','TOLUVIEJO ',1),('057','73','001','IBAGUE',1),('057','73','026','ALVARADO',1),('057','73','030','AMBALEMA',1),('057','73','043','ANZOATEGUI',1),('057','73','055','ARMERO',1),('057','73','067','ATACO',1),('057','73','124','CAJAMARCA',1),('057','73','148','CARMEN DE APICALA',1),('057','73','152','CASABIANCA',1),('057','73','168','CHAPARRAL',1),('057','73','200','COELLO',1),('057','73','217','COYAIMA',1),('057','73','226','CUNDAY',1),('057','73','236','DOLORES',1),('057','73','268','ESPINAL',1),('057','73','270','FALAN',1),('057','73','275','FLANDES',1),('057','73','283','FRESNO',1),('057','73','319','GUAMO',1),('057','73','347','HERVEO ',1),('057','73','349','HONDA ',1),('057','73','352','ICONONZO',1),('057','73','408','LERIDA ',1),('057','73','411','LIBANO ',1),('057','73','443','MARIQUITA',1),('057','73','449','MELGAR',1),('057','73','461','MURILLO ',1),('057','73','483','NATAGAIMA ',1),('057','73','504','ORTEGA ',1),('057','73','520','PALOCABILDO ',1),('057','73','547','PIEDRAS ',1),('057','73','555','PLANADAS',1),('057','73','563','PRADO',1),('057','73','585','PURIFICACION',1),('057','73','616','RIOBLANCO',1),('057','73','622','RONCESVALLES',1),('057','73','624','ROVIRA',1),('057','73','671','SALDA?æA ',1),('057','73','675','SAN ANTONIO',1),('057','73','678','SAN LUIS ',1),('057','73','686','SANTA ISABEL',1),('057','73','854','VALLE DE SAN JUAN ',1),('057','73','861','VENADILLO ',1),('057','73','870','VILLAHERMOSA ',1),('057','73','873','VILLARRICA ',1),('057','76','001','CALI ',1),('057','76','020','ALCALA ',1),('057','76','036','ANDALUCIA ',1),('057','76','041','ANSERMANUEVO ',1),('057','76','100','BOLIVAR ',1),('057','76','109','BUENAVENTURA ',1),('057','76','111','GUADALAJARA DE BUGA ',1),('057','76','113','BUGALAGRANDE ',1),('057','76','122','CAICEDONIA ',1),('057','76','126','CALIMA ',1),('057','76','147','CARTAGO ',1),('057','76','233','DAGUA ',1),('057','76','243','EL AGUILA ',1),('057','76','246','EL CAIRO ',1),('057','76','248','EL CERRITO ',1),('057','76','250','EL DOVIO ',1),('057','76','275','FLORIDA ',1),('057','76','306','GINEBRA ',1),('057','76','318','GUACARI ',1),('057','76','364','JAMUNDI ',1),('057','76','377','LA CUMBRE ',1),('057','76','400','LA UNION ',1),('057','76','497','OBANDO ',1),('057','76','520','PALMIRA ',1),('057','76','563','PRADERA ',1),('057','76','616','RIOFRIO ',1),('057','76','622','ROLDANILLO ',1),('057','76','670','SAN PEDRO ',1),('057','76','736','SEVILLA ',1),('057','76','823','TORO ',1),('057','76','828','TRUJILLO ',1),('057','76','834','TULUA ',1),('057','76','845','ULLOA ',1),('057','76','863','VERSALLES ',1),('057','76','869','VIJES ',1),('057','76','890','YOTOCO ',1),('057','76','892','YUMBO ',1),('057','76','895','ZARZAL ',1),('057','81','001','ARAUCA ',1),('057','81','065','ARAUQUITA ',1),('057','81','220','CRAVO NORTE ',1),('057','81','300','FORTUL ',1),('057','81','591','PUERTO RONDON ',1),('057','81','736','SARAVENA ',1),('057','81','794','TAME ',1),('057','85','001','YOPAL ',1),('057','85','010','AGUAZUL ',1),('057','85','015','CHAMEZA ',1),('057','85','125','HATO COROZAL ',1),('057','85','136','LA SALINA ',1),('057','85','139','MANI ',1),('057','85','162','MONTERREY ',1),('057','85','225','NUNCHIA ',1),('057','85','230','OROCUE ',1),('057','85','250','PAZ DE ARIPORO ',1),('057','85','263','PORE ',1),('057','85','279','RECETOR ',1),('057','85','300','SABANALARGA ',1),('057','85','315','SACAMA ',1),('057','85','325','SAN LUIS DE PALENQUE ',1),('057','85','400','TAMARA ',1),('057','85','410','TAURAMENA ',1),('057','85','430','TRINIDAD ',1),('057','85','440','VILLANUEVA ',1),('057','86','001','MOCOA ',1),('057','86','320','ORITO ',1),('057','86','568','PUERTO ASIS ',1),('057','86','569','PUERTO CAICEDO ',1),('057','86','571','PUERTO GUZMAN ',1),('057','86','573','LEGUIZAMO ',1),('057','86','749','SIBUNDOY ',1),('057','86','755','SAN FRANCISCO ',1),('057','86','865','VALLE DEL GUAMUEZ ',1),('057','86','885','VILLAGARZON ',1),('057','91','001','LETICIA ',1),('057','91','263','EL ENCANTO ',1),('057','91','405','LA CHORRERA ',1),('057','91','407','LA PEDRERA ',1),('057','91','430','LA VICTORIA ',1),('057','91','460','MIRITI - PARANA ',1),('057','91','530','PUERTO ALEGRIA ',1),('057','91','536','PUERTO ARICA ',1),('057','91','540','PUERTO NARI?æO ',1),('057','91','798','TARAPACA ',1),('057','94','001','INIRIDA ',1),('057','94','343','BARRANCO MINAS ',1),('057','94','663','MAPIRIPANA ',1),('057','94','883','SAN FELIPE ',1),('057','94','884','PUERTO COLOMBIA ',1),('057','94','885','LA GUADALUPE ',1),('057','94','886','CACAHUAL ',1),('057','94','887','PANA PANA ',1),('057','94','888','MORICHAL ',1),('057','95','001','SAN JOSE DEL GUAVIARE ',1),('057','95','025','EL RETORNO ',1),('057','97','001','MITU ',1),('057','97','161','CARURU ',1),('057','97','511','PACOA ',1),('057','97','666','TARAIRA ',1),('057','97','777','PAPUNAUA ',1),('057','97','889','YAVARATE ',1),('057','99','001','PUERTO CARRE?æO ',1),('057','99','524','LA PRIMAVERA ',1),('057','99','624','SANTA ROSALIA ',1),('057','99','773','CUMARIBO ',1),('057','99','774','CHARCO',1),('057','99','778','CHINAUTA',1),('057','99','779','UBATE',1);

/*Table structure for table `app_departamentos` */

DROP TABLE IF EXISTS `app_departamentos`;

CREATE TABLE `app_departamentos` (
  `ID_PAIS` varchar(10) NOT NULL,
  `ID_DPTO` varchar(10) NOT NULL,
  `NOMBRE` varchar(255) NOT NULL,
  `estado` int(11) DEFAULT 1,
  PRIMARY KEY (`ID_PAIS`,`ID_DPTO`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `app_departamentos` */

insert  into `app_departamentos`(`ID_PAIS`,`ID_DPTO`,`NOMBRE`,`estado`) values ('057','05','Antioquia',1),('057','08','Atlantico',1),('057','11','DISTRITO CAPITAL Bogota D. C.',1),('057','13','Bolivar',1),('057','15','Boyaca',1),('057','17','Caldas',1),('057','18','Caqueta',1),('057','19','Cauca',1),('057','20','Cesar',1),('057','23','Cordoba',1),('057','25','Cundinamarca',1),('057','27','Choco',1),('057','41','Huila',1),('057','44','La Guajira',1),('057','47','Magdalena',1),('057','50','Meta',1),('057','52','Nari?æo',1),('057','54','Norte de Santander',1),('057','63','Quindio',1),('057','66','Risaralda',1),('057','68','Santander',1),('057','70','Sucre',1),('057','73','ALPUJARRA Tolima',1),('057','76','Valle del Cauca',1),('057','81','Arauca',1),('057','85','Casanare',1),('057','86','Putumayo',1),('057','88','Departamento Archipielago de San Andres, Providencia y Santa Catalina',1),('057','91','Amazonas',1),('057','94','Guainia',1),('057','95','Guaviare',1),('057','97','Vaupe',1),('057','99','Vichada',1);

/*Table structure for table `app_empresas` */

DROP TABLE IF EXISTS `app_empresas`;

CREATE TABLE `app_empresas` (
  `idEmpresa` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` text DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `telefono` text DEFAULT NULL,
  `ciudad` int(11) DEFAULT NULL,
  `departamento` int(11) DEFAULT NULL,
  `pais` int(11) DEFAULT NULL,
  `tipoDocumento` int(11) DEFAULT NULL,
  `nroDocumento` int(11) DEFAULT NULL,
  `tipoActividad` int(11) DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `icono` text DEFAULT NULL,
  `nombreEncargado` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `ultimoIngreso` datetime DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  `eliminado` int(11) DEFAULT 0,
  PRIMARY KEY (`idEmpresa`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `app_empresas` */

insert  into `app_empresas`(`idEmpresa`,`nombre`,`direccion`,`telefono`,`ciudad`,`departamento`,`pais`,`tipoDocumento`,`nroDocumento`,`tipoActividad`,`logo`,`icono`,`nombreEncargado`,`email`,`ultimoIngreso`,`estado`,`eliminado`) values (1,'Orugal Corp','Cra 81 # 11 09','3114881738',1,11,NULL,NULL,NULL,NULL,'perfil.jpg','perfil.jpg',NULL,'info@orugal.com.co',NULL,1,1),(5,'It Soluciones','Cra 81 # 11 09','23123123213213',1,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'isarmiento@itsoluciones.net',NULL,1,0),(6,'fgdfgdfgf','dfgdfgdfg','45345345',1,11,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'kyodfgdfgf@fsdfdf.vom',NULL,1,0);

/*Table structure for table `app_estadopago` */

DROP TABLE IF EXISTS `app_estadopago`;

CREATE TABLE `app_estadopago` (
  `idPago` bigint(20) NOT NULL AUTO_INCREMENT,
  `idEmpresa` bigint(20) DEFAULT NULL,
  `esDemo` int(11) DEFAULT 1,
  `descripcion` text DEFAULT NULL,
  `fechaInicio` datetime DEFAULT NULL,
  `fechaFin` datetime DEFAULT NULL,
  `cantComprada` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  `eliminado` int(11) DEFAULT 0,
  PRIMARY KEY (`idPago`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `app_estadopago` */

insert  into `app_estadopago`(`idPago`,`idEmpresa`,`esDemo`,`descripcion`,`fechaInicio`,`fechaFin`,`cantComprada`,`estado`,`eliminado`) values (1,1,1,'Demo Inicial de 90 d?¡as para que pruebes la aplicaci??n.','2016-06-29 10:58:04','2016-09-27 10:58:04',360,1,0),(2,2,1,'pago','2016-06-29 11:01:04','2016-09-27 11:01:04',90,1,0),(3,3,1,'Demo Inicial de 90 d?¡as para que pruebes la aplicaci??n.','2016-06-29 11:02:22','2016-09-27 11:02:22',90,1,0),(4,4,1,'Demo Inicial de 90 d?¡as para que pruebes la aplicaci??n.','2016-06-29 12:28:37','2016-09-27 12:28:37',90,1,0),(5,5,1,'Demo Inicial de 90 d?¡as para que pruebes la aplicaci??n.','2016-06-29 13:15:51','2016-09-27 13:15:51',90,1,0),(6,6,1,'Demo Inicial de 90 d?¡as para que pruebes la aplicaci??n.','2016-06-29 13:32:12','2016-09-27 13:32:12',90,1,0);

/*Table structure for table `app_estados` */

DROP TABLE IF EXISTS `app_estados`;

CREATE TABLE `app_estados` (
  `idEstado` int(11) NOT NULL,
  `nombreEstado` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idEstado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `app_estados` */

insert  into `app_estados`(`idEstado`,`nombreEstado`) values (0,'Inactivo'),(1,'Activo');

/*Table structure for table `app_lista_religiones` */

DROP TABLE IF EXISTS `app_lista_religiones`;

CREATE TABLE `app_lista_religiones` (
  `id_religion` bigint(20) NOT NULL AUTO_INCREMENT,
  `des_religiones` text DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_religion`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;

/*Data for the table `app_lista_religiones` */

insert  into `app_lista_religiones`(`id_religion`,`des_religiones`,`estado`) values (1,'Advaita Vedanta',1),(2,'Adventistas',1),(3,'Adventistas cristianos',1),(4,'Adventistas del S?®ptimo D?¡a',1),(5,'Americanas',1),(6,'Andinas',1),(7,'Anglicanos?á',1),(8,'Animismo',1),(9,'?üsatr??',1),(10,'Australianas',1),(11,'Baha?¡smo',1),(12,'Baptista',1),(13,'B?Ân',1),(14,'Brujer?¡a',1),(15,'Budismo',1),(16,'Candombl?®',1),(17,'Catolicos ',1),(18,'Catolicos independientes',1),(19,'Celtismo',1),(20,'Chamanismo?á',1),(21,'Chiismo?á',1),(22,'Chondogyo?á',1),(23,'Conferencia General de Dios',1),(24,'Confucianismo',1),(25,'Conservador',1),(26,'Cristadelfianos',1),(27,'Cristianismo',1),(28,'Cristianos reformados',1),(29,'Cu?íqueros',1),(30,'Davidianos',1),(31,'Dodecate?¡smo',1),(32,'Espiritismo',1),(33,'Etenismo',1),(34,'Evangelismo',1),(35,'Fetichismo',1),(36,'Hinduismo',1),(37,'Iglesia copta',1),(38,'Iglesia Mundial de Dios',1),(39,'Iglesia Unificada de Cristo',1),(40,'Ind?¡genas',1),(41,'Islam',1),(42,'Jainismo',1),(43,'Juda?¡smo',1),(44,'Kemetismo',1),(45,'Kimbanda',1),(46,'Luteranismo',1),(47,'Mah?y?na',1),(48,'Mande?¡smo',1),(49,'Metodismo',1),(50,'Mormonismo',1),(51,'Neodruidismo',1),(52,'Ortodoxo',1),(53,'Pentecostalismo',1),(54,'Protestantismo',1),(55,'Romuva',1),(56,'Samaritanismo',1),(57,'Santer?¡a',1),(58,'Secular',1),(59,'Shiva?¡smo',1),(60,'Sijismo',1),(61,'Stregher?¡a',1),(62,'Sufismo',1),(63,'Sunismo?á',1),(64,'Tao?¡smo',1),(65,'Testigos de Jehov?í',1),(66,'Therav?da',1),(67,'Totemismo',1),(68,'Umbanda',1),(69,'Unitarios',1),(70,'Universalistas',1),(71,'Vaishnavismo',1),(72,'Vashraiana',1),(73,'Vud??',1),(74,'Wicca',1),(75,'Yazidismo',1),(76,'Yoruba?á',1),(77,'Zoroastrismo',1);

/*Table structure for table `app_listado_afp` */

DROP TABLE IF EXISTS `app_listado_afp`;

CREATE TABLE `app_listado_afp` (
  `id_afp` bigint(20) NOT NULL AUTO_INCREMENT,
  `des_afp` text DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  PRIMARY KEY (`id_afp`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `app_listado_afp` */

insert  into `app_listado_afp`(`id_afp`,`des_afp`,`estado`) values (1,'Colpensiones',1),(2,'Porvenir',1),(3,'Proteccion',1),(4,'Colfondos',1),(5,'Fondo de solidaridad pensional',1),(6,'Caja de prevision Social de los trabajadores de la universidad del Cauca',1),(7,'Caja Nacional de prevision Social ',1),(8,'Pensiones de Antioquia',1),(9,'Caja de prevision social de comunicaciones',1),(10,'Fondo de prevision social del Congreso de la Republica ',1),(11,'Asociacion Colombiana de Aviadores',1),(12,'Instituto de seguros Sociales para pensiones ',1),(13,'Instituto de seguros sociales para profesionales ',1),(14,'Skandia alternativo',1),(15,'Skandia administradora de fondos de pensiones y cesantias ',1),(16,'Santander',1),(17,'Bbva',1);

/*Table structure for table `app_listado_eps` */

DROP TABLE IF EXISTS `app_listado_eps`;

CREATE TABLE `app_listado_eps` (
  `id_eps` bigint(20) NOT NULL AUTO_INCREMENT,
  `des_eps` text DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  PRIMARY KEY (`id_eps`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

/*Data for the table `app_listado_eps` */

insert  into `app_listado_eps`(`id_eps`,`des_eps`,`estado`) values (1,'Cafesalud ',1),(2,'Famisanar',1),(3,'Saludcoop',1),(4,'Salud Total',1),(5,'Cruz Blanca',1),(6,'Coomeva',1),(7,'Calisalud',1),(8,'Caprecom',1),(9,'Capresoca',1),(10,'Colmedica',1),(11,'Comfenalco Antioquia',1),(12,'Comfenalco Valle',1),(13,'Convida ARS',1),(14,'Humanavivir',1),(15,'Instituto de los Seguros Sociales',1),(16,'Salud Colmena',1),(17,'Salud Colpatria',1),(19,'Salud Colombia',1),(20,'Saludvida',1),(21,'Sanitas',1),(22,'Selvasalud',1),(23,'Solsalud',1),(24,'S.O.S ',1),(25,'Susalud',1),(26,'Compensar',1),(27,'Nueva Eps',1);

/*Table structure for table `app_listas` */

DROP TABLE IF EXISTS `app_listas`;

CREATE TABLE `app_listas` (
  `idLista` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idLista`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `app_listas` */

/*Table structure for table `app_login` */

DROP TABLE IF EXISTS `app_login`;

CREATE TABLE `app_login` (
  `idLogin` bigint(20) NOT NULL AUTO_INCREMENT,
  `idGeneral` bigint(20) DEFAULT NULL,
  `tipoLogin` int(11) DEFAULT NULL,
  `usuario` text DEFAULT NULL,
  `clave` text DEFAULT NULL,
  `clave64` text DEFAULT NULL,
  `cambioClave` int(11) DEFAULT 1,
  `primeraVez` int(11) DEFAULT 1,
  `verificado` int(11) DEFAULT 0,
  `estado` int(11) DEFAULT 1,
  PRIMARY KEY (`idLogin`)
) ENGINE=InnoDB AUTO_INCREMENT=539 DEFAULT CHARSET=latin1;

/*Data for the table `app_login` */

insert  into `app_login`(`idLogin`,`idGeneral`,`tipoLogin`,`usuario`,`clave`,`clave64`,`cambioClave`,`primeraVez`,`verificado`,`estado`) values (7,1,2,'admin@wannabe.dev','8cb2237d0679ca88db6464eac60da96345513964','MTIzNDU=',0,1,0,1);

/*Table structure for table `app_mails` */

DROP TABLE IF EXISTS `app_mails`;

CREATE TABLE `app_mails` (
  `idMail` bigint(20) NOT NULL AUTO_INCREMENT,
  `para` text DEFAULT NULL,
  `asunto` text DEFAULT NULL,
  `mensaje` text DEFAULT NULL,
  `estado` varchar(30) DEFAULT NULL,
  `fechaEnvio` datetime DEFAULT NULL,
  `ip` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idMail`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `app_mails` */

insert  into `app_mails`(`idMail`,`para`,`asunto`,`mensaje`,`estado`,`fechaEnvio`,`ip`) values (4,'admin@wannabe.dev','Cambio de contraseña - SAMI ','Se ha realizado el cambio de contraseña para acceder al aplicativo de SAMI <br><br>Su nueva contraseña es: <h2>12345</h2>','0','2023-05-11 12:42:11','::1');

/*Table structure for table `app_modulos` */

DROP TABLE IF EXISTS `app_modulos`;

CREATE TABLE `app_modulos` (
  `idModulo` bigint(20) NOT NULL AUTO_INCREMENT,
  `idPadre` bigint(20) DEFAULT NULL,
  `nombreModulo` text DEFAULT NULL,
  `icono` text DEFAULT NULL,
  `urlModulo` text DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  `orden` int(11) DEFAULT 0,
  `eliminado` int(11) DEFAULT 0,
  PRIMARY KEY (`idModulo`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

/*Data for the table `app_modulos` */

insert  into `app_modulos`(`idModulo`,`idPadre`,`nombreModulo`,`icono`,`urlModulo`,`estado`,`orden`,`eliminado`) values (1,0,'Configuración','fas fa-fw fa-cog',NULL,1,0,0),(3,1,'Admin módulos','fa fa-file','Admin/adminModulos/',1,1,0),(4,1,'Listados generales','fa fa-list-alt','adminListas/listadosGlobales/',0,4,0),(5,1,'Usuarios','fas fa-user','Usuarios/adminUsuarios/',1,3,0),(35,1,'Parametrización','fas fa-list-alt','Parametrizacion/parametrizacion/',1,2,0);

/*Table structure for table `app_paises` */

DROP TABLE IF EXISTS `app_paises`;

CREATE TABLE `app_paises` (
  `ID_PAIS` varchar(10) NOT NULL,
  `NOMBRE` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_PAIS`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `app_paises` */

insert  into `app_paises`(`ID_PAIS`,`NOMBRE`) values ('057','COLOMBIA'),('058','VENEZUELA');

/*Table structure for table `app_perfiles` */

DROP TABLE IF EXISTS `app_perfiles`;

CREATE TABLE `app_perfiles` (
  `idPerfil` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombrePerfil` text DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  `eliminado` int(11) DEFAULT 0,
  PRIMARY KEY (`idPerfil`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `app_perfiles` */

insert  into `app_perfiles`(`idPerfil`,`nombrePerfil`,`estado`,`eliminado`) values (1,'Súper Administrador',1,0),(2,'Administrador',1,0);

/*Table structure for table `app_personas` */

DROP TABLE IF EXISTS `app_personas`;

CREATE TABLE `app_personas` (
  `idPersona` bigint(20) NOT NULL AUTO_INCREMENT,
  `idPerfil` int(11) DEFAULT NULL,
  `nombre` text DEFAULT NULL,
  `apellido` text DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `telefono` text DEFAULT NULL,
  `celular` text DEFAULT NULL,
  `ciudad` int(11) DEFAULT NULL,
  `departamento` int(11) DEFAULT NULL,
  `pais` int(11) DEFAULT NULL,
  `tipoDocumento` int(11) DEFAULT NULL,
  `nroDocumento` bigint(20) DEFAULT NULL,
  `tarjetaProfesional` text DEFAULT NULL,
  `idCargo` bigint(20) DEFAULT NULL,
  `salario` text DEFAULT NULL,
  `cuenta` text DEFAULT NULL,
  `idArea` bigint(20) DEFAULT NULL,
  `idSexo` int(11) DEFAULT NULL,
  `idProfesion` text DEFAULT NULL,
  `tipoUsuario` int(11) DEFAULT 2,
  `ciudadExpedicionCedula` varchar(10) DEFAULT NULL,
  `fechaNacimiento` datetime DEFAULT NULL,
  `contrato` text DEFAULT NULL,
  `fechaIngreso` date DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `barrio` tinytext DEFAULT NULL,
  `titulo` tinytext DEFAULT NULL,
  `institucion` tinytext DEFAULT NULL,
  `fechaRetiro` date DEFAULT NULL,
  `id_eps` bigint(20) DEFAULT NULL,
  `id_afp` bigint(20) DEFAULT NULL,
  `id_app_cesantias` bigint(20) DEFAULT NULL,
  `icono` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `ultimoIngreso` datetime DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  `eliminado` int(11) DEFAULT 0,
  PRIMARY KEY (`idPersona`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `app_personas` */

insert  into `app_personas`(`idPersona`,`idPerfil`,`nombre`,`apellido`,`direccion`,`telefono`,`celular`,`ciudad`,`departamento`,`pais`,`tipoDocumento`,`nroDocumento`,`tarjetaProfesional`,`idCargo`,`salario`,`cuenta`,`idArea`,`idSexo`,`idProfesion`,`tipoUsuario`,`ciudadExpedicionCedula`,`fechaNacimiento`,`contrato`,`fechaIngreso`,`logo`,`barrio`,`titulo`,`institucion`,`fechaRetiro`,`id_eps`,`id_afp`,`id_app_cesantias`,`icono`,`email`,`ultimoIngreso`,`estado`,`eliminado`) values (1,1,'Farez','Prieto','Cra 16 # 5 29','7203015','3114881738',1,11,NULL,4,1030534849,'55555',1,'$3.000.000','BTA4568',1,1,'T?®cnico profesional en desarrollo de sotware',1,'11-001','1987-03-02 00:00:00','INDEFINIDO','2016-11-24','icono.png','Bogotá',NULL,'Cedinpro',NULL,26,4,2,'86105ebb83a01204464e50071697cd88.jpg','admin@wannabe.dev',NULL,1,0);

/*Table structure for table `app_pertenencia_etnica` */

DROP TABLE IF EXISTS `app_pertenencia_etnica`;

CREATE TABLE `app_pertenencia_etnica` (
  `id_grupo_etnico` bigint(20) NOT NULL AUTO_INCREMENT,
  `grupo_etnia` text DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  PRIMARY KEY (`id_grupo_etnico`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `app_pertenencia_etnica` */

insert  into `app_pertenencia_etnica`(`id_grupo_etnico`,`grupo_etnia`,`estado`) values (1,'Ind?¡gena',1),(2,'ROM (gitano)',1),(3,'Raizal (archipi?®lago de San Andr?®s y Providencia)',1),(4,'Palanquero de San Basilio',1),(5,'Negro(a), Mulato(a), Afrocolombiano(a) o Afro descendiente',1),(6,'Ninguno de los anteriores',1);

/*Table structure for table `app_profesiones` */

DROP TABLE IF EXISTS `app_profesiones`;

CREATE TABLE `app_profesiones` (
  `idProfesion` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombreProfesion` text DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  PRIMARY KEY (`idProfesion`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `app_profesiones` */

insert  into `app_profesiones`(`idProfesion`,`nombreProfesion`,`estado`) values (1,'Ing de Sistemas',1);

/*Table structure for table `app_registroslogin` */

DROP TABLE IF EXISTS `app_registroslogin`;

CREATE TABLE `app_registroslogin` (
  `idRegistro` bigint(20) NOT NULL AUTO_INCREMENT,
  `idLogin` bigint(20) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `ip` text DEFAULT NULL,
  `disp` text DEFAULT NULL,
  `eliminado` int(11) DEFAULT 0,
  PRIMARY KEY (`idRegistro`)
) ENGINE=InnoDB AUTO_INCREMENT=275 DEFAULT CHARSET=latin1;

/*Data for the table `app_registroslogin` */

insert  into `app_registroslogin`(`idRegistro`,`idLogin`,`fecha`,`ip`,`disp`,`eliminado`) values (240,7,'2017-02-14 11:06:51','192.168.0.33','Mozilla/5.0 (Windows NT 10.0; WOW64; rv:53.0) Gecko/20100101 Firefox/53.0',0),(241,7,'2017-02-14 14:04:00','192.168.0.33','Mozilla/5.0 (Windows NT 10.0; WOW64; rv:53.0) Gecko/20100101 Firefox/53.0',0),(242,7,'2017-02-14 14:04:27','192.168.0.33','Mozilla/5.0 (Windows NT 10.0; WOW64; rv:53.0) Gecko/20100101 Firefox/53.0',0),(243,7,'2017-02-14 16:47:52','192.168.0.33','Mozilla/5.0 (Windows NT 10.0; WOW64; rv:53.0) Gecko/20100101 Firefox/53.0',0),(244,7,'2018-09-26 10:43:56','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36',0),(245,7,'2019-05-18 09:00:28','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.96 Safari/537.36',0),(246,7,'2019-05-18 09:44:24','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.96 Safari/537.36',0),(247,7,'2019-05-18 10:42:00','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.96 Safari/537.36',0),(248,7,'2019-05-18 10:51:28','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.96 Safari/537.36',0),(249,7,'2019-05-18 11:54:26','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.96 Safari/537.36',0),(250,7,'2019-05-18 10:55:17','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.96 Safari/537.36',0),(251,7,'2019-05-18 11:59:35','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.96 Safari/537.36',0),(252,7,'2019-05-18 12:07:13','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.96 Safari/537.36',0),(253,7,'2019-05-18 12:10:44','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.96 Safari/537.36',0),(254,7,'2019-05-18 12:16:40','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.96 Safari/537.36',0),(255,7,'2019-05-18 13:30:15','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.96 Safari/537.36',0),(256,7,'2019-05-18 13:49:59','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.96 Safari/537.36',0),(257,7,'2023-05-09 16:48:37','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 OPR/98.0.0.0',0),(258,7,'2023-05-09 18:57:32','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 OPR/98.0.0.0',0),(259,7,'2023-05-09 19:04:04','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 OPR/98.0.0.0',0),(260,7,'2023-05-09 20:00:17','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 OPR/98.0.0.0',0),(261,7,'2023-05-09 20:05:16','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 OPR/98.0.0.0',0),(262,7,'2023-05-09 20:53:30','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 OPR/98.0.0.0',0),(263,7,'2023-05-09 21:06:23','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 OPR/98.0.0.0',0),(264,7,'2023-05-09 21:42:27','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 OPR/98.0.0.0',0),(265,7,'2023-05-09 21:47:02','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 OPR/98.0.0.0',0),(266,7,'2023-05-09 22:57:21','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 OPR/98.0.0.0',0),(267,7,'2023-05-10 13:51:32','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 OPR/98.0.0.0',0),(268,7,'2023-05-10 18:24:53','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 OPR/98.0.0.0',0),(269,7,'2023-05-10 19:59:35','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 OPR/98.0.0.0',0),(270,7,'2023-05-10 23:01:27','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 OPR/98.0.0.0',0),(271,7,'2023-05-10 23:02:38','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 OPR/98.0.0.0',0),(272,7,'2023-05-10 23:09:15','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 OPR/98.0.0.0',0),(273,7,'2023-05-11 11:53:36','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 OPR/98.0.0.0',0),(274,7,'2023-05-11 12:42:26','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 OPR/98.0.0.0',0);

/*Table structure for table `app_rel_perfil_modulo` */

DROP TABLE IF EXISTS `app_rel_perfil_modulo`;

CREATE TABLE `app_rel_perfil_modulo` (
  `idRelacion` bigint(20) NOT NULL AUTO_INCREMENT,
  `idPerfil` bigint(20) DEFAULT NULL,
  `idModulo` bigint(20) DEFAULT NULL,
  `ver` int(11) DEFAULT 0,
  `crear` int(11) DEFAULT 0,
  `editar` int(11) DEFAULT 0,
  `borrar` int(11) DEFAULT 0,
  PRIMARY KEY (`idRelacion`)
) ENGINE=InnoDB AUTO_INCREMENT=451 DEFAULT CHARSET=latin1;

/*Data for the table `app_rel_perfil_modulo` */

insert  into `app_rel_perfil_modulo`(`idRelacion`,`idPerfil`,`idModulo`,`ver`,`crear`,`editar`,`borrar`) values (119,1,7,0,0,0,0),(120,2,7,0,0,0,0),(194,1,6,1,1,1,1),(195,2,6,1,1,1,0),(197,1,33,1,1,1,1),(198,2,33,1,1,1,0),(248,1,37,1,1,1,1),(249,2,37,1,1,1,1),(263,1,41,1,1,1,1),(265,2,41,1,1,1,0),(267,1,39,1,1,1,1),(268,2,39,1,1,1,1),(287,1,34,1,1,1,1),(290,2,34,1,1,1,1),(349,1,42,1,1,1,1),(353,2,42,1,1,1,1),(356,1,44,1,1,1,1),(358,2,44,1,1,1,0),(377,1,43,1,1,1,1),(378,2,43,0,0,0,0),(381,1,37,1,1,1,1),(382,2,37,0,0,0,0),(437,2,3,1,1,1,1),(438,1,3,1,1,1,1),(439,1,35,1,1,1,1),(440,2,35,1,1,1,0),(443,1,4,1,1,1,1),(444,2,4,1,1,1,0),(445,2,38,1,1,1,0),(446,1,38,1,1,1,1),(449,1,5,1,1,1,1),(450,2,5,1,1,1,1);

/*Table structure for table `app_rel_personas_empresa` */

DROP TABLE IF EXISTS `app_rel_personas_empresa`;

CREATE TABLE `app_rel_personas_empresa` (
  `idRelPerEmp` bigint(20) NOT NULL AUTO_INCREMENT,
  `idEmpresa` bigint(20) DEFAULT NULL,
  `idPersona` bigint(20) DEFAULT NULL,
  `fechaRelacion` datetime DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  `eliminado` int(11) DEFAULT 0,
  PRIMARY KEY (`idRelPerEmp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `app_rel_personas_empresa` */

/*Table structure for table `app_sexo` */

DROP TABLE IF EXISTS `app_sexo`;

CREATE TABLE `app_sexo` (
  `idSexo` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombreSexo` text DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  PRIMARY KEY (`idSexo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `app_sexo` */

insert  into `app_sexo`(`idSexo`,`nombreSexo`,`estado`) values (1,'Masculino',1),(2,'Femenino',1),(3,'No binario',1);

/*Table structure for table `app_tipos_doc` */

DROP TABLE IF EXISTS `app_tipos_doc`;

CREATE TABLE `app_tipos_doc` (
  `idTipoDoc` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombreTipoDoc` text DEFAULT NULL,
  `sigla` varchar(5) DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  PRIMARY KEY (`idTipoDoc`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `app_tipos_doc` */

insert  into `app_tipos_doc`(`idTipoDoc`,`nombreTipoDoc`,`sigla`,`estado`) values (1,'Registro Civil','RC',1),(2,'Tarjeta De Identidad','TI',1),(3,'Pasaporte','PA',1),(4,'Cédula De Ciudadanía','CC',1),(5,'Cédula De Extranjería','CE',1),(6,'Menor Sin Identificación','MS',1),(7,'Adulto Sin Identificación','AS',1),(8,'Certificado Nacido Vivo','NV',1);

/*Table structure for table `app_variablesglobales` */

DROP TABLE IF EXISTS `app_variablesglobales`;

CREATE TABLE `app_variablesglobales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `variable` text NOT NULL,
  `valor` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `app_variablesglobales` */

insert  into `app_variablesglobales`(`id`,`variable`,`valor`) values (1,'Test','10');

/*Table structure for table `aud_areas` */

DROP TABLE IF EXISTS `aud_areas`;

CREATE TABLE `aud_areas` (
  `idAuditoria` bigint(20) NOT NULL AUTO_INCREMENT,
  `idArea` bigint(20) DEFAULT NULL,
  `textAuditoria` text DEFAULT NULL,
  `idUsuario` bigint(20) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `ip` text DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  PRIMARY KEY (`idAuditoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `aud_areas` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
