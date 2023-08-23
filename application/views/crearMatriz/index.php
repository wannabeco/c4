<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Crea nueva matriz  <!--<small><?php echo $_SESSION['project']['info']['nombre']." ".$_SESSION['project']['info']['apellido']; ?></small>--></h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Datos de creación</h6>
        </div>
        <div class="card-body" ng-controller="crearMatriz" ng-init="initcreaMatriz()">
            <!-- Contenido de parametrización-->
            <form action="" role="form" id="agregaNuevaMatriz">
                <div class="row">

                    <div class="form-group col-md-6 float-left">
                        <label for="exampleInputEmail1">Nombre de matriz</label>
                        <input type="text" class="form-control" id="nombreNuevaMatriz" name="nombreNuevaMatriz">
                    </div>
                    <div class="form-group col-md-3 float-left">
                        <label for="exampleInputEmail1">Precio</label>
                        <input type="number" class="form-control" id="Precio" name="Precio" ng-model="Precio"/>
                    </div>
                    <div class="form-group col-md-3 float-left">
                        <label for="exampleInputEmail1">Gratis primera vez</label><br>
                        <label>
                        <input type="radio"  name="gratis" id="gratis" value="1"/>
                            <span>SI</span>
                        </label>
                        <label>
                            <input type="radio" name="gratis" id="gratis" value="2"/>
                            <span>NO</span>
                        </label>
                    </div>
                    <div class="form-group col-md-6 float-left">
                        <label for="exampleInputEmail1">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" maxlength="250" oninput="contarCaracteres()"></textarea>
                        <span id="caracteres-utilizados"></span>
                    </div>
                    <div class="form-group col-md-6 float-left">
                        <label for="exampleFormControlSelect1">Tipo Plantilla</label><br>
                            <label>
                        <input type="radio"  name="dirigida" id="dirigida1" value="1" ng-model="tipoP" />
                            <span>Básica</span>
                        </label>
                        <label>
                            <input type="radio" name="dirigida" id="dirigida2" value="2" ng-model="tipoP"/>
                            <span >Específica</span>
                        </label>
                    </div>

                    <div class="form-group col-md-6 float-left" ng-if="tipoP == 2">
                        <label for="exampleFormControlSelect1">Tipo empresa</label>
                        </label>
                        <select class="custom-select" id="tipoEmpresa" name="tipoEmpresa" ng-model="selectedOption" ng-change="agrega()">
                            <option value="" >Seleccione...</option>
                            <?php foreach($infoTipoEmpresa as $tipoEmpresa){ ?>
                                  <option value="<?php echo $tipoEmpresa['idTipoEmpresa']. ',' . $tipoEmpresa['TipoEmpresa'] ?>" ><?php echo $tipoEmpresa['TipoEmpresa'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-12 text-dark tipos">
                    </div>
                    <div class="col-md-12 text-right botones">
                        <button type="button" class="btn btn-primary ml-4" ng-click="agregaNuevaMatriz()" style="float: right;">Agregar Matriz</button>
                        <button type="button" class="btn btn-danger" style="float: right;" ng-click="recargar()">Limpiar Matriz</button>
                    </div>
                </div>
            </form>
            <!-- Fin contenido parametrización-->
        </div>
    </div>
</div>
<style>
    label > input[type="radio"] {display: none;}
    label > input[type="radio"] + *::before {content: "";display: inline-block;vertical-align: bottom;width: 1rem;height: 1rem;margin-right: 0.3rem;border-radius: 50%;border-style: solid;border-width: 0.1rem;border-color: gray;}
    /* label > input[type="radio"]:checked + * {color: teal;} */
    label > input[type="radio"]:checked + *::before {background: radial-gradient(teal 0%, teal 40%, transparent 50%, transparent);border-color: teal;}
    fieldset {margin: 20px;max-width: 400px;}
    label > input[type="radio"] + * {display: inline-block;padding: 0.5rem 1rem;}
</style>
<script>
    function contarCaracteres() {
    var textarea = document.getElementById('descripcion');
    var caracteresUtilizados = textarea.value.length;
    var caracteresRestantes = 250 - caracteresUtilizados;
    var contadorElemento = document.getElementById('caracteres-utilizados');
    contadorElemento.textContent = 'Caracteres utilizados: ' + caracteresUtilizados + ', Restantes: ' + caracteresRestantes;
}
</script>