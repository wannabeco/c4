/*
* Controlador que maneja todas las funcionalidades de la creación de usuarios
* @author Farez Prieto @orugal
* @date 15 de Noviembre de 2016
*/
project.controller('planes', function($scope,$http,$q,constantes)
{	
    $scope.initPlanes = function() {
		$scope.config = configLogin; // configuración global
	};
	$scope.Promocion = '0';

	//plantilla informacion de matriz
	$scope.creaPlanes = function($idPlan){	
		$('#modalCreaPlanes').modal("show");
		var controlador = 	$scope.config.apiUrl+"Planes/creaPlan";
		var parametros  = 	"idPlan="+$idPlan;
		constantes.consultaApi(controlador,parametros,function(json){
			$("#modalCrea").html(json);
			//actualiza el DOM
			$scope.compileAngularElement("#formCreaPlanes");
		},'');
	}
	//crear planes
	$scope.crearPlan =function($edita,$idPlan){
		var nombrePlan 		= $("#nombrePlan").val();
		var tituloPLan 		= $("#tituloPLan").val();
		var descripcion 	= $("#descripcion").val();
		var precio 			= $("#precio").val();
		var promocion 		= $("#promocion").val();
		var fechaInicio 	= $("#fechaInicio").val();
		var fechaFinaliza 	= $("#fechaFinaliza").val();
		var dirigido 		= $("#dirigido").val();
		var mesCobraYear 	= $("#mesCobraYear").val();
		if(nombrePlan == ""){
			constantes.alerta("Atención","Debe escribir un nombre del Plan.","info",function(){});
		}else if(tituloPLan == ""){
			constantes.alerta("Atención","Debe escribir el titulo del plan.","info",function(){});
		}else if(descripcion == ""){
			constantes.alerta("Atención","Debe escribir una pequeña descripcion del plan.","info",function(){});
		}else if(precio == ""){
			constantes.alerta("Atención","Debe escribir el precio del plan.","info",function(){});
		}else if(dirigido == ""){
			constantes.alerta("Atención","Debe Seleccionar para quien va dirigido el plan.","info",function(){});
		}else if(dirigido == 0 && mesCobraYear == 0){
			constantes.alerta("Atención","Debe escribir la cantidad de meses a cobrar el año.","info",function(){});
		}else if(promocion == 1 && fechaInicio == ""){
			constantes.alerta("Atención","Debe seleccionar una fecha de incio de la promoción.","info",function(){});
		}else if(promocion == 1 && fechaFinaliza == ""){
			constantes.alerta("Atención","Debe seleccionar una fecha donde finaliza de la promoción.","info",function(){});
		}else{
			if($edita == 0){
				constantes.confirmacion("Confirmación","Esta apunto de crear un plan, recuerde que el plan que tenga 0 usuarios y 0 checks, seran tomados como limitados. ¿desea continuar?",'info',function(){
					var controlador = $scope.config.apiUrl+"Planes/creaPlanes";
					var parametros  = 	$("#formCreaPlanes").serialize();
					constantes.consultaApi(controlador,parametros,function(json){
						if(json.continuar == 1){
							constantes.alerta("Atención",json.mensaje,"success",function(){
								window.location = $scope.config.apiUrl+"Planes/planes/45";
							});
						}else{
							constantes.alerta("Atención",json.mensaje,"warning",function(){});
						}
					});
				});
			}
			else if($edita == 1){
				constantes.confirmacion("Confirmación","Esta apunto de actualizar el plan, recuerde que el plan que tenga 0 usuarios y 0 checks, seran tomados como limitados. ¿desea continuar?",'info',function(){
					var controlador = $scope.config.apiUrl+"Planes/actualizaPlan";
					var parametros  = 	$("#formCreaPlanes").serialize()+"&idPlan="+$idPlan;
					constantes.consultaApi(controlador,parametros,function(json){
						if(json.continuar == 1){
							constantes.alerta("Atención",json.mensaje,"success",function(){
								window.location = $scope.config.apiUrl+"Planes/planes/45";
							});
						}else{
							constantes.alerta("info",json.mensaje,"warning",function(){});
						}
					});
				});
			}
		}
	}
	$scope.BorrarPlan =function($id){
		constantes.confirmacion("Confirmación","Esta apunto de eliminar el plan, ¿desea continuar?",'info',function(){
			var controlador = $scope.config.apiUrl+"Planes/eliminaPLan";
			var parametros  = 	"idPlan="+$id;
			constantes.consultaApi(controlador,parametros,function(json){
				if(json.continuar == 1){
					constantes.alerta("Atención",json.mensaje,"success",function(){
						window.location = $scope.config.apiUrl+"Planes/planes/45";
					});
				}else{
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