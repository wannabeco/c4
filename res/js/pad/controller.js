/*
* Controlador que maneja todas las funcionalidades de las apps del pad
* @author Farez Prieto @orugal
* @date 24 de Enero de 2017
*/

project.controller('guardaVisitaPad',function($scope,$http,$q,constantes)
{
	//alert("dfkdsf")
	$scope.initformVisitas = function()
	{
		$.material.init();
		$scope.config 			=  configLogin;//configuración global

		$('#fechaVisita').datetimepicker({
		     format: 'YYYY-MM-DD'
		});
		$('#fechaFinal').datetimepicker({
		     format: 'YYYY-MM-DD'
		});
		$('#fecha_nacimiento').datetimepicker({
		     format: 'YYYY-MM-DD'
		});
		$('#horaVisita').datetimepicker({
		     format: 'HH:mm'
		});

		$('#diagnostico').select2({
		  ajax: {
		    url: $scope.config.apiUrl+"Pad/getCieDiez",
		    dataType: 'json',
		    delay: 250,
		    data: function (params) {
		      return {
		        q: params.term, // search term
		        page: params.page
		      };
		    },
		    processResults: function (data, params) {
		      // parse the results into the format expected by Select2
		      // since we are using custom formatting functions we do not need to
		      // alter the remote JSON data, except to indicate that infinite
		      // scrolling can be used
		      params.page = params.page || 1;

		      return {
		        results: data.items,
		        pagination: {
		          more: (params.page * 30) < data.total_count
		        }
		      };
		    },
		    cache: true
		  },
		  escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
		  minimumInputLength: 1/*,
		  templateResult: formatRepo, // omitted for brevity, see the source of this page
		  templateSelection: formatRepoSelection // omitted for brevity, see the source of this page*/
		});
	}

	
	$scope.guardaVisita = function(edita)
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
		var ciudadPaciente		=	$("#ciudadPaciente").val();
		var idServicio			=	$("#idServicio").val();
		var idEspecialista		=	$("#idEspecialista").val();

		var fechaVisita			=	$("#fechaVisita").val();
		var fechaFinal			=	$("#fechaFinal").val();
		var horaVisita			=	$("#horaVisita").val();
		var sesiones			=	$("#sesiones").val();
		var turno				=	$("#turno").val();
		var diagnostico			=	$("#diagnostico").val();


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
		else if(fechaVisita == "")
		{
			constantes.alerta("Atención","Seleccione la fecha en que se realizará la visita al paciente.","info",function(){})
		}
		else if(fechaFinal == "")
		{
			constantes.alerta("Atención","Seleccione la fecha final de la visita.","info",function(){})
		}
		else if(sesiones != undefined && sesiones == '')
		{
			constantes.alerta("Atención","Escriba la cantidad de sesiones para el paciente.","info",function(){})
		}
		else if(turno != undefined && turno == '')
		{
			constantes.alerta("Atención","Seleccione el turno que tomará el auxiliar de enfermeria.","info",function(){})
		}
		else if(diagnostico == null)
		{
			constantes.alerta("Atención","Por favor escriba un diagnostico inicial para el paciente.","info",function(){})
		}
		else
		{
			//alert(diagnostico);
			var texto = (edita==1)?"Está a punto de actualizar la información del paciente y de paso asignar una visita, desea continuar?":"Está a punto de insertar un nuevo paciente y de paso asignar una visita, desea continuar?";
			constantes.confirmacion("Confirmación",texto,'info',function(){
				var controlador = 	$scope.config.apiUrl+"Pad/procesaVisitas";
				var parametros  = 	$("#formGuardaCita").serialize()+"&diag="+diagnostico+"&edita="+edita;
				constantes.consultaApi(controlador,parametros,function(json){
					if(json.continuar == 1)
					{
						/*swal.close();
						$("#modalCitas").modal("hide");
						$("#modalDatosPersona").modal("hide");
						setTimeout(function(){
							$scope.consultaAgendaEspecialista(idServicio,idEspecialista);
						},1000);*/
						
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

project.controller('misVisitas',function($scope,$http,$q,constantes)
{
	$scope.initVisVisitas = function()
	{
		$.material.init();
		$scope.config 			=  configLogin;//configuración global

		$('#fechaConsulta').datetimepicker({
	            format: 'YYYY-MM-DD'
	    });
	    $scope.consultaMisVisitas();
	}

	$scope.consultaMisVisitas = function()
	{
		var fechaConsulta 	=  $("#fechaConsulta").val();
		var documento 		=  $("#documento").val();
		
		if(documento != "" && isNaN(documento))
		{
			constantes.alerta("Atención","El documento de identidad sólo puede contener números","info",function(){})
		}
		else
		{
			var controlador = 	$scope.config.apiUrl+"Pad/consultaMisVisitas";
			var parametros  = 	$("#formConsulta").serialize();
			constantes.consultaApi(controlador,parametros,function(json){
				if(json.continuar == 1)
				{
					//alert(json.datos.length);
					$scope.visitas = json.datos;
					$scope.cantCitas = json.datos.length;
					$scope.$digest();
				}
				else
				{
					$scope.mensajeError = json.mensaje;
					$scope.cantCitas = 0;
					$scope.visitas = [];
					$scope.$digest();
					//constantes.alerta("Atención","No se encontraron citas con los parámetros de búsqueda, por favor verifique e intente de nuevo.","info",function(){})
				}
			});
		}
	}
});

project.controller('detalleVisita',function($scope,$http,$q,constantes)
{
	var validaObjetivosYplanCasero = false;
	$scope.initDetalleVisita = function()
	{
		$.material.init();
		$scope.config 			=  configLogin;//configuración global
		$('#fechaNota').datetimepicker({
	            format: 'YYYY-MM-DD'
	    });
	    $('#horaNota').datetimepicker({
	        format: 'HH:mm'
	    });
	}

	$scope.guardaNotaEnfermeria = function()
	{
		var fechaNota 	= $("#fechaNota").val();
		var horaNota 	= $("#horaNota").val();
		var textoNota 	= $("#textoNota").val();
		var planManejo 	= $("#planManejo").val();
		var objetivos 	= $("#objetivos").val();
		
		//valido campos
		if(fechaNota == "")
		{
			constantes.alerta("Atención","Debe seleccionar la fecha.","info",function(){})
		}
		else if(horaNota == "")
		{
			constantes.alerta("Atención","Debe seleccionar la hora.","info",function(){})
		}
		else if(textoNota == "")
		{
			constantes.alerta("Atención","Debe escribir el texto de la nota de enfermeria.","info",function(){})
		}
		else if(planManejo == "" && validaObjetivosYplanCasero == true)
		{
			constantes.alerta("Atención","Debe llenar el campo evolución.","info",function(){})
		}
		else if(objetivos == "" && validaObjetivosYplanCasero == true)
		{
			constantes.alerta("Atención","Debe completar el campo objetivos.","info",function(){})
		}
		else
		{
			constantes.confirmacion("Confirmación","¿La información agregada en el formulario es correcta?, ¿desea continuar?",'info',function()
			{
				var controlador = 	$scope.config.apiUrl+"Pad/guardaNotaEnfermeria";
				var parametros  = 	$("#formNotas").serialize();
				constantes.consultaApi(controlador,parametros,function(json){
					//$("#selEspecialista").html(json);
					if(json.continuar == 1)
					{
						constantes.alerta("Atención",json.mensaje,"success",function(){
							location.reload();
						})
					}
					else
					{
						constantes.alerta("Atención",json.mensaje,"error",function(){

						})
					}
				});
			});	
		}
	}
});
project.controller('asignaVisitas',function($scope,$http,$q,constantes)
{

	$scope.visitas = [];
	$scope.cantCitas = 0;
	$scope.mensajeError = "No hay citas para mostrar en este momento.";
	var btnIniciaCita = true;
	$scope.initasignaVisitas = function()
	{
		$.material.init();
		$scope.config 			=  configLogin;//configuración global

		$('#fechaConsulta').datetimepicker({
	            format: 'YYYY-MM-DD'
	    });
	    $scope.consultaVisitas();
	}
	$scope.consultaEspecialistaServiciosAgenda = function(idServicio,persist)
	{
		//alert("asdasdasd");
		var idServicio 	=   $("#idServicio").val();
		var controlador = 	$scope.config.apiUrl+"adminAgendas/especialistasServicio";
		var parametros  = 	"&idServicio="+idServicio+"&persist="+persist+"&mostrar=1";
		constantes.consultaApi(controlador,parametros,function(json){
			$("#selEspecialista").html(json);
		},'html');
	}

	$scope.consultaVisitas = function()
	{
		var fechaConsulta 	=  $("#fechaConsulta").val();
		var documento 		=  $("#documento").val();
		
		if(documento != "" && isNaN(documento))
		{
			constantes.alerta("Atención","El documento de identidad sólo puede contener números","info",function(){})
		}
		else
		{
			var controlador = 	$scope.config.apiUrl+"Pad/consultaVisitas";
			var parametros  = 	$("#formConsulta").serialize();
			constantes.consultaApi(controlador,parametros,function(json){
				if(json.continuar == 1)
				{
					//alert(json.datos.length);
					$scope.visitas = json.datos;
					$scope.cantCitas = json.datos.length;
					$scope.$digest();
				}
				else
				{
					$scope.mensajeError = json.mensaje;
					$scope.cantCitas = 0;
					$scope.visitas = [];
					$scope.$digest();
					//constantes.alerta("Atención","No se encontraron citas con los parámetros de búsqueda, por favor verifique e intente de nuevo.","info",function(){})
				}
			});
		}
	}

	$scope.buscaTratante = function()
	{
		$scope.palabra = $("#palabra").val();
		//nombreEspecialista
		var controlador = 	$scope.config.apiUrl+"Pad/consultaTratantesPad";
		var parametros  = 	"nroDocumento="+$scope.palabra;
		constantes.consultaApi(controlador,parametros,function(json){
			if(json.continuar == 1)
			{
				$("#nombreEspecialista").html("<strong>"+json.datos.nombre+" "+json.datos.apellido+" / <i>"+json.datos.nombreCargo+"</i> </strong>");
				$("#btnContinuarCita").removeClass("disabled");
			}
			else
			{
				$("#nombreEspecialista").html("El número de documento no pertenece a ningún usuario creado");	
				$("#btnContinuarCita").addClass("disabled");
			}
		});
	}

	$scope.iniciaCita = function()
	{
		//verifico si el botón está deshabilitado
		var btn = $("#btnContinuarCita");
		var persona  = $("#palabra").val();;
		var documento = $("#paciente").val();;
		if(!btn.hasClass('disabled'))//cuando el botón no este deshabilitado
		{
			//valido campos
			if(persona == "")
			{
				constantes.alerta("Atención","Debe escribir el documento del auxiliar ó terapeuta.","info",function(){})
			}
			else if(documento == "")
			{
				constantes.alerta("Atención","Debe escribir el documento del paciente.","info",function(){})
			}
			else
			{
				$('#modalUsuarios').modal("show");
				//realizo la consulta de la información del usuario
				var idServicio 	=   $("#idServicio").val();
				var controlador = 	$scope.config.apiUrl+"Pad/consultaDataPaciente";
				var parametros  = 	"documento="+documento+"&persona="+persona;
				constantes.consultaApi(controlador,parametros,function(json){
					$("#modalCrea").html(json);
					$scope.compileAngularElement("#formGuardaCita");
				},'html');
				//$("#modalDatosPersona").modal("show");
			}
		}
		else
		{
				constantes.alerta("Atención","Al parecer el documento de identidad del terapeuta ó auxiliar ingresado no existe en la base de datos, por favor verifique, de lo contrario no podrá continuar.","info",function(){})
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