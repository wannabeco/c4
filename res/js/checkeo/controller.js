/*
* Controlador que maneja todas las funcionalidades de la creación de usuarios
* @author Farez Prieto @orugal
* @date 15 de Noviembre de 2016
*/
project.controller('checkeador', function($scope, $http, $q, constantes) {	

	$scope.initcheckeador = function() {
		$scope.config = configLogin; // configuración global
		$("#archivoPregunta1").hide();
		$("#archivoPregunta2").hide();
		$("#archivoPregunta3").hide();
		$("#archivoPregunta4").hide();
		$("#archivoPregunta5").hide();
		$("#archivoPregunta6").hide();
		$scope.consultaCheck();
		$scope.perfilUsuario = "";
	};

	$scope.mostrarInput1 = function(){
		if ($("#pregunta1").prop("checked")){
			$("#archivoPregunta1").show();
		}else{
			$("#archivoPregunta1").hide();
		}
	}
	$scope.ocultaInput1 =function(){
		$("#archivoPregunta1").hide();
	}
	$scope.mostrarInput2 = function(){
		if($("#pregunta2").prop("checked")){
			$("#archivoPregunta2").show();
		}else{
			$("#archivoPregunta2").hide();
		}
	}
	$scope.ocultaInput2 = function(){
		$("#archivoPregunta2").hide();
	}
	$scope.mostrarInput3 = function(){
		if($("#pregunta3").prop("checked")){
			$("#archivoPregunta3").show();
		}else{
			$("#archivoPregunta3").hide();
		}
	}
	$scope.ocultaInput3 = function(){
		$("#archivoPregunta3").hide();
	}
	$scope.mostrarInput4 = function(){
		if($("#pregunta4").prop("checked")){
			$("#archivoPregunta4").show();
		}else{
			$("#archivoPregunta4").hide();
		}
	}
	$scope.ocultaInput4 = function(){
		$("#archivoPregunta4").hide();
	}
	$scope.mostrarInput5 = function(){
		if($("#pregunta5").prop("checked")){
			$("#archivoPregunta5").show();
		}else{
			$("#archivoPregunta5").hide();
		}
	}
	$scope.ocultaInput5 = function(){
		$("#archivoPregunta5").hide();
	}
	$scope.mostrarInput6 = function(){
		if($("#pregunta6").prop("checked")){
			$("#archivoPregunta6").show();
		}else{
			$("#archivoPregunta6").hide();
		}
	}
	$scope.ocultaInput6 = function(){
		$("#archivoPregunta6").hide();
	}

	//upload dile
	$scope.uploadPic = function(archivo,caja,imagen,preloader,salida){
		var file = document.getElementById(archivo).files[0];
		var formData 	=   new FormData();
		formData.append(caja, file);
		formData.append("caja", caja);

		var controlador = 	$scope.config.apiUrl+"MisMatrices/cargaFoto"; 
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
			//una vez finalizado correctamente
			success: function(json){	
				if(json.continuar == 1){
					var archivoCargado = json.foto;
					$("#"+salida).val(archivoCargado);
				} else {
					$("#"+preloader).hide();
					constantes.alerta("Atención",json.mensaje,"info",function(){});
				}
			},
			//si ha ocurrido un error
			error: function(){
			}
		});
	}
	//consulto respuestas
	$scope.consultaCheck = function(){
		
		var idRecurrente = $("#idMatrizRecurrente").val();
		var edita = $("#edita").val();
		var idPerfil = $("#idPerfil").val();
		var idRelPeriocidad = $("#idRelPeriocidad").val();
		$scope.perfilUsuario = idPerfil;
		if(edita == 1 && idPerfil != 8){
			var controlador = 	$scope.config.apiUrl+"CrearMatriz/consultaCheck"; 
			var parametros	=	{ idRecurrente: idRecurrente, idRelPeriocidad:idRelPeriocidad };
			$.ajax({
				url: controlador,  
				type: 'POST',
				data: parametros,
				dataType:"json",
				//una vez finalizado correctamente
				success: function(json){
					$scope.respuestas = json.respuesta;
					console.log(json);
					$scope.archivos = json.arrayArchivos;
					$scope.idEmpresa	=json.idEmpresa;
					if($scope.respuestas[0] == "SI"){
						document.querySelector('input[id=pregunta1][value="SI"]').checked = true;
						$scope.mostrarInput1();
						$scope.urlArchivo1 = $scope.archivos[0];
						$scope.$apply();
						document.querySelector('input[id=pregunta1][value="SI"]').checked = true;

					} if($scope.respuestas[0] == "NO"){
						document.querySelector('input[id=pregunta1][value="NO"]').checked = true;
					} if($scope.respuestas[0] == "NO/A"){
						document.querySelector('input[id=pregunta1][value="NO/A"]').checked = true;
					} if($scope.respuestas[1] == "SI"){
						document.querySelector('input[id=pregunta2][value="SI"]').checked = true;
						$scope.mostrarInput2();
						$scope.urlArchivo2 = $scope.archivos[1];
						$scope.$apply();
						document.querySelector('input[id=pregunta2][value="SI"]').checked = true;

					} if($scope.respuestas[1] == "NO"){
						document.querySelector('input[id=pregunta2][value="NO"]').checked = true;
					} if($scope.respuestas[1] == "NO/A"){
						document.querySelector('input[id=pregunta2][value="NO/A"]').checked = true;
					} if($scope.respuestas[2] == "SI"){
						document.querySelector('input[id=pregunta3][value="SI"]').checked = true;
						$scope.mostrarInput3();
						$scope.urlArchivo3 = $scope.archivos[2];
						$scope.$apply();
						document.querySelector('input[id=pregunta3][value="SI"]').checked = true;

					} if($scope.respuestas[2] == "NO"){
						document.querySelector('input[id=pregunta3][value="NO"]').checked = true;
					} if($scope.respuestas[2] == "NO/A"){
						document.querySelector('input[id=pregunta3][value="NO/A"]').checked = true;
					}if($scope.respuestas[3] == "SI"){
						document.querySelector('input[id=pregunta4][value="SI"]').checked = true;
						$scope.mostrarInput4();
						$scope.urlArchivo4 = $scope.archivos[3];
						$scope.$apply();
						document.querySelector('input[id=pregunta4][value="SI"]').checked = true;

					} if($scope.respuestas[3] == "NO"){
						document.querySelector('input[id=pregunta4][value="NO"]').checked = true;
					} if($scope.respuestas[3] == "NO/A"){
						document.querySelector('input[id=pregunta4][value="NO/A"]').checked = true;
					} if($scope.respuestas[4] == "SI"){
						document.querySelector('input[id=pregunta5][value="SI"]').checked = true;
						$scope.mostrarInput5();
						$scope.urlArchivo5 = $scope.archivos[4];
						$scope.$apply();
						document.querySelector('input[id=pregunta5][value="SI"]').checked = true;

					} if($scope.respuestas[4] == "NO"){
						document.querySelector('input[id=pregunta5][value="NO"]').checked = true;
					} if($scope.respuestas[4] == "NO/A"){
						document.querySelector('input[id=pregunta5][value="NO/A"]').checked = true;
					} if($scope.respuestas[5] == "SI"){
						document.querySelector('input[id=pregunta6][value="SI"]').checked = true;
						$scope.mostrarInput6();
						$scope.urlArchivo6 = $scope.archivos[5];
						$scope.$apply();
						document.querySelector('input[id=pregunta6][value="SI"]').checked = true;

					} if($scope.respuestas[5] == "NO"){
						document.querySelector('input[id=pregunta6][value="NO"]').checked = true;
					} if($scope.respuestas[5] == "NO/A"){
						document.querySelector('input[id=pregunta6][value="NO/A"]').checked = true;
					}
				},
				//si ha ocurrido un error
				error: function(){
				}
			});
			//consulto si el perfil es de oficial de cumplimiento para llenar campos
		}else if(edita == 1 && idPerfil == 8){
			var idRecurrente = $("#idMatrizRecurrente").val();
			var edita = $("#edita").val();
			var idEmpresa = $("#idEmpresa").val();
			var idPersona = $("#idPersona").val();
			var idRelPeriocidad = $("#idRelPeriocidad").val();
			// alert(idRelPeriocidad);
			var controlador = 	$scope.config.apiUrl+"CrearMatriz/consultaCheckRealizado"; 
			var parametros	=	{ idRecurrente: idRecurrente, idEmpresa : idEmpresa, idPersona : idPersona, idRelPeriocidad:idRelPeriocidad};
			$.ajax({
				url: controlador,  
				type: 'POST',
				data: parametros,
				dataType:"json",
				//una vez finalizado correctamente
				success: function(json){
					console.log(json);
					$scope.respuestas = json.respuesta;
					$scope.archivos = json.arrayArchivos;
					$scope.idEmpresa	=json.idEmpresa;
					//pregunta1
					if($scope.respuestas[0] == "SI"){
						document.querySelector('input[id=pregunta1][value="SI"]').checked = true;
						$scope.mostrarInput1();
						$scope.urlArchivo1 = $scope.archivos[0];
						$scope.uno = "SI";
						$scope.$apply();
						document.querySelector('input[id=pregunta1][value="SI"]').checked = true;
					} if($scope.respuestas[0] == "NO"){
						$scope.uno = "NO";
						$scope.$apply();
						document.querySelector('input[id=pregunta1][value="NO"]').checked = true;
					} if($scope.respuestas[0] == "NO/A"){
						$scope.uno ="NO/A";
						$scope.$apply();
						document.querySelector('input[id=pregunta1][value="NO/A"]').checked = true;
					} 
					//pregunta2
					if($scope.respuestas[1] == "SI"){
						document.querySelector('input[id=pregunta2][value="SI"]').checked = true;
						$scope.mostrarInput2();
						$scope.urlArchivo2 = $scope.archivos[1];
						$scope.dos = "SI";
						$scope.$apply();
						document.querySelector('input[id=pregunta2][value="SI"]').checked = true;
					} if($scope.respuestas[1] == "NO"){
						$scope.dos = "NO";
						$scope.$apply();
						document.querySelector('input[id=pregunta2][value="NO"]').checked = true;
					} if($scope.respuestas[1] == "NO/A"){
						$scope.dos = "NO/A";
						$scope.$apply();
						document.querySelector('input[id=pregunta2][value="NO/A"]').checked = true;
					} 
					//pregunta3
					if($scope.respuestas[2] == "SI"){
						document.querySelector('input[id=pregunta3][value="SI"]').checked = true;
						$scope.mostrarInput3();
						$scope.urlArchivo3 = $scope.archivos[2];
						$scope.tres = "SI";
						$scope.$apply();
						document.querySelector('input[id=pregunta3][value="SI"]').checked = true;
					} if($scope.respuestas[2] == "NO"){
						$scope.tres = "NO";
						$scope.$apply();
						document.querySelector('input[id=pregunta3][value="NO"]').checked = true;
					} if($scope.respuestas[2] == "NO/A"){
						$scope.tres = "NO/A";
						$scope.$apply();
						document.querySelector('input[id=pregunta3][value="NO/A"]').checked = true;
					}
					//pregunta4
					if($scope.respuestas[3] == "SI"){
						document.querySelector('input[id=pregunta4][value="SI"]').checked = true;
						$scope.mostrarInput4();
						$scope.urlArchivo4 = $scope.archivos[3];
						$scope.cuatro = "SI";
						$scope.$apply();
						document.querySelector('input[id=pregunta4][value="SI"]').checked = true;
					} if($scope.respuestas[3] == "NO"){
						$scope.cuatro = "NO";
						$scope.$apply();
						document.querySelector('input[id=pregunta4][value="NO"]').checked = true;
					} if($scope.respuestas[3] == "NO/A"){
						$scope.cuatro = "NO/A";
						$scope.$apply();
						document.querySelector('input[id=pregunta4][value="NO/A"]').checked = true;
					} 
					//pregunta 5
					if($scope.respuestas[4] == "SI"){
						document.querySelector('input[id=pregunta5][value="SI"]').checked = true;
						$scope.mostrarInput5();
						$scope.urlArchivo5 = $scope.archivos[4];
						$scope.cinco = "SI";
						$scope.$apply();
						document.querySelector('input[id=pregunta5][value="SI"]').checked = true;
					} if($scope.respuestas[4] == "NO"){
						$scope.cinco = "NO";
						$scope.$apply();
						document.querySelector('input[id=pregunta5][value="NO"]').checked = true;
					} if($scope.respuestas[4] == "NO/A"){
						$scope.cinco = "NO/A";
						$scope.$apply();
						document.querySelector('input[id=pregunta5][value="NO/A"]').checked = true;
					} 
					//pregunta6
					if($scope.respuestas[5] == "SI"){
						document.querySelector('input[id=pregunta6][value="SI"]').checked = true;
						$scope.mostrarInput6();
						$scope.urlArchivo6 = $scope.archivos[5];
						$scope.seis = "SI";
						$scope.$apply();
						document.querySelector('input[id=pregunta6][value="SI"]').checked = true;
					} if($scope.respuestas[5] == "NO"){
						$scope.seis = "NO";
						$scope.$apply();
						document.querySelector('input[id=pregunta6][value="NO"]').checked = true;
					} if($scope.respuestas[5] == "NO/A"){
						$scope.seis = "NO/A";
						$scope.$apply();
						document.querySelector('input[id=pregunta6][value="NO/A"]').checked = true;
					}

					$scope.arrayResOficial = json.arrayResOficial;
					if($scope.arrayResOficial != ""){
						if($scope.arrayResOficial[0] == "SI"){
							document.querySelector('input[id=pregunta1o][value="SI"]').checked = true;
						} if($scope.arrayResOficial[0] == "NO"){
							document.querySelector('input[id=pregunta1o][value="NO"]').checked = true;
						} if($scope.arrayResOficial[1] == "SI"){
							document.querySelector('input[id=pregunta2o][value="SI"]').checked = true;
						} if($scope.arrayResOficial[1] == "NO"){
							document.querySelector('input[id=pregunta2o][value="NO"]').checked = true;
						} if($scope.arrayResOficial[2] == "SI"){
							document.querySelector('input[id=pregunta3o][value="SI"]').checked = true;
						} if($scope.arrayResOficial[2] == "NO"){
							document.querySelector('input[id=pregunta3o][value="NO"]').checked = true;
						} if($scope.arrayResOficial[3] == "SI"){
							document.querySelector('input[id=pregunta4o][value="SI"]').checked = true;
						} if($scope.arrayResOficial[3] == "NO"){
							document.querySelector('input[id=pregunta4o][value="NO"]').checked = true;
						} if($scope.arrayResOficial[4] == "SI"){
							document.querySelector('input[id=pregunta5o][value="SI"]').checked = true;
						} if($scope.arrayResOficial[4] == "NO"){
							document.querySelector('input[id=pregunta5o][value="NO"]').checked = true;
						} if($scope.arrayResOficial[5] == "SI"){
							document.querySelector('input[id=pregunta6o][value="SI"]').checked = true;
						} if($scope.arrayResOficial[5] == "NO"){
							document.querySelector('input[id=pregunta6o][value="NO"]').checked = true;
						} 
					}
				},
				//si ha ocurrido un error
				error: function(){
				}
			});
		}
	}
	var resPreguntas=[];
	var archivos = [];
	$scope.enviarFormulario = function(){
		var pregunta1 			= $('input[name="pregunta1"]:checked').val();
		var archivo1			= $("#archivo1").val();
		var pregunta2 			= $('input[name="pregunta2"]:checked').val();
		var archivo2			= $("#archivo2").val();
		var pregunta3 			= $('input[name="pregunta3"]:checked').val();
		var archivo3			= $("#archivo3").val();
		var pregunta4 			= $('input[name="pregunta4"]:checked').val();
		var archivo4			= $("#archivo4").val();
		var pregunta5 			= $('input[name="pregunta5"]:checked').val();
		var archivo5			= $("#archivo5").val();
		var pregunta6 			= $('input[name="pregunta6"]:checked').val();
		var archivo6			= $("#archivo6").val();
		var idNuevaMatriz 		= $("#idNuevaMatriz").val();
		var idPersona 			= $("#idPersona").val();
		var idMatrizRecurrente 	= $("#idMatrizRecurrente").val();
		var idEmpresa 			= $("#idEmpresa").val();
		var comentario 			= $('#comentarios').val();
		var idRelPeriocidad = $("#idRelPeriocidad").val();
		var edita				= $('#edita').val();
		// alert(pregunta1);
		if(pregunta1 == undefined){
			constantes.alerta("Atención","Debe de chekear la respuesta para la pregunta 1.","info",function(){});
		}else if(pregunta1 == "SI" && archivo1 == ""){
			constantes.alerta("Atención","Debe de agregar un documento para la preunta1.","info",function(){});
		}else if(pregunta2 == undefined){
			constantes.alerta("Atención","Debe de chekear la respuesta para la pregunta 2.","info",function(){});
		}else if(pregunta2 == "SI" && archivo2 == ""){
			constantes.alerta("Atención","Debe de agregar un documento para la preunta2.","info",function(){});
		}else if(pregunta3 == undefined){
			constantes.alerta("Atención","Debe de chekear la respuesta para la pregunta 3.","info",function(){});
		}else if(pregunta3 == "SI" && archivo3 == ""){
			constantes.alerta("Atención","Debe de agregar un documento para la preunta3.","info",function(){});
		}else if(pregunta4 == undefined){
			constantes.alerta("Atención","Debe de chekear la respuesta para la pregunta 4.","info",function(){});
		}else if(pregunta4 == "SI" && archivo4 == ""){
			constantes.alerta("Atención","Debe de agregar un documento para la preunta4.","info",function(){});
		}else if(pregunta5 == undefined){
			constantes.alerta("Atención","Debe de chekear la respuesta para la pregunta 5.","info",function(){});
		}else if(pregunta5 == "SI" && archivo5 == ""){
			constantes.alerta("Atención","Debe de agregar un documento para la preunta5.","info",function(){});
		}else if(pregunta6 == undefined){
			constantes.alerta("Atención","Debe de chekear la respuesta para la pregunta 6.","info",function(){});
		}else if(pregunta6 == "SI" && archivo6 == ""){
			constantes.alerta("Atención","Debe de agregar un documento para la preunta6.","info",function(){});
		}else if(comentario == ""){
			constantes.alerta("Atención","Debe de escribir un comentario.","info",function(){});
		}else{
			resPreguntas.push(pregunta1,pregunta2,pregunta3,pregunta4,pregunta5,pregunta6);
			var respuestas =resPreguntas;
			archivos.push(archivo1,archivo2,archivo3,archivo4,archivo5,archivo6);
			constantes.confirmacion("Confirmación","Esta apunto de actualizar el formulario, ¿Desea continuar?",'info',function(){
				var controlador = $scope.config.apiUrl+"MisMatrices/actualizaCheck";
				var parametros  = 	"respuestas="+respuestas+"&archivos="+archivos+"&idNuevaMatriz="+idNuevaMatriz+"&idPersona="+idPersona+"&idMatrizRecurrente="+idMatrizRecurrente+"&comentario="+comentario+"&idEmpresa="+idEmpresa+"&idRelPeriocidad="+idRelPeriocidad;
				constantes.consultaApi(controlador,parametros,function(json){
					if(json.continuar == 1){
						constantes.alerta("Atención",json.mensaje,"success",function(){
							location.reload();
						});
					}
					else{
						constantes.alerta("Atención",json.mensaje,"warning",function(){});
					}
				});
			});
		}
	}
	var resOficiales=[];
	//envio respuestas de oficial de cumplimiento
	$scope.enviarFormularioOficial = function(){
		var idNuevaMatriz 		= $("#idNuevaMatriz").val();
		var idPersona 			= $("#idPersona").val();
		var idMatrizRecurrente 	= $("#idMatrizRecurrente").val();
		var idEmpresa 			= $("#idEmpresa").val();
		var idRelPeriocidad = $("#idRelPeriocidad").val();

		var pregunta1o 			= $('input[name="pregunta1o"]:checked').val();
		var pregunta2o 			= $('input[name="pregunta2o"]:checked').val();
		var pregunta3o 			= $('input[name="pregunta3o"]:checked').val();
		var pregunta4o 			= $('input[name="pregunta4o"]:checked').val();
		var pregunta5o 			= $('input[name="pregunta5o"]:checked').val();
		var pregunta6o 			= $('input[name="pregunta6o"]:checked').val();

		if(pregunta1o == undefined){
			constantes.alerta("Atención","Debe de chekear la respuesta para la pregunta 1.","info",function(){});
		} else if(pregunta2o == undefined){
			constantes.alerta("Atención","Debe de chekear la respuesta para la pregunta 2.","info",function(){});
		} else if(pregunta3o == undefined){
			constantes.alerta("Atención","Debe de chekear la respuesta para la pregunta 3.","info",function(){});
		} else if(pregunta4o == undefined){
			constantes.alerta("Atención","Debe de chekear la respuesta para la pregunta 4.","info",function(){});
		} else if(pregunta5o == undefined){
			constantes.alerta("Atención","Debe de chekear la respuesta para la pregunta 5.","info",function(){});
		} else if(pregunta6o == undefined){
			constantes.alerta("Atención","Debe de chekear la respuesta para la pregunta 6.","info",function(){});
		}else{
			resOficiales.push(pregunta1o,pregunta2o,pregunta3o,pregunta4o,pregunta5o,pregunta6o);
			var respuestasOficiales =resOficiales;
			constantes.confirmacion("Confirmación","Esta apunto de actualizar el formulario, ¿Desea continuar?",'info',function(){
				var controlador = $scope.config.apiUrl+"MisMatrices/actualizaCheck";
				var parametros  = "resOficial="+respuestasOficiales+"&idNuevaMatriz="+idNuevaMatriz+"&idPersona="+idPersona+"&idMatrizRecurrente="+idMatrizRecurrente+"&idEmpresa="+idEmpresa+"&idRelPeriocidad="+idRelPeriocidad;
				constantes.consultaApi(controlador,parametros,function(json){
					if(json.continuar == 1){
						constantes.alerta("Atención",json.mensaje,"success",function(){
							location.reload();
						});
					} else{
						constantes.alerta("Atención",json.mensaje,"warning",function(){});
					}
				});
			});
		}
	}



	
	var resPreguntas=[];
	var archivos = [];

	$scope.checkboxes = function() {
		var pregunta1 			= $('input[name="pregunta1"]:checked').val();
		var archivo1			= $("#archivo1").val();
		var pregunta2 			= $('input[name="pregunta2"]:checked').val();
		var archivo2			= $("#archivo2").val();
		var pregunta3 			= $('input[name="pregunta3"]:checked').val();
		var archivo3			= $("#archivo3").val();
		var pregunta4 			= $('input[name="pregunta4"]:checked').val();
		var archivo4			= $("#archivo4").val();
		var pregunta5 			= $('input[name="pregunta5"]:checked').val();
		var archivo5			= $("#archivo5").val();
		var pregunta6 			= $('input[name="pregunta6"]:checked').val();
		var archivo6			= $("#archivo6").val();
		var idNuevaMatriz 		= $("#idNuevaMatriz").val();
		var idPersona 			= $("#idPersona").val();
		// var idPerfil 			= $("#idPerfil").val();
		var idMatrizRecurrente 	= $("#idMatrizRecurrente").val();
		var idEmpresa 			= $("#idEmpresa").val();
		var comentario 			= $('#comentarios').val();
		var idRelPeriocidad 	= $('#idRelPeriocidad').val();
		var edita				= $('#edita').val();
		// alert(pregunta1);
		if(pregunta1 == undefined){
			constantes.alerta("Atención","Debe de chekear la respuesta para la pregunta 1.","info",function(){});
		}else if(pregunta1 == "SI" && archivo1 == ""){
			constantes.alerta("Atención","Debe de agregar un documento para la preunta1.","info",function(){});
		}else if(pregunta2 == undefined){
			constantes.alerta("Atención","Debe de chekear la respuesta para la pregunta 2.","info",function(){});
		}else if(pregunta2 == "SI" && archivo2 == ""){
			constantes.alerta("Atención","Debe de agregar un documento para la preunta2.","info",function(){});
		}else if(pregunta3 == undefined){
			constantes.alerta("Atención","Debe de chekear la respuesta para la pregunta 3.","info",function(){});
		}else if(pregunta3 == "SI" && archivo3 == ""){
			constantes.alerta("Atención","Debe de agregar un documento para la preunta3.","info",function(){});
		}else if(pregunta4 == undefined){
			constantes.alerta("Atención","Debe de chekear la respuesta para la pregunta 4.","info",function(){});
		}else if(pregunta4 == "SI" && archivo4 == ""){
			constantes.alerta("Atención","Debe de agregar un documento para la preunta4.","info",function(){});
		}else if(pregunta5 == undefined){
			constantes.alerta("Atención","Debe de chekear la respuesta para la pregunta 5.","info",function(){});
		}else if(pregunta5 == "SI" && archivo5 == ""){
			constantes.alerta("Atención","Debe de agregar un documento para la preunta5.","info",function(){});
		}else if(pregunta6 == undefined){
			constantes.alerta("Atención","Debe de chekear la respuesta para la pregunta 6.","info",function(){});
		}else if(pregunta6 == "SI" && archivo6 == ""){
			constantes.alerta("Atención","Debe de agregar un documento para la preunta6.","info",function(){});
		}else if(comentario == ""){
			constantes.alerta("Atención","Debe de escribir un comentario.","info",function(){});
		}else{
			resPreguntas.push(pregunta1,pregunta2,pregunta3,pregunta4,pregunta5,pregunta6);

			var respuestas =resPreguntas;
			archivos.push(archivo1,archivo2,archivo3,archivo4,archivo5,archivo6);

				constantes.confirmacion("Confirmación","Esta apunto de guardar el formulario, ¿Desea continuar?",'info',function(){
					var controlador = $scope.config.apiUrl+"MisMatrices/nuevocheck";
					var parametros  = 	"respuestas="+respuestas+"&archivos="+archivos+"&idNuevaMatriz="+idNuevaMatriz+"&idPersona="+idPersona+"&idMatrizRecurrente="+idMatrizRecurrente+"&comentario="+comentario+"&idEmpresa="+idEmpresa+"&idRelPeriocidad="+idRelPeriocidad;
					constantes.consultaApi(controlador,parametros,function(json){
						if(json.continuar == 1){
							constantes.alerta("Atención",json.mensaje,"success",function(){
								location.reload();
							});
						}else{
							constantes.alerta("Atención",json.mensaje,"warning",function(){});
						}
					});
				});	
		}
        // Realizar cualquier otra lógica necesaria con los valores de los checkboxes
	}	

	
	$scope.mostrarInputFile = function() {
		$scope.mostrarFile = !$scope.mostrarFile;
	  };

});