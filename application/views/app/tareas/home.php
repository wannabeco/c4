<div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Proyectos <!--<small>Estructura de las áreas de su empresa</small>-->
                            <div class="btn-group" >
                                <button type="button" class="btn dropdown-toggle"
                                        data-toggle="dropdown">
                                  Acciones <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                  
                                    <li role="separator" class="divider"></li><li class="dropdown-header">Seleccione una opción</li>
                                    <li><a class="btn" data-toggle="modal" data-target="#modalBach"><i class="fa fa-fw fa-table"></i> Agregar nuevo proyecto</a></li>
                                </ul>
                            </div>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <a href="#"><i class="fa fa-home"></i> Singularcom</a>
                            </li>
                            <li class="active">
                                 Proyectos
                            </li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-primary alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i> Los proyectos que se muestran en este área son todos los existentes en su empresa.
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
                        <h2>Proyectos Actuales</h2>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Proyecto</th>
                                        <th class="text-center">% Cumplimiento Total</th>
                                        <th class="text-center">% Mis tareas</th>
                                        <th class="text-center">Área</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Realización del sistema claro fijo asesores</td>
                                        <td class="text-center">32.3%</td>
                                        <td class="text-center">100%</td>
                                        <td class="text-center">Desarrollo</td>
                                        <td  class="text-center">
                                            <!--<a href="javascript:void(0)" title="Editar" class="btn btn-primary btn-fab btn-fab-mini"><i class="material-icons">edit</i></a>-->
                                            <a href="javascript:void(0)" title="Eliminar" class="btn btn-danger btn-fab btn-fab-mini"><i class="material-icons">delete</i></a>
                                            <a href="<?php echo base_url()?>App/infoProyecto" title="Ver tarea" class="btn btn-success btn-fab btn-fab-mini"><i class="material-icons">table</i></a>
                                        </td>
                                    </tr>
                                    <tr class="success">
                                        <td>Ajuste ayudaventas para que permita facturar nuevamente por clausula</td>
                                        <td class="text-center">100%</td>
                                        <td class="text-center">100%</td><!-- Sólo para el usuario-->
                                        <td class="text-center">Desarrollo</td>
                                        <td  class="text-center">
                                            <!--<a href="javascript:void(0)" title="Editar" class="btn btn-primary btn-fab btn-fab-mini"><i class="material-icons">edit</i></a>-->
                                            <a href="javascript:void(0)" title="Eliminar" class="btn btn-danger btn-fab btn-fab-mini"><i class="material-icons">delete</i></a>
                                            <a href="<?php echo base_url()?>App/infoProyecto" title="Ver tarea" class="btn btn-success btn-fab btn-fab-mini"><i class="material-icons">table</i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Cuadro de control de gerencia</td>
                                        <td class="text-center">33.3%</td>
                                        <td class="text-center">33.3%</td>
                                        <td class="text-center">Desarrollo</td>
                                        <td  class="text-center">
                                            <!--<a href="javascript:void(0)" title="Editar" class="btn btn-primary btn-fab btn-fab-mini"><i class="material-icons">edit</i></a>-->
                                            <a href="javascript:void(0)" title="Eliminar" class="btn btn-danger btn-fab btn-fab-mini"><i class="material-icons">delete</i></a>
                                            <a href="<?php echo base_url()?>App/infoProyecto" title="Ver tarea" class="btn btn-success btn-fab btn-fab-mini"><i class="material-icons">table</i></a>
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