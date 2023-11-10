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
		
	$scope.verMatriz = function($id,$idEmpresa,$idPeriocidad){
		var idEmpresa = $idEmpresa;
		var controlador = $scope.config.apiUrl+"InfomarcionMatriz/consultoR?idmatriz="+$id;
		var parametros = "";
		$.ajax({
			url: controlador,
			type: "POST",
			data: parametros,
			dataType: "json",
			success: function(response) {
				if(response == ""){
					constantes.alerta("Atención","El check se encuentra en construcción.","info",function(){});
				}
				else{
					window.location = $scope.config.apiUrl+"MisMatrices/informacion/42/"+$id+"/"+idEmpresa+"/"+$idPeriocidad;
				}
			$scope.$apply();
			}
		});
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
			constantes.alerta("Atención","Debe escribir un nombre del check.","info",function(){});
		}else if(dirigida == ""){
			constantes.alerta("Atención","Debe seleccionar Tipo Plantilla.","info",function(){});
		}else if(gratis == ""){
			constantes.alerta("Atención","Debe seleccionar si el check sera gratis al registrar la empresa.","info",function(){});
		}else if(dirigida == 2 && tipoEmpresa == ""){
			constantes.alerta("Atención","Debe seleccionar el tipo de empresa","info",function(){});
		}else{
			constantes.confirmacion("Confirmación","Esta apunto de crear un check, ¿Desea continuar?",'info',function(){
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

	$scope.borraMatriz = function($idNuevaMatriz, $idEmpresa){
		constantes.confirmacion("Confirmación","Esta apunto de eliminar un check, ¿Desea continuar?",'info',function(){
			var controlador = $scope.config.apiUrl+"MisMatrices/eliminaMatrizComprada";
			var parametros  = "idMatriz="+$idNuevaMatriz+"&idEmpresa="+$idEmpresa;
			constantes.consultaApi(controlador,parametros,function(json){
				if(json.continuar == 1){
					constantes.alerta("Atención",json.mensaje,"success",function(){
						window.location = $scope.config.apiUrl+"MisMatrices/matrices/43/"+$idEmpresa+"/0";
					});
				} else {
					constantes.alerta("Atención",json.mensaje,"warning",function(){});
				}
			});
		});
	}

	// plantilla crea parametros a matriz
	$scope.cargaPlantillaMatriz = function(idNuevaMatriz){	
		$('#modalMatriz').modal("show");
		var controlador = 	$scope.config.apiUrl+"CrearMatriz/actualizaMatriz";
		var parametros  = 	"idNuevaMatriz="+idNuevaMatriz;
		constantes.consultaApi(controlador,parametros,function(json){
			$("#modaldeMatriz").html(json);
			$scope.compileAngularElement("#formMatriz");
		},'');
	}
	// periocidad de la matriz o check
	$scope.periocidad = function(idRelPeriocidad,edita){
		$('#modalPeriocidad').modal("show");
		var controlador = 	$scope.config.apiUrl+"MisMatrices/modalPeriocidad";
		var parametros  = 	"edita="+edita+"&idRelPeriocidad="+idRelPeriocidad;
		constantes.consultaApi(controlador,parametros,function(json){
			$("#modaldePeriocidad").html(json);
			$scope.compileAngularElement("#creaPeriocidad");
		},'');
	}
	//crear nueva periocidad
	$scope.crearPeriocidad = function(){
		var idperiodicidad 	= $('#idperiodicidad').val();
		var nombreRel      	= $('#nombreRel').val();
		var edita      		= $('#editar').val();
		var idRelPeriocidad	= $('#idRelPeriocidad').val();
		if(idperiodicidad == ""){
			constantes.alerta("Atención","Debe seleccionar un periodo de checks.","info",function(){});
		}else if(nombreRel == ""){
			constantes.alerta("Atención","Debe agregar una descripcion","info",function(){});
		}else if(nombreRel.length > 30){
			constantes.alerta("Atención","La descripción no debe ser mayor a 30 caracteres.","info",function(){});
		}else{
			if(edita == 1){
				constantes.confirmacion("Confirmación","Esta apunto de actualizar, ¿Desea continuar?",'info',function(){
					var controlador = $scope.config.apiUrl+"MisMatrices/crearRelPeriocidad";
					var parametros  = 	"edita="+edita+"&idRelPeriocidad="+idRelPeriocidad+"&"+$("#creaPeriocidad").serialize();
					constantes.consultaApi(controlador,parametros,function(json){
						if(json.continuar == 1){
							constantes.alerta("Atención",json.mensaje,"success",function(){
								$scope.recargar();
							});
						}
						else{
							constantes.alerta("Atención",json.mensaje,"warning",function(){});
						}
					});
				});
			}else{
				constantes.confirmacion("Confirmación","Esta apunto de crear el periodo de check, ¿Desea continuar?",'info',function(){
					var controlador = $scope.config.apiUrl+"MisMatrices/crearRelPeriocidad";
					var parametros  = "edita="+edita+"&"+$("#creaPeriocidad").serialize();
					constantes.consultaApi(controlador,parametros,function(json){
						if(json.continuar == 1){
							constantes.alerta("Atención",json.mensaje,"success",function(){
								$scope.recargar();
							});
						}
						else{
							constantes.alerta("Atención",json.mensaje,"warning",function(){});
						}
					});
				});
			}
		}
	}
	//elimino la periocidad
	$scope.borraPeriocidad = function($idRelPeriocidad){
		constantes.confirmacion("Confirmación","Esta apunto de eliminar la periocidad, ¿Desea continuar?",'info',function(){
			var controlador = $scope.config.apiUrl+"MisMatrices/borraPeriocidad";
			var parametros  = "idRelPeriocidad="+$idRelPeriocidad;
			constantes.consultaApi(controlador,parametros,function(json){
				if(json.continuar == 1){
					constantes.alerta("Atención",json.mensaje,"success",function(){
						$scope.recargar();
					});
				} else {
					constantes.alerta("Atención",json.mensaje,"warning",function(){});
				}
			});
		});
	}
	//ingreso a ver mis matrices
	$scope.verMatrices = function($id,$idEmpresa){
		window.location = $scope.config.apiUrl+"MisMatrices/matrices/43/"+$idEmpresa+"/"+$id;
	}
	//modal de creo mi propio check
	$scope.creoMiCheck =function(){
		$('#miNuevocheck').modal("show");
	 	var controlador = $scope.config.apiUrl+"MisMatrices/creoMiCheck";
	 	var parametros  = "edita="+0;
	 	constantes.consultaApi(controlador,parametros,function(json){
	 		$("#modalmiNuevocheck").html(json);
	 		// actualiza el DOM
	 		$scope.compileAngularElement("#agregaNuevaMatriz");
	 	},'');
	}

	$scope.compileAngularElement = function(elSelector) {
        var elSelector = (typeof elSelector == 'string') ? elSelector : null ;  
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