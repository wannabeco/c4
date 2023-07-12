/*
* Controlador que maneja todas las funcionalidades de la creación de usuarios
* @author Farez Prieto @orugal
* @date 15 de Noviembre de 2016
*/
project.controller('sugerencias', function($scope,$http,$q,constantes)
{
    $scope.initsugerencias = function(){
		$scope.config 			=  configLogin;//configuración global
    }
	
	//crea modal formulario de relacion de empresa con oficial de cumplimiento.
	$scope.verSugerencia = function($id){
		$('#modalSugerencias').modal("show");
	 	var controlador = 	$scope.config.apiUrl+"Sugerencias/modalSugerencias";
	 	var parametros  = 	"idSugerir="+$id;
	 	constantes.consultaApi(controlador,parametros,function(json){
	 		$("#modalCrea").html(json);
	 		$scope.compileAngularElement("#formSugieres");
	 	},'');
	}
	$scope.actualizaSugerencia =function(){
		var respuesta = $("#respuesta").val();
		var idSugiere = $("#idSugiere").val();
		if(respuesta == ""){
			constantes.alerta("Atención","Por favor escribir la respuesta.","info",function(){});
		}else{
			constantes.confirmacion("Confirmación","Esta apunto guardar la respues, ¿desea continuar?",'info',function(){
				var controlador = $scope.config.apiUrl+"Sugerencias/guardaRespuesta";
				var parametros  = "respuesta="+respuesta+"&idSugiere="+idSugiere;
				constantes.consultaApi(controlador,parametros,function(json){
					if(json.continuar == 1){
						constantes.alerta("Atención",json.mensaje,"success",function(){
							location.reload();
						});
					}
					else{
						constantes.alerta("Atención",json.mensaje,"warning",function(){});
					}
				});
			});
		}
	}

	//elimina matriz
	$scope.borraEmpresas = function($id){
		var idEmpresa =$id;
		constantes.confirmacion("Confirmación","Esta apunto de eliminar la empresa, ¿desea continuar?",'info',function(){
			var controlador = $scope.config.apiUrl+"Empresas/eliminaEmpresa";
			var parametros  = {idEmpresa:$id}
			constantes.consultaApi(controlador,parametros,function(json){
				if(json.continuar == 1){
					constantes.alerta("Atención",json.mensaje,"success",function(){
						location.reload();
					});
				}
				else{
					constantes.alerta("Atención",json.mensaje,"warning",function(){});
				}
			});
		});
	}
	
	$scope.compileAngularElement = function(elSelector) {

        var elSelector = (typeof elSelector == 'string') ? elSelector : null ;  
            // The new element to be added
        if (elSelector != null ) {
            var $div = $( elSelector );

                // The parent of the new element
                var $target = $("[ng-app]");

              angular.element($target).injector().invoke(['$compile', function ($compile) {
                        var $scope = angular.element($target).scope();
                        $compile($div)($scope);
                        // Finally, refresh the watch expressions in the new element
                        $scope.$apply();
                    }]);
            }

       }

});