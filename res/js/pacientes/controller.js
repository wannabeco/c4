/*
* Controlador que maneja todas las funcionalidades de la creación de usuarios
* @author Farez Prieto @orugal
* @date 15 de Noviembre de 2016
*/
project.controller('pacientesApp', function($scope,$http,$q,constantes)
{
	//alert("sdfsdfd");
	$scope.usuarios 	= [];
	$scope.padreModulo	=	"";
	$scope.initPacientes = function()
	{
		$scope.config 			=  configLogin;//configuración global
		$.material.init();
		$scope.getPacientes();
	}

	$scope.getPacientes = function(idUsuario,edita)
	{
		var controlador = 	$scope.config.apiUrl+"Pacientes/getPacientes";
		var parametros  = 	"";
		constantes.consultaApi(controlador,parametros,function(json){
			$scope.usuarios  = json.datos;
			$scope.$digest();
		});
	}

	/*
	* Me abre una plantilla que me permitira editar o crear los módulos
	*/
	$scope.cargaPlantillaControl = function(idPaciente,edita)
	{
		$('#modalUsuarios').modal("show");
		var controlador = 	$scope.config.apiUrl+"Pacientes/cargaPlantillaCreacionPacientes";
		var parametros  = 	"edita="+edita+"&idPaciente="+idPaciente;
		constantes.consultaApi(controlador,parametros,function(json){
				
			$("#modalCrea").html(json);
			//actualiza el DOM
			$scope.compileAngularElement("#formAgregaPaciente");
		},'');
	}

	$scope.borraPaciente = function(idPaciente)
	{
		constantes.confirmacion("Confirmación","Está seguro que desea borrar el usuario seleccionado?",'info',function()
		{
			var controlador = 	$scope.config.apiUrl+"Pacientes/borraPaciente";
			var parametros  = 	"idPaciente="+idPaciente;
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


project.controller('procesaGuardadoPac', function($scope,$http,$q,constantes)
{
	$.material.init();
	$scope.config 			=  configLogin;//configuración global

	//alert("Dentro de esto");

    $('#fecha_nacimiento').datetimepicker({
            format: 'YYYY-MM-DD'
    });



	$scope.procesaUsuarioPac = function(edita)
	{
		
		var tipoPaciente		=	$("#tipoPaciente").val();
		var tip_doc_pac			=	$("#tip_doc_pac").val();
		var num_doc				=	$("#num_doc").val();
		var nombre_paciente		=	$("#nombre_paciente").val();
		var apellido_paciente	=	$("#apellido_paciente").val();
		var estado_paciente		=	$("#estado_paciente").val();
		var fecha_nacimiento	=	$("#fecha_nacimiento").val();
		var id_app_lista_aseguradoras	=	$("#id_app_lista_aseguradoras").val();
		var edad				=	$("#edad").val();
		var idSexo				=	$("#idSexo").val();
		var direccion_paciente	=	$("#direccion_paciente").val();
		var barrio_paciente		=	$("#barrio_paciente").val();
		var telefono_paciente	=	$("#telefono_paciente").val();
		var celular_paciente	=	$("#celular_paciente").val();
		var email_paciente		=	$("#email_paciente").val();
		var estado				=	$("#estado").val();
		var tip_doc_pac_aco		=	$("#tip_doc_pac_aco").val();
		var num_doc_aco			=	$("#num_doc_aco").val();
		var nombre_aco			=	$("#nombre_aco").val();
		var telefono_aco		=	$("#telefono_aco").val();
		var ciudadPaciente		=	$("#ciudadPaciente").val();
		var continuaForm		=	false;


		var idPaciente			=	(edita == 1)?$("#idPaciente").val():"";
		//empiezo la validación de campos que será la misma si es editar que si es crear
		if(tipoPaciente == "")
		{
			constantes.alerta("Atención","Debe seleccionar el tipo de paciente.","info",function(){})
		}
		else if(tip_doc_pac == "")
		{
			constantes.alerta("Atención","Debe seleccionar un tipo de documento.","info",function(){})
		}
		else if(num_doc == "")
		{
			constantes.alerta("Atención","Debe escribir el número de documento de identidad.","info",function(){})
		}
		else if(num_doc != "" && isNaN(num_doc))
		{
			constantes.alerta("Atención","El documento de identidad debe contener sólo números.","info",function(){})
		}
		else if(nombre_paciente == "")
		{
			constantes.alerta("Atención","Escriba el nombre del paciente.","info",function(){})
		}
		else if(apellido_paciente == "")
		{
			constantes.alerta("Atención","Escriba el apellido del paciente.","info",function(){})
		}
		else if(estado_paciente == "")
		{
			constantes.alerta("Atención","Seleccione el estado del paciente.","info",function(){})
		}
		else if(id_app_lista_aseguradoras == "")
		{
			constantes.alerta("Atención","Seleccione la aseguradora.","info",function(){})
		}
		else if(edad == "")
		{
			constantes.alerta("Atención","Escriba la edad del paciente.","info",function(){})
		}
		else if(idSexo == "")
		{
			constantes.alerta("Atención","Debe seleccionar el sexo del usuario.","info",function(){})
		}
		else if(ciudadPaciente == "")
		{
			constantes.alerta("Atención","Escriba la ciudad de residencia del paciente.","info",function(){})
		}
		/*else if(direccion_paciente == "")
		{
			constantes.alerta("Atención","Escriba la dirección de residencia del paciente.","info",function(){})
		}
		else if(barrio_paciente == "")
		{
			constantes.alerta("Atención","Escriba el barrio donde vive el paciente.","info",function(){})
		}*/
		else if(telefono_paciente == "")
		{
			constantes.alerta("Atención","Escriba un número de teléfono de contacto del paciente.","info",function(){})
		}
		else if(telefono_paciente != "" && isNaN(telefono_paciente))
		{
			constantes.alerta("Atención","El campo teléfono sólo puede contener números.","info",function(){})
		}
		else if(celular_paciente != "" && isNaN(celular_paciente))
		{
			constantes.alerta("Atención","El campo celular sólo puede contener números.","info",function(){})
		}
		else if(email_paciente != "" && !constantes.validaMail(email_paciente))
		{
			constantes.alerta("Atención","El correo electrónico ingresado no es correcto, por favor verifique.","info",function(){})
		}
		else if(num_doc_aco != "" && isNaN(num_doc_aco))
		{
			constantes.alerta("Atención","El documento de identidad del acompañante sólo puede contener números.","info",function(){})
		}
		else if(telefono_aco != "" && isNaN(telefono_aco))
		{
			constantes.alerta("Atención","El campo teléfono del acompañante sólo puede contener números.","info",function(){})
		}
		/*else if(tipoPaciente == 'PAD' && tip_doc_pac_aco == "")
		{
			constantes.alerta("Atención","Debe seleccionar el tipo de documento del acompañante.","info",function(){})
		}
		else if(tipoPaciente == 'PAD' && num_doc_aco == "")
		{
			constantes.alerta("Atención","Debe escribir el número de documento del acompañante.","info",function(){})
		}
		else if(tipoPaciente == 'PAD' && nombre_aco == "")
		{
			constantes.alerta("Atención","Debe escribir el nombre del acompañante.","info",function(){})
		}
		else if(tipoPaciente == 'PAD' && telefono_aco == "")
		{
			constantes.alerta("Atención","Debe escribir un teléfono de contacto del acompañante.","info",function(){})
		}*/
		else
		{
			//alert("dkfjdhsfkjh9");
			var texto = (edita==1)?"Está apunto de editar la información del usuario, desea continuar?":"Está a punto de insertar un nuevo usuario, desea continuar?";
			constantes.confirmacion("Confirmación",texto,'info',function(){
				var controlador = 	$scope.config.apiUrl+"Pacientes/procesaUsuarios";
				var parametros  = 	$("#formAgregaPaciente").serialize()+"&edita="+edita;
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