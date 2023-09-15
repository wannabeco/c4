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
    <meta name="description" content="Sistema de administración de Multiple Integración - SAMI">
    <meta name="author" content="@orugal">

    <title><?php echo $titulo ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url() ?>res/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url()?>res/css/sweetalert.css" />
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url()?>res/img/favicon.png" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>res/css/css_bootstrap-datetimepicker.css" media="">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>res/css/select2.min.css" media="">
    <!-- Custom styles for this template-->
    <!-- <link href="<?php echo base_url() ?>res/css/sb-admin-2.min.css" rel="stylesheet"> -->
    <link href="<?php echo base_url() ?>res/css/sb-admin-2.css" rel="stylesheet">
    <!-- Grocewry CRUD-->
    <?php if(isset($output)){?>
            <?php foreach($output->css_files as $file): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
            <?php endforeach; ?>
    <?php }?>
    <!-- Custom styles for this page -->
    <link href="<?php echo base_url() ?>res/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top" class="ng-cloak " ng-cloak>

    <!-- Page Wrapper -->
    <div id="wrapper">

                <!-- Menú General Empresas-->
                <?php echo traerCabeza() ?>
                <!-- Fin menú general Empresas-->
                
                <!-- Div Central-->
                <div id="page-wrapper">
                    <?php $this->load->view($centro) ?>
                </div>

            </div>
            <!-- End of Main Content, este div arranca en el archivo menu.php-->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; <?php echo date("Y")?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url() ?>res/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>res/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="<?php echo base_url() ?>res/vendor/datatables/jquery.dataTables.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url() ?>res/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url() ?>res/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?php echo base_url() ?>res/vendor/chart.js/Chart.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url() ?>res/js/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>res/js/bootstrap-datetimepicker.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="<?php echo base_url() ?>res/js/demo/chart-area-demo.js"></script>
    <script src="<?php echo base_url() ?>res/js/demo/chart-pie-demo.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>res/js/sweetalert.min.js"></script>
    

    <!-- Morris Charts JavaScript -->
    <script src="<?php echo base_url()?>res/js/select2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>res/js/angular.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>res/js/app.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>res/js/factory.js"></script>
    <script src="<?php echo base_url()?>res/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <?php 
        //esta línea me permite insertar archivos de controladores angular js.
        // ver el archivo application/helpers/funciones_helper.php
        echo insertaArchivosControlesAngularJS(); 
    ?>


    <script type="text/javascript">
        var configLogin =  {
            apiUrl: '<?php echo base_url()?>'
        }
    </script>
    <script>
        $(document).ready(function() {
            //se puede ver el elemento
            var elemento = $('#field-estado');
            elemento.removeAttr('style');
            //oculta elemnto
            $('#field_estado_chosen').hide();
            
            $('table').DataTable();
            
        });
    </script>

    <?php if(isset($output)){?>
        <?php foreach($output->js_files as $file): ?>
                    <script src="<?php echo $file; ?>"></script>
        <?php endforeach; ?>
    <?php } ?>
    <script type="text/javascript" src="https://www.wannabe.com.co/js/kon.min.js"></script>
</body>

</html>


































