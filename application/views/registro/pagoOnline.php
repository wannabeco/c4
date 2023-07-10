<div ng-controller="pagos" ng-init="initpagos()">
    <?php 
            $referencia = $codigoPago;
            $datos = json_encode($compraTemporal);
            //var_dump($datos);die();
        ?>
    <div class="container"><br>
    <center><img src="<?php echo base_url()?>/res/img/CargaFoto.png" width="20%"></center><br>
    <h3 class="text-center"><strong><?php echo $pagoRealizar; ?></strong></h3><br>
    <div class="table-responsive">
        <?php if($pagoRealizar == "Pago de matrices"){?>
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Nombre de Matriz</th>
                    <th class="text-right">Precio</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0; 
                    foreach($compraTemporal as $compra){?>
                    <tr> 
                        <td> <?php echo $compra['nombreMatriz']; ?> </td>
                        <td class="text-right"> <?php echo number_format($compra['precioMatriz'],0,',','.'); ?> </td>
                    </tr>
                    <?php $precioMatriz = $compra['precioMatriz']; $total += $precioMatriz; }?>    
                    <tr>
                        <th>Total a Pagar</th>
                        <th  class="text-right">
                        <?php echo number_format($total,0,',','.')?>
                        </th>
                    </tr>
            </tbody>
        </table>
        <?php } else if($pagoRealizar == "Pago de empresas"){ ?>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre de Matriz</th>
                        <th class="text-right">Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; 
                        foreach($compraTemporal as $compra){?>
                        <tr> 
                            <td> <?php echo $compra['nombreEmpresa']; ?> </td>
                            <td class="text-right"> <?php echo number_format($compra['precioEmpresa'],0,',','.'); ?> </td>
                        </tr>
                        <?php $precioMatriz = $compra['precioEmpresa']; $total += $precioMatriz; }?>    
                        <tr>
                            <th>Total a Pagar</th>
                            <th  class="text-right">
                            <?php echo number_format($total,0,',','.')?>
                            </th>
                        </tr>
                </tbody>
            </table>
        <?php }?>    
    </div>
    
    <div class="alert alert-primary text-center" role="alert">
        <a onclick="window.close()" class="btn btn-primary" style="background:#000;color:#fff">Pagar</a>                
    </div>
    <img src="<?php echo base_url()?>/res/img/payuPagos.jpg" width="100%" alt="">
    <center>
        <a onclick="window.close()" class="btn btn-primary">CERRAR VENTANA</a>
    </center>
    </div>
    <?php if($proveedor == 'payu'){
        //“ApiKey~merchantId~referenceCode~amount~currency”.
        // $llave = md5($infoTienda['payu_apikey']."~".$infoTienda['payu_id_mercado']."~".$referencia."~".$infoPedido['valor']."~COP");
    ?>
        
        <div class="container">
            <?php //var_dump($infoPedido);?>
                <center>
                <!-- <form method="post" id="theForm" action="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/">
                    <input name="merchantId" id="merchantId"    type="hidden"  value="<?php echo $infoTienda['payu_id_mercado']?>">
                    <input name="accountId"     type="hidden"  value="<?php echo $infoTienda['payu_id_cuenta']?>" >
                    <input name="description"   type="hidden"  value="<?php echo $infoTienda['nombreTransaccion']?>"  >
                    <input name="apKey" id="apKey"   type="hidden"  value="<?php echo $infoTienda['payu_apikey']?>"  >
                    <input name="secret"                            type="hidden"   value="pRRXKOl8ikMmt9u">
                    <input name="referenceCode" id="referenceCode" type="hidden"  value="<?php echo $referencia?>" >
                    <input name="amount"        type="hidden"  value="<?php echo $infoPedido['valor']?>"   >
                    <input name="tax"           type="hidden"  value="0"  >
                    <input name="taxReturnBase" type="hidden"  value="0" >
                    <input name="currency" id="currency"    type="hidden"  value="COP">
                    <input name="signature"  id="signature"   type="hidden"  value="<?php echo $llave?>">
                    <input name="test"          type="hidden"  value="<?php echo $infoTienda['payu_test'] ?>" >
                    <input name="buyerEmail"    type="hidden"  value="<?php echo $infoPedido['email']?>" >
                    <input name="responseUrl"    type="hidden"  value="<?php echo base_url()._PAYU_LINK_RESP?>" >
                    <input name="confirmationUrl"    type="hidden"  value="<?php echo base_url()._PAYU_LINK_CONFIRM?>" > 
                    <button type="submit" class="btn btn-primary" style="background:#000;color:#fff"><?php echo lang("text30")?></button>               
                </form><br><br> -->
            </center>
        </div>
        <?php }else if($proveedor == 'wompi'){?>
            <div class="container">
                <center>
                    <!-- <form action="https://checkout.wompi.co/p/" method="GET">
                        <input type="hidden" name="public-key" value="<?php echo $infoTienda['wompi_public_key'] ?>" />
                        <input type="hidden" name="currency" value="COP" />
                        <input type="hidden" name="amount-in-cents" value="<?php echo number_format($infoPedido['valor'],0,'','')?>00" />
                        <input type="hidden" name="reference" value="<?php echo $referencia?>" />
                        <input type="hidden" name="redirect-url" value="<?php echo base_url()._WOMPI_LINK_CONFIRM?>" />
                        <button type="submit" class="btn btn-primary" style="background:#000;color:#fff"><?php echo lang("text30")?></button>
                    </form><br><br> -->
                    <img src="<?php echo base_url()?>/res/img/pagos-seguros-por-wompi.png" width="80%" alt="">
                    <!-- <a onclick="this.close()" class="btn btn-primary">CERRAR VENTANA</a> -->
                </center>
            </div>
            <?php }?>
</div>