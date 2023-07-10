<div class="container-fluid" ng-controller="personas" ng-init="personasInit()">

<div id="modalPersona" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <div class="modal-content">
          <form role="form" ng-submit="agregaPersona()" id="formAgregaPersona">    
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h2 class="modal-title"><?php echo lang('txtPersona2') ?></h2>
            <p class="text-justify"><?php echo lang('txtPersona3') ?></p>
          </div>
          <div class="modal-body">  
            <div class="alert alert-primary alert-dismissable">
                <i class="fa fa-info-circle"></i> <?php echo lang("txtPersona4") ?>
            </div>            
              <div class="form-group" id="cajaNombreEmpresa">
                  <input tabindex="1" autocomplete="off" id="palabra" name="palabra" ng-model="palabra" class="ember-view ember-text-field form-control login-input" placeholder="<?php echo lang("txtPersona5") ?>"  type="text">
                  <input type="hidden" name="idPersona" id="idPersona" ng-model="idPersona" />
                  <p class="help-block"><?php echo lang('txtPersona6') ?></p>
               </div>
          </div>
          <div class="modal-footer">
           <button type="button"  data-dismiss="modal" class="btn  btn-default"><?php echo lang('reg_btn_cancelar') ?></button>
            <button type="submit" class="btn btn-raised btn-primary"><?php echo lang('lblEnviaInvitacion') ?></button>
          </div>
          </form>
        </div>

      </div>
    </div>
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?php echo lang("tituloPersonas") ?> <!--<small>Estructura de las áreas de su empresa</small>-->
                <div class="btn-group" >
                    <button type="button" class="btn dropdown-toggle"
                            data-toggle="dropdown">
                      <?php echo lang("lblAcciones") ?> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                      
                        <li role="separator" class="divider"></li><li class="dropdown-header"><?php echo lang("lblSeleccioneOpc") ?></li>
                        <li><a class="btn" data-toggle="modal" data-target="#modalPersona"><i class="fa fa-fw fa-user"></i> <?php echo lang("lblagregarNueva") ?></a></li>
                    </ul>
                </div>
            </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> <?php echo $_SESSION['project']['info']['nombre'] ?></a>
            </li>
            <li class="active">
                 <?php echo lang("tituloPersonas") ?>
            </li>
        </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-primary alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-info-circle"></i> <?php echo lang("txtPersona1") ?>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
                <form class="form-inline">
                  <div class="form-group">
                    <label for="exampleInputName2">Filtro por palabra: </label>
                    <input type="text" class="form-control" id="exampleInputName2" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail2">Filtro por área: </label>
                    <select class="form-control" >
                        <option>Seleccione el área</option>
                        <option>Soporte</option>
                        <option>Desarrollo</option>
                        <option>Contabilidad</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary">Buscar</button>
                </form>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <h2>Personas Actuales</h2>
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Nombre</th>
                            <th class="text-center">% Cumplimiento</th>
                            <th class="text-center">Tareas Asignadas</th>
                            <th class="text-center">Área</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><i class="material-icons" title="Jefe del Área">face</i></td>
                            <td>Farez Prieto</td>
                            <td class="text-center">32.3%</td>
                            <td class="text-center">5</td>
                            <td class="text-center">Desarrollo</td>
                            <td  class="text-center">
                                <a href="<?php echo base_url()?>empresas/proyectos" class="btn btn-info btn-fab btn-fab-mini" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Esperando a que el usuario acepte la solicitud"><i class="material-icons">schedule</i></a>
                            </td>
                        </tr>
                        <tr>
                            <th><i class="material-icons" title="Programador">code</i></th>
                            <td>Jhon Puerto</td>
                            <td class="text-center">33.3%</td>
                            <td class="text-center">5</td>
                            <td class="text-center">Desarrollo</td>
                            <td  class="text-center">
                                <a href="javascript:void(0)" title="Editar" class="btn btn-primary btn-fab btn-fab-mini"><i class="material-icons">edit</i></a>
                                <a href="javascript:void(0)" title="Eliminar" class="btn btn-danger btn-fab btn-fab-mini"><i class="material-icons">delete</i></a>
                                <a href="<?php echo base_url()?>empresas/proyectos" title="Ver tareas" class="btn btn-success btn-fab btn-fab-mini"><i class="material-icons">table</i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.row -->

 </div>
            <!-- /.container-fluid -->