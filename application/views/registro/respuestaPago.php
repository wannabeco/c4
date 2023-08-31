<div class="container-fluid" ng-controller="pedidos" ng-init="nuevoPedidoInit()" id="contenedorUsuarios">

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
            <br>
            <center><img src="<?php echo base_url()?>res/img/Logo.png" width="50%"></center><br>
            <h1 class="page-header text-center" style="font-size:1.8em">
                <strong><?php echo lang("text35")?></strong>
            </h1>
        </div>
    </div> 
    <!-- /.row -->
    <div class="row p-4">
        <div class="col-lg-12">
                <?php if (strtoupper($firma) != strtoupper($firmacreada)) { ?>
                    <table class="table">
                        <tr>
                            <td><?php echo lang("text37")?></td>
                            <td><span class="label <?php echo $claseLabel; ?>"><?php echo $estadoTx; ?></span></td>
                        </tr>
                        <tr>
                            <td>Codigo de referencia</td>
                            <td><?php echo $reference_pol; ?></td> 
                        </tr>
                        <tr>
                            <td><?php echo lang("cod_pedido_label")?></td>
                            <td><?php echo $referenceCode; ?></td> 
                        </tr>
                        <tr>
                            <td><?php echo lang("text40")?></td>
                            <td><?php echo $lapPaymentMethod; ?></td> 
                        </tr>
                        <?php
                        if($pseBank != null) {
                        ?>
                            <tr>
                            <td>cus </td>
                            <td><?php echo $cus; ?> </td>
                            </tr>
                            <tr>
                            <td><?php echo lang("lbl_bank")?> </td>
                            <td><?php echo $pseBank; ?> </td>
                            </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <td><?php echo lang("text41")?></td>
                            <td>$ <?php echo number_format($TX_VALUE,0,',','.'); ?></td>
                        </tr>
                    </table>
                    <div class="alert alert-primary text-center">
                        <strong><?php echo lang("text36")?></strong>
                    </div>


                        <?php
                        }
                        else
                        {
                        ?>
                            <h1>Error validando firma digital.</h1>
                        <?php
                        }
                        ?>
                                <!-- <h2><?php echo lang("text36")?></h2> -->
                                <input type="text" value="<?php var_dump('');die();?>" hidden>
        </div>
    </div>
    <!-- /.row -->
 </div>
<!-- /.container-fluid -->