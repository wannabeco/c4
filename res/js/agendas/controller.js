/*
* Controlador que maneja todas las funcionalidades de la creación de usuarios
* @author Farez Prieto @orugal
* @date 15 de Noviembre de 2016
*/
project.controller('agendasApp', function($scope,$http,$q,constantes)
{
	$scope.usuarios 	= [];
	$scope.padreModulo	=	"";
	$scope.initAgendas = function()
	{
		$scope.config 			=  configLogin;//configuración global
		$.material.init();
		//$scope.pintaAgendaVacia();
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

	$scope.consultaEspecialistaServiciosAgenda = function(idServicio,persist)
	{
		//alert("asdasdasd");
		var idServicio 	=   $("#idServicio").val();
		var controlador = 	$scope.config.apiUrl+"adminAgendas/especialistasServicio";
		var parametros  = 	"&idServicio="+idServicio+"&persist="+persist+"&mostrar=0";
		constantes.consultaApi(controlador,parametros,function(json){
			$("#selEspecialista").html(json);
		},'html');
	}

	$scope.consultaAgendaEspecialista = function()
	{

		//capturo las variables
		var idServicio 	= $("#idServicio").val();
		var idPersona 	= $("#idPersona").val();
		//alert(idPersona)

		if(idServicio == "")
		{
			constantes.alerta("Atención","Debe seleccionar un servicio para realizar la consulta de agendas","info",function(){})
		}
		else if(idPersona == "")
		{
			constantes.alerta("Atención","Debe seleccionar un especialista para realizar la consulta de agendas","info",function(){})
		}
		else
		{
			constantes.confirmacion("Confirmación","Se realizará una consulta con la información proporcionada, desea continuar?",'info',function(){
				var idServicio 	=   $("#idServicio").val();
				var controlador = 	$scope.config.apiUrl+"adminAgendas/consultaAgendaEspecialista";
				var parametros  = 	"&idServicio="+idServicio+"&idPersona="+idPersona;
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
			},true);
			
		}
		
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
			selectable: true,
			selectHelper: true,
		    hiddenDays: AllDayS,
			defaultView: "agendaWeek",
			events: eventos,
			minTime: desde,
			maxTime : hasta,
			editable: false,
			eventLimit: true,
			allDaySlot: false,
			slotEventOverlap:false,
			eventLimitClick : "day",
			selectOverlap: function(event) {
				return event.rendering === 'background';
			},
			select:function(start,end,jsEvent,view)
			{
				var actual			=	moment().format("YYYY-MM-DD HH:mm");
				var fechaSel		=	moment(start).format("YYYY-MM-DD HH:mm");

				var unixActual			=	moment().format("X");
				var unixFechaSel		=	moment(start).format("X");


				if(fechaSel >= actual)
				{
					var fechaIniData 	= moment(start).format("YYYY-MM-DD HH:mm");
					var fechaFinData 	= moment(end).format("YYYY-MM-DD HH:mm");
					var especialidad	= $("#idServicio").val();
					var especialista 	= $("#idPersona").val();

					//alert(fechaIniData);
					//abrir pop up de la creación de la cita
					$("#modalCitas").modal("show");
					var controlador = 	$scope.config.apiUrl+"AdminAgendas/modalConsultaUsuario";
					var parametros  = 	"edita=0&fechaIniData="+fechaIniData+"&fechaFinData="+fechaFinData+"&servicio="+especialidad+"&persona="+especialista;
					constantes.consultaApi(controlador,parametros,function(json){
						$("#modalCrea").html(json);
						//actualiza el DOM
						$scope.compileAngularElement("#formConsultaDataUsuario");
					},'');
				}
				else
				{	
					constantes.alerta("Atención","No puede asigar citas a fechas pasadas.","warning",function(){})
				}
				

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



project.controller('configuraAgendas', function($scope,$http,$q,constantes)
{
	$scope.variable 		= "Prueba";
	$scope.idServicio 		= $("#idServicio").val();
	$scope.initConfAgendas = function()
	{
		$.material.init();
		$scope.horariosVar 	= [];
		$scope.config 			=  configLogin;//configuración global
		$scope.getHorariosConfigurados("",0);
	}

	$scope.getHorariosConfigurados = function(idUsuario,edita)
	{
		var controlador = 	$scope.config.apiUrl+"adminAgendas/getHorariosConfigurados";
		var parametros  = 	"";
		constantes.consultaApi(controlador,parametros,function(json){
			if(json.continuar == 1)
			{
				$scope.horariosVar  = json.datos;
				$scope.variable 	= "Prueba";
				$scope.$digest();
			}
		});
	}

	/*
	* Me abre una plantilla que me permitira editar o crear los módulos
	*/
	$scope.cargaPlantillaControl = function(idPersona,idServicio,edita)
	{
		$('#modalUsuarios').modal("show");
		var controlador = 	$scope.config.apiUrl+"adminAgendas/cargaPlantillaModalConfigAgendas";
		var parametros  = 	"edita="+edita+"&idPersona="+idPersona+"&idServicio="+idServicio;
		constantes.consultaApi(controlador,parametros,function(json){
				
			$("#modalCrea").html(json);
			//actualiza el DOM
			$scope.compileAngularElement("#formConfigAgenda");
			//$scope.$digest();
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




project.controller('procesaGuardadoConfigAgenda', function($scope,$http,$q,constantes)
{
	$.material.init();
	$scope.idServicio 		= $("#idServicio").val();
	$scope.idPersonaCampo 	= $("#idPersonaCampo").val();
	$scope.config 			=  configLogin;//configuración global
	$listaEspecialistas		=	[];



	$scope.consultaEspecialistaServicios = function(persist)
	{
		//alert(persist);
		var idServicio 	=   $("#idServicio").val();
		var controlador = 	$scope.config.apiUrl+"adminAgendas/especialistasServicio";
		var parametros  = 	"&idServicio="+idServicio+"&persist="+persist+"&mostrar=0";
		constantes.consultaApi(controlador,parametros,function(json){
			$("#selEspecialista").html(json);
		},'html');
	}

	if($scope.idServicio != "")
	{
		setTimeout(function(){
			$scope.consultaEspecialistaServicios($scope.idPersonaCampo);
		},100)

	}



	//esta función realiza el proceso de guardar los listados de horarios para la persona seleccionada
	$scope.procesaHorariosListas = function(edita)
	{
		//realizo la validación de campos
		var idServicio		=	$("#idServicio").val();
		var idPersona		=	$("#idPersona").val();
		var selectHoraIni	=	$("#selectHoraIni").val();
		var selectHoraFin	=	$("#selectHoraFin").val();
		var diasSem			=	$(".diasSemanas:checked");

		//valido
		if(idServicio == "")
		{
			constantes.alerta("Atención","Debe seleccionar un servicio para poder buscar los especialistas","warning",function(){})
		}
		else if(idPersona == "")
		{
			constantes.alerta("Atención","Debe seleccinar el especialista al cual le desea asignar la lista.","warning",function(){})
		}
		else if(diasSem.length == 0)
		{
			constantes.alerta("Atención","Debe seleccionar por lo menos un día de la semana.","warning",function(){})
		}
		else if(selectHoraIni == "")
		{
			constantes.alerta("Atención","Seleccione la hora de inicio de disponibilidad del especialista.","warning",function(){})
		}
		else if(selectHoraFin == "")
		{
			constantes.alerta("Atención","Seleccione la hora de finalización de disponibilidad del especialista.","warning",function(){})
		}
		else
		{
			//procedo a guardar
			var contadorInsertados	=	0;
			constantes.confirmacion("Confirmación","Está a punto de asignar la disponibilidad seleccionada al usuario, desea continuar?",'info',function(){


				var controlador2 = 	$scope.config.apiUrl+"adminAgendas/borraHorarios";
				//antes que nada debo borrar lo que ya está creado, luego insertaré
				var parametros  = 	"&idPersona="+idPersona+"&idServicio="+idServicio;
				constantes.consultaApi(controlador2,parametros,function(json){
					if(json.continuar == 1)
					{
						
					}	
				});

				var controlador = 	(edita==1)?$scope.config.apiUrl+"adminAgendas/editaHorarios":$scope.config.apiUrl+"adminAgendas/insertaHorarios";

				//procedo a realizar la inserción de cada regla en la base de datos
					$.each(diasSem,function()
					{
						var diaSemana = 	$(this).val();
						//empiezo a enviar peticiones por ajax a la base de datos
						var parametros  = 	"&diaSemana="+diaSemana+"&idPersona="+idPersona+"&idServicio="+idServicio+"&horaInicio="+selectHoraIni+"&horaFin="+selectHoraFin;
						constantes.consultaApi(controlador,parametros,function(json){
							if(json.continuar == 1)
							{
								contadorInsertados++;	
								//alert(contadorInsertados+" - "+diasSem.length)
								//valido la cantidad de insertados contra la cantidad todal de días seleccionados
								if(contadorInsertados == diasSem.length)
								{
									constantes.alerta("Atención","Los horarios se han insertado correctamente.","success",function(){
										location.reload();
									})
								}
								else
								{
									constantes.alerta("Atención",json.mensaje,"warning",function(){})
								}
							}	
						});
					});


			},true);
		}
	}



});



project.controller('consultadataUsuario', function($scope,$http,$q,constantes)
{
	$.material.init();
	$scope.idServicio 		= $("#idServicio").val();
	$scope.idPersonaCampo 	= $("#idPersonaCampo").val();
	$scope.config 			=  configLogin;//configuración global
	$listaEspecialistas		=	[];



	$scope.consultaEspecialistaServicios = function(persist)
	{
		//alert(persist);
		var idServicio 	=   $("#idServicio").val();
		var controlador = 	$scope.config.apiUrl+"adminAgendas/especialistasServicio";
		var parametros  = 	"&idServicio="+idServicio+"&persist="+persist+"&mostrar=0";
		constantes.consultaApi(controlador,parametros,function(json){
			$("#selEspecialista").html(json);
		},'html');
	}

	$scope.consultaDataUsuario = function()
	{
		var documento = $("#documento").val();
		var fechaIni  = $("#fechaIni").val();
		var fechaFin  = $("#fechaFin").val();
		var servicio  = $("#servicio").val();
		var persona   = $("#persona").val();

		if(documento == "")
		{
			constantes.alerta("Atención","Debe escribir el número de documento de identidad del paciente.","info",function(){})
		}
		else if(documento != "" && isNaN(documento))
		{
			constantes.alerta("Atención","El documento de identidad sólo puede contener números.","info",function(){})
		}
		else
		{
			$('#modalDatosPersona').modal("show");
			//realizo la consulta de la información del usuario
			var idServicio 	=   $("#idServicio").val();
			var controlador = 	$scope.config.apiUrl+"adminAgendas/consultaDataPaciente";
			var parametros  = 	"documento="+documento+"&fechaIni="+fechaIni+"&fechaFin="+fechaFin+"&servicio="+servicio+"&persona="+persona;
			constantes.consultaApi(controlador,parametros,function(json){
				$("#modalPersona").html(json);
				$scope.compileAngularElement("#formGuardaCita");
			},'html');
			//$("#modalDatosPersona").modal("show");	
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


project.controller('consultaCitas',function($scope,$http,$q,constantes)
{

	$scope.citas = [];
	$scope.cantCitas = 0;
	$scope.mensajeError = "No hay citas para mostrar en este momento.";
	$scope.initConsultaCitas = function()
	{
		$.material.init();
		$scope.config 			=  configLogin;//configuración global

		$('#fechaConsulta').datetimepicker({
	            format: 'YYYY-MM-DD'
	    });
	    $scope.buscaCitas();
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

	$scope.buscaCitas = function()
	{
		var idPersona 		=  $("#idPersona").val();
		var fechaConsulta 	=  $("#fechaConsulta").val();
		var documento 		=  $("#documento").val();
		var idServicio 		=  $("#idServicio").val();
		
		if(documento != "" && isNaN(documento))
		{
			constantes.alerta("Atención","El documento de identidad sólo puede contener números","info",function(){})
		}
		else
		{
			var controlador = 	$scope.config.apiUrl+"adminAgendas/buscaCitas";
			var parametros  = 	$("#formConsulta").serialize();
			constantes.consultaApi(controlador,parametros,function(json){
				if(json.continuar == 1)
				{
					//alert(json.datos.length);
					$scope.citas = json.datos;
					$scope.cantCitas = json.datos.length;
					$scope.$digest();
				}
				else
				{
					$scope.mensajeError = json.mensaje;
					$scope.cantCitas = 0;
					$scope.citas = [];
					$scope.$digest();
					//constantes.alerta("Atención","No se encontraron citas con los parámetros de búsqueda, por favor verifique e intente de nuevo.","info",function(){})
				}
			});
		}
	}
	$scope.procesaCita = function(idCita,proceso)
	{
		$("#modalProceso").modal("show");
		var texto  = (proceso ==1)?"Está a punto de confirmar la cita, si tiene alguna  observación que realizar al respecto escríbala en el campo que verá a continuación, si no hay observaciones puede dejarlo en blanco.":"Por favor escriba el motivo por el cual el paciente realiza la cancelación de la cita.";
		var titulo = (proceso ==1)?"Validación de cita":"Cancelación de cita";
		var placeholder 	=  	(proceso ==1)?"Llenar si tiene observaciones":"Es obligatorio escribir una observación";
		var textBtn	=  	(proceso ==1)?"Confirmar cita":"Cancelar cita";		
		var continua 	=	false;

		$("#tituloProceso").html(titulo);
		$("#textoProceso").html(texto);
		$("#btnTexto").html(textBtn);
		$("#idCita").val(idCita);
		$("#proceso").val(proceso);
	}

	$scope.procesaCitaRegistro = function()
	{
		var idCita	=	$("#idCita").val();
		var proceso =	$("#proceso").val();
		var observaciones = $("#observaciones").val();
		var continuar = false;
		var titulo  = "";

		if(proceso == 2)
		{
			titulo  = "Está seguro que desea cancelar la cita?";
			if(observaciones === "")
			{
				constantes.alerta("Atención","Debe escribir el motivo por el cual se cancela la cita.","info",function(){})
				continuar = false;
			}
			else
			{
				continuar = true;
			}
		}
		else
		{
			titulo  = "Está a punto de aprobar la cita, desea continuar?";
			continuar = true;
		}

		if(continuar == true)
		{	
			constantes.confirmacion("Confirmación",titulo,'info',function(){
				var controlador = 	$scope.config.apiUrl+"adminAgendas/actualizaCitas";
				var parametros  = 	$("#formProceso").serialize();
				constantes.consultaApi(controlador,parametros,function(json){
					if(json.continuar == 1)
					{
						constantes.alerta("Atención",json.mensaje,"info",function(){
							$("#tituloProceso").html("");
							$("#textoProceso").html("");
							$("#observaciones").val("");
							$("#btnTexto").html("");
							$("#idCita").val("");
							$("#proceso").val("");
							$("#modalProceso").modal("hide");
							$scope.buscaCitas();
						})
					}
					else
					{
						constantes.alerta("Atención",json.mensaje,"info",function(){
							$("#tituloProceso").html("");
							$("#textoProceso").html("");
							$("#observaciones").val("");
							$("#btnTexto").html("");
							$("#idCita").val("");
							$("#proceso").val("");
							$("#modalProceso").modal("hide");
							$scope.buscaCitas();
						})
					}
				});
			},true);
		}
	}
});

project.controller('controladorGuardaCita',function($scope,$http,$q,constantes){
	
	$.material.init();
	$scope.config 			=  configLogin;//configuración global

	$('#fecha_nacimiento').datetimepicker({
            format: 'YYYY-MM-DD'
    });


	$scope.consultaAgendaEspecialista = function(idServicio,idPersona)
	{

		//capturo las variables
		var idServicio 	= $("#idServicio").val();
		var idPersona 	= $("#idPersona").val();
		//alert(idPersona)

		if(idServicio == "")
		{
			constantes.alerta("Atención","Debe seleccionar un servicio para realizar la consulta de agendas","info",function(){})
		}
		else if(idPersona == "")
		{
			constantes.alerta("Atención","Debe seleccionar un especialista para realizar la consulta de agendas","info",function(){})
		}
		else
		{
			/*constantes.confirmacion("Confirmación","Se realizará una consulta con la información proporcionada, desea continuar?",'info',function(){*/
				var idServicio 	=   $("#idServicio").val();
				var controlador = 	$scope.config.apiUrl+"adminAgendas/consultaAgendaEspecialista";
				var parametros  = 	"&idServicio="+idServicio+"&idPersona="+idPersona;
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
			/*},true);*/
			
		}
		
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
			selectable: true,
			selectHelper: true,
		    hiddenDays: AllDayS,
			defaultView: "agendaWeek",
			events: eventos,
			minTime: desde,
			maxTime : hasta,
			editable: false,
			eventLimit: true,
			allDaySlot: false,
			eventLimitClick : "day",
			selectOverlap: function(event) {
				return event.rendering === 'background';
			},
			select:function(start,end,jsEvent,view)
			{
				var actual			=	moment().format("YYYY-MM-DD HH:mm");
				var fechaSel		=	moment(start).format("YYYY-MM-DD HH:mm");

				var unixActual			=	moment().format("X");
				var unixFechaSel		=	moment(start).format("X");


				if(fechaSel >= actual)
				{
					var fechaIniData 	= moment(start).format("YYYY-MM-DD HH:mm");
					var fechaFinData 	= moment(end).format("YYYY-MM-DD HH:mm");
					var especialidad	= $("#idServicio").val();
					var especialista 	= $("#idPersona").val();

					//alert(fechaIniData);
					//abrir pop up de la creación de la cita
					$("#modalCitas").modal("show");
					var controlador = 	$scope.config.apiUrl+"AdminAgendas/modalConsultaUsuario";
					var parametros  = 	"edita=0&fechaIniData="+fechaIniData+"&fechaFinData="+fechaFinData+"&servicio="+especialidad+"&persona="+especialista;
					constantes.consultaApi(controlador,parametros,function(json){
						$("#modalCrea").html(json);
						//actualiza el DOM
						$scope.compileAngularElement("#formConsultaDataUsuario");
					},'');
				}
				else
				{	
					constantes.alerta("Atención","No puede asigar citas a fechas pasadas.","warning",function(){})
				}
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

	$scope.guardaCita = function(edita)
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
		var ciudadPaciente		=	$("#ciudadPaciente").val();
		var idServicio			=	$("#idServicio").val();
		var idEspecialista		=	$("#idEspecialista").val();


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
		else
		{
			//alert("dkfjdhsfkjh9");
			var texto = (edita==1)?"Está apunto de editar la información del usuario, desea continuar?":"Está a punto de insertar un nuevo usuario, desea continuar?";
			constantes.confirmacion("Confirmación",texto,'info',function(){
				var controlador = 	$scope.config.apiUrl+"AdminAgendas/procesaCitas";
				var parametros  = 	$("#formGuardaCita").serialize()+"&edita="+edita;
				constantes.consultaApi(controlador,parametros,function(json){
					if(json.continuar == 1)
					{
						swal.close();
						$("#modalCitas").modal("hide");
						$("#modalDatosPersona").modal("hide");
						setTimeout(function(){
							$scope.consultaAgendaEspecialista(idServicio,idEspecialista);
						},1000);
						/*constantes.alerta("Atención",json.mensaje,"success",function(){
							location.reload();
						})*/
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
