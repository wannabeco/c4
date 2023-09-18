<div class="container-fluid" ng-controller="cargaPagos" ng-init="initPagos()" id="contenedorUsuarios">
    <div class="container">
        <div class="row">
            <div class="col col-lg-6">
                <div class="row">
                    <div class="col col-lg-12">
                        <img src="<?php echo base_url() ?>res/img/logoAzul.jpg" width="50%">
                    </div>
                    <div class="col col-lg-12" style="font-size: 1.3em;margin: 10% 0 0 0">
                        <strong>Capitán: </strong><?php echo $_SESSION['project']['info']['nombre'] ?> <?php echo $_SESSION['project']['info']['apellido'] ?><br>
                        <strong>Documento: </strong><?php echo $_SESSION['project']['info']['nroDocumento'] ?> <br>
                        <strong>Id Pago: </strong><?php echo $infoPagos[0]['codigoPago'] ?> <br>
                        <strong>Fecha: </strong><?php echo formatoFechaEspanol(date("Y-m-d H:i:s"))?> <br>
                        <!-- <?php var_dump($infoPagos) ?> -->
                    </div>
                    <div class="col col-lg-12" style="font-size: 1.2em;margin: 10% 0 0 0">
                        <table class="table">
                            <tr>
                                <td colspan="2"><strong>DETALLE PAGO</strong></td>
                            </tr>
                            <?php $suma=0;foreach($infoPagosTotal as $listado){ ?>
                                   <tr>
                                       <td class="text-left"><?php echo $listado['conceptoPago'] ?></td>
                                       <td class="text-right">$<?php echo number_format($listado['valorPago'],0,",",".")?></td>
                                   </tr> 
                            <?php $suma+=$listado['valorPago']; } ?>

                            <tr>
                                <td class="text-left" ><strong>TOTAL</strong></td>
                                <td class="text-right" ><strong>$<?php echo number_format($suma,0,",",".")?></strong></td>
                            </tr>
                        </table>   
                    </div>
                </div>
            </div>
            <div class="col col-lg-6" style="padding: 10%">
                <h4>PARA TENER EN CUENTA</h4>
                <p>
                    <ul>
                        <li>Esta factura tiene una vigencia de X días</li>
                        <li>Si desea confirmar los valores de la factura por favor comuníquese a...</li>
                        <li>Al hacer click en el botón REALIZA TU PAGO, será dirigido a la plataforma de transacción PayU</li>
                    </ul>
                </p>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->