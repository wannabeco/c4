/*
* Controlador que maneja todas las funcionalidades de la creación de usuarios
* @author Farez Prieto @orugal
* @date 15 de Noviembre de 2016
*/
project.controller('pagos', function($scope,$http,$q,constantes)
{	
    $scope.initpagos = function() {
		$scope.config = configLogin; // configuración global
	};

	$scope.cierraPop =function(){
		$window.close();
	}


	//pago matrices
	$scope.pagaMatrices =function($datos){
		var controlador = $scope.config.apiUrl+"Pagos/pagoMatrices";
		var parametros  = "datos="+$datos;
		constantes.consultaApi(controlador,parametros,function(json){
			if(json.continuar == 1){
				constantes.alerta("Atención","el pago se ha registrado correctamente",'info',function(){});
			}
			else{
				constantes.alerta("Atención",json.mensaje,"warning",function(){});
			}
			
		});
		this.close();

	}
	//pago empresas
	$scope.pagaMatrices =function($datos){
		var controlador = $scope.config.apiUrl+"Pagos/pagoMatrices";
		var parametros  = "datos="+$datos;
		constantes.consultaApi(controlador,parametros,function(json){
			if(json.continuar == 1){
				constantes.alerta("Atención","el pago se ha registrado correctamente",'info',function(){});
			}
			else{
				constantes.alerta("Atención",json.mensaje,"warning",function(){});
			}
			
		});
		this.close();
	}

});