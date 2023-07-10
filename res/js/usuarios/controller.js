/*
* Controlador que maneja todas las funcionalidades de la creación de usuarios
* @author Farez Prieto @orugal
* @date 15 de Noviembre de 2016
*/
project.controller('usuariosApp', function($scope,$http,$q,constantes)
{
	$scope.usuarios 	= [];
	$scope.padreModulo	=	"";
	$scope.initUsuarios = function()
	{
		$scope.config 			=  configLogin;//configuración global
		$scope.getUsuarios();
	}

	$scope.getUsuarios = function(idUsuario,edita)
	{
		var controlador = 	$scope.config.apiUrl+"Usuarios/getUsuarios";
		var parametros  = 	"";
		constantes.consultaApi(controlador,parametros,function(json){
			$scope.usuarios  = json.datos;
			$scope.$digest();
		});
	}
	/*
	* Me abre una plantilla que me permitira editar o crear los módulos
	*/
	$scope.cargaPlantillaControl = function(idUsuario,edita)
	{
		$('#modalUsuarios').modal("show");
		var controlador = 	$scope.config.apiUrl+"Usuarios/cargaPlantillaCreacionUsuarios";
		var parametros  = 	"edita="+edita+"&idUsuario="+idUsuario;
		constantes.consultaApi(controlador,parametros,function(json){
				
			$("#modalCrea").html(json);
			//actualiza el DOM
			$scope.compileAngularElement("#formAgregaPersona");
		},'');
	}

	$scope.borraUsuario = function(idUsuario)
	{
		constantes.confirmacion("Confirmación","Está seguro que desea borrar el usuario seleccionado? Recuerde que podra Inactivarlo para no cumplir funciones",'info',function()
		{
			var controlador = 	$scope.config.apiUrl+"Usuarios/borraUsuario";
			var parametros  = 	"idUsuario="+idUsuario;
			constantes.consultaApi(controlador,parametros,function(json){
					
					if(json.continuar == 1)
					{
						constantes.alerta("Atención",json.mensaje,"success",function(){
							location.reload();
						})
					}
					else
					{
						constantes.alerta("Atención",json.mensaje,"warning",function(){})
					}
			});
		});
	}
	$scope.generaDatosAcceso = function(idUsuario)
	{
		constantes.confirmacion("Confirmación","Está seguro que desea generar usuario y clave de acceso a este usuario?",'info',function()
		{
			var controlador = 	$scope.config.apiUrl+"Usuarios/generaDatosAcceso";
			var parametros  = 	"idUsuario="+idUsuario;
			constantes.consultaApi(controlador,parametros,function(json){
					
					if(json.continuar == 1)
					{
						constantes.alerta("Atención",json.mensaje,"success",function(){
							location.reload();
						})
					}
					else
					{
						constantes.alerta("Atención",json.mensaje,"warning",function(){})
					}
			});
		});
	}
	$scope.procesaUsuario = function(edita)
	{
		var tipoDocumento		=	$("#tipoDocumento").val();
		var nroDocumento		=	$("#nroDocumento").val();
		var nombre				=	$("#nombre").val();
		var apellido			=	$("#apellido").val();
		var direccion			=	$("#direccion").val();
		var telefono			=	$("#telefono").val();
		var idSexo				=	$("#idSexo").val();
		var idProfesion			=	$("#idProfesion").val();
		var idArea				=	$("#idArea").val();
		var idCargo				=	$("#idCargo").val();
		var tarjetaProfesional	=	$("#tarjetaProfesional").val();
		var email				=	$("#email").val();
		var tipoUsuario			=	$("#tipoUsuario").val();
		var idCargo				=	$("#idCargo").val();
		var idPerfil			=	$("#idPerfil").val();
		var estado				=	(edita == 1)?$("#estado").val():"1";
		var idUsuario			=	(edita == 1)?$("#idUsuario").val():"";
		//empiezo la validación de campos que será la misma si es editar que si es crear
		if(tipoDocumento == "")
		{
			constantes.alerta("Atención","Debe seleccionar un tipo de documento.","info",function(){})
		}
		else if(nroDocumento == "")
		{
			constantes.alerta("Atención","Debe escribir el número de documento de identidad.","info",function(){})
		}
		else if(nroDocumento != "" && isNaN(nroDocumento))
		{
			constantes.alerta("Atención","El documento de identidad debe contener sólo números.","info",function(){})
		}
		else if(nombre == "")
		{
			constantes.alerta("Atención","Debe escribir el nombre del usuario.","info",function(){})
		}
		else if(apellido == "")
		{
			constantes.alerta("Atención","Debe escribir el apellido del usuario.","info",function(){})
		}
		else if(telefono != "" && isNaN(telefono))
		{
			constantes.alerta("Atención","El teléfono debe contener sólo números.","info",function(){})
		}
		else if(idSexo == "")
		{
			constantes.alerta("Atención","Debe seleccionar el sexo del usuario.","info",function(){})
		}
		else if(idProfesion == "")
		{
			constantes.alerta("Atención","Debe seleccionar la profesión del usuario.","info",function(){})
		}
		else if(idArea == "")
		{
			constantes.alerta("Atención","Debe seleccionar el área donde se asignará el usuario.","info",function(){})
		}
		else if(idCargo == "")
		{
			constantes.alerta("Atención","Debe seleccionar el cargo que desempeñará el usuario.","info",function(){})
		}
		else if(email == "")
		{
			constantes.alerta("Atención","Es importante escribir un correo electrónico valido ya que este será el usuario de acceso al sistema para el usuario.","info",function(){})
		}
		else if(email != "" && !constantes.validaMail(email))
		{
			constantes.alerta("Atención","El correo electrónico ingresado no es correcto, por favor verifique.","info",function(){})
		}
		else if(tipoUsuario == "")
		{
			constantes.alerta("Atención","Por favor seleccione si el usuario será administrativo u operativo.","info",function(){})
		}
		else if(idPerfil == "")
		{
			constantes.alerta("Atención","Seleccione el perfil del usuario, de esto dependerá lo que pueda realizar en la aplicación.","info",function(){})
		}
		else
		{

			var texto = (edita==1)?"Está apunto de editar la información del usuario, desea continuar?":"Está a punto de insertar un nuevo usuario, desea continuar?";
			constantes.confirmacion("Confirmación",texto,'info',function(){
				var controlador = 	$scope.config.apiUrl+"Usuarios/procesaUsuarios";
				var parametros  = 	$("#formAgregaPersona").serialize()+"&edita="+edita;
				constantes.consultaApi(controlador,parametros,function(json){
					if(json.continuar == 1)
					{
						constantes.alerta("Atención",json.mensaje,"success",function(){
							location.reload();
						})
					}
					else
					{
						constantes.alerta("Atención",json.mensaje,"warning",function(){})
					}
					
				});
			});


			
		}
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


project.controller('procesaGuardado', function($scope,$http,$q,constantes)
{
	$scope.config 			=  configLogin;//configuración global
	
	$('#fechaIngreso').datetimepicker({
            format: 'YYYY-MM-DD'
    });
    $('#fechaNacimiento').datetimepicker({
            format: 'YYYY-MM-DD'
    });



	$scope.procesaUsuario = function(edita)
	{
		var tipoDocumento		=	$("#tipoDocumento").val();
		var nroDocumento		=	$("#nroDocumento").val();
		var ciudadExpedicionCedula		=	$("#ciudadExpedicionCedula").val();
		var fechaNacimiento		=	$("#fechaNacimiento").val();
		var nombre				=	$("#nombre").val();
		var apellido			=	$("#apellido").val();
		var direccion			=	$("#direccion").val();
		var telefono			=	$("#telefono").val();
		var celular				=	$("#celular").val();
		var idSexo				=	$("#idSexo").val();
		var idProfesion			=	$("#idProfesion").val();
		var idArea				=	$("#idArea").val();
		var idCargo				=	$("#idCargo").val();
		var tarjetaProfesional	=	$("#tarjetaProfesional").val();
		var email				=	$("#email").val();
		var tipoUsuario			=	$("#tipoUsuario").val();
		var idCargo				=	$("#idCargo").val();
		var contrato			=	$("#contrato").val();
		var salario				=	$("#salario").val();
		var idPerfil			=	$("#idPerfil").val();
		var estado				=	(edita == 1)?$("#estado").val():"1";
		var idUsuario			=	(edita == 1)?$("#idUsuario").val():"";
		//empiezo la validación de campos que será la misma si es editar que si es crear
		// if(tipoDocumento == "")
		// {
		// 	constantes.alerta("Atención","Debe seleccionar un tipo de documento.","info",function(){})
		// }
		// else if(nroDocumento == "")
		// {
		// 	constantes.alerta("Atención","Debe escribir el número de documento de identidad.","info",function(){})
		// }
		// else if(nroDocumento != "" && isNaN(nroDocumento))
		// {
		// 	constantes.alerta("Atención","El documento de identidad debe contener sólo números.","info",function(){})
		// }
		// else if(ciudadExpedicionCedula == "")
		// {
		// 	constantes.alerta("Atención","Seleccione la ciudad de expedición de su documento.","info",function(){})
		// }
		// else if(fechaNacimiento == "")
		// {
		// 	constantes.alerta("Atención","Seleccione la fecha de nacimiento del usuario.","info",function(){})
		// }
		if(nombre == "")
		{
			constantes.alerta("Atención","Debe escribir el nombre del usuario.","info",function(){})
		}
		else if(apellido == "")
		{
			constantes.alerta("Atención","Debe escribir el apellido del usuario.","info",function(){})
		}
		// else if(telefono != "" && isNaN(telefono))
		// {
		// 	constantes.alerta("Atención","El teléfono debe contener sólo números.","info",function(){})
		// }
		// else if(celular != "" && isNaN(celular))
		// {
		// 	constantes.alerta("Atención","El celular debe contener sólo números.","info",function(){})
		// }
		else if(idSexo == "")
		{
			constantes.alerta("Atención","Debe seleccionar el sexo del usuario.","info",function(){})
		}
		// else if(idProfesion == "")
		// {
		// 	constantes.alerta("Atención","Debe seleccionar la profesión del usuario.","info",function(){})
		// }
		// else if(idArea == "")
		// {
		// 	constantes.alerta("Atención","Debe seleccionar el área donde se asignará el usuario.","info",function(){})
		// }
		// else if(idCargo == "")
		// {
		// 	constantes.alerta("Atención","Debe seleccionar el cargo que desempeñará el usuario.","info",function(){})
		// }
		else if(email == "")
		{
			constantes.alerta("Atención","Es importante escribir un correo electrónico valido ya que este será el usuario de acceso al sistema para el usuario.","info",function(){})
		}
		else if(email != "" && !constantes.validaMail(email))
		{
			constantes.alerta("Atención","El correo electrónico ingresado no es correcto, por favor verifique.","info",function(){})
		}
		else if(tipoUsuario == "")
		{
			constantes.alerta("Atención","Por favor seleccione si el usuario será administrativo u operativo.","info",function(){})
		}
		else if(idPerfil == "")
		{
			constantes.alerta("Atención","Seleccione el perfil del usuario, de esto dependerá lo que pueda realizar en la aplicación.","info",function(){})
		}
		else
		{

			var texto = (edita==1)?"Está apunto de editar la información del usuario, desea continuar?":"Está a punto de insertar un nuevo usuario, desea continuar?";
			constantes.confirmacion("Confirmación",texto,'info',function(){
				var controlador = 	$scope.config.apiUrl+"Usuarios/procesaUsuarios";
				var parametros  = 	$("#formAgregaPersona").serialize()+"&edita="+edita;
				constantes.consultaApi(controlador,parametros,function(json){
					if(json.continuar == 1)
					{
						constantes.alerta("Atención",json.mensaje,"success",function(){
							location.reload();
						})
					}
					else
					{
						constantes.alerta("Atención",json.mensaje,"warning",function(){})
					}
					
				});
			});


			
		}
	}
});