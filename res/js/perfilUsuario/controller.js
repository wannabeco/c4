/*
* Controlador que maneja todas las funcionalidades de la creación de usuarios
* @author Farez Prieto @orugal
* @date 15 de Noviembre de 2016
*/
project.controller('perfilUsuario', function($scope,$http,$q,constantes)
{
    $scope.initPerfilUsuarios = function()
    {
		$scope.config 			=  configLogin;//configuración global
	    $('#fechaNacimiento').datetimepicker({
	            format: 'YYYY-MM-DD'
	    });
    }


	$scope.procesaDataUsuario = function(edita)
	{
		var tipoDocumento		=	$("#tipoDocumento").val();
		var nroDocumento		=	$("#nroDocumento").val();
		var nombre				=	$("#nombre").val();
		var apellido			=	$("#apellido").val();
		var fechaNacimiento		=	$("#fechaNacimiento").val();
		var direccion			=	$("#direccion").val();
		var barrio				=	$("#barrio").val();
		var telefono			=	$("#telefono").val();
		var celular				=	$("#celular").val();
		var idSexo				=	$("#idSexo").val();
		var email				=	$("#email").val();
		var edita 				=   1;
		
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
		else if(fechaNacimiento == "")
		{
			constantes.alerta("Atención","Seleccione la fecha de nacimiento del usuario.","info",function(){})
		}
		else if(telefono != "" && isNaN(telefono))
		{
			constantes.alerta("Atención","El teléfono debe contener sólo números.","info",function(){})
		}
		else if(celular != "" && isNaN(celular))
		{
			constantes.alerta("Atención","El celular debe contener sólo números.","info",function(){})
		}
		else if(idSexo == "")
		{
			constantes.alerta("Atención","Debe seleccionar el sexo del usuario.","info",function(){})
		}
		else if(email == "")
		{
			constantes.alerta("Atención","Es importante escribir un correo electrónico valido ya que este será el usuario de acceso al sistema para el usuario.","info",function(){})
		}
		else if(email != "" && !constantes.validaMail(email))
		{
			constantes.alerta("Atención","El correo electrónico ingresado no es correcto, por favor verifique.","info",function(){})
		}
		else
		{

			var texto = (edita==1)?"Está apunto de editar la información del usuario, desea continuar?":"Está a punto de insertar un nuevo usuario, desea continuar?";
			constantes.confirmacion("Confirmación",texto,'info',function(){
				var controlador = 	$scope.config.apiUrl+"Usuarios/procesaUsuarios";
				var parametros  = 	$("#dataUsuario").serialize()+"&edita="+edita;
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
	$scope.cambioFotoPerfil = function()
	{
		constantes.confirmacion("Confirmación","Está a punto de cargar una foto a su perfil, desea continuar?",'info',function()
		{
				var formData 	=   new FormData($("#formFotoPerfil")[0]);
		        var controlador = 	$scope.config.apiUrl+"PerfilUsuario/cambiafotoPerfil"; 
		        //hacemos la petición ajax  
		        parametros	=	formData;
		        $.ajax({
		            url: controlador,  
		            type: 'POST',
		            data: parametros,
		            dataType:"json",
		            cache: false,
		            contentType: false,
		            processData: false,
		            beforeSend: function(){
		                     
		            },
		            //una vez finalizado correctamente
		            success: function(json)
		            {
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
		            },
		            //si ha ocurrido un error
		            error: function(){
		              
		            }
		        });
		});
	}

	$scope.cambioClaveUsuario = function()
	{
		var claveActual		=	$("#claveActual").val();
		var nClave			=	$("#nClave").val();
		var rClave			=	$("#rClave").val();
		var edita 			=	1;
		//validación

		//empiezo la validación de campos que será la misma si es editar que si es crear
		if(claveActual == "")
		{
			constantes.alerta("Atención","Debe escribir su contraseña actual.","info",function(){})
		}
		else if(nClave == "")
		{
			constantes.alerta("Atención","Debe escribir su nueva contraseña.","info",function(){})
		}
		else if(rClave == "")
		{
			constantes.alerta("Atención","Debe repetir su nueva contraseña.","info",function(){})
		}
		else if(nClave != rClave)
		{
			constantes.alerta("Atención","Las contraseñas no coinciden, inténtelo de nuevo.","info",function(){})
		}
		else
		{

			var texto = "Está a punto de actualizar su contraseña de ingreso, desea continuar?";
			constantes.confirmacion("Confirmación",texto,'info',function(){
				var controlador = 	$scope.config.apiUrl+"PerfilUsuario/cambioClave";
				var parametros  = 	$("#formCambioClave").serialize()+"&edita="+edita;
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