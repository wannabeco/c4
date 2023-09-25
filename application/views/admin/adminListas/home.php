<div class="container-fluid" ng-controller="listas" ng-init="initListas()" id="contenedorUsuarios">

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
                        <li><a class="btn" ng-click="cargaPlantillaControl(0)"><i class="fa fa-fw fa-plus"></i> AGREGAR NUEVA LISTA</a></li>
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
    <div class="row">
        <div class="col-lg-12">
            <form class="form-inline">
              <div class="form-group  label-floating">
                <label class="control-label" for="tipoDocumento">Filtrar por palabra</label>
                <input type="text" class="form-control" ng-model="q" placeholder=""><br>
              </div>
            </form>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>NOMBRE LISTA</th>
                            <th>NOMBRE TABLA</th>
                            <!--<th class="text-center">ACCIONES</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="listas in listas  | filter:q as results">
                            <td>{{listas.nombreLista}}</td>
                            <td>{{listas.nombreTableLista}}</td>
                            <!--<td  class="text-center">

                                <?php if(getPrivilegios()[0]['editar'] == 1){ ?>
                                    <a ng-click="cargaPlantillaControl(1)" title="Editar usuario" class="btn btn-primary btn-fab btn-fab-mini"><i class="material-icons">edit</i></a>
                                <?php }?>
                                <?php if(getPrivilegios()[0]['borrar'] == 1){ ?>
                                    <a ng-click="borraUsuario(listas.idPersona)" title="Eliminar"  class="btn btn-danger btn-fab btn-fab-mini"><i class="material-icons">delete</i></a>
                                <?php } ?>
                            </td>-->
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.row -->
 </div>
<!-- /.container-fluid -->