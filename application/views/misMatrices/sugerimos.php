<div  ng-controller="buscar" ng-init="initbuscar()">    
    <div class="modal-header">
        <h5 class="modal-title pl-3"><?php echo $titulo ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body" id="cajaNombreEmpresa">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-danger">Te sugerimos check a la medida de tu empresa.</h6>
                </div>
                <div class="card-body">
                    <div class="row col-md-12 text-dark tiposDos"></div>
                    <table class="table table-striped">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col">Nombre check</th>
                                <th scope="col">Descripción</th>
                                <th scope="col" style="width: 124px;">Precio</th>
                                <th scope="col" style="width: 124px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($infoMatrices as $info){ ?>
                                <tr>
                                    <td><p class="text-dark"><?php echo $info["nombreNuevaMatriz"];?></p></td>
                                    <td><p class="text-dark"><?php echo $info["descripcion"];?></p></td>
                                    <td><p class="text-dark"><?php echo "$ ".number_format($info["precio"]);?></p></td>
                                    <td style="width: 160px;">
                                        <button type="button" class="btn btn-primary float-left ml-2 agregaGratisDos"data-toggle="tooltip" data-placement="top" title="Gratis" data-idEmpresa="<?php echo $idEmpresa;?>" data-nombreNuevaMatriz="<?php echo $info["nombreNuevaMatriz"];?>" data-idNuevaMatriz="<?php echo $info["idNuevaMatriz"];?>">Adquirir</button>
                                        <!-- boton pago -->
                                        <button type="button" class="btn btn-primary float-left ml-2 PagaraButton" data-toggle="tooltip" data-placement="top" title="Comprar" data-idEmpresa="<?php echo $idEmpresa;?>" data-nombreNuevaMatriz="<?php echo $info["nombreNuevaMatriz"];?>" data-idNuevaMatriz="<?php echo $info["idNuevaMatriz"];?>" data-precio="<?php echo $info["precio"];?>">Adquirir</button>
                                        <button type="button" id="btnMostrarLista" class="btn btn-primary infoInterno" data-toggle="tooltip" data-placement="top" title="Información" data-idNuevaMatriz="<?php echo $info["idNuevaMatriz"];?>"><i class="fas fa-check-double"></i></button>
                                    </td>
                                </tr>
                            <?php  }?>
                        </tbody>
                    </table>
                    <!-- datos -->
                    <div id="listaInfo" style="display: none;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button"  data-dismiss="modal" class="btn  btn-primary"><?php echo lang('reg_btn_cancelar') ?></button>
    </div>
</div>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>