<div class="container-fluid" ng-controller="areas" ng-init="areasInit()">

    <div id="modalArea" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <div class="modal-content">
          <form role="form" ng-submit="agregarNuevaArea()" id="formAreas">    
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h2 class="modal-title"><?php echo lang('tituloCreaArea') ?></h2>
          </div>
          <div class="modal-body">              
              <div class="form-group" id="cajaNombreEmpresa">
                  <input tabindex="1" id="nombreArea" name="nombreArea" ng-model="nombreArea" class="ember-view ember-text-field form-control login-input" placeholder="<?php echo lang("plh_CreaArea") ?>"  type="text">
                  <p class="help-block"><?php echo lang('txtInfoArea1') ?></p>
               </div>
          </div>
          <div class="modal-footer">
           <button type="button"  data-dismiss="modal" class="btn  btn-default"><?php echo lang('reg_btn_cancelar') ?></button>
            <button type="submit" class="btn btn-raised btn-primary"><?php echo lang('reg_btn_crea') ?></button>
          </div>
          </form>
        </div>

      </div>
    </div>

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?php echo lang("tituloArea") ?><!--<small><?php echo $_SESSION['project']['info']['nombre'] ?></small>-->
                <div class="btn-group" >
                    <button type="button" class="btn dropdown-toggle"
                            data-toggle="dropdown">
                      <?php echo lang("lblAcciones") ?> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                      
                        <li role="separator" class="divider"></li><li class="dropdown-header"><?php echo lang("lblSeleccioneOpc") ?></li>
                        <li><a class="btn" data-toggle="modal" data-target="#modalArea"><i class="fa fa-fw fa-sitemap"></i> <?php echo lang("lblagregarNueva") ?></a></li>
                    </ul>
                </div>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> <?php echo $_SESSION['project']['info']['nombre'] ?></a>
                </li>
                <li class="active">
                     <?php echo lang("tituloArea") ?>
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-primary alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-info-circle"></i>  <?php echo lang("txtInfoArea2") ?>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <form class="form-inline">
              <div class="form-group">
                <label for="exampleInputName2"><?php echo lang("LblFiltrar") ?>: </label>
                <input type="text" class="form-control" ng-model="q" placeholder="">
              </div>
            </form>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <h2><?php echo lang("txtInfoArea4") ?></h2>

            <div class="row" ng-if="listaAreas.length == 1">
                <div class="col-lg-12">
                    <div class="alert alert-info">
                        <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                        <?php echo lang("txtInfoArea3") ?>
                    </div>
                </div>
            </div>

            <div class="table-responsive" ng-if="listaAreas.length > 0 ">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th><?php echo lang("txtInfoArea6") ?></th>
                            <th class="text-center"><?php echo lang("txtInfoArea7") ?></th>
                            <!--<th class="text-center">% Cumplimiento</th>-->
                            <!--<th class="text-center"><?php echo lang("txtInfoArea8") ?></th>-->
                            <th class="text-center"><?php echo lang("lblAcciones") ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="areas in listaAreas | filter:q as results">
                            <td>{{areas.nombreArea}}</td>
                            <td class="text-center">10</td>
                            <!--<td class="text-center">32.3%</td>-->
                            <!--<td class="text-center">321</td>-->
                            <td  class="text-center">
                                <!--<a href="javascript:void(0)" class="btn btn-primary btn-fab btn-fab-mini"><i class="material-icons">info</i></a>-->
                                <a ng-click="eliminaArea(results,$index)" class="btn btn-danger btn-fab btn-fab-mini" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?php echo lang("lblEliminar") ?>"><i class="material-icons">delete</i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <li class="animate-repeat" ng-if="results.length == 0">
                  <strong><?php echo lang("txtInfoArea5") ?></strong>
                </li>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->