/*
* Controlador que maneja todas las funcionalidades de la creación de usuarios
* @author Farez Prieto @orugal
* @date 15 de Noviembre de 2016
*/
project.controller('misMatrices', function($scope,$http,$q,constantes)
{	
    $scope.initmisMatrices = function() {
		$scope.config = configLogin; // configuración global
	};
	$scope.infoMatrices= "";
	$scope.inforMiMatriz = "";
		
	$scope.verMatriz = function($id){
		window.location = $scope.config.apiUrl+"MisMatrices/informacion/42/"+$id;
	}

	$scope.agregarMatriz =function(){
		window.location = $scope.config.apiUrl+"Buscar/consultaMatrices";
	}

	$scope.agregaNuevaMatriz = function(){
		var nombreNuevaMatriz = $('#nombreNuevaMatriz').val();
		var dirigida       	  = $('#dirigida').val();
		var tipoEmpresa       = ids;
		
		
		//empiezo la validación de campos que será la misma si es editar que si es crear
		
		if(nombreNuevaMatriz == ""){
			constantes.alerta("Atención","Debe escribir un nombre de mastriz.","info",function(){});
		}else if(dirigida == ""){
			constantes.alerta("Atención","Debe seleccionar Tipo Plantilla.","info",function(){});
		}else if(gratis == ""){
			constantes.alerta("Atención","Debe seleccionar si la matriz sera gratis al registrar la emrpesa.","info",function(){});
		}else if(dirigida == 2 && tipoEmpresa == ""){
			constantes.alerta("Atención","Debe seleccionar el tipo de empresa","info",function(){});
		}else{
			constantes.confirmacion("Confirmación","Esta apunto de crear una matriz, ¿desea continuar?",'info',function(){
				var controlador = $scope.config.apiUrl+"CrearMatriz/creaLaNuevaMatriz";
				var parametros  = 	$("#agregaNuevaMatriz").serialize()+"&idTipoEmpresa="+tipoEmpresa;
				constantes.consultaApi(controlador,parametros,function(json){
					if(json.continuar == 1){
						constantes.alerta("Atención",json.mensaje,"success",function(){
							window.location = $scope.config.apiUrl+"MatricesCreadas/matricesCreadas/41";
						});
					}
					else{
						constantes.alerta("Atención",json.mensaje,"warning",function(){});
					}
				});
			});
		}
	}

	$scope.recargar = function(){
		location.reload();
	}


	//plantilla informacion de matriz
	$scope.cargaPlantillaInfo = function(idNuevaMatriz,edita){	
		$('#modalParametros').modal("show");
		var controlador = 	$scope.config.apiUrl+"MisMatrices/miMatriz";
		var parametros  = 	"edita="+edita+"&idNuevaMatriz="+idNuevaMatriz;
		constantes.consultaApi(controlador,parametros,function(json){
				
			$("#modalCrea").html(json);
			//actualiza el DOM
			$scope.compileAngularElement("#formAgregaParametros");
		},'');
	}

	//seguerir matriz
	$scope.crearnueva =function(){
		$('#modalMatriz').modal("show");
	 	var controlador = $scope.config.apiUrl+"MisMatrices/sugerirMatriz";
	 	var parametros  = "";
	 	constantes.consultaApi(controlador,parametros,function(json){
				
	 		$("#modalCreaNueva").html(json);
	 		// actualiza el DOM
	 		$scope.compileAngularElement("#formMatriz");
	 	},'');
	}







	// plantilla crea parametros a matriz
	  $scope.cargaPlantillaMatriz = function(idNuevaMatriz){	
	 	$('#modalMatriz').modal("show");
	 	var controlador = 	$scope.config.apiUrl+"CrearMatriz/actualizaMatriz";
	 	var parametros  = 	"idNuevaMatriz="+idNuevaMatriz;
	 	constantes.consultaApi(controlador,parametros,function(json){
				
	 		$("#modaldeMatriz").html(json);
	 		// actualiza el DOM
	 		$scope.compileAngularElement("#formMatriz");
	 	},'');
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