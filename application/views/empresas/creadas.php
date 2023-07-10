<div class="container-fluid" ng-controller="buscarEmpresas" ng-init="initbuscarEmpresas()">
    <!-- modal estandar-->
    <div id="modalParametros" class="modal fade" role="dialog"  data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="modalCrea">
                <!--Form de creación -->
            </div>
        </div>
    </div>
    <!-- modal sugerir nueva matriz -->
    <div id="modalMatriz" class="modal fade" role="dialog"  data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-md">
            <div class="modal-content" id="modalCreaNueva">
                <!--Form de creación -->
            </div>
        </div>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 text-dark"><?php echo $titulo;?></h1>
    </div>
    <div ng-if="infoMisEmpresas.continuar === 0">
        <div class="col-md-7">
            <div class="alert alert-success" role="alert">
            <i class="fas fa-info-circle"></i> Recuerde que las empresas adicionales a <strong> 1 </strong> que incluye el plan serán cobradas.
            </div>
        </div>
    </div>
    <div ng-if="infoMisEmpresas.continuar === 1">
        <div class="col-md-7">
            <div class="alert alert-info" role="alert">
            <i class="fas fa-exclamation-triangle"></i> Recuerde que las empresas adicionales a <strong> 1 </strong> que incluye el plan, <strong> serán cobradas.</strong>
            </div>
        </div>
    </div>
    <div class="">
        <!-- buscador -->
        <div class="col-md-12 p-4">
            <div class="form-group input-group">
                <input class="form-control" width="90%" id="busca" type="text" placeholder="Buscar empresas.." ng-model="searchText" ng-keyup="search()"/>
            </div>
        </div>
    </div>
    <div class="row col-md-12 text-dark tipos"></div>
    <div class="p-4">
        <!-- card -->
        <div class="card mb-5 col-md-6 float-left" style="width: 600px; height: 200px;" ng-repeat="empresas in infoEmpresas | limitTo: pageSize: (currentPage - 1) * pageSize" ng-class="{'float-right': $index % 2 != 0}">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/1/16/SparkyLinux-logo-200px.png" class="imagencard" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ empresas.nombre }}</h5>
                        <p class="card-text text-justify">{{ empresas.nombreEncargado }} <strong>Teléfono:</strong> {{ empresas.telefono }}</p>
                        <p class="card-text text-justify">{{ empresas.email }}</p>
                        <div ng-if="infoMisEmpresas.continuar === 0">
                            <p class="card-text col-md-4 float-left"><small class="text-muted" style="text-decoration: line-through;">$ {{ precioEmpresa | number }}</small></p>
                            <form ng-submit="agregaGratis(empresas.nombre, empresas.idEmpresa)" class="flat-left">
                                <button class="btn btn-primary float-right" type="submit"><i class="fas fa-plus"></i> Agregar</button>
                            </form>
                        </div>
                        <div ng-if="infoMisEmpresas.continuar == 1">
                            <p class="card-text col-md-4 float-left"><small class="text-muted">$ {{ precioEmpresa | number }} </small></p>
                            <form ng-submit="agrega(empresas.nombre, empresas.idEmpresa, precioEmpresa)" class="flat-left">
                                <button class="btn btn-primary float-right" type="submit"><i class="fas fa-plus"></i> Agregar</button>
                            </form>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- paginador -->
    <div class="row col-md-12">
        <div style="display: flex; justify-content: center; width: 100%;">
        <nav aria-label="...">
            <ul class="pagination">
                <li class="page-item" ng-class="{ 'disabled': currentPage === 1 }">
                <a class="page-link" href="#" ng-click="setCurrentPage(1)">Principio</a>
                </li>
                <li class="page-item" ng-class="{ 'disabled': currentPage === 1 }">
                <a class="page-link" href="#" ng-click="setCurrentPage(currentPage - 1)">Anterior</a>
                </li>
                <li class="page-item" ng-repeat="page in getPagesArray()">
                <a class="page-link" href="#" ng-click="setCurrentPage(page)" ng-class="{ 'active': currentPage === page }">{{ page }}</a>
                </li>
                <li class="page-item" ng-class="{ 'disabled': currentPage === totalPages }">
                <a class="page-link" href="#" ng-click="setCurrentPage(currentPage + 1)">Siguiente</a>
                </li>
                <li class="page-item" ng-class="{ 'disabled': currentPage === totalPages }">
                <a class="page-link" href="#" ng-click="setCurrentPage(totalPages)">Ultima</a>
                </li>
            </ul>
        </nav>
        </div>
    </div>
</div>
<style>
    .imagencard{
        width:150px;
        height:150px;
        margin-top: 20px;
        margin-left: 20px;
    }
    .card-title{
        font-size:1.05rem;
    }
    .card-text{
        font-size:0.85rem;
    }
</style>