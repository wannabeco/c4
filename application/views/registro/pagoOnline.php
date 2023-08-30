<div>
    <?php 
            $payu_id_mercado =989196;
            $payu_id_cuenta =997663;
            $payu_apikey = "x4Wpfz8di5FY3nrpUOn0C50ypU";
            // $payu_apikey = "x4Wpfz8di5FY3nrpUOn0C50ypU";
            $referencia = $codigoPago;
            $datos = json_encode($compraTemporal);
            $email = $_SESSION['project']['info']['email'];
            
        ?>
    <div class="container"><br>
    <center><img src="<?php echo base_url()?>res/img/Logo.png" width="40%"></center><br>
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
        <?php } else if($pagoRealizar == "Pago plan empresa"){?>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Item</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = $totalPagarEmpresa; ?>
                        <tr> 
                            <td>PLan Mensual</td>
                            <td class="text-center"></td>
                            <td class="text-center"> <?php echo number_format($precioPlanEmpresa,0,',','.'); ?> </td>
                        </tr>
                        <tr> 
                            <td>Usuarios</td>
                            <td class="text-center"> <?php echo $cantPerfiles; ?> </td>
                            <td class="text-center"> <?php echo number_format($totalPerfil,0,',','.'); ?> </td>
                        </tr>
                        <tr> 
                            <td>Matrices</td>
                            <td class="text-center"> <?php echo $cantMatrices; ?> </td>
                            <td class="text-center"> <?php echo number_format($totalMatrices,0,',','.'); ?> </td>
                        </tr>
                        <tr>
                            <td colspan="2"><strong>Total a pagar</strong></td>
                            <td class="text-center"><?php echo number_format($total,0,',','.'); ?></td>
                        </tr>
                </tbody>
            </table>
        <?php }else if($pagoRealizar == "Pago plan oficial de cumplimiento"){?>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Item</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = $totalPagarEmpresa; ?>
                        <tr> 
                            <td>PLan Mensual</td>
                            <td class="text-center"></td>
                            <td class="text-center"> <?php echo number_format($precioPlanEmpresa,0,',','.'); ?> </td>
                        </tr>
                        <tr> 
                            <td>Empresas</td>
                            <td class="text-center"> <?php echo $cantCompradas; ?> </td>
                            <td class="text-center"> <?php echo number_format($totalCompradas,0,',','.'); ?> </td>
                        </tr>
                        <tr>
                            <td colspan="2"><strong>Total a pagar</strong></td>
                            <td class="text-center"><?php echo number_format($total,0,',','.'); ?></td>
                        </tr>
                </tbody>
            </table>
        <?php }?>
    </div>
    </div>
    <?php if($proveedor == 'payu'){
        $llave = md5($payu_apikey."~".$payu_id_mercado."~".$referencia."~".$total."~COP");
        // $llave = md5(_PAYU_API_KEY."~"._PAYU_ID_MERCADO."~".$referencia."~".$precio."~COP");
    ?>
        <div class="container alert alert-primary text-center mt-4" role="alert">
                <center>
                <form method="post" id="theForm" action="https://checkout.payulatam.com/ppp-web-gateway-payu/">
                    <input name="accountId"                         type="hidden"   value="<?php echo $payu_id_cuenta?>">
                    <input name="merchantId"    id="merchantId"     type="hidden"   value="<?php echo $payu_id_mercado?>">
                    <input name="description"                       type="hidden"   value="<?php echo $nombreTransaccion?>">
                    <input name="referenceCode" id="referenceCode"  type="hidden"   value="<?php echo $referencia?>">
                    <input name="amount"                            type="hidden"   value="<?php echo sprintf('%.2f',$total)?>">
                    <input name="tax"                               type="hidden"   value="0">
                    <input name="taxReturnBase"                     type="hidden"   value="0">
                    <input name="currency"      id="currency"       type="hidden"   value="COP">
                    <input name="signature"     id="signature"      type="hidden"   value="<?php echo $llave?>">
                    <input name="test"                              type="hidden"   value="false" >
                    <input name="buyerEmail"                        type="hidden"   value="<?php echo $email?>">
                    <input name="responseUrl"                       type="hidden"   value="<?php echo base_url().'Pagos/respuestaPago'?>" >
                    <input name="confirmationUrl"                   type="hidden"   value="<?php echo base_url().'Pagos/confirmacionPago'?>" > 
                    <button type="submit" class="btn btn-primary" style="background:#000;color:#fff"><?php echo lang("text30")?></button>               
                </form><br><br>
                <img src="<?php echo base_url()?>/res/img/payuPagos.jpg" width="100%" alt="">
            </center>
            <a onclick="window.close()" class="btn btn-primary"style="background:;color:#f6f6f6;">CERRAR VENTANA</a>
            <input type="text" value="<?php var_dump('');die();?>" hidden>
        </div>
    <?php }?>
</div>