/*
* Controlador que maneja todas las funcionalidades de la zona áreas
* @author Farez Prieto @orugal
* @date 01 de Julio de 2016
*/
project.controller('areas', function($scope,$http,$q,constantes)
{
	$scope.listaAreas = [];
	$scope.nombreArea = $("#nombreArea").val();
	$scope.areasInit = function()
	{
		$scope.config 			=  configLogin;//configuración global
		//cargo las areas
		$scope.getAreas();
	}
	$scope.getAreas = function()
	{
		var controlador = 	$scope.config.apiUrl+"Areas/getAreas";
		var parametros  = "palabra="+$scope.usuario;
		constantes.consultaApi(controlador,parametros,function(json){
			if(json.continuar == 1)
			{
				$scope.listaAreas		=	json.datos;
				$scope.$digest();
			}
			else
			{
				constantes.alerta("Atención",json.mensaje,"warning",function(){})
			}
		});
	}
	$scope.agregarNuevaArea = function()
	{
		//valido campos
		if($scope.nombreArea == "" || $scope.nombreArea == undefined)
		{
			constantes.alerta("Atención","Recuerde que debe escribir el nombre del área que va a crear","warning",function(){
				setTimeout(function(){$("#nombreArea").focus()});
			})
		}
		else
		{
			constantes.confirmacion("Atención","Está a punto de crear un área de servicio, desea continuar","info",function(){
				//se inicia el login
				var controlador = 	$scope.config.apiUrl+"Areas/creaNuevaArea";
				var parametros  = 	$("#formAreas").serialize();
				constantes.consultaApi(controlador,parametros,function(json){
					if(json.continuar == 1)
					{
						constantes.alerta("Atención",json.mensaje,"success",function(){
							$('#modalArea').modal('hide');
							$scope.getAreas();
							$("#nombreArea").val("");
						})
						
					}
					else
					{
						constantes.alerta("Atención",json.mensaje,"warning",function(){
							$('#modalArea').modal('hide');
							$("#nombreArea").val("");
						})
					}
				});
			})
		}
	}
	$scope.eliminaArea = function(results,index)
	{
		constantes.confirmacion("Atención","Está a punto de eliminar un área de servicio, desea continuar?","warning",function(){
			var areaBorrar = results[index].idArea;
			//se inicia el login
			var controlador = 	$scope.config.apiUrl+"Areas/borrarArea";
			var parametros  = 	"idArea="+Math.round(Math.random()*(100-999)+parseInt(999))+areaBorrar;
			constantes.consultaApi(controlador,parametros,function(json){
				if(json.continuar == 1)
				{
					swal.close();
					$scope.q = "";
					$scope.getAreas();
					$scope.$digest();
				}
				else
				{
					constantes.alerta("Atención",json.mensaje,"warning",function(){})
				}
			});
		})
	}
});
