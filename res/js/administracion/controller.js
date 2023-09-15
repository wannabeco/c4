/*
* Controlador que maneja todas las funcionalidades de la zona personas
* @author Farez Prieto @orugal
* @date 13 de Julio 2016
*/
project.controller('modulos', function($scope,$http,$q,constantes)
{
	$scope.modulos 	= [];
	$scope.modulosInternos 	= [];
	$scope.palabra 		= $("#palabra").val();
	$scope.idPersona 	= $("#idPersona").val();
	$scope.padreModulo	=	"";
	$scope.categoriaEditar = {};
	var users = [];
	var fotoUsuarioSug 	= ""; 
	$scope.adminInit = function()
	{
		$scope.config 			=  configLogin; //configuración global
		$scope.getModulos();
	}

	$scope.initModal = function()
	{
		$scope.config 			=  configLogin; //configuración global
		$scope.getModulos();
	}
	$scope.getModulos = function()
	{
		var controlador = 	$scope.config.apiUrl+"Admin/getModulosCompletos";
		var parametros  = 	"padre="+0;
		constantes.consultaApi(controlador,parametros,function(json){
			if(json.continuar == 1)
			{
				$scope.modulos		=	json.datos;
				$scope.$digest();
			}
			else
			{
				constantes.alerta("Atención",json.mensaje,"warning",function(){})
			}
		});
	}
	$scope.estadoCategoriaPrincipal = function(categoria,estadoActual)
	{
		var texto = (estadoActual == 1)?"Está a punto de apagar la categoría seleccionada, desea continuar":"Está a punto de encender la categoría, desea continuar?";
		constantes.confirmacion("Confirmación",texto,'info',function(){
			var controlador = 	$scope.config.apiUrl+"Admin/estadoCategoriaModulo";
			var parametros  =   "idCategoria="+categoria+"&estadoActual="+estadoActual;
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
	$scope.agregarCategoria = function()
	{

		$scope.categoria = $("#categoria").val();
		//valido
		if($scope.categoria == undefined || $scope.categoria == ""){
			constantes.alerta("Atención","Debe escribir el nombre de la categoría","info",function(){});
		}
		else{
			constantes.confirmacion("Atención","Está a punto de crear una nueva categoría, ¿desea continuar?","info",function(){
					var controlador = 	$scope.config.apiUrl+"Admin/agregarCategoriaModulo";
					var parametros  =   "nombreModulo="+$scope.categoria;
					constantes.consultaApi(controlador,parametros,function(json){
						if(json.continuar == 1){
							$scope.getModulos();
							$("#palabra").val("");
							$scope.palabra  = "";
							$('#modalCategoria').modal('hide');

						}
						else{
							constantes.alerta("Atención",json.mensaje,"warning",function(){})
						}
					});
			});
		}
	}
	$scope.consultaModulosCategoria = function(padre)
	{
		$("#panelModulo").hide();
		$("#panelDescModulo").hide();
		var controlador = 	$scope.config.apiUrl+"Admin/getModulosCompletos";
		var parametros  = "padre="+padre;
		constantes.consultaApi(controlador,parametros,function(json){
			if(json.continuar == 1)
			{
				$("#panelModulo").fadeIn();
				$("#panelDescModulo").fadeIn();
				enlace  = "#panelModulo";
			    $('html, body').animate({
			        scrollTop: $(enlace).offset().top
			    }, 1000);
				$scope.modulosInternos		=	json.datos;
				$scope.padreModulo			=   padre;
				//$scope.compileAngularElement("#panelModulo");
				$scope.$digest();
			}
			else
			{
				constantes.alerta("Atención",json.mensaje,"warning",function(){})
			}
		});
	}
	/*
	* Me abre una plantilla que me permitira editar o crear los módulos
	*/
	$scope.cargaPlantillaCreacionModulos = function(id,edita)
	{
		$('#modalNModulo').modal("show");
		var controlador = 	$scope.config.apiUrl+"Admin/cargaPlantillaCreacionModulos";
		var parametros  = 	"edita="+edita+"&id="+id+"&padre="+$scope.padreModulo;//quiere decir que va a crear uno nuevo
		constantes.consultaApi(controlador,parametros,function(json){
				
			$("#modalCreaModulo").html(json);
			//actualiza el DOM
			$scope.compileAngularElement("#formAgregaModulo");
			//$scope.$apply();

			/*$('#modalNModulo').modal("show");
			setTimeout(function(){
				$("#modalCreaModulo").html(json)
			},1000);*/
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
		
	$scope.cargarDataCategoria = function(data) {
		$scope.categoriaEditar = {
			idModulo: data.idPadre,
			nombreModulo: data.nombreModulo,
			nombreActual: data.nombreModulo
		}
		$scope.$digest();
	}

	$scope.editarCategoria = function() {
		// validar si cambió el nombre
		if( $scope.categoriaEditar.nombreModulo != $scope.categoriaEditar.nombreActual ) {
			constantes.confirmacion("Atención","Está a punto de editar la categoría, ¿desea continuar?","info",function(){
				$.post( $scope.config.apiUrl+"Admin/editarCategoriaModulo", $scope.categoriaEditar, function(response){
					if( response.continuar == 1 ) {
						constantes.alerta("Correcto",response.mensaje,"success",function(){
							location.reload();
						});
					} else {
						constantes.alerta("Atención",response.mensaje,"error",function(){});
					}
				},"json");
			});
		} else {
			constantes.alerta("Atención","No ha cambiado el nombre de la categoría","warning",function(){});
		}
	}
	$scope.procesaModulos = function(accion)
	{
		var nombreModulo 	=	$("#nombreModulo").val();
		var urlModulo 		=	$("#urlModulo").val();
		var padre 			=	$("#idPadre").val();
		var idEditar 		=	$("#idEditar").val();
		var icono 			=	$("#icono").val();
		var orden 			=	$("#orden").val();
		//valido los campos
		if(nombreModulo == undefined || nombreModulo == ""){
			constantes.alerta("Atención","Debe escribir el nombre del módulo.","warning",function(){})
		}
		else if(urlModulo == undefined || urlModulo == ""){
			constantes.alerta("Atención","Debe escribir la URL donde se encuentra el código fuente del módulo.","warning",function(){})
		}
		else
		{
			//aquí se toma la decición de si se edita o se cre
			if(accion == 1)//edita
			{
				constantes.confirmacion("Confirmación","Esta apunto de crear un nuevo módulo, desea continuar",'info',function(){
					var controlador = 	$scope.config.apiUrl+"Admin/editarModulo";
					var parametros  = 	"edita="+accion+"&nombreModulo="+nombreModulo+"&urlModulo="+urlModulo+"&padre="+padre+"&idEditar="+idEditar+"&icono="+icono+"&orden="+orden+"&estado="+$("#estado").val();//quiere decir que va a crear uno nuevo
					constantes.consultaApi(controlador,parametros,function(json){
						if(json.continuar == 1)//procede a guardar los privilegios
						{
							//recorro e inserto los privilegios
							var elementoRecorrer     = $(".modulosLista");
							var cantElementosRecorre = $(".modulosLista").length;
							var cont 				 = 0;
							$.each(elementoRecorrer,function(){
								var idPerfil = $(this).attr("rel");
								//alert(idPerfil);
								var ver 	 = ($("#ver"+idPerfil).is(":checked"))?1:0;
								var crear 	 = ($("#crear"+idPerfil).is(":checked"))?1:0;
								var editar 	 = ($("#editar"+idPerfil).is(":checked"))?1:0;
								var borrar 	 = ($("#borrar"+idPerfil).is(":checked"))?1:0;

								var parametros  = 	"edita="+accion+"&idModulo="+idEditar+"&idPerfil="+idPerfil+"&ver="+ver+"&crear="+crear+"&editar="+editar+"&borrar="+borrar;//quiere decir que va a crear uno nuevo
								var controlador = 	$scope.config.apiUrl+"Admin/agregarPrivilegio";
								constantes.consultaApi(controlador,parametros,function(json)
								{
									if(json.continuar == 1)
									{
										cont++;
									}
									else
									{

									}

									//alert(cont+" - "+cantElementosRecorre)
									if(cont == cantElementosRecorre)
									{
										constantes.alerta("Atención","El módulo se ha creado exitosamente","success",function(){
											location.reload();
										})
									}

								},'json');
							});

						}
						else
						{
							constantes.alerta("Atención",json.mensaje,"warning",function(){})
						}

					},'json');

				},true);
			}
			else//crea
			{
				

				constantes.confirmacion("Confirmación","Esta apunto de crear un nuevo módulo, desea continuar",'info',function(){
					var controlador = 	$scope.config.apiUrl+"Admin/crearModulo";
					var parametros  = 	"edita="+accion+"&nombreModulo="+nombreModulo+"&urlModulo="+urlModulo+"&padre="+padre;//quiere decir que va a crear uno nuevo
					constantes.consultaApi(controlador,parametros,function(json){
						if(json.continuar == 1)//procede a guardar los privilegios
						{
							//recorro e inserto los privilegios
							var elementoRecorrer     = $(".modulosLista");
							var cantElementosRecorre = $(".modulosLista").length;
							var cont 				 = 0;
							$.each(elementoRecorrer,function(){
								var idPerfil = $(this).attr("rel");
								//alert(idPerfil);
								var ver 	 = ($("#ver"+idPerfil).is(":checked"))?1:0;
								var crear 	 = ($("#crear"+idPerfil).is(":checked"))?1:0;
								var editar 	 = ($("#editar"+idPerfil).is(":checked"))?1:0;
								var borrar 	 = ($("#borrar"+idPerfil).is(":checked"))?1:0;

								var parametros  = 	"edita="+accion+"&idModulo="+json.datos+"&idPerfil="+idPerfil+"&ver="+ver+"&crear="+crear+"&editar="+editar+"&borrar="+borrar;//quiere decir que va a crear uno nuevo
								var controlador = 	$scope.config.apiUrl+"Admin/agregarPrivilegio";
								constantes.consultaApi(controlador,parametros,function(json)
								{
									if(json.continuar == 1)
									{
										cont++;
									}
									else
									{

									}

									//alert(cont+" - "+cantElementosRecorre)
									if(cont == cantElementosRecorre)
									{
										constantes.alerta("Atención","El módulo se ha creado exitosamente","success",function(){
											location.reload();
										})
									}

								},'json');
							});

						}
						else
						{
							constantes.alerta("Atención",json.mensaje,"warning",function(){})
						}

					},'json');

				},true);
		

			}
		}
	}
});

