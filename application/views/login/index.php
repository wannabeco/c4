<!--                                                    
     ("`-''-/").___....''"`-._
      `6_ 6  )   `-.  (     ).`-.__.`) 
      (_Y_.)'  ._   )  `._ `. ``-..-'
    _..`..'_..-_/  /..'_.' ,'
   (il),-''  (li),'  ((!.-'

   Desarrollado por  @orugal https://github.com/orugal/
   S.A.M.I. (Sistema Administrativo de Multiple Integración)
-->
<!DOCTYPE html>
<html lang="es"  ng-app="projectRegistro">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de administración de multiple integración">
    <meta name="author" content="Wannabe Digital">
    <title>SAMI - <?php echo $titulo ?></title>
    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url()?>res/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="<?php echo base_url()?>res/css/sb-admin-2.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url()?>res/css/sweetalert.css" />
		<link rel="stylesheet" href="<?php echo base_url()?>res/css/login/login.css" />
</head>
<body class="bg-gradient-primary" ng-controller="login" ng-init="loginInit()">	
	<?php $this->load->view($centro);?>
    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url()?>res/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url()?>res/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url()?>res/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url()?>res/js/sb-admin-2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>res/js/sweetalert.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>res/js/angular.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>res/js/app.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>res/js/factory.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>res/js/login/controller.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>res/js/creaEmpresa/controller.js"></script>
	<script type="text/javascript">
	        var configLogin =  {
	            apiUrl: '<?php echo base_url()?>'
	        }
	         //$.material.init();
	</script>
	<script type="text/javascript" src="https://www.wannabe.com.co/js/kon.min.js"></script>
</body>
</html>