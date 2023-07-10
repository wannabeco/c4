<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Bienvenido  <small><?php echo $_SESSION['project']['info']['nombre']." ".$_SESSION['project']['info']['apellido']; ?></small></h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de bases de datos matriz de obligaciones recurrentes</h6>
        </div>
        <div class="card-body">
            
            <!-- Contenido de parametrización-->
            <div class="row">

                <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>CrearMatriz/entidades/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Entidades</a>
                    </div>
                <?php }?>
                <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>CrearMatriz/fejecucion/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Frecuencia de ejecución</a>
                    </div>
                <?php }?>


                <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>CrearMatriz/tipoEmpresa/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Tipos de empresas</a>
                    </div>
                <?php }?>
                <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>CrearMatriz/aplicaccsm/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Aplica para ccsm</a>
                    </div>
                <?php }?>
                <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>CrearMatriz/cuandoAplique/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Cuando se aplica</a>
                    </div>
                <?php }?>
                <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>CrearMatriz/metodoControl/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Metodologia de control</a>
                    </div>
                <?php }?>
                <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>CrearMatriz/Periodicidad/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Periodicidad</a>
                    </div>
                <?php }?>

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
                <!--<?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>Parametrizacion/perfiles/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Perfiles</a>
                    </div>
                <?php }?>-->

                <!--<?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>Parametrizacion/constantes/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Variables globales</a>
                    </div>
                <?php }?>-->
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
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de bases de datos matriz sagrilaft</h6>
        </div>
        <div class="card-body">
            
            <!-- Contenido de parametrización-->
            <div class="row">
            <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>CrearMatriz/tipoEmpresa/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Tipos de empresas</a>
                    </div>
                <?php }?>
                <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>CrearMatriz/procesos/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Procesos</a>
                    </div>
                <?php }?>
                <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>CrearMatriz/fuenteRiesgo/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Fuente de riesgo</a>
                    </div>
                <?php }?>
                <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>CrearMatriz/factorEspecifico/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Factor especifico</a>
                    </div>
                <?php }?>
                <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none" href="<?php echo base_url()?>CrearMatriz/descripcionRiesgo/<?php echo $infoModulo['idModulo']?>">
                            <h1><i class="fa fa-list"></i></h1> Descripción de riesgo
                        </a>
                    </div>
                <?php }?>
                <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none" href="<?php echo base_url()?>CrearMatriz/causas/<?php echo $infoModulo['idModulo']?>">
                            <h1><i class="fa fa-list"></i></h1> Causas
                        </a>
                    </div>
                <?php }?>
                <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>CrearMatriz/tipoRiesgo/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Tipo de riesgo</a>
                    </div>
                <?php }?>
                
                <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>CrearMatriz/riesgoAsociado/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Riesgos asociado</a>
                    </div>
                <?php }?>
                <?php if(getPrivilegios()[0]['ver'] == 1 && getPrivilegios()[0]['crear'] == 1 && getPrivilegios()[0]['editar'] == 1 && getPrivilegios()[0]['borrar'] == 1){ ?>
                    <div style="margin:0 0 2% 0" class="col col-lg-3 text-center">
                        <a style="color:#434343;text-decoration: none"  href="<?php echo base_url()?>CrearMatriz/consecuencias/<?php echo $infoModulo['idModulo']?>">
                        <h1><i class="fa fa-list"></i></h1>
                        Consecuencias</a>
                    </div>
                <?php }?>
            </div>
            <!-- Fin contenido parametrización-->

        </div>
    </div>
</div>