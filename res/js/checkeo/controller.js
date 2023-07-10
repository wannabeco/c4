/*
* Controlador que maneja todas las funcionalidades de la creación de usuarios
* @author Farez Prieto @orugal
* @date 15 de Noviembre de 2016
*/
project.controller('checkeador', function($scope, $http, $q, constantes) {	

	$scope.config 			=  configLogin;//configuración global

	var resPreguntas=[];

	$scope.checkboxes = function() {
		var pregunta1 			= $('input[name="pregunta1"]:checked').val();
		var pregunta2 			= $('input[name="pregunta2"]:checked').val();
		var pregunta3 			= $('input[name="pregunta3"]:checked').val();
		var pregunta4 			= $('input[name="pregunta4"]:checked').val();
		var pregunta5 			= $('input[name="pregunta5"]:checked').val();
		var pregunta6 			= $('input[name="pregunta6"]:checked').val();
		var idNuevaMatriz 		= $("#idNuevaMatriz").val();
		var idPersona 			= $("#idPersona").val();
		var idPerfil 			= $("#idPerfil").val();
		var idMatrizRecurrente 	= $("#idMatrizRecurrente").val();
		var idEmpresa 			= $("#idEmpresa").val();
		var comentario 			= $('#comentarios').val();

		if(pregunta1 == undefined){
			constantes.alerta("Atención","Debe de chekear la respuesta para la pregunta 1.","info",function(){});
		}else if(pregunta2 == undefined){
			constantes.alerta("Atención","Debe de chekear la respuesta para la pregunta 2.","info",function(){});
		}else if(pregunta3 == undefined){
			constantes.alerta("Atención","Debe de chekear la respuesta para la pregunta 3.","info",function(){});
		}else if(pregunta4 == undefined){
			constantes.alerta("Atención","Debe de chekear la respuesta para la pregunta 4.","info",function(){});
		}else if(pregunta5 == undefined){
			constantes.alerta("Atención","Debe de chekear la respuesta para la pregunta 5.","info",function(){});
		}else if(pregunta6 == undefined){
			constantes.alerta("Atención","Debe de chekear la respuesta para la pregunta 6.","info",function(){});
		}else if(comentario == ""){
			constantes.alerta("Atención","Debe de escribir un comentario.","info",function(){});
		}else{
			resPreguntas.push(pregunta1,pregunta2,pregunta3,pregunta4,pregunta5,pregunta6);
			var respuestas =resPreguntas;
			constantes.confirmacion("Confirmación","Esta apunto de guardar el formulario, las opciones son: Pregunta Nº1 = "+pregunta1+", Pregunta Nº2 = "+pregunta2+", Pregunta Nº3 = "+pregunta3+", Pregunta Nº4 = "+pregunta4+", Pregunta Nº5 = "+pregunta5+", Pregunta Nº6 = "+pregunta6+". ¿desea continuar?",'info',function(){
				var controlador = $scope.config.apiUrl+"MisMatrices/nuevocheck";
				var parametros  = "respuestas="+respuestas+"&idNuevaMatriz="+idNuevaMatriz+"&idPersona="+idPersona+"&idMatrizRecurrente="+idMatrizRecurrente+"&comentario="+comentario+"&idPerfil="+idPerfil+"&idEmpresa="+idEmpresa;
				constantes.consultaApi(controlador,parametros,function(json){
					if(json.continuar == 1){
						constantes.alerta("Atención",json.mensaje,"success",function(){
							window.location = $scope.config.apiUrl+"MisMatrices/matrices/43";
						});
					}
					else{
						constantes.alerta("Atención",json.mensaje,"warning",function(){});
					}
				});
			});
		}

        // Realizar cualquier otra lógica necesaria con los valores de los checkboxes
	}
});