/*
* Controlador que maneja todas las funcionalidades de la creación de usuarios
* @author Farez Prieto @orugal
* @date 15 de Noviembre de 2016
*/
project.controller('crearMatriz', function($scope,$http,$q,constantes)
{	
    $scope.initcreaMatriz = function(){
		$scope.config 			=  configLogin;//configuración global		
    }
	$scope.tipoP = "";
	$scope.check ="";
	$scope.Precio = 25000;
	$scope.idEmpresa =""
	
	$scope.irCreaMatriz =function(){
		window.location = $scope.config.apiUrl+"CrearMatriz/creaNuevaMatriz/40";
	}
	$scope.verMatriz = function($id){
		window.location = $scope.config.apiUrl+"InfomarcionMatriz/informacion/42/"+$id;
	}

	//funcion para agregar tipos de empresas a la plantilla especifica
	var tipos = [];
	var nombre = [];
	var ids =[];
	$scope.agrega =function(){
		nombre.push($('#tipoEmpresa').val());
		var valorSeleccionado = $('#tipoEmpresa').val();
		var partes = valorSeleccionado.split(',');
		var numero = partes[0].trim();
		
		if (!ids.includes(numero)) {
			ids.push(numero);
		}

		tipos.push(nombre);
		$(".tipos").html(tipos[0].map(function(elemento) {
			var palabra = elemento.split(',')[1].trim();
			return '<span class="badge bg-success" style="font-size:16px; color:white; margin-left:10px;">' + palabra + ' <a href="#" class="eliminar text-danger" data-palabra="' + palabra + '"> X </a></span>';
		}).join(''));
	}
	$(document).on('click', '.eliminar', function() {
		var palabraEliminar = $(this).data('palabra');
		var indice = tipos[0].findIndex(function(elemento) {
		  return elemento.split(',')[1].trim() === palabraEliminar;
		});
	  
		if (indice !== -1) {
		  tipos[0].splice(indice, 1);
	  
		$(".tipos").html(tipos[0].map(function(elemento) {
		  var palabra = elemento.split(',')[1].trim();
		  return '<span class="badge bg-success" style="font-size:16px; color:white; margin-left:10px;">' + palabra + ' <a href="#" class="eliminar text-danger" data-palabra="' + palabra + '"> X </a></span>';
		}).join(''));
	  }
	});
	//fin de funcion tipos de empresa


	$scope.agregaNuevaMatriz = function(){
		var nombreNuevaMatriz 	= $('#nombreNuevaMatriz').val();
		var dirigida 			= $('input[name="dirigida"]:checked').val();
		var tipoEmpresa       	= ids;
		var gratis			  	= $("#gratis").val();
		var Precio			  	= $("#Precio").val();
		var descripcion		  	= $("#descripcion").val();
		//empiezo la validación de campos que será la misma si es editar que si es crear
		
		if(nombreNuevaMatriz == "" && tipoEmpresa == ""){
			constantes.alerta("Atención","Debe escribir un nombre de mastriz.","info",function(){});
		}else if(Precio ==""){
			constantes.alerta("Atención","Debe escribir un precio para la matriz, de no tener ningun valor, por favor agregr 0.","info",function(){});
		}else if(descripcion == ""){
			constantes.alerta("Atención","Debe escribir una breve descripción para la matriz, así podrá ser identificada correctamente.","info",function(){});
		}else if(gratis == ""){
			constantes.alerta("Atención","Debe seleccionar si la matriz sera gratis al registrar empresa","info",function(){});
		}else if(dirigida == undefined){
			constantes.alerta("Atención","Debe seleccionar Tipo Plantilla.","info",function(){});
		}else if(dirigida == 2 && tipoEmpresa == ""){
			constantes.alerta("Atención","Debe seleccionar el tipo de empresa","info",function(){});
		}
		else{
			constantes.confirmacion("Confirmación","Esta apunto de crear una matriz, ¿desea continuar?",'info',function(){
				var controlador = $scope.config.apiUrl+"CrearMatriz/creaLaNuevaMatriz";
				var parametros  = 	$("#agregaNuevaMatriz").serialize()+"&idTipoEmpresa="+tipoEmpresa;
				constantes.consultaApi(controlador,parametros,function(json){
					if(json.continuar == 1){
						constantes.alerta("Atención",json.mensaje,"success",function(){
							window.location = $scope.config.apiUrl+"MatricesCreadas/matricesCreadas/41";
						});
					}
					else{
						constantes.alerta("Atención",json.mensaje,"warning",function(){});
					}
				});
			});
		}
	}
	
	  

	$scope.recargar = function(){
		location.reload();
	}

	//plantilla crea parametros a matriz
	$scope.cargaPlantillaparametros = function(idNuevaMatriz,edita){	
		$('#modalParametros').modal("show");
		var controlador = 	$scope.config.apiUrl+"CrearMatriz/parametrizaciones";
		var parametros  = 	"edita="+edita+"&idNuevaMatriz="+idNuevaMatriz;
		constantes.consultaApi(controlador,parametros,function(json){
			$("#modalCrea").html(json);
			$scope.compileAngularElement("#formAgregaParametros");
		},'');
	}
	//plantilla crea parametros a matriz
	$scope.cargaPlantillaMatriz = function(idMatriz){	
		$('#modalMatriz').modal("show");
		var controlador = 	$scope.config.apiUrl+"CrearMatriz/actualizaMatriz";
		var parametros  = 	"idNuevaMatriz="+idMatriz;
		constantes.consultaApi(controlador,parametros,function(json){
			$("#modaldeMatriz").html(json);
			$scope.compileAngularElement("#formMatriz");
			$scope.muestraTipoEmpresa();
		},'');

	}
	//modal de check
	$scope.check = function(idMatriz,idRecurrente,edita){
		$('#modalCheck').modal("show");
		var controlador = 	$scope.config.apiUrl+"CrearMatriz/formCheck";
		var parametros  = 	"edita="+edita+"&idNuevaMatriz="+idMatriz+"&idRecurrente="+idRecurrente;
		constantes.consultaApi(controlador,parametros,function(json){
			$("#modalformCheck").html(json);
			$scope.compileAngularElement("#formulario");
		},'');
	}
	//checkeo 
	$scope.checkCompleto = function(idRecurrente,idMatriz,idEmpresa,idResponsable,edita){
		$('#modalCheck').modal("show");
		var controlador = 	$scope.config.apiUrl+"CrearMatriz/formCheck";
		var parametros  = 	"edita="+edita+"&idNuevaMatriz="+idMatriz+"&idRecurrente="+idRecurrente+"&idEmpresa="+idEmpresa+"&idResponsable="+idResponsable;
		constantes.consultaApi(controlador,parametros,function(json){
			$("#modalformCheck").html(json);
			$scope.compileAngularElement("#formulario");
		},'');
	}	

	$scope.muestraTipoEmpresa =function(){
		var tipoEmpresa = $("#dirigida").val();
		$scope.tipoP = tipoEmpresa;
	}
	
	//elimina matriz
	$scope.borraMatriz = function($id){
		constantes.confirmacion("Confirmación","Esta apunto de eliminar una matriz, ¿desea continuar?",'info',function(){
		var controlador = $scope.config.apiUrl+"MatricesCreadas/eliminaNuevaMatriz";
			var parametros  = {idNuevaMatriz:$id}
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
		var controlador = $scope.config.apiUrl+"MatricesCreadas/eliminalaMatriz";
			var parametros  = {idMatrizes:$id}
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
	$scope.borraParametro = function($id){
		constantes.confirmacion("Confirmación","Esta apunto de eliminar el parametro, ¿desea continuar?",'info',function(){
			var controlador = $scope.config.apiUrl+"InfomarcionMatriz/eliminaParametro";
			var parametros  = {$id}
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
	$scope.volver = function(){
		var parametro = 37;
		var idEmpresa = $scope.idEmpresa;
		window.location = $scope.config.apiUrl+"Empresas/matrices/"+parametro+"/"+idEmpresa;
	}
	$scope.crearnuevaItem =function($id){
		$('#sugerirIteme').modal("show");
	 	var controlador = $scope.config.apiUrl+"MisMatrices/sugerirItem";
	 	var parametros  = "idMatriz="+$id;
	 	constantes.consultaApi(controlador,parametros,function(json){
	 		$("#modalCreaNuevoItem").html(json);
	 		// actualiza el DOM
	 		$scope.compileAngularElement("#sugerirItem");
	 	},'');
	}

	//siguere item interno de matriz
	$scope.sugerirItema = function(){
		var descripcion = $("#descripcion").val();
		var nombre 		= $("#nombre").val();
		var email 		= $("#email").val();
		var matriz 		= $("#matriz").val();
		if(descripcion == ""){
			constantes.alerta("Atención","Es necesario escribir una descipcion para sugerir una matriz.",'info',function(){});
		}
		else{
			constantes.confirmacion("Atención","Esta apunto de sugerir una matriz, ¿Desea continuar?.",'info',function(){
				var controlador = 	$scope.config.apiUrl+"Buscar/sugiereMatriz";
				var parametros  = "nombre="+nombre+"&email="+email+"&descripcion="+descripcion+"&matriz="+matriz;
				constantes.consultaApi(controlador,parametros,function(json){
					if(json.continuar == 1){
						constantes.alerta("Atención",json.mensaje,"success",function(){
							window.location.assign($scope.config.apiUrl+"MisMatrices/matrices/43"); 
						});
					}
					else{
						constantes.alerta("Atención",json.mensaje,"warning",function(){});
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

project.controller('crearParametrosMatriz', function($scope,$http,$q,constantes)
{	

	$scope.tipoP = "";	
	$scope.config 			=  configLogin;//configuración global

	//nueva funcion de agrega tipo empresa
	var tipo = [];
	var nombres = [];
	var idse =[];

	$scope.initformMatriz =function(){
		$scope.muestraTipoEmpresa();
	}
	$scope.agregaNuevo = function(){
		nombres.push($('#tipoEmpresa').val());
		var valorSeleccionado = $('#tipoEmpresa').val();
		var partes = valorSeleccionado.split(',');
		var numero = partes[0].trim();
		
		if (!idse.includes(numero)) {
			idse.push(numero);
		}

		tipo.push(nombres);
		$(".tipo").html(tipo[0].map(function(elemento) {
			var palabra = elemento.split(',')[1].trim();
			return '<span class="badge bg-success" style="font-size:16px; color:white; margin-left:10px;">' + palabra + ' <a href="#" class="eliminara text-danger" data-palabra="' + palabra + '"> X </a></span>';
		}).join(''));
	}

	$(document).on('click', '.eliminara', function() {
		var palabraEliminar = $(this).data('palabra');
		var indice = tipo[0].findIndex(function(elemento) {
		  return elemento.split(',')[1].trim() === palabraEliminar;
		});
	  
		if (indice !== -1) {
		  tipo[0].splice(indice, 1);
	  
		$(".tipo").html(tipo[0].map(function(elemento) {
		  var palabra = elemento.split(',')[1].trim();
		  return '<span class="badge bg-success" style="font-size:16px; color:white; margin-left:10px;">' + palabra + ' <a href="#" class="eliminara text-danger" data-palabra="' + palabra + '"> X </a></span>';
		}).join(''));
	  }
	});



	$scope.muestraTipoEmpresa =function(){
		var tipoEmpresa = $("#dirigida").val();
		$scope.tipoP = tipoEmpresa;
	}

	$(document).on('click', '.eliminara', function() {
		$scope.borraParametro();
	});



	//agrega parametros a matriz
	$scope.agregaNuevaParametro = function(edita){

		var obligacion 			= $('#obligacion').val();
		var idEntidad       	= $('#idEntidad').val();
		var normatividad       	= $('#normatividad').val();
		var frecuencia       	= $('#frecuencia').val();
		var idcuandoAplique     = $('#idcuandoAplique').val();
		var idResponsable       = $('#idResponsable').val();
		var idccsm       		= $('#idccsm').val();
		var idMetodoControl     = $('#idMetodoControl').val();
		var idperiodicidad      = $('#idperiodicidad').val();
		var estado      		= $('#estado').val();
		
		//empiezo la validación de campos que será la misma si es editar que si es crear
		
		if(obligacion == ""){
			constantes.alerta("Debe de escribir la obligacion a cumplir.","info",function(){});
		}else if(idEntidad == ""){
			constantes.alerta("Atención","Debe seleccionar una entidad.","info",function(){});
		}else if(normatividad == ""){
			constantes.alerta("Atención","Debe escribir la normatividad de regulación.","info",function(){});
		}else if(frecuencia == ""){
			constantes.alerta("Atención","Debe escribir la frecuencia de ejecucion.","info",function(){});
		}else if(idcuandoAplique == ""){
			constantes.alerta("Atención","Debe seleccionar cuando se aplica.","info",function(){});
		}else if(idResponsable == ""){
			constantes.alerta("Atención","Debe seleccionar el responsable.","info",function(){});
		}else if(idccsm == ""){
			constantes.alerta("Atención","Debe seleccionar si corresponde a Ccsm.","info",function(){});
		}else if(idMetodoControl == ""){
			constantes.alerta("Atención","Debe seleccionar la metodologia de control.","info",function(){});
		}else if(idperiodicidad == ""){
			constantes.alerta("Atención","Debe seleccionar la periodicidad.","info",function(){});
		}else if(estado == ""){
			constantes.alerta("Atención","Debe seleccionar un estado para el parametro.","info",function(){});
		}else{
			var texto = (edita==1)?"Está apunto de editar la información del parametro, ¿desea continuar?":"Está a punto de insertar un nuevo parametro, ¿desea continuar?";
			constantes.confirmacion("Confirmación",texto,'info',function(){
				var controlador = $scope.config.apiUrl+"CrearMatriz/crearParametros";
				var parametros  = 	$("#formAgregaParametros").serialize()+"&edita="+edita;
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

	//se actualiza matriz
	$scope.actualizarMatriz = function(){
		constantes.confirmacion("Confirmación","Esta apunto de actualizar la matriz,¿desea continuar?",'info',function(){
			var controlador = $scope.config.apiUrl+"CrearMatriz/actualizaMatrizGeneral";
			var parametros  = 	$("#formMatriz").serialize()+"&idse="+idse;
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
	//elimina tipo de empresa que se encuentran asignadas
	$scope.deliminaAdiccion = function($id) {
		constantes.confirmacion("Atención","Esta apunto de eliminar el tipo de empresa:, ¿desea continuar?",'info',function(){
			var controlador = $scope.config.apiUrl+"CrearMatriz/eliminaRelacion";
			var parametros  = {$id}
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
	};


});