
<div class="container-fluid" ng-controller="usuariosApp" ng-init="initUsuarios()" id="contenedorUsuarios">
    <!-- modal estandar-->
    <div id="modalUsuarios" class="modal fade" role="dialog"  data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content" id="modalCrea">
                <!--Form de creación -->
            </div>
        </div>
    </div>
    <!-- cabecera de la plantilla-->
    <h1 class="h3 mb-4 text-gray-800">
        <?php echo $infoModulo['nombreModulo'] ?>
    </h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb"  style="background-color:transparent !important">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> Home</a>
            </li>
            <li class="breadcrumb-item">
                <?php if( isset($urlModulo) && ! empty($urlModulo) ){ ?>
                    <a href="<?php echo base_url($urlModulo.$infoModulo['idModulo']) ?>"> <?php echo $infoModulo['nombreModulo'] ?></a>
                <?php } else { ?>
                    <a href="<?php echo base_url() ?>CrearMatriz/crearParametrosMatriz/<?php echo $infoModulo['idModulo']?>"> Parametrización de matrices </a>
                <?php } ?>
            </li>
            <li class="breadcrumb-item active">
                 <?php echo " ".$titulo ?>
            </li>

        </ol>
    </nav>
    <!-- fin cabecera-->


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Listado de <?php echo " ".$titulo ?></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <?php echo $output->output; ?>
            </div>
        </div>
    </div>

</div>
