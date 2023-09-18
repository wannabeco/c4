/*
* Controlador que maneja todas las funcionalidades de la creación de usuarios
* @author Farez Prieto @orugal
* @date 15 de Noviembre de 2016
*/
project.controller('especialistasApp', function($scope,$http,$q,constantes)
{
	$scope.usuarios 	= [];
	$scope.padreModulo	=	"";
	$scope.initEspecialistas = function()
	{
		$scope.config 			=  configLogin;//configuración global
		$.material.init();
		$scope.consultaCitasEspecialista();
	}

	$scope.consultaCitasEspecialista = function()
	{
		var idServicio 	=   $("#idServicio").val();
		var controlador = 	$scope.config.apiUrl+"Especialistas/consultaAgendaEspecialista";
		var parametros  = 	"";
		constantes.consultaApi(controlador,parametros,function(json){
			$('#calendar').fullCalendar('destroy');
			setTimeout(function(){
			$scope.pintaAgendaVacia(json);
				setTimeout(function(){
					$('#calendar').fullCalendar('rerenderEvents');
					$('#calendar').fullCalendar('refresh');
				},700);
			},500)
		});
	}

	$scope.pintaAgendaVacia = function(json)
	{
		//alert(json.datos.horarios.length);
		var AllDayS = [0,1,2,3,4,5,6];
		var eventos = [];
		var desde 	= "07:00";
		var hasta   = "18:00";
		var mostrarCalendario	=	false;
		if(json.datos.horarios.length > 0)
		{
			for(a in json.datos.horarios){
				delete AllDayS[json.datos.horarios[a].idDiaSemana];
				//AllDayS.push(json.datos.horarios[a].idDiaSemana);
			};
			console.log(AllDayS);
			desde 	= json.datos.horarios[0].horaInicio;
			hasta   = json.datos.horarios[0].horaFinal;
			mostrarCalendario	=	true;
		}

		if(json.datos.citas.length > 0)
		{
			eventos = json.datos.citas;
		}


		var date 	 = new Date();
		var month 	 = new Array();
			month[0] = "01";
			month[1] = "02";
			month[2] = "03";
			month[3] = "04";
			month[4] = "05";
			month[5] = "06";
			month[6] = "07";
			month[7] = "08";
			month[8] = "09";
			month[9] = "10";
			month[10] = "11";
			month[11] = "12";

		var diaAct 	=	(date.getDate() < 10)?"0"+date.getDate():date.getDate();
		var options = {
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			lang:"es",
			defaultDate: date.getFullYear()+"-"+month[date.getMonth()]+"-"+diaAct,//   '2015-12-01',
			selectable: false,
			selectHelper: false,
		    hiddenDays: AllDayS,
			defaultView: "agendaDay",
			events: eventos,
			minTime: desde,
			maxTime : hasta,
			editable: false,
			eventLimit: true,
			allDaySlot: false,
			slotEventOverlap:false,
			eventLimitClick : "day",
			eventClick:function(calEvent, jsEvent, view)
			{
				$scope.procesaEventoSeleccionado(calEvent);
			},
			selectOverlap: function(event) {
				return event.rendering === 'background';
			},
			select:function(start,end,jsEvent,view)
			{
				
			},
			slotDuration:'00:30:00'//duración de 30 minutos cada cita
		}
		if(mostrarCalendario)
		{
			$('#calendar').fullCalendar(options);
		}
		else
		{
			constantes.alerta("Atención","El especialista seleccionado no tiene horarios asignados. Debe realizar la asignación de horarios en la seccion de configuración de de agendas","warning",function(){})
		}
	}

	$scope.procesaEventoSeleccionado = function(dataEvento)
	{
		$("#modalCitaUsuario").modal("show");
		var controlador = 	$scope.config.apiUrl+"Especialistas/iniciandoCita";
		var parametros  = 	"idCita="+dataEvento.id;
		constantes.consultaApi(controlador,parametros,function(json){
			$("#modalCrea").html(json);
			//actualiza el DOM
			$scope.compileAngularElement("#formPopCita");
		},'');
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


project.controller('controlaCita', function($scope,$http,$q,constantes)
{
	$scope.iniciaCitasPop = function()
	{
		$scope.config 			=  configLogin;//configuración global
		$.material.init();
	}
	$scope.iniciarCita = function(idCita)
	{
		document.location = $scope.config.apiUrl+"Especialistas/gestionCita/"+idCita;
	}
});


project.controller('ventanaCita', function($scope,$http,$q,constantes)
{
	$scope.ventanaCitaIni = function(idCita)
	{
		$('#fecha_nacimiento').datetimepicker({
	            format: 'YYYY-MM-DD'
	    });
		$scope.config 			=  configLogin;//configuración global
		$.material.init();
	}

	/*Función que se dedica a poner el formlario de história clínica que deba ir en cada sección.*/
	$scope.decideFormHistoria = function(formulario,rutaForm,idPaciente)
	{
		if(rutaForm != "")
		{
			$('#modalFormHistoria').modal("show");
			var controlador = 	$scope.config.apiUrl+rutaForm;
			var parametros  = 	"idFormulario="+formulario+"&idPaciente="+idPaciente;
			constantes.consultaApi(controlador,parametros,function(json){
				$("#modalCrea").html(json);
				//actualiza el DOM
				$scope.compileAngularElement("#formulario");
			},'');
		}
		else
		{
			constantes.alerta("Atención","No hay un formulario desarrollado para esta história clínica, consulte al administrador.","warning",function(){})
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


	$scope.actualizapacienteCita = function(edita)
	{
		
		var tipoPaciente		=	$("#tipoPaciente").val();
		var tip_doc_pac			=	$("#tip_doc_pac").val();
		var num_doc				=	$("#num_doc").val();
		var nombre_paciente		=	$("#nombre_paciente").val();
		var apellido_paciente	=	$("#apellido_paciente").val();
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
				var parametros  = 	$("#dataPaciente").serialize()+"&edita="+edita;
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

	$scope.abrePopHistoriasClinicas = function()
	{
		
	}

});




//funciones que controlan el guardado de los formularios
project.controller('guardadoForms', function($scope,$http,$q,constantes)
{
	$scope.iniciaForms = function()
	{
		$scope.config 			=  configLogin;//configuración global
		$.material.init();
	}

	/*FORMULARIO DE HISTORIA CLÍNICA PSICOLOGÍA PEDIÁTRICA*/

	//guardado formulario historia clinica psicologia pediátrica
	$scope.guardaFormPsicologiaPediatrica = function()
	{
		//validación de campos
	}
	$scope.agregaEstructFuncFamiliar = function()
	{
		
	}

	/*FIN FORMULARIO DE HISTORIA CLÍNICA PSICOLOGÍA PEDIÁTRICA*/


});