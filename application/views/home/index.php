<!--                                                    
     ("`-''-/").___....''"`-._
      `6_ 6  )   `-.  (     ).`-.__.`) 
      (_Y_.)'  ._   )  `._ `. ``-..-'
    _..`..'_..-_/  /..'_.' ,'
   (il),-''  (li),'  ((!.-'

   Desarrollado por  @orugal
-->
<!DOCTYPE html>
<html ng-app="home">
	<head>
		<title><?php echo $titulo ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
		<link href='//fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
		<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
		<link href='//fonts.googleapis.com/css?family=Ubuntu:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>res/css/bootstrap.min.css"  media=""/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>res/css/angular-cps.css"  media=""/>
		<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>res/css/bootstrap-theme.min.css"  media=""/>-->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>res/css/tucomunidadInt.css"  media=""/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>res/css/css_bootstrap-datetimepicker.css" media="">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>res/css/bootstrap-toggle.min.css" rel="stylesheet" media="">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>res/css/fileinput.min.css" rel="stylesheet" media="">
		<link rel="stylesheet" href='<?php echo base_url()?>res/css/fullcalendar.css' rel='stylesheet' />
		<link rel="stylesheet" href='<?php echo base_url()?>res/css/fullcalendar.print.css' rel='stylesheet' media='print' />
		<link rel="stylesheet" href='<?php echo base_url()?>res/css/custom.css' rel='stylesheet' />
		<link rel="stylesheet" href="<?php echo base_url()?>res/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo base_url()?>res/css/sweetalert.css">
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url()?>res/images/favico.ico">
		
	</head>
	<body>
		
		<script type="text/javascript" src="<?php echo base_url()?>res/js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>res/js/jquery-ui-1.10.3.custom.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>res/js/bootbox.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>res/js/sweetalert.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>res/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>res/js/angular.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>res/js/home/app.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>res/js/home/controller.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>res/js/factory.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>res/js/home/propiedadesController.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>res/js/home/vigilantesController.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>res/js/home/facturacion.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>res/js/home/administracion.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>res/js/listadosGlobales/controller.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>res/js/viviendas/controller.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>res/js/moment.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>res/js/bootstrap-datetimepicker.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>res/js/bootstrap-toggle.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>res/js/fileinput.js"></script> 
		<script type="text/javascript" src="<?php echo base_url()?>res/js/morris/raphael-2.1.0.min.js"></script>
    	<script type="text/javascript" src="<?php echo base_url()?>res/js/morris/morris.js"></script>
    	<script type="text/javascript" src="<?php echo base_url()?>res/js/bootstrap-tour.js"></script>

		<script src='<?php echo base_url()?>res/js/moment.min.js'></script>
		<!--<script src='<?php echo base_url()?>res/js/jquery.min.js'></script>-->
		<script src='<?php echo base_url()?>res/js/fullcalendar.min.js'></script>
		<script src='<?php echo base_url()?>res/js/lang-all.js'></script>
		<script type="text/javascript">
			var configLogin =  {
			    appName: '<?php echo $titulo ?>',
			    appVersion: 1.0,
			    apiUrl: '<?php echo base_url()?>'
			}
		</script>
		<?php $this->load->view($cabeza);?>
		<?php $this->load->view($centro);?>
		<?php $this->load->view($pie);?>	
	</body>
</html>