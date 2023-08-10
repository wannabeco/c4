/*
* Controlador que maneja todas las funcionalidades de la creación de usuarios
* @author Farez Prieto @orugal
* @date 15 de Noviembre de 2016
*/
project.controller('creaEmpresa', function($scope,$http,$q,constantes)
{
    $scope.initcreaEmpresa = function()
    {	
		$scope.config 			=  configLogin;//configuración global
		
    }

	$scope.isFirstRadioSelected = true;
	$scope.registro = 1;

	$scope.registraEmpresa = function(){	
		var nombre       		=   $('#nombre').val();
		var tipoEmpresa 		=   $('#tipoEmpresa').val();
		var nombreUsuario		=	$("#nombreUsuario").val();
		var apellido			=	$("#apellido").val();
		var email				=	$("#email").val();
		var clave				=	$("#clave").val();
		var rclave				=	$("#rclave").val();
		
		//empiezo la validación de campos que será la misma si es editar que si es crear
		if(nombre == ""){
			constantes.alerta("Atención","Debe escribir el nombre de la empresa.","info",function(){})
		}
		else if(tipoEmpresa <= 0){
			constantes.alerta("Atención","Debe seleccionar el tipo de empresa.","info",function(){})
		}
		else if(nombreUsuario == ""){
			constantes.alerta("Atención","Debe escribir el nombre del usuario.","info",function(){})
		}
		else if(apellido == ""){
			constantes.alerta("Atención","Debe escribir el apellido del usuario.","info",function(){})
		}
		else if(email == ""){
			constantes.alerta("Atención","Es importante escribir un correo electrónico valido ya que este será el usuario de acceso al sistema para el usuario.","info",function(){})
		}
		else if(email != "" && !constantes.validaMail(email)){
			constantes.alerta("Atención","El correo electrónico ingresado no es correcto, por favor verifique.","info",function(){})
		}
		else if(clave == ""){
			constantes.alerta("Atención","La contraseña es requerica, por favor verifique.","info",function(){})
		}
		else if(rclave == ""){
			constantes.alerta("Atención","Es necesario que repita la contraseña, por favor verifique.","info",function(){})
		}
		else if(rclave != clave){
			constantes.alerta("Atención","Las contraseñas no coinsiden, por favor verifique.","info",function(){})
		}
		else{
			constantes.confirmacion("Confirmación","Esta apunto de crear una empresa, ¿desea continuar?",'info',function(){
				//$scope.cracion("Creando empresa",10000);
				var controlador = $scope.config.apiUrl+"Registro/insertaEmpresaNueva";
				var parametros  = 	$("#dataEmpresa").serialize();
					constantes.consultaApi(controlador,parametros,function(json){
						if(json.continuar == 1){
							var usuario = json.datos[0]["usuario"];
							var clave 	= atob(json.datos[0]["clave64"]);
							constantes.alerta("Atención",json.mensaje,"success",function(){
								window.location = $scope.config.apiUrl+"Login/verificaIngresoDos/"+encodeURIComponent(usuario)+"/"+encodeURIComponent(clave);
							});
						}
						else{
							constantes.alerta("Atención",json.mensaje,"warning",function(){});
						}
					});
			});
		}
	}

	$scope.registraOficial = function(){
		var nombreUsuarios		=	$("#nombreUsuarios").val();
		var apellidos			=	$("#apellidos").val();
		var celular				=	$("#celular").val();
		// var empresa 			=   $('#empresa').val();
		var email				=	$("#email").val();
		var clave				=	$("#clave").val();
		var rclave				=	$("#rclave").val();

		if(nombreUsuarios == ""){
			constantes.alerta("Atención","Debe escribir el nombre del usuario.","info",function(){});
		}else if(apellidos == ""){
			constantes.alerta("Atención","Debe escribir el apellido del usuario.","info",function(){});
		}
		// else if(empresa <= 0){
		// 	constantes.alerta("Atención","Debe seleccionar la empresa.","info",function(){})
		// }
		else if(celular == ""){
			constantes.alerta("Atención","El numero de celular es requerido.","info",function(){});
		}else if(isNaN(celular)){
			constantes.alerta("Atención","El numero de celular no es valido, por favor verifique.","info",function(){});
		}else if(celular.length < 10){
			constantes.alerta("Atención","El numero de celular no es valido, por favor verifique.","info",function(){});
		}else if(celular.length > 10){
			constantes.alerta("Atención","El numero de celular no es valido, por favor verifique.","info",function(){});
		}else if(email == ""){
			constantes.alerta("Atención","Es importante escribir un correo electrónico valido ya que este será el usuario de acceso al sistema para el usuario.","info",function(){});
		}else if(email != "" && !constantes.validaMail(email)){
			constantes.alerta("Atención","El correo electrónico ingresado no es correcto, por favor verifique.","info",function(){});
		}else if(clave == ""){
			constantes.alerta("Atención","La contraseña es requerica, por favor verifique.","info",function(){});
		}else if(rclave == ""){
			constantes.alerta("Atención","Es necesario que repita la contraseña, por favor verifique.","info",function(){});
		}else if(rclave != clave){
			constantes.alerta("Atención","Las contraseñas no coinsiden, por favor verifique.","info",function(){});
		}
		else{
			constantes.confirmacion("Confirmación","Esta apunto de registrarse como Oficial de cumplimiento, ¿desea continuar?",'info',function(){
				var controlador = $scope.config.apiUrl+"Registro/creaOficial";
				var parametros  = 	$("#dataOficial").serialize();
					constantes.consultaApi(controlador,parametros,function(json){
						if(json.continuar == 1){
							// var usuario = json.datos[0]["usuario"];
							// var clave 	= atob(json.datos[0]["clave64"]);
							constantes.alerta("Atención",json.mensaje,"success",function(){
								// window.location = $scope.config.apiUrl+"Login/verificaIngresoDos/"+encodeURIComponent(usuario)+"/"+encodeURIComponent(clave);
								window.location = $scope.config.apiUrl+"Login";
							});
						}
						else{
							constantes.alerta("Atención",json.mensaje,"warning",function(){});
						}
						
					});
			});
		}
	}
});