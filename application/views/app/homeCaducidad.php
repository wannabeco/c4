<div class="container-fluid" ng-controller="pagos"  ng-init="initpagos()">
    <div class="row">
      <?php
      if($_SESSION["project"]["info"]["idPerfil"] == 11){
        $empresa  = json_encode($infoEmpresa[0]);
        $referencia				= substr(md5(time()), 0, 16);
      }
      ?>
        <div class="col-lg-12">
            <!-- APP MOVIL  -->
            <div class="text-center">
              <?php foreach($infoPlanes as $info){
                        if($info["dirigido"] == 0 && $_SESSION["project"]["info"]["idPerfil"] == 11){  
              ?>
              <!-- cuadno el perfil es administrador de empresa -->
                <div class="col col-lg-4 col-md-4 float-left">
                    <div class="card box-shadow">
                      <div class="card-header">
                        <h3 class="my-0 font-weight-normal"><?php echo ucfirst($info["tituloPlan"]);?></h3>
                      </div>
                      <div class="card-body" style="height: auto;">
                        <h2 class="card-title pricing-card-title"><?php echo "$ ".number_format($info["precio"],0, ',', '.'); ?><small class="text-muted">/ Mensual</small></h2>
                        <span style="position:relative; float:left; left:20px;"> <?php echo ucfirst($info["descripcion"]); ?> </span><br>
                        <hr>
                          <div class="mb-4" style="height:auto;">
                          
                              <h4>ADICIONALES</h4>
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
                                <div class="col-md-4 float-left text-left">Matrices</div>
                                <div class="col-md-4 float-left"><?php echo $cantMatrices;?></div>
                                <div class="col-md-4 float-left text-right"><?php echo "$ ".number_format($totalMatrices,0, ',', '.');?></div>
                              </div><br>
                              <div class="col-md-12" style="top:50px;">
                                <hr>
                                <h4>TOTALES</h4>
                                <div class="col-md-12">
                                  <div class="col-md-8 float-left text-left"><strong>TOTAL ADICIONALES</strong></div>
                                  <div class="col-md-4 float-left text-right"><?php echo "$ ".number_format($adicionales,0,',', '.'); ?></div>
                                </div>
                                <div class="col-md-12">
                                  <div class="col-md-8 float-left text-left"><strong>TOTAL PLAN</strong></div>
                                  <div class="col-md-4 float-left text-right"><?php echo "$ ".number_format($info["precio"],0, ',', '.'); ?></div>
                                </div><br>
                              </div>
                              
                              <div class="col-md-12" style="top:80px;">
                                <hr>
                                <div class="col-md-8 float-left">
                                  <h4>TOTAL A PAGAR </h4>
                                </div>
                                <div class="col-md-4 float-left">
                                  <?php echo "$ ".number_format($totalPagarEmpresa,0,',', '.'); ?>
                                </div>
                              </div><br>
                          </div>
                            
                        <br><br>
                        <?php if($infoEmpresa > 0){ ?>
                            <button type="button" class="btn btn-lg btn-block btn-primary mt-5" ng-click="pagoEmpresa(<?php echo $_SESSION["project"]["info"]["idEmpresa"];?>)">
                              <i class="fa fa-shopping-cart" aria-hidden="true" style="margin-right:5px;"></i> Pagar Ahora
                            </button>
                            <br>
                            <span>Todos los valores expresados en este resumen son mensuales</span>
                        <?php } ?>
                      </div>
                    </div>
                </div>
                <!-- cuando el perfil es oficial de cumplimiento -->
                <?php }if($info["dirigido"] == 1 && $_SESSION["project"]["info"]["idPerfil"] == 8){ ?>
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