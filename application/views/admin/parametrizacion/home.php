<div class="container-fluid"  ng-controller="listas" ng-init="initListas()" id="contenedorUsuarios">
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
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $infoModulo['nombreModulo'] ?></li>
        </ol>
    </nav>
    <!-- fin cabecera-->


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Lista de bases de datos generales</h6>
        </div>
        <div class="card-body">
            <!-- Contenido de parametrización-->
            <div class="row">
                <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none" href="<?php echo base_url()?>Parametrizacion/tiposDoumento/<?php echo $infoModulo['idModulo']?>">
                            <h1><i class="fa fa-list"></i></h1>Tipos de documento
                        </a>
                    </div>
                <?php }?>
                <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>Parametrizacion/sexo/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Sexo</a>
                    </div>
                <?php }?>
                
                <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>Parametrizacion/tipoEmpresa/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Tipos de empresa</a>
                    </div>
                <?php }?>

                <!-- <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>Parametrizacion/areasTrabajo/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Áreas de trabajo</a>
                    </div>
                <?php }?> -->

                <!-- <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>Parametrizacion/tipoContrato/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Tipos de contrato</a>
                    </div>
                <?php }?> -->

                <!-- <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>Parametrizacion/cargos/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Cargos</a>
                    </div>
                <?php }?> -->

               <!--  <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>Parametrizacion/bancos/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Entidades bancarias</a>
                    </div>
                <?php }?> -->

               <!--  <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>Parametrizacion/tiposCuenta/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Tipo de cuenta</a>
                    </div>
                <?php }?>

                <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>Parametrizacion/eps/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        EPS</a>
                    </div>
                <?php }?>

                <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>Parametrizacion/afp/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        AFP</a>
                    </div>
                <?php }?>

                <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>Parametrizacion/fondoCesantias/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Fondo cesantías</a>
                    </div>
                <?php }?>
                 -->
                <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>Parametrizacion/perfiles/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Perfiles</a>
                    </div>
                <?php }?>

                <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>Parametrizacion/constantes/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Variables globales</a>
                    </div>
                <?php }?>
                <!-- 
                <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>Parametrizacion/impuestos/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Impuestos</a>
                    </div>
                <?php }?> -->
            </div>
            <!-- Fin contenido parametrización-->

        </div>
    </div>

</div>