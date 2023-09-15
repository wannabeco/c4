<div class="container-fluid" ng-controller="pacientesApp" ng-init="initPacientes()" id="contenedorUsuarios">

<div id="modalUsuarios" class="modal fade" role="dialog"  data-keyboard="false" data-backdrop="static">
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
                            <li><a class="btn" ng-click="cargaPlantillaControl('',0)"><i class="fa fa-fw fa-plus"></i> AGREGAR NUEVO PACIENTE</a></li>
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
            {{usuarios.lenght}}
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">IDENTIFICACIÓN</th>
                            <th>NOMBRES</th>
                            <th>APELLIDOS</th>
                            <th>DIRECCIÓN</th>
                            <th>TELÉFONO</th>
                            <th>PACIENTE</th>
                            <th>TIPO</th>
                            <th class="text-center">ESTADO</th>
                            <th class="text-center">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="ulist in usuarios  | filter:q as results">
                            <td class="text-center">{{ulist.num_doc}}</td>
                            <td>{{ulist.nombre_paciente}}</td>
                            <td>{{ulist.apellido_paciente}}</td>
                            <td>{{ulist.direccion_paciente}}</td>
                            <td>{{ulist.telefono_paciente}}</td>
                            <td align="center">
                                <span class="label label-warning" ng-if="ulist.estado_paciente=='puntual'" value="1" >PUNTUAL</span>
                                <span class="label label-danger" ng-if="ulist.estado_paciente=='cronico'" value="1" >CRÓNICO</span>
                                <span class="label label-primary" ng-if="ulist.estado_paciente=='phd'" value="1" >PHD</span>
                                <span class="label label-default" ng-if="ulist.estado_paciente=='evento'" value="1" >EVENTO</span>
                            </td>
                            <td class="text-center">{{ulist.tipoPaciente}}</td>
                            <td align="center">
                                <span class="label label-success" ng-if="ulist.estado==1" value="1" >ACTIVO</span>
                                <span class="label label-default" ng-if="ulist.estado==0" value="0" >INACTIVO</span>
                            </td>
                            <td  class="text-center">

                                <?php if(getPrivilegios()[0]['editar'] == 1){ ?>
                                    <a ng-click="cargaPlantillaControl(ulist.idPaciente,1)" title="Editar usuario" class="btn btn-primary btn-fab btn-fab-mini"><i class="material-icons">edit</i></a>
                                <?php }?>
                                <?php if(getPrivilegios()[0]['borrar'] == 1){ ?>
                                    <a ng-click="borraPaciente(ulist.idPaciente)" title="Eliminar"  class="btn btn-danger btn-fab btn-fab-mini"><i class="material-icons">delete</i></a>
                                <?php } ?>
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