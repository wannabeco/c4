/*
* Controlador que maneja todas las funcionalidades de la creación de usuarios
* @author Farez Prieto @orugal
* @date 15 de Noviembre de 2016
*/
project.controller('pagos', function($scope,$http,$q,constantes)
{	
    $scope.initpagos = function() {
		$scope.config = configLogin; // configuración global
		$scope.membresiaPlan = 'mes';
	};


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
	}
	$scope.pagoEmpresa = function($dataEmpresa,$idPlan,$duracion){
		var proveedor 	= "payu";
		var idPlan	  	= $idPlan
		var duracion   	= $duracion
		constantes.confirmacion("Atención","Esta apunto de realizar el pago, ¿Desea continuar?. Recuerde activar las ventanas emergentes antes de continuar.",'info',function(){
			//verifico que la empresa cumpla con los datos necesarios, si no, sera enviado actualizar datos
			var controlador = $scope.config.apiUrl+"Empresas/infoEmpresaid";
			var parametros  = "idEmpresa="+$dataEmpresa;
			constantes.consultaApi(controlador,parametros,function(json){
				var informacion = json.datos;
				var data = informacion[0];
				if(data.nroDocumento !== null && data.nroDocumento !== ""){
					//agrego pago a pedido temporal
					var controlador = $scope.config.apiUrl+"PagoMatriz/pagoMensualidadEmpresa";
					var parametros  = "proveedor="+proveedor+"&dataEmpresa="+$dataEmpresa;
					constantes.consultaApi(controlador,parametros,function(json){
						if(json.continuar == 1){
							var idPago = json.datos;		
							//se abre pop
							var ventana ="";
							var pago ="Mensualidad empresas";								
							var parametro = "idPago="+ idPago+"&pago="+pago+"&idPLan="+idPlan+"&duracion="+duracion;
							var ruta = $scope.config.apiUrl+"Pagos/procesoPagoOnline/?"+parametro;
							var ventana = window.open(ruta, "pago_payu" , "width=600,height=880,left = 420");
							var tiempo= 0;
								var interval = setInterval(function(){
									if(ventana.closed !== false) {
										window.clearInterval(interval);
										window.location.assign($scope.config.apiUrl+"MisMatrices/home/43/"+$dataEmpresa+"/0"); 
									} else {
										tiempo +=1;
									}
							},1000);
						}
						else
						{
						constantes.alerta("Atención",json.mensaje,"error",function(){});
						}
					});
				}
				else{
					var texto = "Para realizar el pago, es necesario completar toda la informacion de la empresa.";
					constantes.confirmacion("Confirmación",texto,'info',function(){
						window.location.assign($scope.config.apiUrl+"PerfilUsuario/datosEmpresa");
					});
				}

			});
		});
	}
	$scope.pagoOficialC = function($dataPersona){
		var proveedor = "payu";
		constantes.confirmacion("Atención","Esta apunto de realizar el pago, ¿Desea continuar?. Recuerde activar las ventanas emergentes antes de continuar.",'info',function(){
			//verifico que la empresa cumpla con los datos necesarios, si no, sera enviado actualizar datos
			var controlador = $scope.config.apiUrl+"Empresas/infoUsuarioid";
			var parametros  = "idPersona="+$dataPersona;
			constantes.consultaApi(controlador,parametros,function(json){
				var informacion = json.datos;
				var data = informacion[0];
				if(data.nroDocumento !== null && data.nroDocumento !== ""){
					//agrego pago a pedido temporal
					var controlador = $scope.config.apiUrl+"PagoMatriz/pagoMensualidadOficial";
					var parametros  = "proveedor="+proveedor+"&idPersona="+$dataPersona;
					constantes.consultaApi(controlador,parametros,function(json){
						if(json.continuar == 1){
							var idPago = json.datos;		
							//se abre pop
							var ventana ="";
							var pago ="Mensualidad Oficial";								
							var parametro = "idPago="+idPago+"&pago="+pago;
							var ruta = $scope.config.apiUrl+"Pagos/procesoPagoOnline/?"+parametro;
							var ventana = window.open(ruta, "pago_payu" , "width=600,height=880,left = 420");
							var tiempo= 0;
								var interval = setInterval(function(){
									if(ventana.closed !== false) {
										window.clearInterval(interval);
										window.location.assign($scope.config.apiUrl+"Empresas/empresas/37"); 
									} else {
										tiempo +=1;
									}
							},1000);
						}
						else
						{
						constantes.alerta("Atención",json.mensaje,"error",function(){})
						}
					});
				}
				else{
					var texto = "Para realizar el pago, es necesario completar toda la informacion.";
					constantes.confirmacion("Confirmación",texto,'info',function(){
						window.location.assign($scope.config.apiUrl+"PerfilUsuario/datosUsuario");
					});
				}

			});
		});
	}

});