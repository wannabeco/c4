<div class="container-fluid" ng-controller="pagos"  ng-init="initpagos()">
    <div class="row">
      <?php
      if($_SESSION["project"]["info"]["idPerfil"] == 11){
        $empresa  = json_encode($infoEmpresa[0]);
        $referencia				= substr(md5(time()), 0, 16);
      }
      $cantidad = 0;
      ?>
        <div class="col-lg-12">
            <!-- APP MOVIL  -->
          <?php if($nombrePlan != ""){?>
            <div class="alert alert-info m-2" role="alert">
              <i class="fas fa-info-circle"></i> Actualmetne la empresa cuenta con el <strong> <?php echo $nombrePlan;?></strong>
            </div>
          <?php }?>
            <div class="text-center">
              <?php foreach($infoPlanes as $info){
                        if($info["dirigido"] == 0 && $_SESSION["project"]["info"]["idPerfil"] == 11){  
                          $cantidad++;
              ?>
              <!-- cuadno el perfil es administrador de empresa -->
                <div class="col col-lg-4 col-md-4 float-left">
                    <div class="card box-shadow">
                      <div class="card-header">
                        <h3 class="my-0 font-weight-normal"><?php echo ucfirst($info["tituloPlan"]);?></h3>
                      </div>
                      <div class="card-body" style="height: auto;">
                      <select class="form-control custom-select text-center" ng-model="membresiaPlan">
                          <option value="mes">Mes</option>
                          <option value="year">Año</option>
                      </select><br><br>
                        <h2 ng-if="membresiaPlan == 'mes'" class="card-title pricing-card-title"><?php echo "$ ".number_format($info["precio"],0, ',', '.'); ?><small class="text-muted">/ Mensual</small></h2>
                        <h2 ng-if="membresiaPlan == 'year'" class="card-title pricing-card-title"><?php echo "$ ".number_format(($info["precio"]*$info["mesCobraYear"]),0, ',', '.'); ?><small class="text-muted">/ Anual</small></h2>
                        <span style="position:relative; float:center;"> <?php echo ucfirst($info["descripcion"]); ?> </span><br>
                        <hr>
                          <div class="mb-4" style="height:auto;">
                              <h5>INCLUYE</h5>
                              <div class="col-md-12">
                                <ul>
                                  <li>
                                    <?php if($cantidad != 3){?>
                                      <p class="text-left">Usuarios <span style="float: right;"><?php echo $info["canUsuarios"];?></span></p> 
                                    <?php }if($cantidad == 3){?>
                                      <p class="text-left">Usuarios <span style="float: right;">Limitados</span></p> 
                                    <?php }?>
                                  </li>
                                  <li>
                                    <?php if($cantidad != 3){?>
                                      <p class="text-left">Checks <span style="float: right;"><?php echo $info["canMatrices"];?></span></p> 
                                      <?php }if($cantidad == 3){?>
                                        <p class="text-left">Checks <span style="float: right;">Limitados</span></p> 
                                    <?php }?>
                                  </li>
                                </ul>
                              </div>
                            <?php if($adicionalesa == 1){?>
                            <hr>
                              <h5>ADICIONALES</h5>
                              <div class="col-md-12">
                                <div class="col-md-4 float-left text-left"><strong>ITEM</strong></div>
                                <div class="col-md-4 float-left"><strong>CANT</strong></div>
                                <div class="col-md-4 float-left"><strong>VALOR</strong></div>
                              </div>
                              <div class="col-md-12">
                                <div class="col-md-4 float-left text-left">Usuarios</div>
                                <div class="col-md-4 float-left"><?php echo $cantPerfiles;?></div>
                                <div class="col-md-4 float-left text-right"><?php echo "$ ".number_format($totalPerfil,0, ',', '.');?></div>
                              </div>
                              <div class="col-md-12">
                                <div class="col-md-4 float-left text-left">Checks</div>
                                <div class="col-md-4 float-left"><?php echo $cantMatrices;?></div>
                                <div class="col-md-4 float-left text-right"><?php echo "$ ".number_format($totalMatrices,0, ',', '.');?></div>
                              </div><br>
                              <div class="col-md-12" style="top:50px;">
                                <hr>
                                <h5>TOTALES</h5>
                                <div class="col-md-12">
                                  <div class="col-md-7 float-left text-left"><strong>TOTAL ADICIONALES</strong></div>
                                  <div class="col-md-5 float-left text-right" style="padding-right:0px;"><?php echo "$ ".number_format($adicionales,0,',', '.'); ?></div>
                                </div>
                                <div class="col-md-12">
                                  <div class="col-md-7 float-left text-left"><strong>TOTAL PLAN</strong></div>
                                  <div ng-if="membresiaPlan == 'mes'" class="col-md-5 float-left text-right" style="padding-right:0px;"><?php echo "$ ".number_format($info["precio"],0, ',', '.'); ?></div>
                                  <div ng-if="membresiaPlan == 'year'" class="col-md-5 float-left text-right" style="padding-right:0px;"><?php echo "$ ".number_format($info["precio"]*$info["mesCobraYear"],0, ',', '.'); ?></div>
                                </div><br>
                              </div>
                              <div class="col-md-12" style="top:80px;">
                                <hr>
                                <div class="col-md-7 float-left">
                                  <h5>TOTAL A PAGAR </h5>
                                </div>
                                <div ng-if="membresiaPlan == 'mes'"class="col-md-5 float-left text-right">
                                  <?php echo "$ ".number_format($info["precio"]+$totalPerfil+$totalMatrices,0,',', '.'); ?>
                                </div>
                                <div ng-if="membresiaPlan == 'year'"class="col-md-5 float-left text-right">
                                  <?php echo "$ ".number_format(($info["precio"]*$info["mesCobraYear"])+$totalPerfil+$totalMatrices,0,',', '.'); ?>
                                </div>
                              </div><br>
                              <br><br>
                              <?php if($infoEmpresa > 0){ ?>
                                  <button ng-if="membresiaPlan == 'mes'" type="button" class="btn btn-lg btn-block btn-primary mt-5" ng-click="pagoEmpresa(<?php echo $_SESSION["project"]["info"]["idEmpresa"];?>,<?php echo $info["idPlan"];?>,'mes')">
                                    <i class="fa fa-shopping-cart" aria-hidden="true" style="margin-right:5px;"></i> Pagar Ahora
                                  </button>
                                  <button ng-if="membresiaPlan == 'year'" type="button" class="btn btn-lg btn-block btn-primary mt-5" ng-click="pagoEmpresa(<?php echo $_SESSION["project"]["info"]["idEmpresa"];?>,<?php echo $info["idPlan"];?>,'year')">
                                    <i class="fa fa-shopping-cart" aria-hidden="true" style="margin-right:5px;"></i> Pagar Ahora
                                  </button>
                                  <br>
                                  <span>Todos los valores expresados en este resumen son mensuales</span>
                              <?php } ?>
                              <?php } else{?>
                                  <div class="col-md-12">
                                    <hr>
                                    <div class="col-md-7 float-left">
                                        <h5>TOTAL A PAGAR </h5>
                                    </div>
                                    <div ng-if="membresiaPlan == 'mes'"  class="col-md-5 float-left text-right">
                                        <?php echo "$ ".number_format($info["precio"],0,',', '.'); ?>
                                    </div>
                                    <div ng-if="membresiaPlan == 'year'"  class="col-md-5 float-left text-right">
                                        <?php echo "$ ".number_format(($info["precio"]*$info["mesCobraYear"]),0,',', '.'); ?>
                                    </div>
                                  </div><br>
                                <br><br>
                                <?php if($infoEmpresa > 0){ ?>
                                    <button ng-if="membresiaPlan == 'mes'" type="button" class="btn btn-lg btn-block btn-primary" ng-click="pagoEmpresa(<?php echo $_SESSION["project"]["info"]["idEmpresa"];?>,<?php echo $info["idPlan"];?>,'mes')">
                                      <i class="fa fa-shopping-cart" aria-hidden="true" style="margin-right:5px;"></i> Pagar Ahora
                                    </button>
                                    <button ng-if="membresiaPlan == 'year'" type="button" class="btn btn-lg btn-block btn-primary" ng-click="pagoEmpresa(<?php echo $_SESSION["project"]["info"]["idEmpresa"];?>,<?php echo $info["idPlan"];?>,'year')">
                                      <i class="fa fa-shopping-cart" aria-hidden="true" style="margin-right:5px;"></i> Pagar Ahora
                                    </button>
                              <?php } }?>
                          </div>                        
                      </div>
                    </div>
                </div>
                <!-- cuando el perfil es oficial de cumplimiento -->
                <?php } if($info["dirigido"] == 1 && $_SESSION["project"]["info"]["idPerfil"] == 8){ ?>
                  <div class="col col-lg-4 col-md-4 float-left">
                    <div class="card box-shadow">
                      <div class="card-header">
                        <h3 class="my-0 font-weight-normal"><?php echo ucfirst($info["tituloPlan"]);?></h3>
                      </div>
                      <div class="card-body" style="height: 450px;">
                        <h2 class="card-title pricing-card-title"><?php echo "$ ".number_format($info["precio"],0, ',', '.'); ?><small class="text-muted">/ Mensual</small></h2>
                        <div class="mb-4" style="height:auto;">
                          <span style="position:relative; float:center;"> <?php echo ucfirst($info["descripcion"]); ?> </span>
                          <?php if($EmpresasCompradas > 0){?>
                             <!-- adicionales -->
                            <h4>ADICIONALES</h4>
                              <div class="col-md-12">
                                <div class="col-md-4 float-left text-left"><strong>ITEM</strong></div>
                                <div class="col-md-4 float-left"><strong>CANT</strong></div>
                                <div class="col-md-4 float-left"><strong>VALOR</strong></div>
                              </div>
                              <div class="col-md-12">
                                <div class="col-md-4 float-left text-left">Empresas</div>
                                <div class="col-md-4 float-left"><?php echo $cantCompradas;?></div>
                                <div class="col-md-4 float-left text-right"><?php echo "$ ".number_format($totalCompradas,0, ',', '.');?></div>
                              </div>

                              <!-- totales -->
                              <div class="col-md-12" style="top:50px;">
                              <hr>
                                <h4>TOTALES</h4>
                                <div class="col-md-12">
                                  <div class="col-md-8 float-left text-left"><strong>TOTAL ADICIONALES</strong></div>
                                  <div class="col-md-4 float-left text-right"><?php echo "$ ".number_format($totalCompradas,0,',', '.'); ?></div>
                                </div>
                                <div class="col-md-12">
                                  <div class="col-md-8 float-left text-left"><strong>TOTAL PLAN</strong></div>
                                  <div class="col-md-4 float-left text-right"><?php echo "$ ".number_format($info["precio"],0, ',', '.'); ?></div>
                                </div><br>
                              </div>
                              <!-- total a pagar -->
                              <div class="col-md-12" style="top:80px;">
                                <hr>
                                <div class="col-md-8 float-left text-left"><strong>TOTAL A PAGAR</strong></div>
                                <div class="col-md-4 float-left">
                                  <?php echo "$ ".number_format($totalPagarEmpresa,0,',', '.'); ?>
                                </div>
                              </div><br>
                          <?php }?>
                        </div>
                          <div class="col-md-12 float-left" style="top: 60px;">
                            <button type="button" class="btn btn-lg btn-block btn-primary" ng-click="pagoOficialC(<?php echo $_SESSION["project"]["info"]["idPersona"];?>)">
                              <i class="fa fa-shopping-cart" aria-hidden="true" style="margin-right:5px;"></i> Pagar Ahora payu </button>
                          </div>
                      </div>
                    </div>
                </div>
                <?php }} ?>
            </div>
                            
                <div class="col col-lg-2 col-md-2"></div>
            </div>
            <div class="row text-center">
                
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
<style>
/* Estilos para eliminar los bordes del select */
.custom-select {
    border: none;
    padding: 0;
    /* background: transparent; */
    outline: none;
    box-shadow: none;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
}
</style>