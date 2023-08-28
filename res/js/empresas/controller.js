/*
* Controlador que maneja todas las funcionalidades de la creación de usuarios
* @author Farez Prieto @orugal
* @date 15 de Noviembre de 2016
*/
project.controller('empresas', function($scope,$http,$q,constantes)
{
    $scope.initEmpresas = function(){
		$scope.config 			=  configLogin;//configuración global
		// $scope.consultaEmpresa();
    }
	
	$scope.verEmpresa = function($id){
		var controlador = $scope.config.apiUrl+"Empresas/infoEmpresa";
		var parametros = "idEmpresa="+$id;
		$.ajax({
			url: controlador,
			type: "POST",
			data: parametros,
			dataType: "json",
			success: function(response) {
				var data = response.datos[0];
				if(data){
					var ciudad = data.ciudad;
					var departamento = data.departamento;
					var email = data.email;
					console.log(data);
					if(ciudad === undefined || ciudad === null || ciudad === '') {
						constantes.alerta("Atención", "La empresa no cuenta con información completa, el email de contacto es: " + email, "warning", function() {});
					}else if(departamento === undefined || departamento === null || departamento === ''){
						constantes.alerta("Atención", "La empresa no cuenta con información completa, el email de contacto es: " + email, "warning", function() {});
					} else {
						window.location = $scope.config.apiUrl + "Empresas/empresa/37/"+$id;
					}
				} else {
					constantes.alerta("Atención","No hay datos de empresa","warning", function() {});
				}
			},error: function(xhr, textStatus, errorThrown) {
				console.log("Error en la petición: " + textStatus);
			}
		});
	}
	$scope.regresa =function(){
		window.location = $scope.config.apiUrl+"Empresas/empresas/37";
	}
	$scope.buscaEmpresa =function(){
		window.location = $scope.config.apiUrl+"BuscarEmpresas/consultaEmpresas";
	}
	$scope.matrices = function($id){
		//consulto primero si la empresa tiene matrices compradas.
		var controlador = $scope.config.apiUrl+"Empresas/matricesEmpresa";
		var parametros  = "idEmpresa="+$id;
		constantes.consultaApi(controlador,parametros,function(json){
			if(json.continuar == 1){
				//consulto que la empresa tenga la emebresia al dia
				var controlador = $scope.config.apiUrl+"Empresas/infoEmpresa";
				var parametros  = "idEmpresa="+$id;
				constantes.consultaApi(controlador,parametros,function(json){
					if(json.continuar == 1){
						window.location = $scope.config.apiUrl+"MisMatrices/home/43/"+$id;
					}
					else{
						constantes.alerta("Atención",json.mensaje,"warning",function(){});
					}
				});
			}
			else{
				constantes.alerta("Atención",json.mensaje,"warning",function(){});
			}
		});
	}

	//crea modal formulario de relacion de empresa con oficial de cumplimiento.
	$scope.relacionarEmpresa =function(){
		$('#modalRelEmpresa').modal("show");
	 	var controlador = 	$scope.config.apiUrl+"Empresas/creaRelacion";
	 	var parametros  = 	"";
	 	constantes.consultaApi(controlador,parametros,function(json){
	 		$("#modalRelCrea").html(json);
	 		$scope.compileAngularElement("#formRelEmpresa");
	 	},'');
	}
	

	//elimina matriz
	$scope.borraEmpresas = function($id){
		var idEmpresa =$id
		constantes.confirmacion("Confirmación","Esta apunto de eliminar la empresa, ¿Desea continuar?",'info',function(){
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
	

	//elimina relacion de oficial y empresa
	$scope.eliminaRel =function($id){
		var idEmpresa =$id
		constantes.confirmacion("Confirmación","Esta apunto de eliminar la empresa, recuerde que se eliminara todo tipo de relación. ¿Desea continuar?",'info',function(){
			var controlador = $scope.config.apiUrl+"Empresas/eliminaRel";
			var parametros  = {idEmpresa:$id}
			constantes.consultaApi(controlador,parametros,function(json){
				if(json.continuar == 1){
					constantes.alerta("Atención",json.mensaje,"success",function(){
						location.reload();
					});
				}else{
					constantes.alerta("Atención",json.mensaje,"warning",function(){});
				}
			});
		});
	}
	
	//crea la relacion de oficial de cumplimiento y empresa
	$scope.crearRelacion = function(){
		var idEmpresa = $("#idEmpresa").val();
		//var controlador = 	$scope.config.apiUrl+"Empresas/crearRel";
		if(idEmpresa == ""){
			constantes.alerta("Atención","Debe seleccionar una empresa","info",function(){});
		}else{
			constantes.confirmacion("Confirmación","Esta a punto de agregar una empresa, ¿Desea continuar?",'info',function(){
				//window.location = $scope.config.apiUrl+"Empresas/empresas/37";
				var controlador = 	$scope.config.apiUrl+"Empresas/crearRel";
				var parametros  = $("#formRelEmpresa").serialize();
				constantes.consultaApi(controlador,parametros,function(json){
					if(json.continuar == 1){
						constantes.alerta("Atención",json.mensaje,"success",function(){
							window.location = $scope.config.apiUrl+"Empresas/empresas/37";
						});
					}else{
						constantes.alerta("Atención",json.mensaje,"warning",function(){});
					}
				});
			});
		}
	}
	//modal de iniciar perido empresa
	$scope.periocidad =function(){
		$('#modalperiodo').modal("show");
	 	var controlador = 	$scope.config.apiUrl+"Empresas/periocidad";
	 	var parametros  = 	"";
	 	constantes.consultaApi(controlador,parametros,function(json){
	 		$("#modalRelCrea").html(json);
	 		$scope.compileAngularElement("#modalperiodo");
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