<div class="card shadow m-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-danger">Información de empresas</h6>
    </div>
    <div class="card-body">
        <div class="container-fluid" ng-controller="empresas" ng-init="initEmpresas()">
            <div class="container-fluid">
                <div class="form-group col-md-4 float-left">
                    <label for="exampleInputEmail1">Nombre Empresa</label>
                    <input type="text" class="form-control" id="" name="" value="<?php echo $infoEmpresa["nombre"];?>" disabled/>
                </div>
                <div class="form-group col-md-4 float-left">
                    <label for="exampleInputEmail1">Tipo de Empresa</label>
                    <input type="text" class="form-control" id="" name="" value="<?php echo $infoEmpresa["TipoEmpresa"];?>" disabled/>
                </div>
                <div class="form-group col-md-4 float-left">
                    <label for="exampleInputEmail1">Dirección</label>
                    <input type="text" class="form-control" id="" name="" value="<?php echo $infoEmpresa["direccion"];?>" disabled/>
                </div>
                <div class="form-group col-md-4 float-left">
                    <label for="exampleInputEmail1">Teléfono</label>
                    <input type="text" class="form-control" id="" name="" value="<?php echo $infoEmpresa["telefono"];?>" disabled/>
                </div>
                <div class="form-group col-md-4 float-left">
                    <label for="exampleInputEmail1">Departamento</label>
                    <input type="text" class="form-control" id="" name="" value="<?php echo $departamento["NOMBRE"];?>" disabled/>
                </div>
                <div class="form-group col-md-4 float-left">
                    <label for="exampleInputEmail1">Ciudad</label>
                    <input type="text" class="form-control" id="" name="" value="<?php echo $ciudad["NOMBRE"];?>" disabled/>
                </div>
                <div class="form-group col-md-4 float-left">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="text" class="form-control" id="" name="" value="<?php echo $infoEmpresa["email"];?>" disabled/>
                </div>
                <div class="form-group col-md-4 float-left">
                    <label for="exampleInputEmail1">Nombre Encargado</label>
                    <input type="text" class="form-control" id="" name="" value="<?php echo $infoEmpresa["nombreEncargado"];?>" disabled/>
                </div>
                <div class="form-group col-md-12 float-left">
                    <button type="button" class="btn btn-primary regresa" ng-click="regresa()">Regresar</button>
                </div>
            
            </div>
        </div>
    </div>
</div>   
<style>
    .regresa{position:relative;float:right;}
</style>    