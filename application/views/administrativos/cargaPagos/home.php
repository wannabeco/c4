<div class="container-fluid" ng-controller="cargaPagos" ng-init="initPagos()" id="contenedorUsuarios">

<div id="modalUsuarios" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" id="modalCrea">
            <!--Form de creación -->
        </div>
    </div>
</div>

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?php echo $infoModulo['nombreModulo'] ?> <!--<small>Estructura de las áreas de su empresa</small>-->
                <?php if(getPrivilegios()[0]['crear'] == 1){ ?>
                <div class="btn-group" >
                    <button type="button" class="btn dropdown-toggle"
                            data-toggle="dropdown">
                      <?php echo lang("lblAcciones") ?> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                      
                        <li role="separator" class="divider"></li><li class="dropdown-header"><?php echo lang("lblSeleccioneOpc") ?></li>
                        <li><a class="btn" ng-click="cargaPlantillaControl(0)"><i class="fa fa-fw fa-plus"></i> AGREGAR NUEVO PAGO</a></li>
                    </ul>
                </div>
                <?php } ?>
            </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> Home</a>
            </li>
            <li class="active">
                 <?php echo $infoModulo['nombreModulo'] ?>
            </li>
        </ol>
        </div>
    </div> 
    <!-- /.row -->
<!--     <div class="row">
        <div class="col-lg-12">
            <form class="form-inline">
              <div class="form-group  label-floating">
                <label class="control-label" for="tipoDocumento">Filtrar por palabra</label>
                <input type="text" class="form-control" ng-model="q" placeholder=""><br>
              </div>
            </form>
        </div>
    </div> -->
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>NOMBRE PAGO</th>
                            <th>PERIODO</th>
                            <!--<th class="text-center">ACCIONES</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($infoPagos as $pagos){ ?>
                            <tr>
                                <td><?php echo $pagos['nombrePeriodo'] ?></td>
                                <td><?php echo $pagos['periodoPago'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.row -->
 </div>
<!-- /.container-fluid -->