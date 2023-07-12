/*
* Controlador que maneja todas las funcionalidades de la creación de usuarios
* @author Farez Prieto @orugal
* @date 15 de Noviembre de 2016
*/
project.controller('buscarEmpresas', function($scope,$http,$q,constantes)
{	
    $scope.initbuscarEmpresas = function() {
		$scope.config = configLogin; // configuración global
		$scope.busquedaEmpresas();
	};
	$scope.precioEmpresa = 25000;

	//plantilla informacion de matriz
	$scope.cargaPlantillaInfo = function(idNuevaMatriz,edita){	
		$('#modalParametros').modal("show");
		var controlador = 	$scope.config.apiUrl+"MisMatrices/miMatriz";
		var parametros  = 	"edita="+edita+"&idNuevaMatriz="+idNuevaMatriz;
		constantes.consultaApi(controlador,parametros,function(json){
				
			$("#modalCrea").html(json);
			//actualiza el DOM
			$scope.compileAngularElement("#formAgregaParametros");
		},'');
	}

	//busqueda de todas las matrices
	$scope.busquedaEmpresas = function() {
		var controlador = $scope.config.apiUrl+"BuscarEmpresas/empresasCreadas";
		var parametros = "";
		$.ajax({
			url: controlador,
			type: "GET",
			data: parametros,
			dataType: "json",
			success: function(response) {
				console.log(response);
				$scope.infoEmpresas = response.infoEmpresas;
				$scope.infoMisEmpresas = response.infoMisEmpresas;
				//console.log($scope.infoEmpresas);
				$scope.$apply();
			}
		});
	};
	//buscador
	$scope.searchText = "";
	$scope.search = function() {
		var controlador = $scope.config.apiUrl+"BuscarEmpresas/empresasCreadas";
		var parametros = "buscar="+$scope.searchText;
		$.ajax({
			url: controlador,
			type: "POST",
			data: parametros,
			dataType: "json",
			success: function(response) {
			//console.log(response);
			$scope.infoEmpresas = response.infoEmpresas;
			$scope.infoMisEmpresas = response.infoMisEmpresas;
			$scope.$apply();
			}
		});
	};
	//paginador
	$scope.currentPage = 1;
	$scope.pageSize = 6;

	$scope.setCurrentPage = function(page) {
	$scope.currentPage = page;
	};
	$scope.getPagesArray = function() {
		if (typeof $scope.infoEmpresas === 'undefined' || $scope.infoEmpresas === null) {
			return [];
		  }
		var totalPages = Math.ceil($scope.infoEmpresas.length / $scope.pageSize);
		var pagesArray = [];

		for (var i = 1; i <= totalPages; i++) {
			pagesArray.push(i);
		}
		return pagesArray;
	};
	$scope.setCurrentPage = function(page) {
		if (page < 1) {
		  return;
		}
		$scope.currentPage = page;
		$scope.busquedaEmpresas();
	};


	//agrega a la lista en bage	pago
	var tipos = [];
	var total = 0;
	var idss = [];
	
	$scope.agrega = function(nombre, idEmpresa, precio) {
		var nuevaEmpresa = {
			id: idEmpresa,
			nombre: nombre,
			precio: precio
		};
		var indice = tipos.findIndex(function(elemento) {
			return elemento.id === nuevaEmpresa.id;
		});
		if (indice === -1) {
			tipos.push(nuevaEmpresa);
			total += parseInt(nuevaEmpresa.precio);
			idss.push(idEmpresa);
		}
		$(".tipos").html(
			tipos.map(function(elemento) {
				var palabra = elemento.nombre.trim();
				return (
					'<div class="float-left col-md-8"><span class="badge bg-success" style="font-size:16px; color:white; margin-left:10px;">' +
					palabra +' <a href="#" class="eliminar text-danger" title="Eliminar" data-palabra="' +palabra +'"> X </a></span></div>'
				);
			}).join('') +
			(total !== 0 ? '<div class="float-left col-md-2"> Total: <strong>' + total + '</strong></div>' +
			'<div class="float-left col-md-2" style="padding-right: 0px;top:-10px;"><button class="btn btn-primary float-right" id="Pagar" type="button">Pagar</button></div>': '')
		);
		return false;
	};
	$(document).on('click', '.eliminar', function() {
		var palabraEliminar = $(this).data('palabra');
		var indice = tipos.findIndex(function(elemento) {
			return elemento.nombre.trim() === palabraEliminar;
		});
		if (indice !== -1) {
			var matrizEliminada = tipos[indice];
			tipos.splice(indice, 1);
			total -= matrizEliminada.precio;
			var idEliminar = idss[indice];
        	idss.splice(indice, 1);
			console.log(tipos);
			$(".tipos").html(
				tipos.map(function(elemento) {
					var palabra = elemento.nombre.trim();
					return (
						'<div class="float-left col-md-8"><span class="badge bg-success" style="font-size:16px; color:white; margin-left:10px;">' +
						palabra +' <a href="#" class="eliminar text-danger" title="Eliminar" data-palabra="' +palabra +'"> X </a></span></div>'
					);
				}).join('') +
				(total !== 0 ? '<div class="float-left col-md-2"> Total: <strong>' + total + '</strong></div>' +
				'<div class="float-left col-md-2" style="padding-right: 0px;top:-10px;"><button class="btn btn-primary float-right" id="Pagar" type="button">Pagar</button></div>': '')
			);
		}
	});
	//agrego matrices gratis
	// var tiposGratis = [];
	// var maxTiposGratis = 1;
	// var ids = [];
	// $scope.agregaGratis = function(nombre, idEmpresa) {
	// 	if(tiposGratis.length >= maxTiposGratis){
	// 		constantes.alerta("Atención","Para tu plan, solo podras agregar 1 empresa gratis, por favor verifique y elimine la que no necesite.",'info',function(){});
	// 		return false;
	// 	}
	//   var nuevaEmpresa = {
	// 	id: idEmpresa,
	// 	nombre: nombre
	//   };
	//   var indice = tiposGratis.findIndex(function(elemento) {
	// 	return elemento.id === nuevaEmpresa.id;
	//   });
	//   if (indice === -1) {
	// 	tiposGratis.push(nuevaEmpresa);
	// 	ids.push(idEmpresa);
	//   }
	//   $(".tipos").html(
	// 	tiposGratis.map(function(elemento) {
	// 	  var palabra = elemento.nombre.trim();
	// 	  return (
	// 		'<div class="float-left col-md-6"><span class="badge bg-success" style="font-size:16px; color:white; margin-left:10px;">' +
	// 		palabra +
	// 		' <a href="#" class="eliminar text-danger" data-palabra="' +
	// 		palabra +
	// 		'"> X </a></span></div>'
	// 	  );
	// 	}).join('')+
	// 	(tiposGratis != 0 ?'<button class="btn btn-primary" id="btnAgregar" style="margin-left: 20px;" type="button">Agregar</button>': '')
	//   );
	//   return false;
	// };
	// $(document).on('click', '.eliminar', function() {
	//   var palabraEliminar = $(this).data('palabra');
	//   var indice = tiposGratis.findIndex(function(elemento) {
	// 	return elemento.nombre.trim() === palabraEliminar;
	//   });
	//   if (indice !== -1) {
	// 	tiposGratis.splice(indice, 1);
	// 	var idEliminar = ids[indice];
    //     ids.splice(indice, 1);
	
	// 	$(".tipos").html(
	// 		tiposGratis.map(function(elemento) {
	// 		var palabra = elemento.nombre.trim();
	// 		return (
	// 		  '<span class="badge bg-success" style="font-size:16px; color:white; margin-left:10px;">' +
	// 		  palabra +
	// 		  ' <a href="#" class="eliminar text-danger" data-palabra="' +
	// 		  palabra +
	// 		  '"> X </a></span>'
	// 		);
	// 	  }).join('')+
	// 	  (tiposGratis != 0 ?'<button class="btn btn-primary" id="btnAgregar" style="margin-left: 20px;" type="button">Agregar</button>': '')
	// 	);
	//   }
	// });
	$(document).on('click', '#btnAgregar', function() {
		if(tiposGratis.length < 1){
			constantes.alerta("Atención","No se pudo agregar ninguna empresa, por favor verifique.",'info',function(){});
		}
		else{
			constantes.confirmacion("Confirmación","Esta apunto de agregar empresa, ¿desea continuar?",'info',function(){
				var controlador = $scope.config.apiUrl+"BuscarEmpresas/creaGratisrel";
				var parametros  = 	"id="+ids;
				constantes.consultaApi(controlador,parametros,function(json){
					if(json.continuar == 1){
						constantes.alerta("Atención",json.mensaje,"success",function(){
							window.location = $scope.config.apiUrl+"Empresas/empresas/37";
						});
					}
					else{
						constantes.alerta("Atención",json.mensaje,"warning",function(){});
					}
				});
			});
		}
	});
	$(document).on('click', '#Pagar', function() {
		if(tipos.length < 1){
			constantes.alerta("Atención","Por favor verifique no hay matrices por comprar.",'info',function(){});
		}
		else{
			var proveedor = "payu";
			constantes.confirmacion("Atención","Esta apunto de realizar el pago, ¿Desea continuar?. Recuerde activar las ventanas emergentes antes de continuar.",'info',function(){
				//se abre ventana pop
				var codigo = $("#codigoPago").val();
				//verifico que la empresa no cuente con ninguna de las matrices para poder continuar.
					var controlador = $scope.config.apiUrl+"BuscarEmpresas/getrelEmpresa";
					var parametros  = "id="+idss;
					constantes.consultaApi(controlador,parametros,function(json){
						if(json.continuar ==1 ){
							constantes.alerta("Atención",json.mensaje,"warning",function(){});
						}
						else{
							var controlador = $scope.config.apiUrl+"PagoMatriz/insetCodigoEmpresas";
							var parametros  = "proveedor="+proveedor;
							constantes.consultaApi(controlador,parametros,function(json){
								if(json.continuar == 1){
									var idPago = json.datos;	
									var controlador = $scope.config.apiUrl+"PagoMatriz/insetCEmpresaTemporal";
									var parametros  = "proveedor="+proveedor+"&idPago="+json.datos+"&tipo="+JSON.stringify(tipos);
									constantes.consultaApi(controlador,parametros,function(json){
										
										// eliminar cuando se tenga pasarela de pago
										var controlador = $scope.config.apiUrl+"BuscarEmpresas/creaGratisrel";
										var parametros  = 	"id="+idss;
										constantes.consultaApi(controlador,parametros,function(json){
											if(json.continuar == 1){
												constantes.alerta("Atención",json.mensaje,"success",function(){
													window.location = $scope.config.apiUrl+"Empresas/empresas/37";
												});
											}
											else{
												constantes.alerta("Atención",json.mensaje,"warning",function(){});
											}
										});	


										var ventana ="";
										var pago ="empresa";
										var parametro = "idPago="+ idPago+"&pago="+pago;
										var ruta = $scope.config.apiUrl+"Pagos/procesoPagoOnline/?"+parametro;
										var ventana = window.open(ruta, "pago_payu" , "width=600,height=880,left = 420");
										var tiempo= 0;
											var interval = setInterval(function(){
												
												if(ventana.closed !== false) {
													window.clearInterval(interval);
													window.location = $scope.config.apiUrl+"Empresas/empresas/37";
												} else {
													tiempo +=1;
												}
										},1000)
									});
								}
								else
								{
								constantes.alerta("Atención",json.mensaje,"error",function(){})
								}
							});
						}
					});
			});
		}
	});

	//seguerir matriz
	$scope.crearnueva =function(){
		$('#modalMatriz').modal("show");
	 	var controlador = $scope.config.apiUrl+"MisMatrices/sugerirMatriz";
	 	var parametros  = "";
	 	constantes.consultaApi(controlador,parametros,function(json){
				
	 		$("#modalCreaNueva").html(json);
	 		// actualiza el DOM
	 		$scope.compileAngularElement("#formMatriz");
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