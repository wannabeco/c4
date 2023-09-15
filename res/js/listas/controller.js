/*
* Controlador que maneja todas las funcionalidades de la creación de usuarios
* @author Farez Prieto @orugal
* @date 15 de Noviembre de 2016
*/
project.controller('listas', function($scope,$http,$q,constantes)
{
	$scope.listas 	= [];
	$scope.initListas = function()
	{
		$scope.config 			=  configLogin;//configuración global
		$.material.init();
		$scope.getListas();
	}

	$scope.getListas = function(idUsuario,edita)
	{
		var controlador = 	$scope.config.apiUrl+"adminListas/getListas";
		var parametros  = 	"";
		constantes.consultaApi(controlador,parametros,function(json){
			$scope.listas  = json.datos;
			$scope.$digest();
		});
	}
	/*
	* Me abre una plantilla que me permitira editar o crear los módulos
	*/
	$scope.cargaPlantillaControl = function(edita)
	{
		$('#modalUsuarios').modal("show");
		var controlador = 	$scope.config.apiUrl+"adminListas/cargaPlantillaModal";
		var parametros  = 	"edita="+edita;
		constantes.consultaApi(controlador,parametros,function(json){
				
			$("#modalCrea").html(json);
			//actualiza el DOM
			$scope.compileAngularElement("#formAgregaListas");
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
project.controller('procesaGuardadoListas', function($scope,$http,$q,constantes)
{
	
	$scope.habilitaForm		=	function()
	{
		//alert("sdfkldsjfkljh");
		$.material.init();
		$scope.config 			=  configLogin;//configuración global
		$scope.interfaz	       = constantes;
		$("#excelFile").fileinput({'showUpload':true, 'previewFileType':'any'});
	}
	$scope.procesaLista = function()
	{
		//validación de campos
		var nombreLista = $("#nombreLista").val();
		var nombreTabla = $("#nombreTabla").val();
		var excelFile = $("#excelFile").val();

		if(nombreLista == "")
		{
			constantes.alerta("Atención","Debe escribir el nombre que identificará la lista","info",function(){})
		}
		else if(nombreTabla == "")
		{
			constantes.alerta("Atención","Debe escribir el nombre que tendrá la lista en la base de datos.","info",function(){})
		}
		else if(excelFile == "")
		{
			constantes.alerta("Atención","Debe seleccionar un archivo de Excel.","info",function(){})
		}
		else
		{
			constantes.confirmacion("Confirmación","Está a punto de generar una lista a partir del archivo de excel seleccionado, esta acción puede tardar dependiendo la cantidad de registros del archivo excel, desea continuar?",'info',function()
			{
					var formData 	=   new FormData($("#formAgregaListas")[0]);
			        var controlador = 	$scope.config.apiUrl+"adminListas/procesaListas"; 
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

	}
});