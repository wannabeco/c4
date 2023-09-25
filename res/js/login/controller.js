/*
* Controlador que maneja todas las funcionalidades del login del proyecto
* @author Farez Prieto @orugal
* @date 29 de Junio de 2016
*/
project.controller('login', function($scope,$http,$q,constantes)
{
	$scope.usuario 			= 	$("#usuario").val();
	$scope.clave 			= 	$("#clave").val();
	$scope.fotoLogin 		= 	"";

	$scope.loginInit = function()
	{
		$scope.config 			=  configLogin;//configuración global
		$scope.fotoLogin 		= 	$scope.config.apiUrl+"res/img/user.jpg";
	}
	$scope.getPicture = function()
	{
		var controlador = 	$scope.config.apiUrl+"Login/getPicture";
		var parametros  = "palabra="+$scope.usuario;
		constantes.consultaApi(controlador,parametros,function(json){
			if(json.continuar == 1)
			{
				//console.log(json.datos[0].icono);
				if(json.datos[0].icono != "" && json.datos[0].icono != null)
				{
					//alert(json.tipo)
					if(json.tipo == "empresas")
					{
						$scope.fotoLogin 		= 	$scope.configa.piUrl+"res/fotos/"+json.tipo+"/"+json.datos[0].idEmpresa+"/"+json.datos[0].icono;
						$scope.$digest();
					}
					else
					{
						$scope.fotoLogin 		= 	$scope.config.apiUrl+"res/fotos/"+json.tipo+"/"+json.datos[0].idPersona+"/"+json.datos[0].icono;
						$scope.$digest();
					}
				}
				else
				{
					$scope.fotoLogin 		= 	$scope.config.apiUrl+"res/img/user.jpg";
					$scope.$digest();
				}
			}
			else
			{
				$scope.fotoLogin 		= 	$scope.config.apiUrl+"res/img/user.jpg";
				$scope.$digest();	
			}
		});
	}
	$scope.loginInApp = function()
	{
		if($scope.usuario == "" || $scope.usuario == undefined)
		{
			constantes.alerta("Atención","Debe escribir el correo electrónico que registró","warning",function(){
				setTimeout(function(){$("#usuario").focus()});
			})
		}
		else if($scope.clave == "" || $scope.clave == undefined)
		{
			constantes.alerta("Atención","Debe escribir la clave que registró.","warning",function(){
				setTimeout(function(){$("#clave").focus()});
			})
		}
		else
		{
				//se inicia el login
				var controlador = 	$scope.config.apiUrl+"Login/verificaIngreso";
				var parametros  = 	$("#formLogin").serialize();
				constantes.consultaApi(controlador,parametros,function(json){
					if(json.continuar == 1)
					{
						//valido la zona
						if(json.zona == 1) //zona de pago
						{
							constantes.alerta("Atención",json.mensaje,"warning",function(){
								document.location = $scope.config.apiUrl+"Pago";
							})
						}
						else if(json.zona == 2)//ingreso
						{
							document.location = $scope.config.apiUrl+"App";
						}
						else
						{
							constantes.alerta("Atención",json.mensaje,"success",function(){
							
							})
						}
					}
					else
					{
						constantes.alerta("Atención",json.mensaje,"warning",function(){
							
						})
					}
				});
		}
	}
	$scope.recordarClaveUsuario = function()
	{
		var email = $("#usuario").val();

		//valido
		if(email == "")
		{
			constantes.alerta("Atención","Debe escribir el correo electrónico con el cual se ha registrado al sistema.","warning",function(){});
		}
		else if(email != "" && !constantes.validaMail(email))
		{
			constantes.alerta("Atención","El correo electrónico ingresado no es correcto, por favor verifique.","info",function(){})
		}
		else
		{
			constantes.confirmacion("Confirmación","Está a punto de generar una nueva clave para el usuario, esta seguro que desea continuar?",'info',function(){
				//se inicia el login
				var controlador = 	$scope.config.apiUrl+"Login/cambioClave";
				var parametros  = 	$("#formCambioClave").serialize();
				constantes.consultaApi(controlador,parametros,function(json){
					if(json.continuar == 1)
					{
						constantes.alerta("Atención",json.mensaje,"success",function(){
							document.location = $scope.config.apiUrl;
						})
					}
					else
					{
						constantes.alerta("Atención",json.mensaje,"warning",function(){
							
						})
					}
				});
			});
		}
	}
});
