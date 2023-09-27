<form role="form"  ng-controller="buscar" ng-init="initbuscar()" id="formsugerir"  ng-submit="solicitaMatriz()">    
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
                    <h6 class="m-0 font-weight-bold text-danger">Dejanos sugerirnos check para tu empresa.</h6>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col">Nombre check</th>
                                <th scope="col">Descripción</th>
                                <th scope="col" style="width: 124px;">Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($infoMatrices as $info){ ?>
                                <tr>
                                    <td><p class="text-dark"><?php echo $info["nombreNuevaMatriz"];?></p></td>
                                    <td><p class="text-dark"><?php echo $info["descripcion"];?></p></td>
                                    <td><p class="text-dark"><?php echo "$ ".number_format($info["precio"]);?></p></td>
                                </tr>
                            <?php  }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <input type="text" id="idEmpresa" name="idEmpresa" value="<?php echo $_SESSION["project"]["info"]["idEmpresa"];?>" hidden>
  <div class="modal-footer">
    <button type="button"  data-dismiss="modal" class="btn  btn-default"><?php echo lang('reg_btn_cancelar') ?></button>
    <button type="submit" class="btn btn-raised btn-primary">Guardar</button>
  </div>
</form>